<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

use ElggNews\NewsOptions;

$page_owner = elgg_get_page_owner_entity();
$user = elgg_get_logged_in_user_entity();
$staff = $user->news_staff;

$options = [
    'type' => 'object',
    'subtype' => 'news',
    'full_view' => false,
    'view_toggle_type' => false 
];

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('elgg-news'));

$content = elgg_list_entities($options);
$title = elgg_echo('elgg-news');


if (NewsOptions::allowPost($page_owner, $user)) {
    elgg_register_title_button('news', 'add', 'object', 'news');
}

if (!$content) {
    $content = elgg_echo('elggnews:none');
} 

$layout_options = [
    'filter' => false,
    'content' => $content,
    'title' => $title,
    'filter_override' => '',
];

$template = 'one_column';
if (NewsOptions::showFeaturedOnSidebar()) {
    $template = 'default';
    $layout_options['sidebar'] = elgg_view('elgg-news/sidebar', ['page' => 'all']);
}

$layout = elgg_view_layout($template, $layout_options);

echo elgg_view_page($title, $layout);