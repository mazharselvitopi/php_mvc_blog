<?php

class ArticleController extends Controller
{
    /**
     * Tum makaleleri getirir ve sayfalama yapar
     */
    public function defaultActionGetRequest ($params = [])
    {
        $nowController = $params['now_controller'];
        $nowAction = $params['now_action'];

        if (!isset($params['page'])) $params['page'] = 1;
        elseif (isset($params['page'])) {
            try {
                $params['page'] = intval($params['page']);
            } catch (\Throwable $th) {
            }
            if (!is_integer($params['page'])) {
                $params['page'] = 1;
            }
        } else {
            $params['page'] = 1;
        }
        $articleService = $this->service("Article");
        
        
        if (!isset($params['category'])){
            $articles = $articleService->getArticleWithPage($params['page']);
            $countPage = $articleService->countArticles();
        } else {
            $articles = $articleService->getArticleWithPageInCategory($params['page'], $params['category']);
            $countPage = $articleService->countArticlesInCategory($params['category']);
        }

        if ($countPage == 0) $countPage = 1;
        
        $categoryService = $this->service("Category");
        $allCategories = $categoryService->getCategoryList();
        
        if (!isset($params['category']))
            $this->render("articles", [ 
                                        'articles' => $articles, 
                                        'count_page' =>$countPage, 
                                        'config' => $this->config, 
                                        'now_page' => $params['page'], 
                                        'categories' => $allCategories,
                                        'now_action' => $nowAction,
                                        'now_controller' => $nowController
                                    ]);
        else 
            $this->render("articles", [ 
                                        'articles' => $articles, 
                                        'count_page' =>$countPage, 
                                        'config' => $this->config, 
                                        'now_page' => $params['page'], 
                                        'categories' => $allCategories,
                                        'now_action' => $nowAction,
                                        'now_controller' => $nowController,
                                        'now_category' => $params['category']
                                    ]);
    }



        
    public function readArticleActionGetRequest ($params = [])
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
}