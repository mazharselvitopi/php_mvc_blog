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

        $users = $userRepo->getUsersOnPage($nowPage);

        $totalUsers = $userRepo->getTotalUsers();

        $limit = $params['config']['user_page_limit'];

        $totalPage = $totalUsers / $limit;

        if ($totalPage < 1) $totalPage = 1;
        if ($totalPage > intval($totalPage)) $totalPage++;
        
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

    public function doesEmailExist ($email)
    {
        $userRepo = $this->repo('User');
        return $userRepo->doesEmailExist ($email);
    }

    public function isCorrectEmailAndPassword ($email, $password)
    {
        $userRepo = $this->repo('User');
        return $userRepo->isCorrectEmailAndPassword ($email, $password);
    }

    public function addUser ($name, $surname, $email, $password)
    {
        $userRepo = $this->repo('User');
        return $userRepo->addUser($name, $surname, $email, $password);
    }

    public function updateUser ($name, $surname, $email, $password)
    {
        $userRepo = $this->repo('User');
        return $userRepo->updateUser($name, $surname, $email, $password);
    }

    public function deleteUser ($email)
    {
        $userRepo = $this->repo('User');
        return $userRepo->deleteUser($email);

    }
}