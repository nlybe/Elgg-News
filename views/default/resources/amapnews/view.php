<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

//get entity
$guid = elgg_extract('guid', $vars, '');
$entity = get_entity($guid);

if (!$entity) {
    register_error(elgg_echo('noaccess'));
    $_SESSION['last_forward_from'] = current_page_url();
    forward('');
}

$page_owner = elgg_get_page_owner_entity();
if (elgg_instanceof($page_owner, 'group')) {
    elgg_push_breadcrumb(elgg_echo('groups'), 'groups');
    elgg_push_breadcrumb($page_owner->name, $page_owner->getURL());
    elgg_push_breadcrumb(elgg_echo('amapnews:menu'), "news/group/$page_owner->guid/all");
} else {
    elgg_push_breadcrumb(elgg_echo('amapnews:menu'), 'news');
}

$title = $entity->title; 
elgg_push_breadcrumb($title);

$content = elgg_view_entity($entity, array('full_view' => true));
if ($entity->comments_on != 'Off') {
    $content .= elgg_view_comments($entity);
}     

$sidebar = '';

$body = elgg_view_layout('content', array(
    'content' => $content,
    'title' => $title,
    'filter' => '',
    'sidebar' => $sidebar,
));
echo elgg_view_page($title, $body);



