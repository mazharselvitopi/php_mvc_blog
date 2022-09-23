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
                <header class="bg-gray-100 p-2 shadow rounded-3 border border-2 border-dark">
                    <h5 class = "text-gray-200 rounded-3">Kategoriler</h5>
                </header>
                <ul class="dropdown-menu position-static d-grid gap-1 mt-2 p-2 rounded-3 mx-0 shadow border border-2 border-dark">
                    <li><a class="dropdown-item rounded-2 active" href="#">Action</a></li>
                    <li><a class="dropdown-item rounded-2" href="#">Another action</a></li>
                    <li><a class="dropdown-item rounded-2" href="#">Something else here</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item rounded-2" href="#">Separated link</a></li>
                </ul>
            </div>
        </div>


    </main>

</div>

















    
<?php
require_once 'theme/footerView.php';
?>