<?php

class App
{
    protected $controller;
    protected $action;
    protected $method;
    protected $params;
    protected $mainUrl;
    protected $isEntered;


    public function __construct($config)
    {
        if (isset($_SESSION['username']) && isset($_SESSION['password']))
            $this->isEntered = true;
        else {
            
            $this->isEntered = false;
        }
        
        
        
        $this->mainUrl              = $config['main_url'];
        $this->method               = $_SERVER['REQUEST_METHOD'];
        $urlArray                   = $this->parseUrl();
        $controllerFile             = $config['controllers_dir'] . $urlArray[0] . 'Controller.php';
        $controllerClass            = $urlArray[0] . 'Controller';
        $pageName                   = strtoupper($urlArray[0]).' | ';
        array_shift($urlArray);
        $method                     = $_SERVER['REQUEST_METHOD'];
        


        if ($method == 'GET') $this->method = 'GetRequest';
        elseif ($method == 'POST') $this->method = 'PostRequest';
        else $this->method = 'GetRequest';

        $pageName                  .= strtoupper($urlArray[0]);
        $controllerAction           = $urlArray[0] . 'Action' . $this->method;
        array_shift($urlArray);

        // parametreleri key => value seklinde ayarlama yapiyorum
        if (count($urlArray) >= 2 ){
            for ($i = 0; $i < count($urlArray); $i += 2) {
                    
                if (isset($urlArray[$i+1]))
                    $this->params[$urlArray[$i]] = $urlArray[$i+1];
                else
                    $this->params[$urlArray[$i]] = 'default';
                
            }
        } else {
            $this->params = [];
        }

        // view'lerde lazim olacak controller ve action parametreleri
        $this->params['now_controller'] = $controllerClass;
        $this->params['now_action'] = $controllerAction;
        $this->params['is_entered'] = $this->isEntered;
        $this->params['config']     = $config;
        $this->params['page_name']  = $pageName;

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controllerClass)) {
                $this->controller = new $controllerClass;
                $this->controller->setConfig($config);
                if (method_exists($this->controller, $controllerAction)) {
                    $this->action = $controllerAction;
                    call_user_func_array([$this->controller, $this->action], [$this->params]);
                } else {
                    header('Location: '.$config['root_url'].'main/actionNotFound');
                    //exit ('Action bulunamadi: '. $controllerAction);
                }
            } else {
                header('Location: '.$config['root_url'].'main/controllerNotFound');
                //exit ('Controller class\'i bulunamadi: '. $controllerClass);
            }
        } else {
            header('Location: '.$config['root_url'].'main/controllerFileNotFound');
            //exit ('Controller dosyasi bulunamadi: '. $controllerFile);
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
