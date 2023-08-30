<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

use Elgg\Exceptions\Http\EntityNotFoundException;
use Elgg\Exceptions\Http\EntityPermissionsException;
use ElggNews\NewsOptions;

$page_owner = elgg_get_page_owner_entity();
if (!$page_owner || $page_owner instanceof \ElggUser) { // not allow owner view if user
    throw new EntityPermissionsException();
}

// not display group news view if not allowed in settings
if ($page_owner instanceof \ElggGroup && !NewsOptions::allowPostOnGroups()) {
    throw new EntityNotFoundException();
}

$user = elgg_get_logged_in_user_entity();
// post news only for admins or groups owners (if allowed by admins)
if (NewsOptions::allowPost($page_owner, $user))	{
    elgg_register_title_button('add', 'object', 'news');
}

$options = [
    'type' => 'object',
    'subtype' => 'news',
    'container_guid' => $page_owner->guid,
    'full_view' => false,
    'view_toggle_type' => false
];

$crumbs_title = $page_owner->name;
$title = elgg_echo('elggnews:owner', [$page_owner->name]);

if ($page_owner instanceof \ElggGroup) {
    elgg_push_breadcrumb(elgg_echo('groups'), 'groups');
    elgg_push_breadcrumb($page_owner->name, $page_owner->getURL());
    elgg_push_breadcrumb($crumbs_title);
} else {
    elgg_push_breadcrumb($crumbs_title);
}
$content = elgg_list_entities($options);

if (!$content) {
    $content = elgg_echo('elggnews:none');
}

$vars = [
    'filter' => false,
    'content' => $content,
    'title' => $title,
];

// don't show filter if out of filter context
if ($page_owner instanceof ElggGroup) {
    $vars['filter'] = false;
}

$body = elgg_view_layout('default', $vars);

echo elgg_view_page($title, $body);
