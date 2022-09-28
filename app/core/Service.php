<?php

class Service
{

    protected $config;
    public function setConfig($config)
    {
        $this->config = $config;   
    }

    public function repo ($repo) 
    {
        $repoFile = $this->config['repos_dir'].$repo.'Repo.php';
        $repoClass = $repo.'Repo';
        if (file_exists($repoFile)) {
            require_once $repoFile;
            if (class_exists($repoClass)) {
                $repoClass = new $repoClass;
                $repoClass->setConfig ($this->config);
                return $repoClass;
            } else {
                header('Location: '.$config['root_url'].'main/repoNotFound');
                //exit ('Repo sinifi bulunamadi: ' . $repoClass);
            }
        } else {
            header('Location: '.$config['root_url'].'main/repoFileNotFound');
            //exit ('Repo dosyasi bulunamadi: ' . $repoFile);
        }
    }


}