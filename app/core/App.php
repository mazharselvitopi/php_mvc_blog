<?php

class App
{
    protected $controller;
    protected $action;
    protected $method;
    protected $params;
    protected $mainUrl;


    public function __construct($config)
    {
        $this->mainUrl              = $config['main_url'];
        $this->method               = $_SERVER['REQUEST_METHOD'];
        $urlArray                   = $this->parseUrl();
        $controllerFile             = $config['controllers_dir'] . $urlArray[0] . 'Controller.php';
        $controllerClass            = $urlArray[0] . 'Controller';
        array_shift($urlArray);
        $method                     = $_SERVER['REQUEST_METHOD'];


        if ($method == 'GET') $this->method = 'GetRequest';
        elseif ($method == 'POST') $this->method = 'PostRequest';
        else $this->method = 'GetRequest';

        $controllerAction           = $urlArray[0] . 'Action' . $this->method;
        array_shift($urlArray);
        $this->params = $urlArray;

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controllerClass)) {
                $this->controller = new $controllerClass;
                $this->controller->setConfig($config);
                if (method_exists($this->controller, $controllerAction)) {
                    $this->action = $controllerAction;
                    call_user_func_array([$this->controller, $this->action], [$this->params]);
                } else {
                    exit ('Action bulunamadi: '. $controllerAction);
                }
            } else {
                exit ('Controller class\'i bulunamadi: '. $controllerClass);
            }
        } else {
            exit ('Controller dosyasi bulunamadi: '. $controllerFile);
        }
    }

    public function parseUrl()
    {
        $url = $this->mainUrl;
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = $this->mainUrl;
        }
        $urlArray = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
        if (count($urlArray) < 2) $urlArray[1] = 'default';
        return $urlArray;
    }
}
