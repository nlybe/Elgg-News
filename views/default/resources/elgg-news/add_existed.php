<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

use ElggNews\NewsOptions;

$connected_guid = elgg_extract('guid', $vars, '');
$entity = get_entity($connected_guid);

if ($entity && !$entity instanceof \ElggNews) {
    $vars = elggnews_prepare_form_vars();
    $vars['cguid'] = $connected_guid;
    
    $container = $entity->getContainerEntity();
    if (NewsOptions::allowPostOnGroups() && ($container instanceof \ElggGroup) && $container->canEdit()) {
        elgg_set_page_owner_guid($container->getGUID());
        $vars['group_guid'] = $container->getGUID();
    }
        
    $form_vars = [ 'name' => 'elggnewsForm', 'enctype' => 'multipart/form-data' ];

    $body = elgg_view_form('elgg-news/add', $form_vars, $vars);
    echo $body;
}
else {
    echo elgg_echo("elggnews:add:novalidentity");
}
