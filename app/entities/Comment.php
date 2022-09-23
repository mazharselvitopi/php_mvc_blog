<?php

class Comment
{
    private $id;
    private $nameSurname;
    private $email;
    private $content;
    private $articleId;
    private $createdDate;
    private $updatedDate;
    private $confirmation;

    public function setConfirmation ($confirmation)
    {
        $this->confirmation = $confirmation;
        return $this;
    }

    public function getConfirmation ()
    {
        return $this->confirmation;
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

    public function setArticleId ($articleId)
    {
        $this->articleId = $articleId;
        return $this;
    }

    public function getArticleId ()
    {
        return $this->articleId;
    }

    public function setContent ($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getContent ()
    {
        return $this->content;
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

    public function setNameSurname ($nameSurname)
    {
        $this->nameSurname = $nameSurname;
        return $this;
    }

    public function getNameSurname ()
    {
        return $this->nameSurname;
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

}