<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

use Amapnews\NewsOptions;

$connected_guid = elgg_extract('guid', $vars, '');
$entity = get_entity($connected_guid);

if ($entity && !$entity instanceof \ElggNews) {
    $vars = amapnews_prepare_form_vars();
    $vars['cguid'] = $connected_guid;
    
    $container = $entity->getContainerEntity();
    if (NewsOptions::allowPostOnGroups() && ($container instanceof \ElggGroup) && $container->canEdit()) {
        elgg_set_page_owner_guid($container->getGUID());
        $vars['group_guid'] = $container->getGUID();
    }
        
    $form_vars = array('name' => 'amapnewsForm', 'enctype' => 'multipart/form-data');

    $body = elgg_view_form('amapnews/add', $form_vars, $vars);
    echo $body;
}
else {
    echo elgg_echo("amapnews:add:novalidentity");
}
