<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$page_owner = elgg_get_page_owner_entity();
$user = elgg_get_logged_in_user_entity();
$staff = $user->news_staff;

$options = array(
    'type' => 'object',
    'subtype' => 'news',
    'full_view' => false,
    'view_toggle_type' => false 
);

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('amapnews'));

$content = elgg_list_entities($options);
$title = elgg_echo('amapnews');


if (NewsOptions::allowPost($page_owner, $user)) {
    elgg_register_title_button();
}

if (!$content) {
    $content = elgg_echo('amapnews:none');
} 

$layout_options = [
    'filter_context' => 'all',
    'content' => $content,
    'title' => $title,
    // 'filter_override' => elgg_view('amapnews/nav', array('selected' => $vars['page'])), // 20200423 probably OBS
    'filter_override' => '',
];

$template = 'one_column';
if (NewsOptions::showFeaturedOnSidebar()) {
    $template = 'default';
    $layout_options['sidebar'] = elgg_view('amapnews/sidebar', ['page' => 'all']);
}

$layout = elgg_view_layout($template, $layout_options);

echo elgg_view_page($title, $layout);