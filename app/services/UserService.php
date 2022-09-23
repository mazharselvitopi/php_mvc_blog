<?php

class UserService extends Service
{
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