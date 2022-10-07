<?php

require_once 'admin_theme/topAdminView.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
<h1 class="display-1">Kullaniciyi Guncelle</h1>

<form class="row g-3" method = "post" action = "<?=$params['config']['root_url']?>admin/userupdate/id/<?=$params['user']->getId()?>">
  <div class="col-md-6">
    <label for="id" class="form-label">Id</label>
    <input type="number" class="form-control" id="id" name="id" readonly value="<?=$params['user']->getId()?>">
  </div>
  <div class="col-md-6">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" readonly value="<?=$params['user']->getEmail()?>">
  </div>

  <div class="col-md-6">
    <label for="name" class="form-label">Ad</label>
    <input type="text" class="form-control" id="name" placeholder="Ad" name="name" value="<?=$params['user']->getName()?>">
  </div>
  <div class="col-md-6">
    <label for="surname" class="form-label">Soyad</label>
    <input type="text" class="form-control" id="surname" placeholder="Soyad" name="surname" value="<?=$params['user']->getSurname()?>">
  </div>
  
  <div class="col-12">
    <div class="alert alert-info" role="alert">
      Sifre degistirmek istiyorsaniz eski sifrenizi girmelisiniz <br>
      <b>Sadece yeni sifreleri girerseniz sifre guncellenmez </b>
    </div>
  </div>
  <div class="col-md-6 border border-2 border-danger rounded p-1">
    <label for="old_password" class="form-label">Eski Sifre</label>
    <input type="password" class="form-control" id="old_password" name = "old_password">
  </div>
  <div class="col-md-6">
    <label for="new_password" class="form-label">Yeni Sifre</label>
    <input type="password" class="form-control" id="new_password" name = "new_password">
  </div>
  <div class="col-md-6">
    <label for="new_password_again" class="form-label">Yeni Sifre Tekrar</label>
    <input type="password" class="form-control" id="new_password_again" name="new_password_again">
  </div>
  <div class="col-md-6">
    <label for="inputState" class="form-label">Kullanici Seviyesi</label>
    <select id="inputState" class="form-select" name = "user_level">
      <?php foreach ($params['config']['user_levels'] as $level => $levelName):?>
        <?php if ($level == $params['user']->getUserLevel()): ?>
          <option selected value="<?=$level?>"><?=$levelName?></option>
        <?php else: ?>
          <option value="<?=$level?>"><?=$levelName?></option>
        <?php endif; ?>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">guncelle</button>
  </div>
</form>

<?php require_once $params['config']['views_dir'].'/theme/alertView.php';?>
</main>

<?php
require_once 'admin_theme/footerAdminView.php';
?>
