<?php
class UserRepo extends Repo
{
    public function getUsersOnPage ($page) 
    {
        $limit = $this->config['user_page_limit'];
        
        if ($page < 1) $page = 0;
        else $page--;

        $offset = $page * $limit;

        $query = 'select * from users order by id limit ?, ?';

        $stmt = $this->db->prepare ($query);

        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);

        $stmt->execute();

        $userList = $stmt->fetchAll();

        $data = [];

        foreach ($userList as $user) {
            $userEntity = $this->getUserEntity($user);

            $data[] = $userEntity;
        }

        return $data;

    }

    public function getTotalUsers ()
    {
        $query = 'select count(*) as total from users';

        $total = $this->fetch($query)['total'];

        return $total;

    }

    public function getUserList ()
    {
        $usersData = $this->fetchAll("select * from users");
        $userList = [];

        foreach ($usersData as $user) {
            $userEntity = $this->getUserEntity($user);

            $userList[] = $userEntity;
        }
        return $userList;
    }

    public function getUser ($email)
    {
        $user = $this->fetch("select * from users where email = ?", [$email]);
        $userEntity = $this->getUserEntity($user);
        
        return $userEntity;
    }

    public function getUserWithId ($id)
    {
        $user = $this->fetch ('select * from users where id = ?', [$id]);
        $userEntity = $this->getUserEntity($user);

        return $userEntity;
    }

    public function doesEmailExist ($email)
    {
        $userData = $this->fetch ("select * from users where email = ?", [$email]);
        return $userData;
    }

    public function isCorrectEmailAndPassword ($email, $password)
    {
        $userData = $this->fetch ("select * from users where email = ? and password = ?", [$email, $password]);
        return $userData;
        // devam edecegim
    }

    public function addUser ($name, $surname, $email, $password)
    {
        $query = "insert into users (name, surname, email, password) values (?, ?, ?, ?)";
        $stmt = $this->db->prepare ($query);
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(2, $surname, PDO::PARAM_STR);
        $stmt->bindValue(3, $email, PDO::PARAM_STR);
        $stmt->bindValue(4, $password, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    public function updateUser ($id, $name, $surname, $password, $userLevel)
    {
        $query = "update users set name = ?, surname = ?, password = ? , user_level = ? where id = ?";
        return $this->query($query, [$name, $surname, $password, $userLevel, $id]);

    }

    public function deleteUser ($id)
    {
        $query = "delete from users where id = ?";
        return $this->query($query, [$id]);
    }

    public function getUserEntity ($user)
    {
        $userEntity = $this->entity("User");
        $userEntity ->setId($user['id'])
                    ->setName($user['name'])
                    ->setSurname($user['surname'])
                    ->setEmail($user['email'])
                    ->setPassword($user['password'])
                    ->setUserLevel($user['user_level'])
                    ->setCreatedDate($user['created_date'])
                    ->setUpdatedDate($user['updated_date']);
        
        return $userEntity;
    }


}