<?php

class Category
{
    private $id;
    private $title;
    private $createdDate;
    private $updatedDate;

    public function setUpdatedDate ($updatedDate )
    {
        $this->updatedDate = $updatedDate;
        return $this;
    }

    public function getUpdatedDate ()
    {
        return $this->updatedDate;
    }

    public function setCreatedDate ($createdDate )
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    public function getCreatedDate ()
    {
        return $this->createdDate;
    }

    public function setTitle ($title )
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle ()
    {
        return $this->title;
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