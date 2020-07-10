<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

use Amapnews\NewsOptions;

$options = array(
    'type' => 'object',
    'subtype' => 'news', 
    'limit' => 5,
    'full_view' => false,
    'pagination' => false,
    'size' => 'small',
    'full_view' => false,
    'simplified_view' => true,
    'metadata_name_value_pairs' => array(
        array('name' => 'featured','value' => NewsOptions::NEWS_YES, 'operand' => '='),
    ),
);

$body = elgg_list_entities($options);

echo elgg_view_module('aside', elgg_echo('amapnews_featured'), $body);
