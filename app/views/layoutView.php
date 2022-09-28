<?php

require_once 'theme/topView.php';
// $param = $params['param'];

$pageName = 'Layout';
?>

<div class="p-3">
    <main class="container">

        <div class="row">
            <div class="col-md-8 shadow p-3">
                <?php require_once 'theme/alertView.php';?>

            </div>
            <div class="col-md-4">
                <?php require_once 'theme/menuView.php';?>
            </div>
        </div>


    </main>

</div>



    
<?php
require_once 'theme/footerView.php';
?>