<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_library('elgg:amapnews');

//get entity
$entity_guid = elgg_extract('guid', $vars, '');
$entity_unit = get_entity($entity_guid);

if (!$entity_unit) {
    register_error(elgg_echo('noaccess'));
    $_SESSION['last_forward_from'] = current_page_url();
    forward('');
}

$page_owner = elgg_get_page_owner_entity();
$crumbs_title = $page_owner->name;
if (elgg_instanceof($page_owner, 'group')) {
    elgg_push_breadcrumb($crumbs_title, "news/group/$page_owner->guid/all");
} else {
    elgg_push_breadcrumb($crumbs_title, "news/owner/$page_owner->username");
}

$title = $entity_unit->title; 
elgg_push_breadcrumb($title);

$content = elgg_view_entity($entity_unit, array('full_view' => true));
if ($entity_unit->comments_on != 'Off') {
    $content .= elgg_view_comments($entity_unit);
}     

$sidebar = '';

$body = elgg_view_layout('content', array(
    'content' => $content,
    'title' => $title,
    'filter' => '',
    'sidebar' => $sidebar,
));
echo elgg_view_page($title, $body);



