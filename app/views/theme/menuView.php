
<header class="bg-warning p-2 shadow rounded-3 border border-0 border-dark">
    <h3 class = "text-gray-200 ">Kategoriler</h3>
</header>

<ul class="dropdown-menu position-static d-grid gap-1 mt-2 p-2 rounded-3 mx-0 shadow border border-0 border-dark">
    <?php if ($params['now_controller'] == 'mainController' && $params['now_action'] == 'indexActionGetRequest' && !isset ($params['category'])) {?>
        <li><a class="dropdown-item rounded-2 active bg-warning text-black border border-4 border-secondary " href="<?=$config['root_url']?>main/index">Tum Yazilar</a></li>
    <?php } else {?>
        <li><a class="dropdown-item rounded-2" href="<?=$config['root_url']?>main/index">Tum Yazilar</a></li>
    <?php } ?>
    <?php foreach ($params['categories'] as $category) {
        if(isset ($params['category'])) {
            if($params['category'] == $category->getId()) { ?>
                <li><a class="dropdown-item rounded-2 active bg-warning text-black border border-4 border-secondary " href="<?=$config['root_url']?>main/index/category/<?=$category->getId()?>/page/1"><?=$category->getTitle()?></a></li>
            <?php
            } else { ?>
                <li><a class="dropdown-item rounded-2" href="<?=$config['root_url']?>main/index/category/<?=$category->getId()?>/page/1"><?=$category->getTitle()?></a></li>
        <?php
            }
        } else {?>
            <li><a class="dropdown-item rounded-2" href="<?=$config['root_url']?>main/index/category/<?=$category->getId()?>/page/1"><?=$category->getTitle()?></a></li>
    <?php
        }
    ?>
    <?php }?>
</ul>