<?php
$pageName = "Anasayfa";
require_once 'theme/topView.php';
?>
    Anasayfaya hosgeldiniz. </br>

    <form action="/mvc_learn5/user/getuser" method="post">
        <input type="email" name="email" id="">
        <input type="submit" value="Kullaniciyi getir">

    </form>
    <pre>
        <?php print_r($params); ?>
    </pre>

    
<?php
require_once 'theme/footerView.php';
?>