<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

use ElggNews\NewsOptions;

if (!NewsOptions::allowPostOnGroups()) {
    return;
}

$group = elgg_extract('entity', $vars);
if (!($group instanceof ElggGroup)) {
    return;
}

if (!$group->isToolEnabled('news')) {
    return;
}

$all_link = elgg_view('output/url', [
    'href' => "news/group/$group->guid/all",
    'text' => elgg_echo('link:view:all'),
    'is_trusted' => true,
]);

elgg_push_context('widgets');
$options = [
    'type' => 'object',
    'subtypes' => 'news',
    'container_guid' => elgg_get_page_owner_guid(),
    'limit' => 6,
    'full_view' => false,
    'pagination' => false,
];
$content = elgg_list_entities($options);
elgg_pop_context();

if (!$content) {
    $content = elgg_format_element('p', [], elgg_echo('elggnews:none'));
}

$post_link = elgg_view('output/url', [
    'href' => "news/add/$group->guid",
    'text' => elgg_echo('elggnews:add'),
    'is_trusted' => true,
]);

echo elgg_view('groups/profile/module', [
    'title' => elgg_echo('elggnews:group'),
    'content' => $content,
    'all_link' => $all_link,
    'add_link' => $post_link,
]);
