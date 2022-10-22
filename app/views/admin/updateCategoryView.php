<?php

require_once 'admin_theme/topAdminView.php';

$title = '';

if (isset($params['data']))
{
    $title = $params['data']->getTitle();
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="display-1">Kategori Guncelle</h1>

    <form class="row g-3" method = "post" action = "<?=$params['config']['root_url']?>admin/updatecategory/id/<?=$params['id']?>/page/<?=$params['page']?>">
        <div class="col-md-6">
            <label for="title" class="form-label">Kategori Adı</label>
            <input type="text" class="form-control" id="title" placeholder="Ad" name="title" value="<?=$title?>">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Kategoriyi Guncelle</button>
        </div>
    </form>

    <?php require_once $params['config']['views_dir'].'/theme/alertView.php';?>
</main>

<?php
require_once 'admin_theme/footerAdminView.php';
?>
