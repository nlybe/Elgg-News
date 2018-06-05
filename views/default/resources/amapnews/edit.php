<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$entity_guid = elgg_extract('guid', $vars, '');
$entity_unit = get_entity($entity_guid);

if (!elgg_instanceof($entity_unit, 'object', 'amapnews') || !$entity_unit->canEdit()) {
    register_error(elgg_echo('amapnews:unknown_amapnews'));
    forward(REFERRER);
}

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('amapnews:edit');
elgg_push_breadcrumb($title);

$form_vars = array('name' => 'amapnews', 'enctype' => 'multipart/form-data');
$vars = amapnews_prepare_form_vars($entity_unit);
if (allow_post_on_groups() && elgg_instanceof($page_owner, 'group') && $page_owner->canEdit()) {
    $vars['group_guid'] = $page_owner->guid;
}
$content = elgg_view_form('amapnews/add', $form_vars, $vars);

$body = elgg_view_layout('content', array(
    'filter' => '',
    'content' => $content,
    'title' => $title,
));

echo elgg_view_page($title, $body);
