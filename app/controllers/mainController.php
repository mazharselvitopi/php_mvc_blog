<?php
class MainController extends Controller
{
    public function defaultActionGetRequest ($params = [])
    {
        $articleService = $this->service("Article");
        
        $mainArticles = $articleService->getArticleWithPage(1);


        $this->render("default", $mainArticles);
    }
}