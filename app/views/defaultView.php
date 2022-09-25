<?php
$pageName = "Anasayfa";
require_once 'theme/topView.php';
?>

<div class="p-3">
    <main class="container">

        <div class="row">
            <div class="col-md-8 shadow p-3">
                <h3 class="pb-4 mb-4 fst-italic border-bottom">
                    Blog Yazilarim
                </h3>
                <?php foreach ($params as $article) {?>
                <article class="blog-post">
                    <h2 class="blog-post-title mb-1"><?=$article->getTitle()?></h2>
                    <p class="blog-post-meta"><?= $article->getCreatedDate()?> by <a href="#">Mazhar</a></p>
                    <?=$article->getContent()?>
                    
                </article>
                <?php } ?>

                <nav class="blog-pagination" aria-label="Pagination">
                    <a class="btn btn-outline-primary rounded-pill" href="#">Older</a>
                    <a class="btn btn-outline-secondary rounded-pill disabled">Newer</a>
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