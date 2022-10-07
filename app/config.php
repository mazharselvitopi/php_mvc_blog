<?php

$config = [ 
            'root_url'                  => isset ($_GET['url']) ? str_replace($_GET['url'], '', $_SERVER['REQUEST_URI']) : $_SERVER['REQUEST_URI'],
            
            'core_dir'                  => 'core/', // bu dizinde calisacak

            'controllers_dir'           => '../app/controllers/', // index dizininde calisacak olan App sinifi kullanacak
            'services_dir'              => '../app/services/',
            'repos_dir'                 => '../app/repos/',
            'entities_dir'              => '../app/entities/',
            'views_dir'                 => '../app/views/',
            
            'main_url'                  => 'main/index',

            'db_dsn'                    => 'mysql:host=localhost;dbname=blog;charset=utf8',
            'db_usr'                    => 'root',
            'db_pwd'                    => '',
            'article_page_limit'        => 5,
            'user_page_limit'           => 5,
            'user_levels'               => [
                0 => 'Basic',
                1 => 'Editor',
                2 => 'Admin'
            ],
            'super_admin_id'            => 1

];
