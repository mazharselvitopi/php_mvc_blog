<?php

require_once 'admin_theme/topAdminView.php';

$name = '';
$surname = '';
$email = '';
$password = '';
$rePassword = '';

if (isset($params['data']))
{
    $name = $params['data']['name'];
    $surname = $params['data']['surname'];
    $email = $params['data']['email'];
    $password = $params['data']['password'];
    $rePassword = $params['data']['re_password'];
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="display-1">Yeni Kullanici Ekle</h1>

    <form class="row g-3" method = "post" action = "<?=$params['config']['root_url']?>admin/useradd">
        <div class="col-md-6">
            <label for="name" class="form-label">Ad</label>
            <input type="text" class="form-control" id="name" placeholder="Ad" name="name" value="<?=$name?>">
        </div>
        <div class="col-md-6">
            <label for="surname" class="form-label">Soyad</label>
            <input type="text" class="form-control" id="surname" placeholder="Soyad" name="surname" value="<?=$surname?>" >
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?=$email?>">
        </div>
        <div class="col-md-6">
            <label for="new_password" class="form-label">Sifre</label>
            <input type="password" class="form-control" id="password" name = "password"  value="<?=$password?>">
        </div>
        <div class="col-md-6">
            <label for="re_password" class="form-label">Sifre Tekrar</label>
            <input type="password" class="form-control" id="re_password" name="re_password"  value="<?=$rePassword?>">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Kullaniciyi Ekle</button>
        </div>
    </form>

    <?php require_once $params['config']['views_dir'].'/theme/alertView.php';?>
</main>

<?php
require_once 'admin_theme/footerAdminView.php';
?>
