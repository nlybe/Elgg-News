<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

use Elgg\Exceptions\Http\EntityNotFoundException;
use Elgg\Exceptions\Http\EntityPermissionsException;
use ElggNews\NewsOptions;

$guid = elgg_extract('guid', $vars, '');
$entity = get_entity($guid);

if (!$entity instanceof \ElggNews) {
    throw new EntityNotFoundException();
}

if (!$entity->canEdit()) {
    throw new EntityPermissionsException();
}

$page_owner = elgg_get_page_owner_entity();
if ($page_owner instanceof \ElggGroup) {
    elgg_push_breadcrumb($page_owner->name, "news/group/$page_owner->guid/all");
} else {
    elgg_push_breadcrumb(elgg_echo('elggnews:menu'), "news");
}
elgg_push_breadcrumb($entity->title, $entity->getURL());
$title = elgg_echo('elggnews:edit');
elgg_push_breadcrumb($title);

$form_vars = [ 'name' => 'elggnews', 'enctype' => 'multipart/form-data' ];
$vars = elggnews_prepare_form_vars($entity);
if (NewsOptions::allowPostOnGroups() && ($page_owner instanceof \ElggGroup) && $page_owner->canEdit()) {
    $vars['group_guid'] = $page_owner->guid;
}
$content = elgg_view_form('elgg-news/add', $form_vars, $vars);

$body = elgg_view_layout('default', [
    'filter' => '',
    'content' => $content,
    'title' => $title,
]);

echo elgg_view_page($title, $body);
