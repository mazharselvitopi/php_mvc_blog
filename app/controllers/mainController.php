<?php
class MainController extends Controller
{

/**
 * alert types
 * 1 - primary
 * 2 - secondary
 * 3 - success
 * 4 - danger
 * 5 - warning
 * 6 - info
 * 7 - light
 * 8 - dark
 * 
 */

    public function loginActionGetRequest ($params = [])
    {

    }

    public function logoutActionGetRequest ($params = [])
    {

    }

    public function signupActionGetRequest ($params = [])
    {

    }


    public function indexActionGetRequest ($params = [])
    {
        $nowController = $params['now_controller'];
        $nowAction = $params['now_action'];

        $articleService = $this->service("Article");
        
        $data = $articleService->getArticles($params);
        $articles = $data['articles'];
        $countPage = $data['count_page'];
        $nowPage = $data['now_page'];

        if (isset ($params['category']))
        $nowCategory = $params['category'];

        $categoryService = $this->service("Category");
        $allCategories = $categoryService->getCategoryList();
        
        if (!isset($params['category']))
            $this->render("index", [ 
                                        'articles' => $articles, 
                                        'count_page' =>$countPage, 
                                        'config' => $this->config, 
                                        'now_page' => $nowPage, 
                                        'categories' => $allCategories,
                                        'now_action' => $nowAction,
                                        'now_controller' => $nowController,
                                        
                                        
                                    ]);
        else 
            $this->render("index", [ 
                                        'articles' => $articles, 
                                        'count_page' =>$countPage, 
                                        'config' => $this->config, 
                                        'now_page' => $nowPage, 
                                        'categories' => $allCategories,
                                        'now_action' => $nowAction,
                                        'now_controller' => $nowController,
                                        'now_category' => $nowCategory
                                    ]);

    }

    /**
                'alert' =>  [
                                'type' => 'success', 
                                'title' => 'Deneme', 
                                'content' => 'Gelecek icin umit',
                                'link' => 'http://www.mazharselvitopi.com',
                                'link_title' => 'www.mazharselvitopi.com'
                            ]
     */

    public function readActionGetRequest ($params = [])
    {
       $nowController = $params['now_controller'];
       $nowAction = $params['now_action'];

       $articleId = $params['article'];

       $articleService = $this->service("Article");

       $article = $articleService->getArticle($articleId);

       $categoryService = $this->service('Category');
       $categories = $categoryService->getCategoryList();

       $nowCategory = $article->getCategoryId();

       $this->render('readArticle', [   'article'           => $article, 
                                        'now_controller'    => $nowController,
                                        'now_action'        => $nowAction,
                                        'config'            => $this->config,
                                        'categories'        => $categories,
                                        'now_category'      => $nowCategory
       ] );
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
        $nowController = $params['now_controller'];
        $nowAction = $params['now_action'];

        $this->render ('notFound', [
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
        $nowController = $params['now_controller'];
        $nowAction = $params['now_action'];

        $this->render ('notFound', [
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
        $nowController = $params['now_controller'];
        $nowAction = $params['now_action'];

        $this->render ('notFound', [
                                        'alert' =>  [
                                            'type' => 'danger', 
                                            'title' => 'Repo not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git'
                                        ]
        ]);
    }

    public function repoFileNotFoundActionGetRequest ($params = [])
    {
        $nowController = $params['now_controller'];
        $nowAction = $params['now_action'];

        $this->render ('notFound', [
                                        'alert' =>  [
                                            'type' => 'danger', 
                                            'title' => 'Repo file not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git'
                                        ]
        ]);
    }

    public function viewFileNotFoundActionGetRequest ($params = [])
    {
        $nowController = $params['now_controller'];
        $nowAction = $params['now_action'];

        $this->render ('notFound', [
                                        'alert' =>  [
                                            'type' => 'danger', 
                                            'title' => 'View file not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git'
                                        ]
        ]);
    }

    public function serviceNotFoundActionGetRequest ($params = [])
    {
        $nowController = $params['now_controller'];
        $nowAction = $params['now_action'];

        $this->render ('notFound', [
                                        'alert' =>  [
                                            'type' => 'danger', 
                                            'title' => 'Service not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git'
                                        ]
        ]);
    }

    public function serviceFileNotFoundActionGetRequest ($params = [])
    {
        $nowController = $params['now_controller'];
        $nowAction = $params['now_action'];

        $this->render ('notFound', [
                                        'alert' =>  [
                                            'type' => 'danger', 
                                            'title' => 'Service file not found', 
                                            'content' => 'please go to the link',
                                            'link' => $this->config['root_url'],
                                            'link_title' => 'Anasayfaya git'
                                        ]
        ]);
    }

    

}