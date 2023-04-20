<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

use ElggNews\NewsOptions;

$options = [
    'type' => 'object',
    'subtype' => 'news', 
    'limit' => 5,
    'full_view' => false,
    'pagination' => false,
    'size' => 'small',
    'full_view' => false,
    'simplified_view' => true,
    'metadata_name_value_pairs' => [
        ['name' => 'featured','value' => NewsOptions::NEWS_YES, 'operand' => '='],
    ],
];

$body = elgg_list_entities($options);

echo elgg_view_module('aside', elgg_echo('elgg-news-featured'), $body);
