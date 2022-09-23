<?php 

class ArticleRepo extends Repo
{
    protected $limit;
    public function getArticle ($id)
    {
        $article = $this->fetch("select * from articles where id = ?",[$id]);
        $articleEntity = $this->getArticleEntity($article);

        return $articleEntity;
    }

    public function getArticleWithPage ($page)
    {
        $this->limit = $this->config['article_page_limit'];
        if ( $page < 1 ) $page = 0;
        else $page--;
        $offset = $page * $this->limit;

        $query = "select * from articles order by id limit ?, ?";
        $stmt = $this->db->prepare ($query);
        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->bindValue(2, $this->limit, PDO::PARAM_INT);
        $stmt->execute ();
        $articleList = $stmt->fetchAll();
        $data = [];
        foreach ($articleList as $article){
            $articleEntity = $articleEntity = $this->getArticleEntity($article);
            $data[] = $articleEntity;
        }

        return $data;
    }

    public function getArticleWithPageInCategory ($page, $categoryId)
    {
        $this->limit = $this->config['article_page_limit'];
        if ( $page < 1 ) $page = 0;
        else $page--;

        $articleEntity = $this->entity ('Article');

        $offset = $page * $this->limit;

        $query = "select * from articles where category_id = ? order by id limit ?, ?";
        $stmt = $this->db->prepare ($query);
        $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->bindValue(3, $this->limit, PDO::PARAM_INT);
        $stmt->execute ();
        $articleList = $stmt->fetchAll();
        $data = [];
        foreach ($articleList as $article){
            $articleEntity = $this->getArticleEntity($article);
            $data[] = $articleEntity;
        }

        return $data;
        
    }

    public function countArticles ()
    {
        $articlesCount = $this->fetch("select count(*)  as total from articles");
        
        return $articlesCount['total'];
    }

    public function countArticlesInCategory ($categoryId)
    {
        $articlesCount = $this->fetch("select count(*)  as total from articles where category_id = ?", [$categoryId]);

        return $articlesCount['total'];
    }

    public function getArticleEntity ($article)
    {
        $articleEntity = $this->entity('Article');
        $articleEntity  ->setId($article['id'])
                        ->setTitle($article['title'])
                        ->setSummary($article['summary'])
                        ->setContent($article['content'])
                        ->setCategoryId($article['category_id'])
                        ->setAuthorId($article['author_id'])
                        ->setCreatedDate($article['created_date'])
                        ->setUpdatedDate($article['updated_date']);
        
        return $articleEntity;
    }
}