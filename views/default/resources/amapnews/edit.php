<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

use Amapnews\NewsOptions;

$guid = elgg_extract('guid', $vars, '');
$entity = get_entity($guid);

if (!$entity instanceof \ElggNews || !$entity->canEdit()) {
    elgg_error_response(elgg_echo('amapnews:unknown_amapnews'));
    forward(REFERRER);
}

$page_owner = elgg_get_page_owner_entity();
if ($page_owner instanceof \ElggGroup) {
    elgg_push_breadcrumb($page_owner->name, "news/group/$page_owner->guid/all");
} else {
    elgg_push_breadcrumb(elgg_echo('amapnews:menu'), "news");
}
elgg_push_breadcrumb($entity->title, $entity->getURL());
$title = elgg_echo('amapnews:edit');
elgg_push_breadcrumb($title);

$form_vars = array('name' => 'amapnews', 'enctype' => 'multipart/form-data');
$vars = amapnews_prepare_form_vars($entity);
if (NewsOptions::allowPostOnGroups() && ($page_owner instanceof \ElggGroup) && $page_owner->canEdit()) {
    $vars['group_guid'] = $page_owner->guid;
}
$content = elgg_view_form('amapnews/add', $form_vars, $vars);

$body = elgg_view_layout('default', array(
    'filter' => '',
    'content' => $content,
    'title' => $title,
));

echo elgg_view_page($title, $body);
