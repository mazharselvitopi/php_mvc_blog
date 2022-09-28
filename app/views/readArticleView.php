<?php

require_once 'theme/topView.php';
$article = $params['article'];

$pageName = $article->getTitle();
?>

<div class="p-3">
    <main class="container">

        <div class="row">
            <div class="col-md-8 shadow p-3">
            <?php require_once 'theme/alertView.php';?>
                <article class="blog-post">
                    <h2 class="blog-post-title mb-1"><?=$article->getTitle()?></h2>
                    <p class="blog-post-meta"><?= $article->getCreatedDate()?> by <a href="#">Mazhar</a></p>

                    <?=$article->getSummary()?> <br> <br>

                    <?=$article->getContent()?>
                    
                </article>

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