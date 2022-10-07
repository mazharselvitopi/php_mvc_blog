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
                header('Location: '.$config['root_url'].'main/serviceNotFound');
                //exit ('Service sinifi bulunamadi: ' . $serviceClass);
            }
        } else {
            header('Location: '.$config['root_url'].'main/serviceFileNotFound');
        }
    }

    public function render ($view, $params = [])
    {
        View::render($this->config, $view, $params);
    }

    public function renderUserLevelAdmin ($view, $params = [])
    {
        if($params['is_entered'] == false) 
        {
            $this->alertReturn($params, "danger", "Erisim Problemi", "Bu sayfaya erisemezsiniz",
            $this->config['root_url'].'main/index', 'Anasayfa');
        } 
        else 
        {
            if ($params['user_level'] == 2)
            {
                
                $this->render($view, $params);
            }
            else
            {
                $this->alertReturn($params, "danger", "Erisim Problemi", "Bu sayfaya erisemezsiniz",
                $this->config['root_url'].'main/index', 'Anasayfa');
                
            }
        }
    }

    public function redirect ($url) 
    {
        header('Location: '.$this->config['root_url'].$url);
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
        
        $params['page_name'] = $params['alert']['title'];
        $this->render ('returnAlert', $params);
    }

    //////////////  Hatalar //////////////////////////
    /**                                             //
     * controllerFileNotFound                       //
     * controllerNotFound                           //
     * actionNotFound                               //
     * repoFileNotFound                             //
     * repoNotFound                                 //
     * viewFileNotFound                             //
     * serviceFileNotFound                          //
     * serviceNotFound                              //
     */                                             //
    //////////////////////////////////////////////////

    public function controllerFileNotFoundActionGetRequest ($params = [])
    {
        $params['alert'] = [
            'type' => 'warning', 
            'title' => 'File not found', 
            'content' => 'please go to the link',
            'link' => $this->config['root_url'],
            'link_title' => 'Anasayfaya git'
            
        ];

        $this->render ('notFound', $params);
    }

    public function controllerNotFoundActionGetRequest ($params = [])
    {
        $params['alert'] = [
            'type' => 'warning', 
            'title' => 'Controller not found', 
            'content' => 'please go to the link',
            'link' => $this->config['root_url'],
            'link_title' => 'Anasayfaya git'
        ];

        $this->render ('notFound', $params);
    }

    public function actionNotFoundActionGetRequest ($params = [])
    {
        $params['alert'] = [
            'type' => 'warning', 
            'title' => 'Action not found', 
            'content' => 'please go to the link',
            'link' => $this->config['root_url'],
            'link_title' => 'Anasayfaya git'
        ];

        $this->render ('notFound', $params);
    }

    public function repoNotFoundActionGetRequest ($params = [])
    {
        $params['alert'] = [
            'type' => 'danger', 
            'title' => 'Repo not found', 
            'content' => 'please go to the link',
            'link' => $this->config['root_url'],
            'link_title' => 'Anasayfaya git',
        ];

        $this->render ('notFound', $params);
    }

    public function repoFileNotFoundActionGetRequest ($params = [])
    {
        $params['alert'] = [
            'type' => 'danger', 
            'title' => 'Repo file not found', 
            'content' => 'please go to the link',
            'link' => $this->config['root_url'],
            'link_title' => 'Anasayfaya git',
        ];

        $this->render ('notFound', $params);
    }

    public function viewFileNotFoundActionGetRequest ($params = [])
    {
        $params['alert'] = [
            'type' => 'danger', 
            'title' => 'View file not found', 
            'content' => 'please go to the link',
            'link' => $this->config['root_url'],
            'link_title' => 'Anasayfaya git',
        ];
        
        $this->render ('notFound', $params);
    }

    public function serviceNotFoundActionGetRequest ($params = [])
    {
        $params['alert'] = [
            'type' => 'danger', 
            'title' => 'Service not found', 
            'content' => 'please go to the link',
            'link' => $this->config['root_url'],
            'link_title' => 'Anasayfaya git'
        ];

        $this->render ('notFound', $params);
    }

    public function serviceFileNotFoundActionGetRequest ($params = [])
    {
        $params['alert'] = [
            'type' => 'danger', 
            'title' => 'Service file not found', 
            'content' => 'please go to the link',
            'link' => $this->config['root_url'],
            'link_title' => 'Anasayfaya git',
        ];

        $this->render ('notFound', $params);
    }

}