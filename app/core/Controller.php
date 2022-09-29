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

    public function redirect ($url) 
    {
        header('Location: '.$this->config['root_url'].$url);
    }

    public function alertReturn ($sendData, 
    $type = 'info', 
    $title = 'Bilgilendirme',
    $content = '',
    $link = '',
    $link_title = '')
    {
        if ($content != '' && $link != '' && $link_title != '') {
            $sendData['alert'] = [
                'type' => $type,
                'title' => $title,
                'content' => $content,
                'link' => $link,
                'link_title' => $link_title
            ];
        } elseif ($content != '') {
            $sendData['alert'] = [
                'type' => $type,
                'title' => $title,
                'content' => $content,
            ];
        } else {
            $sendData['alert'] = [
                'type' => $type,
                'title' => $title,
            ];
        }
        
        $sendData['page_name'] = $sendData['alert']['title'];
        $this->render ('returnAlert', $sendData);
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

        $this->render ('notFound', [
                                            'is_entered' => $params['is_entered'],
                                            'alert' =>  [
                                            'type' => 'warning', 
                                            'title' => 'File not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git'
                                            
                                        ]
        ]);
    }

    public function controllerNotFoundActionGetRequest ($params = [])
    {

        $this->render ('notFound', [
                                        'is_entered' => $params['is_entered'],
                                        'alert' =>  [
                                            'type' => 'warning', 
                                            'title' => 'Controller not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git'
                                        ]
        ]);
    }

    public function actionNotFoundActionGetRequest ($params = [])
    {

        $this->render ('notFound', [
                                        'is_entered' => $params['is_entered'],
                                        'alert' =>  [
                                            'type' => 'warning', 
                                            'title' => 'Action not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git'
                                        ]
        ]);
    }

    public function repoNotFoundActionGetRequest ($params = [])
    {

        $this->render ('notFound', [
                                        'is_entered' => $params['is_entered'],
                                        'alert' =>  [
                                            'type' => 'danger', 
                                            'title' => 'Repo not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git',
                                            'is_entered'        => $params['is_entered']
                                        ]
        ]);
    }

    public function repoFileNotFoundActionGetRequest ($params = [])
    {

        $this->render ('notFound', [
                                        'is_entered' => $params['is_entered'],
                                        'alert' =>  [
                                            'type' => 'danger', 
                                            'title' => 'Repo file not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git',
                                            'is_entered'        => $params['is_entered']
                                        ]
        ]);
    }

    public function viewFileNotFoundActionGetRequest ($params = [])
    {

        $this->render ('notFound', [
                                        'is_entered' => $params['is_entered'],
                                        'alert' =>  [
                                            'type' => 'danger', 
                                            'title' => 'View file not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git',
                                            'is_entered'        => $params['is_entered']
                                        ]
        ]);
    }

    public function serviceNotFoundActionGetRequest ($params = [])
    {

        $this->render ('notFound', [
                                        'is_entered' => $params['is_entered'],
                                        'alert' =>  [
                                            'type' => 'danger', 
                                            'title' => 'Service not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git',
                                            'is_entered'        => $params['is_entered']
                                        ]
        ]);
    }

    public function serviceFileNotFoundActionGetRequest ($params = [])
    {

        $this->render ('notFound', [
                                        'is_entered' => $params['is_entered'],
                                        'alert' =>  [
                                            'type' => 'danger', 
                                            'title' => 'Service file not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git',
                                            'is_entered'        => $params['is_entered']
                                        ]
        ]);
    }

}