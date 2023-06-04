<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

use Elgg\Exceptions\Http\EntityPermissionsException;
use ElggNews\NewsOptions;

$guid = elgg_extract('guid', $vars, '');
$submitter = get_entity($guid);

$user = elgg_get_logged_in_user_entity();

// post news only for admins or groups owners (if allowed by admins)
if (!NewsOptions::allowPost($submitter, $user)) {
    throw new EntityPermissionsException();
}

$title = elgg_echo('elggnews:add');
$page_owner = elgg_get_page_owner_entity();
$crumbs_title = $page_owner->name;
if ($page_owner instanceof \ElggGroup) {
    elgg_push_breadcrumb($crumbs_title, "news/group/$page_owner->guid/all");
}  
elgg_push_breadcrumb($title);

// build sidebar 
$sidebar = '';

// create form
$form_vars = [ 'name' => 'elggnewsForm', 'enctype' => 'multipart/form-data' ];

$vars = elggnews_prepare_form_vars();
if (NewsOptions::allowPostOnGroups() && ($submitter instanceof \ElggGroup) && $submitter->canEdit()) {
    $vars['group_guid'] = $submitter->guid;
}
$content = elgg_view_form('elgg-news/add', $form_vars, $vars);

$body = elgg_view_layout('default', [
    'content' => $content,
    'title' => $title,
    'sidebar' => $sidebar,
    'filter' => '',
]);

echo elgg_view_page($title, $body);
