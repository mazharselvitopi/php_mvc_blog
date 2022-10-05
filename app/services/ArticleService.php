<?php

class ArticleService extends Service
{
    public function getArticles ($params = [])
    {
        $data = [];
        $articles = [];
        $totalArticles = 0;
        $params = $this->pagination($params);

        if (!isset($params['category'])){
            $articles = $this->getArticleWithPage($params['page']);
            $totalArticles = $this->countArticles();
        } else {
            $articles = $this->getArticleWithPageOnCategory($params['page'], $params['category']);
            $totalArticles = $this->countArticlesOnCategory($params['category']);
        }
        if ($totalArticles < 0) $totalArticles = 1;

        $data['articles'] = $articles;
        
        $params['total_page'] = $totalArticles / $params['config']['article_page_limit'];

        if ($params['total_page'] > intval($params['total_page']))
        $params['total_page']++;

        $params['data'] = $data;

        return $params;
    }

    public function getArticle ($id)
    {
        $articleRepo = $this->repo("Article");

        return $articleRepo->getArticle($id);
    }

    public function getArticleWithPage ($page)
    {
        $articleRepo = $this->repo("Article");

        return $articleRepo->getArticleWithPage($page);
    }

    public function getArticleWithPageOnCategory ($page, $category)
    {
        $articleRepo = $this->repo("Article");

        return $articleRepo->getArticleWithPageOnCategory($page, $category);
    }

    public function countArticles ()
    {
        $articleRepo = $this->repo ("Article");
        return $articleRepo->countArticles();
    }

    public function countArticlesOnCategory ($categoryId)
    {
        $articleRepo = $this->repo ("Article");
        return $articleRepo->countArticlesOnCategory($categoryId);
    }

    public function pagination ($params = [])
    {   
        if (!isset ($params['page']))
            $params['page'] = 1;
        

        if (intval($params['page']) == 0)
            $params['page'] = 1;

        return $params;
    }
}