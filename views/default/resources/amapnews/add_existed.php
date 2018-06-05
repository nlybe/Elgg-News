<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_css('amapnews_css');

$connected_guid = elgg_extract('cguid', $vars, '');
$entity_unit = get_entity($connected_guid);

if ($entity_unit && !elgg_instanceof($entity_unit, 'object', 'amapnews')) {
    $vars = amapnews_prepare_form_vars();
    $vars['cguid'] = $connected_guid;
    
    $container = $entity_unit->getContainerEntity();
    if (allow_post_on_groups() && elgg_instanceof($container, 'group') && $container->canEdit()) {
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


