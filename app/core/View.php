<?php
class View
{
    public static function render ($config, $view, $params = [])
    {
        $viewFile = $config['views_dir'] . $view . 'View.php';
        if (file_exists($viewFile)) {
            ob_start();
            require_once $viewFile;
            $output = ob_get_clean();
            echo $output;
        } else {
            header('Location: '.$config['root_url'].'main/viewFileNotFound');
            //exit ('View dosyasi bulunamadi: ' . $viewFile);
            // YONLENDIRME
            // header ("Location: http://domain.com/folder/page.html", 301);
            // exit ();
        }
    }
}