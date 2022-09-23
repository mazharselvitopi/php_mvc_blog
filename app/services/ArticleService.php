<?php

class ArticleService extends Service
{
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
}