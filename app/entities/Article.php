<?php

class Article 
{
    private $id;
    private $title;
    private $summary;
    private $content;
    private $categoryId;
    private $authorId;
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

    public function setAuthorId ($authorId )
    {
        $this->authorId = $authorId;
        return $this;
    }

    public function getAuthorId ()
    {
        return $this->authorId;
    }

    public function setCategoryId ($categoryId )
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function getCategoryId ()
    {
        return $this->categoryId;
    }

    public function setContent ($content )
    {
        $this->content = $content;
        return $this;
    }

    public function getContent ()
    {
        return $this->content;
    }

    public function setSummary ($summary )
    {
        $this->summary = $summary;
        return $this;
    }

    public function getSummary ()
    {
        return $this->summary;
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