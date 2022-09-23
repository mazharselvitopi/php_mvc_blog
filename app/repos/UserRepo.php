<?php
class UserRepo extends Repo
{
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

    public function isCorrectEmailAndPassword ($email, $password)
    {
        $userData = $this->fetch ("select * from users where email = ? and password = ?", [$email, $password]);
        return $userData;
        // devam edecegim
    }

    public function addUser ($name, $surname, $email, $password)
    {
        $query = "inser into users (name, surname, email, password) values (?, ?, ?, ?)";
        return $this->query($query, [$name, $surname, $email, $password]);
    }

    public function updateUser ($name, $surname, $email, $password)
    {
        $query = "update users set name = ?, surname = ?, password = ? where email = ?";
        return $this->query($query, [$name, $surname, $password, $email]);

    }

    public function deleteUser ($email)
    {
        $query = "delete from users where email = ?";
        return $this->query($query, [$email]);
    }

    public function getUserEntity ($user)
    {
        $userEntity = $this->entity("User");
        $userEntity ->setId($user['id'])
                    ->setName($user['name'])
                    ->setSurname($user['surname'])
                    ->setEmail($user['email'])
                    ->setCreatedDate($user['created_date'])
                    ->setUpdatedDate($user['updated_date']);
        
        return $userEntity;
    }


}