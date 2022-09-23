<?php

class ArticleController extends Controller
{
    public function defaultActionGetRequest ($params = [])
    {
        if (!isset($params[0])) $params['page'] = 1;
        elseif (!$params[0] == 'page') $params['page'] = 1;
        elseif (isset($params[1])) {
            try {
                $params[1] = intval($params[1]);
            } catch (\Throwable $th) {
            }
            if (is_integer($params[1])) {
                $params[$params[0]] = $params[1];
            } else {
                $params['page'] = 1;
            }
        } else {
            $params['page'] = 1;
        }
        $articleService = $this->service("Article");
        
        $articles = $articleService->getArticleWithPage($params['page']);

        $countPage = $articleService->countArticles();

        $this->render("articles", [$articles, $countPage, 'config' => $this->config, 'now_page' => $params['page']]);
    }

    public function categoryActionGetRequest ($params = [])
    {

    }
}