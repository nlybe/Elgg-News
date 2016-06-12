<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_library('elgg:amapnews');

$page_owner = elgg_get_page_owner_entity();
if (!$page_owner) {
    forward('amapnews/all');
}

$user = elgg_get_logged_in_user_entity();
$staff = $user->news_staff;

// post news only for admins or groups owners (if allowed by admins)
if (elgg_is_admin_logged_in() || (allow_post_on_groups() && elgg_instanceof($page_owner, 'group') && $page_owner->canEdit()) || $staff)	{
    elgg_register_title_button();
}

$options = array(
    'type' => 'object',
    'subtype' => 'amapnews',
    'container_guid' => $page_owner->guid,
    'limit' => 10,
    'full_view' => false,
    'view_toggle_type' => false
);

$crumbs_title = $page_owner->name;
$title = elgg_echo('amapnews:owner', array($page_owner->name));

if (elgg_instanceof($page_owner, 'group')) {
    elgg_push_breadcrumb($crumbs_title);
} else {
    elgg_push_breadcrumb($crumbs_title);
}
$content = elgg_list_entities($options);

if (!$content) {
    $content = elgg_echo('amapnews:none');
}

$filter_context = '';
if ($page_owner->getGUID() == elgg_get_logged_in_user_guid()) {
    $filter_context = 'mine';
}

$vars = array(
    'filter_context' => $filter_context,
    'filter_override' => elgg_view('amapnews/nav', array('selected' => $vars['page'], 'page_owner_guid' => $page_owner->getGUID())),
    'content' => $content,
    'title' => $title,
);

// don't show filter if out of filter context
if ($page_owner instanceof ElggGroup) {
    $vars['filter'] = false;
}

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);
