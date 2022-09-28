<?php

class ArticleService extends Service
{
    public function getArticles ($params = [])
    {
        $data = [];
        $articles = [];
        $countPage = 0;
        $params = $this->pagination($params);

        if (!isset($params['category'])){
            $articles = $this->getArticleWithPage($params['page']);
            $countPage = $this->countArticles();
        } else {
            $articles = $this->getArticleWithPageInCategory($params['page'], $params['category']);
            $countPage = $this->countArticlesInCategory($params['category']);
        }
        if ($countPage == 0) $countPage = 1;

        $data['articles'] = $articles;
        $data['count_page'] = $countPage; 
        $data['now_page'] = $params['page'];

        return $data;
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

    public function getArticleWithPageInCategory ($page, $category)
    {
        $articleRepo = $this->repo("Article");

        return $articleRepo->getArticleWithPageInCategory($page, $category);
    }

    public function countArticles ()
    {
        $articleRepo = $this->repo ("Article");
        return $articleRepo->countArticles();
    }

    public function countArticlesInCategory ($categoryId)
    {
        $articleRepo = $this->repo ("Article");
        return $articleRepo->countArticlesInCategory($categoryId);
    }

    public function pagination ($params = [])
    {
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

        return $params;
    }
}