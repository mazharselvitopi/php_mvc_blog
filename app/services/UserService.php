<?php

class UserService extends Service
{
    public function getUsersOnPage ($params = [])
    {
        if (!isset ($params['page']))
            $params['page'] = 1;

        if (intval($params['page']) == 0)
            $params['page'] = 1;
        
        $nowPage = $params['page'];

        $userRepo = $this->repo('User');

        $totalUsers = $userRepo->getTotalUsers();

        $limit = $params['config']['user_page_limit'];

        $totalPage = $totalUsers / $limit;

        if ($totalPage < 1) $totalPage = 1;
        if ($totalPage > intval($totalPage)) $totalPage++;
        if ($totalPage < $nowPage) $nowPage = $totalPage;
        $users = $userRepo->getUsersOnPage($nowPage);
        $params['data'] = $users;
        $params['total_page'] = $totalPage;
        $params['page'] = $nowPage;

        return $params;
    }

    public function getUserList ()
    {
        $userRepo = $this->repo('User');
        return $userRepo->getUserList();
    }

    public function getUser ($email)
    {
        $userRepo = $this->repo('User');
        return $userRepo->getUser($email);
    }

    public function getUserWithId ($params = [])
    {
        $userRepo = $this->repo('User');
        $params['user'] = $userRepo->getUserWithId($params['id']);

        return $params;

    }

    public function doesEmailExist ($email)
    {
        $userRepo = $this->repo('User');
        return $userRepo->doesEmailExist ($email);
    }

    public function isCorrectEmailAndPassword ($email, $password)
    {
        $userRepo = $this->repo('User');
        return $userRepo->isCorrectEmailAndPassword ($email, $this->encrypt($password));
    }

    public function addUser ($params = [])
    {
        $userRepo = $this->repo('User');

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $this->encrypt($_POST['password']);
        $rePassword = $this->encrypt($_POST['re_password']);

        $params['data']['name'] = $name;
        $params['data']['surname'] = $surname;
        $params['data']['email'] = $email;
        $params['data']['password'] = $_POST['password'];
        $params['data']['re_password'] = $_POST['re_password'];


        $isEmpty = $name == '' || $surname == '' || $email == '' || $password == '' || $rePassword == '';
        $validateEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $isEqualPasswordAndRePassword = $password == $rePassword;
        $doesEmailExist = $this->doesEmailExist($_POST['email']) == null;

        if (!$isEmpty && $validateEmail && $isEqualPasswordAndRePassword && $doesEmailExist)
        {
            $userRepo->addUser($name, $surname, $email, $password);
            
            $params = $this->alertReturn($params, 'success', 'Tebrikler.. <b>'.$name.' '. $surname.'</b>', 'Tebrik ederiz. Basariyla kaydoldunuz. Simdi giris yapabilirsiniz.',
                                $this->config['root_url'].'main/index', 'Anasayfaya gidin...');
        }
        elseif ($isEmpty)
        {
            $params = $this->alertReturn($params, 'warning', 'Bos alan', 'Bos alan girilemez',
                                $this->config['root_url'].'main/index', 'Anasayfaya gidin...');
        }
        elseif (!$validateEmail)
        {
            $params = $this->alertReturn($params, 'warning', 'Email gecersiz', 'Lutfen gecerli bir email adresi girin',
                                    $this->config['root_url'].'main/index', 'Anasayfaya gidin...');
        }
        elseif (!$isEqualPasswordAndRePassword)
        {
            $params = $this->alertReturn($params, 'warning', 'Parola Uyusmazligii', 'Lutfen uyumlu parola girin',
                                    $this->config['root_url'].'main/index', 'Anasayfaya gidin...');
        }
        elseif (!$doesEmailExist)
        {
            $params = $this->alertReturn($params, 'warning', 'Email Adresi Kullaniliyor', 'Bu email adresi kullanilmaktadir. Lutfen baska bir email adresi giriniz.',
                                    $this->config['root_url'].'main/index', 'Anasayfaya gidin...');
        }

        
        return $params;
    }

