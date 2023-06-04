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

// $add_link = elgg_view('output/url', [
//     'href' => "news/add/$group->guid",
//     'text' => elgg_echo('elggnews:add'),
//     'is_trusted' => true,
// ]);

$add_link = elgg_view('output/url', [
    'href' => elgg_generate_url('add:object:news', ['guid' => $group->guid]),
    'text' => elgg_echo('elggnews:add'),
    'is_trusted' => true,
]);

$params = [
	'entity_type' => 'object',
	'entity_subtype' => 'news',
    'content' => $content,
    'all_link' => $all_link,
    'add_link' => $add_link,
];
$params = $params + $vars;

echo elgg_view('groups/profile/module', $params);
