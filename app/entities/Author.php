<?php

class Author
{
    private $id;
    private $userId;

    public function setUserId ($userId )
    {
        $this->userId = $userId;
        return $this;
    }

    public function getUserId ()
    {
        return $this->userId;
    }

    public function setId ($id )
    {
        $this->id = $id;
        return $this;
    }

    public function getId ()
    {
        return $this->id;
    }
}