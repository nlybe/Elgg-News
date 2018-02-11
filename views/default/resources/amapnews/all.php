<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_library('elgg:amapnews');

$page_owner = elgg_get_page_owner_entity();
$user = elgg_get_logged_in_user_entity();
$staff = $user->news_staff;

$options = array(
    'type' => 'object',
    'subtype' => 'amapnews',
    'limit' => 10,
    'full_view' => false,
    'view_toggle_type' => false 
);

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('amapnews'));
$content = elgg_list_entities($options);
$title = elgg_echo('amapnews');


if (allow_post($page_owner, $user)) {
    elgg_register_title_button();
}

if (!$content) {
    $content = elgg_echo('amapnews:none');
} 
 
$body = elgg_view_layout('content', array(
    'filter_context' => 'all',
    'content' => $content,
    'title' => $title,
    'filter_override' => elgg_view('amapnews/nav', array('selected' => $vars['page'])),
));

echo elgg_view_page($title, $body);