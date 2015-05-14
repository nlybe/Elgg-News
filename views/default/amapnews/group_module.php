<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_library('elgg:amapnews');
$group = elgg_get_page_owner_entity();

if ($group->amapnews_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "amapnews/group/$group->guid/all",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtypes' => 'amapnews',
	'container_guid' => elgg_get_page_owner_guid(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
);
$content = elgg_list_entities($options);
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('amapnews:none') . '</p>';
}

$post_link = elgg_view('output/url', array(
	'href' => "amapnews/add/$group->guid",
	'text' => elgg_echo('amapnews:add'),
	'is_trusted' => true,
));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('amapnews:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $post_link,
));
