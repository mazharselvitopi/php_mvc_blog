<header class="bg-gray-100 p-2 shadow rounded-3 border border-2 border-dark">
    <h5 class = "text-gray-200 rounded-3">Kategoriler</h5>
</header>

<ul class="dropdown-menu position-static d-grid gap-1 mt-2 p-2 rounded-3 mx-0 shadow border border-2 border-dark">
    <?php if ($params['now_controller'] == 'articleController' && $params['now_action'] == 'defaultActionGetRequest' && !isset ($params['now_category'])) {?>
        <li><a class="dropdown-item rounded-2 active" href="<?=$config['root_url']?>article/default">Tum Yazilar</a></li>
    <?php } else {?>
        <li><a class="dropdown-item rounded-2" href="<?=$config['root_url']?>article/default">Tum Yazilar</a></li>
    <?php } ?>
    <?php foreach ($params['categories'] as $category) {
        if(isset ($params['now_category'])) {
            if($params['now_category'] == $category->getId()) { ?>
                <li><a class="dropdown-item rounded-2 active" href="<?=$config['root_url']?>article/default/category/<?=$category->getId()?>/page/1"><?=$category->getTitle()?></a></li>
    <?php
            } else { ?>
                <li><a class="dropdown-item rounded-2" href="<?=$config['root_url']?>article/default/category/<?=$category->getId()?>/page/1"><?=$category->getTitle()?></a></li>
    <?php
            }
        } else {?>
            <li><a class="dropdown-item rounded-2" href="<?=$config['root_url']?>article/default/category/<?=$category->getId()?>/page/1"><?=$category->getTitle()?></a></li>
    <?php
        }
    ?>
    

    <?php }?>
</ul>