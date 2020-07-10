<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

//get entity
$guid = elgg_extract('guid', $vars, '');
$entity = get_entity($guid);

if (!$entity) {
    elgg_error_response(elgg_echo('noaccess'));
    forward(REFERRER);
//    $_SESSION['last_forward_from'] = current_page_url();
//    forward('');
}

$page_owner = elgg_get_page_owner_entity();
if ($page_owner instanceof \ElggGroup) {
    elgg_push_breadcrumb(elgg_echo('groups'), 'groups');
    elgg_push_breadcrumb($page_owner->name, $page_owner->getURL());
    elgg_push_breadcrumb(elgg_echo('amapnews:menu'), "news/group/$page_owner->guid/all");
} else {
    elgg_push_breadcrumb(elgg_echo('amapnews:menu'), 'news');
}

$title = $entity->title; 
elgg_push_breadcrumb($title);

$content = elgg_view_entity($entity, ['full_view' => true]);

$body = elgg_view_layout('default', array(
    'content' => $content,
    'title' => $title,
    'filter' => '',
    'sidebar' => '',
));
echo elgg_view_page($title, $body);