    public function updateUser ($params = [])
    {
        $userRepo = $this->repo('User');

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $surname = $_POST['surname'];
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['new_password'];
        $newPasswordAgain = $_POST['new_password_again'];
        $userLevel = $_POST['user_level'];

        $user = $userRepo->getUser($email);
        
        $password = $user->getPassword();

        $isEmpty = $name == '' || $surname == '' || $userLevel == '';

        $isOldPasswordEmpty = $oldPassword == '';

        $areNewPasswordsEmpty = $newPassword == '' || $newPasswordAgain == '';

        $doesThePasswordMatch = $newPassword == $newPasswordAgain;


        if (!$isOldPasswordEmpty)
        {
            $oldPassword = $this->encrypt($oldPassword);
        }
        
        $isOldPasswordTruth = $oldPassword == $password;

        if (!$areNewPasswordsEmpty && $doesThePasswordMatch && !$isOldPasswordEmpty)
        {
            
            $newPassword = $this->encrypt($newPassword);
            $newPasswordAgain = $this->encrypt($newPasswordAgain);
        }

        $superAdmin = $params['config']['super_admin_id'] == $id;

        if ($superAdmin)
        {
            if ($userLevel == 2)
                $superAdmin = true;
            else
                $superAdmin = false;
        }
        else
        {
            $superAdmin = true;
        }

        if (!$isEmpty && $isOldPasswordEmpty && $superAdmin)
        {
            // ad soyad ve level degisiyor

            $userRepo->updateUser( $id, $name, $surname, $password, $userLevel);
            $params = $this->alertReturn($params, 'success', 'Guncelleme Basarili', 'Problemsiz bir sekilde guncellendi');
        }
        elseif (!$isEmpty && !$isOldPasswordEmpty && !$areNewPasswordsEmpty && $doesThePasswordMatch && $isOldPasswordTruth && $superAdmin)
        {
            // password burada degisiyor

            $password = $newPassword;
            $userRepo->updateUser( $id, $name, $surname, $password, $userLevel);

            $params = $this->alertReturn($params, 'success', 'Guncelleme Basarili', 'Problemsiz bir sekilde guncellendi');
        }
        elseif ($isEmpty)
        {
            // eger ad soyad ve userlevel bos ise
            $params = $this->alertReturn($params, 'warning', 'Guncelleme Basarisiz', 'Ad ve Soyad kismi bos olabilir');
        }

        elseif (!$isOldPasswordEmpty && !$isOldPasswordTruth)
        {
            // eger eski parola yanlis ise
            $params = $this->alertReturn($params, 'warning', 'Guncelleme Basarisiz', 'Eski parolaniz yanlis '.$oldPassword.' | '.$user->getPassword() );
        }
        elseif (!$isOldPasswordEmpty && $isOldPasswordTruth && $areNewPasswordsEmpty)
        {
            // eger eski parola dogru ama yeni parolalar bos ise
            $params = $this->alertReturn($params, 'warning', 'Guncelleme Basarisiz', 'Yeni parolalar bos');
        }
        elseif (!$isOldPasswordEmpty && $isOldPasswordTruth && !$areNewPasswordsEmpty && !$doesThePasswordMatch)
        {
            // eski parola dogru ama yeni parolalar eslesmiyor ise
            $params = $this->alertReturn($params, 'warning', 'Guncelleme Basarisiz', 'Yeni Parolalar eslesmiyor');
        }
        elseif (!$superAdmin)
        {
            // superadmin level seviyesi degistiriliyor
            $params = $this->alertReturn($params, 'danger', 'Guncelleme Basarisiz', 'Super admin yetkileri degistirilemez');
        }
        else
        {
            // bir problem var
            $params = $this->alertReturn($params, 'warning', 'Guncelleme Basarisiz', 'Bir problem var');
        }
        
        return $params;
    }

    public function deleteUser ($params)
    {
        $id = $params['id'];
        $userRepo = $this->repo('User');
        if ($id == $params['config']['super_admin_id'])
        {
            $params = $this->alertReturn($params, 'danger', 'Silme Basarisiz', 'Super Admin Silinemez');
        }
        else
        {
            if ($userRepo->deleteUser($id))
            {
                $params = $this->alertReturn($params, 'success', 'Silme Basarili', 'Basariyla kayit silindi.');
            }
            else
            {
                $params = $this->alertReturn($params, 'danger', 'Silme Basarisiz', 'Bir problem var');
            }
        }
        return $params;
    }
}