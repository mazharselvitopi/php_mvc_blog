<?php
class Controller 
{
    protected $config;
    public function setConfig($config)
    {
        $this->config = $config;   
    }

    public function service ($service) 
    {
        $serviceFile = $this->config['services_dir'].$service.'Service.php';
        $serviceClass = $service.'Service';
        if (file_exists($serviceFile)) {
            require_once $serviceFile;
            if (class_exists($serviceClass)) {
                $serviceClass = new $serviceClass;
                $serviceClass->setConfig ($this->config);
                return $serviceClass;
            } else {
                exit ('Service sinifi bulunamadi: ' . $serviceClass);
            }
        } else {
            exit ('Service dosyasi bulunamadi: ' . $serviceFile);
        }
    }

    public function render ($view, $params = [])
    {
        View::render($this->config, $view, $params);
    }
}