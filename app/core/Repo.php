<?php
class Repo 
{

    protected $db;
    protected $config;

    public function setConfig ($config)
    {
        $this->config = $config;
        $this->db = new PDO ($this->config['db_dsn'], $this->config['db_usr'], $this->config['db_pwd']);
    }

    public function fetch ($query, $params = []) 
    {
        $stmt = $this->db->prepare ($query);
        $stmt->execute ($params);
        return $stmt->fetch();
    }

    public function fetchAll ($query, $params = [])
    {
        $stmt = $this->db->prepare ($query);
        $stmt->execute ($params);
        return $stmt->fetchAll();
    }


    public function query ($query, $params = [])
    {
        $stmt = $this->db->prepare($query);

        // donus degeri true yada false olur.
        // execute isleminin donus degeri true yada false olur
        return $stmt->execute($params);
    }

    public function entity ($entity) 
    {
        $entityFile = $this->config['entities_dir'].$entity.'.php';
        $entityClass = $entity;
        if (file_exists($entityFile)) {
            require_once $entityFile;
            if (class_exists($entityClass)) {
                $entityClass = new $entityClass;
                // $entityClass->setConfig ($this->config);
                return $entityClass;
            } else {
                exit ('Entity sinifi bulunamadi: ' . $entityClass);
            }
        } else {
            exit ('Entity dosyasi bulunamadi: ' . $entityFile);
        }
    }

}