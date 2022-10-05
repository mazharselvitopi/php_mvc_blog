<?php

class User 
{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $userLevel;
    private $createdDate;
    private $updatedDate;

    public function setUserLevel ($userLevel)
    {
        $this->userLevel = $userLevel;
        return $this;
    }

    public function getUserLevel ()
    {
        return $this->userLevel;
    }

    public function setUpdatedDate ($updatedDate)
    {
        $this->updatedDate = $updatedDate;
        return $this;
    }

    public function getUpdatedDate ()
    {
        return $this->updatedDate;
    }

    public function setCreatedDate ($createdDate)
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    public function getCreatedDate ()
    {
        return $this->createdDate;
    }

    public function setPassword ($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword ()
    {
        return $this->password;
    }

    public function setEmail ($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail ()
    {
        return $this->email;
    }

    public function setSurname ($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    public function getSurname ()
    {
        return $this->surname;
    }

    public function setId ($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId ()
    {
        return $this->id;
    }

    public function setName ($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName ()
    {
        return $this->name;
    }


}