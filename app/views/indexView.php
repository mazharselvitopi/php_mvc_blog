<?php

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
                <?php foreach ($params['data']['articles'] as $article) {?>
                <article class="blog-post">
                    <h2 class="blog-post-title mb-1"><?=$article->getTitle()?></h2>
                    <p class="blog-post-meta"><?= $article->getCreatedDate()?> by <a href="#">Mazhar</a></p>
                    <?=$article->getSummary()?>
                    <a href="<?=$params['config']['root_url']?>main/read/category/<?=$article->getCategoryId()?>/article/<?=$article->getId()?>">Devamini Oku</a>
                    
                </article>
                <?php } ?>

                <nav class="blog-pagination" aria-label="Pagination">
                    <?php 
                    for ($i = 1; $i <= $params['total_page']; $i++) {
                        if ($i == $params['page']) {?>
                            <a class="btn btn-outline-secondary rounded-pill disabled" ><?=$i?></a>
                    <?php } else {
                                if (!isset ($params['now_category'])) {
                    ?>
                                    <a class="btn btn-outline-primary rounded-pill" href="<?=$params['config']['root_url'] ?>main/index/page/<?=$i?>"><?=$i?></a>
                            <?php } else {?>
                                <a class="btn btn-outline-primary rounded-pill" href="<?=$params['config']['root_url'] ?>main/index/category/<?=$params['now_category']?>/page/<?=$i?>"><?=$i?></a>
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