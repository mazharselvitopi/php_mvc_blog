<?php

require_once 'admin_theme/topAdminView.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Kategoriler</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Kategori Adi</th>
                <th scope="col">Eklenme Tarihi</th>
                <th scope="col">Guncellenme Tarihi</th>
                <th scope="col">Guncelle</th>
                <th scope="col">Sil</th>

            </tr>
            </thead>
            <tbody>

            <?php foreach ($params['data'] as $data):?>

                <tr>
                    <td><?=$data->getId()?></td>
                    <td><?=$data->getTitle()?></td>
                    <td><?=$data->getCreatedDate()?></td>
                    <td><?=$data->getUpdatedDate()?></td>
                    <td><a href="<?=$params['config']['root_url']?>admin/categoryupdate/id/<?=$data->getId()?>" class="btn btn-success">Guncelle</a></td>
                    <td><a href="<?=$params['config']['root_url']?>admin/categorydelete/id/<?=$data->getId()?>/page/<?=$params['page']?>" class="btn btn-danger">Sil</a></td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <nav aria-label="users_pagination">

        <ul class="pagination">

            <?php for($i = 1; $i <= $params['total_page']; $i++):?>

                <?php if ($params['page'] == $i):?>

                    <li class="page-item active" aria-current="page">

                        <span class="page-link"><?=$i?></span>

                    </li>

                <?php else: ?>

                    <li class="page-item"><a class="page-link" href="<?=$params['config']['root_url']?>admin/categories/page/<?=$i?>"><?=$i?></a></li>

                <?php endif;?>

            <?php endfor; ?>
        </ul>
    </nav>

    <?php require_once $params['config']['views_dir'].'/theme/alertView.php';?>
</main>

<?php
require_once 'admin_theme/footerAdminView.php';
?>
