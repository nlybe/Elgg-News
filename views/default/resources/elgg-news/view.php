<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

$guid = elgg_extract('guid', $vars);
elgg_entity_gatekeeper($guid, 'object', 'news');

$entity = get_entity($guid);

if (!$entity) {
    elgg_error_response(elgg_echo('noaccess'));
    forward(REFERRER);
}

$page_owner = elgg_get_page_owner_entity();
if ($page_owner instanceof \ElggGroup) {
    elgg_push_breadcrumb(elgg_echo('groups'), 'groups');
    elgg_push_breadcrumb($page_owner->name, $page_owner->getURL());
    elgg_push_breadcrumb(elgg_echo('elggnews:menu'), "news/group/$page_owner->guid/all");
} else {
    elgg_push_breadcrumb(elgg_echo('elggnews:menu'), 'news');
}

elgg_push_breadcrumb($entity->title, $entity->getURL());

$content = elgg_view_entity($entity, ['full_view' => true]);

echo elgg_view_page($entity->getDisplayName(), [
	'content' => $content,
	'filter_id' => '',
	'entity' => $entity,
	'sidebar' => '',
], 'default', [
	'entity' => $entity,
]);
