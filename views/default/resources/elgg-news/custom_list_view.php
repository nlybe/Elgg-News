<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

use ElggNews\NewsOptions;

$limit = elgg_extract('limit', $vars, elgg_get_config('default_limit'));
$featured = get_input('featured', false);

$options = [
    'type' => 'object',
    'subtype' => 'news',
    'limit' => $limit,
];

if ($featured) {
    $options['metadata_name_value_pairs'] = [
        [ 
            'name' => 'featured',
            'value' => NewsOptions::NEWS_YES, 
            'operand' => '=' ],
    ];
}

$entities = elgg_get_entities($options);
$title = elgg_echo('elgg-news');

if (!$entities) {
    $content = elgg_echo('elggnews:none');
} 
else {
    $content = elgg_view('elgg-news/custom_list_view', [
        'entities' => $entities,
        'read_more' => true,
        'item_class' => '',
        'photo_size' => 'custom',
        'photo_cover' => true,
        'photo_class' => '',
    ]);
}

$body = elgg_view_layout('one_column', [
    'content' => $content,
    'title' => $title,
    'filter' => false,
]);

echo elgg_view_page($title, $body);

