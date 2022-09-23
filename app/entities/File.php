<?php

class File 
{
    private $id;
    private $path;
    private $extension;
    private $size;
    private $createdDate;
    private $updatedDate;

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

    public function setSize ($size)
    {
        $this->size = $size;
        return $this;
    }

    public function getSize ()
    {
        return $this->size;
    }

    public function setExtension ($extension)
    {
        $this->extension = $extension;
        return $this;
    }

    public function getExtension ()
    {
        return $this->extension;
    }

    public function setPath ($path)
    {
        $this->path = $path;
        return $this;
    }

    public function getPath ()
    {
        return $this->path;
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