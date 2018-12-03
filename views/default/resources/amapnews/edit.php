<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$guid = elgg_extract('guid', $vars, '');
$entity = get_entity($guid);

if (!elgg_instanceof($entity, 'object', 'news') || !$entity->canEdit()) {
    register_error(elgg_echo('amapnews:unknown_amapnews'));
    forward(REFERRER);
}

$page_owner = elgg_get_page_owner_entity();
if (elgg_instanceof($page_owner, 'group')) {
    elgg_push_breadcrumb($page_owner->name, "news/group/$page_owner->guid/all");
} else {
    elgg_push_breadcrumb(elgg_echo('amapnews:menu'), "news");
}
elgg_push_breadcrumb($entity->title, $entity->getURL());
$title = elgg_echo('amapnews:edit');
elgg_push_breadcrumb($title);

$form_vars = array('name' => 'amapnews', 'enctype' => 'multipart/form-data');
$vars = amapnews_prepare_form_vars($entity);
if (NewsOptions::allowPostOnGroups() && elgg_instanceof($page_owner, 'group') && $page_owner->canEdit()) {
    $vars['group_guid'] = $page_owner->guid;
}
$content = elgg_view_form('amapnews/add', $form_vars, $vars);

$body = elgg_view_layout('content', array(
    'filter' => '',
    'content' => $content,
    'title' => $title,
));

echo elgg_view_page($title, $body);
