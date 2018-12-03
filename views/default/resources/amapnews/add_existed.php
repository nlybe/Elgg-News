<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_css('amapnews_css');

$connected_guid = elgg_extract('guid', $vars, '');
$entity = get_entity($connected_guid);

if ($entity && !elgg_instanceof($entity, 'object', 'news')) {
    $vars = amapnews_prepare_form_vars();
    $vars['cguid'] = $connected_guid;
    
    $container = $entity->getContainerEntity();
    if (NewsOptions::allowPostOnGroups() && elgg_instanceof($container, 'group') && $container->canEdit()) {
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


