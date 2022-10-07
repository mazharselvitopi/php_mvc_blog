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

    public function alertReturn ($params, 
    $type = 'info', 
    $title = 'Bilgilendirme',
    $content = '',
    $link = '',
    $link_title = '')
    {
        if ($content != '' && $link != '' && $link_title != '') {
            $params['alert'] = [
                'type' => $type,
                'title' => $title,
                'content' => $content,
                'link' => $link,
                'link_title' => $link_title
            ];
        } elseif ($content != '') {
            $params['alert'] = [
                'type' => $type,
                'title' => $title,
                'content' => $content,
            ];
        } else {
            $params['alert'] = [
                'type' => $type,
                'title' => $title,
            ];
        }
        
        return $params;
    }

    public function encrypt ($pass) 
    {
        $pass = sha1(base64_encode(md5(base64_encode($pass))));
        $pass = substr($pass, 0, 32);
        return $pass;
    }


}