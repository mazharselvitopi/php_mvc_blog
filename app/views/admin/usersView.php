<?php

require_once 'admin_theme/topAdminView.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Kullanicilar</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Ad</th>
                    <th scope="col">Soyad</th>
                    <th scope="col">Email</th>
                    <th scope="col">Kaydolma Tarihi</th>
                    <th scope="col">Guncellenme Tarihi</th>
                    <th scope="col">Guncelle</th>
                    <th scope="col">Sil</th>

                </tr>
            </thead>
            <tbody>
 
                <?php foreach ($params['data'] as $data):?>

                    <tr>
                        <td><?=$data->getId()?></td>
                        <td><?=$data->getName()?></td>
                        <td><?=$data->getSurname()?></td>
                        <td><?=$data->getEmail()?></td>
                        <td><?=$data->getUserLevel()?></td>
                        <td><?=$data->getCreatedDate()?></td>
                        <td><?=$data->getUpdatedDate()?></td>
                        <td><a href="<?=$params['config']['root_url']?>main/" class="btn btn-success">Guncelle</a></td>
                        <td><a href="<?=$params['config']['root_url']?>main/" class="btn btn-danger">Sil</a></td>

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

                        <li class="page-item"><a class="page-link" href="<?=$params['config']['root_url']?>admin/user/page/<?=$i?>"><?=$i?></a></li>

                <?php endif;?>

            <?php endfor; ?>
        </ul>
    </nav>
</main>

<?php
require_once 'admin_theme/footerAdminView.php';
?>
