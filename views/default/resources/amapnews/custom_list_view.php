<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$limit = elgg_extract('limit', $vars, elgg_get_config('default_limit'));
$featured = get_input('featured', false);

$options = array(
    'type' => 'object',
    'subtype' => 'news',
    'limit' => $limit,
);

if ($featured) {
    $options['metadata_name_value_pairs'] = array(
        array('name' => 'featured','value' => NewsOptions::NEWS_YES, 'operand' => '='),
    );
}

$entities = elgg_get_entities($options);
$title = elgg_echo('amapnews');

if (!$entities) {
    $content = elgg_echo('amapnews:none');
} 
else {
    $content = elgg_view('amapnews/custom_list_view', array(
        'entities' => $entities,
        'read_more' => true,
        'item_class' => '',
        'photo_size' => 'custom',
        'photo_cover' => true,
        'photo_class' => '',
    ));
}

$body = elgg_view_layout('one_column', array(
    'content' => $content,
    'title' => $title,
));

echo elgg_view_page($title, $body);

