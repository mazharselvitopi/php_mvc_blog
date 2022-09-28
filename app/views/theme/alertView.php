<?php 
/**
 * alert types
 * 1 - primary
 * 2 - secondary
 * 3 - success
 * 4 - danger
 * 5 - warning
 * 6 - info
 * 7 - light
 * 8 - dark
 * 
 */
function renderAlert ($alertType = '', $alertTitle = '', $alertContent = '', $alertLink = '', $alertLinkTitle = '')
{?>
<div class="alert alert-<?=$alertType?> alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
    <h4 class="alert-heading"><?=$alertTitle?></h4>
    <p> <?=$alertContent?> </p>
    <hr>
    <a href="<?=$alertLink?>" class="alert-link"><?=$alertLinkTitle?></a>
    
</div>
<?php 
}

if (isset ($params['alert']) && isset ($params['alert']['type'])){
    $alertType = '';
    $alertTitle = '';
    $alertContent = '';
    $alertLink = '';
    $alertLinkTitle = '';
    if (isset ($params['alert']['type'])) $alertType = $params['alert']['type'];
    if (isset ($params['alert']['title'])) $alertTitle = $params['alert']['title'];
    if (isset ($params['alert']['content'])) $alertContent = $params['alert']['content'];
    if (isset ($params['alert']['link_title'])) $alertLinkTitle = $params['alert']['link_title'];
    if (isset ($params['alert']['link'])) $alertLink = $params['alert']['link'];

    renderAlert(    $alertType,
                    $alertTitle,
                    $alertContent,
                    $alertLink,
                    $alertLinkTitle
                );
    
}

?>