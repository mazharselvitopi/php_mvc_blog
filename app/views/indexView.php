<?php
$pageName = "Anasayfa";
$countArticle = $params['count_page'];
$articlePageLimit = $params['config']['article_page_limit'];
$totalPage = $countArticle / $articlePageLimit;
if ($totalPage < 1) $totalPage = 1;
$nowPage = $params['now_page'];
require_once 'theme/topView.php';

?>

<div class="p-3">
    <main class="container">

        <div class="row">
            <div class="col-md-8 shadow p-3">
                <?php require_once 'theme/alertView.php';?>
                <h3 class="pb-4 mb-4 fst-italic border-bottom">
                    Blog Yazilarim
                </h3>
                <?php foreach ($params['articles'] as $article) {?>
                <article class="blog-post">
                    <h2 class="blog-post-title mb-1"><?=$article->getTitle()?></h2>
                    <p class="blog-post-meta"><?= $article->getCreatedDate()?> by <a href="#">Mazhar</a></p>
                    <?=$article->getSummary()?>
                    <a href="<?=$config['root_url']?>main/read/article/<?=$article->getId()?>">Devamini Oku</a>
                    
                </article>
                <?php } ?>

                <nav class="blog-pagination" aria-label="Pagination">
                    <?php 
                    for ($i = 1; $i <= $totalPage; $i++) {
                        if ($i == $nowPage) {?>
                            <a class="btn btn-outline-secondary rounded-pill disabled" ><?=$i?></a>
                    <?php } else {
                                if (!isset ($params['now_category'])) {
                    ?>
                            <a class="btn btn-outline-primary rounded-pill" href="<?=$config['root_url'] ?>main/index/page/<?=$i?>"><?=$i?></a>
                    <?php } else {?>
                                <a class="btn btn-outline-primary rounded-pill" href="<?=$config['root_url'] ?>main/index/category/<?=$params['now_category']?>/page/<?=$i?>"><?=$i?></a>
                        <?php
                    
                        }
                    }
                }?>
                </nav>

            </div>
            <div class="col-md-4">
                <?php require_once 'theme/menuView.php'?>
            </div>
        </div>


    </main>

</div>



    
<?php
require_once 'theme/footerView.php';
?>