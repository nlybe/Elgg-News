<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_library('elgg:amapnews');

$limit = elgg_extract('limit', $vars, elgg_get_config('default_limit'));
$featured = get_input('featured', false);

$options = array(
    'type' => 'object',
    'subtype' => 'amapnews',
    'limit' => $limit,
);

if ($featured) {
    $options['metadata_name_value_pairs'] = array(
        array('name' => 'featured','value' => AMAPNEWS_GENERAL_YES, 'operand' => '='),
    );
}

//elgg_pop_breadcrumb();
//elgg_push_breadcrumb(elgg_echo('amapnews'));
$entities = elgg_get_entities_from_metadata($options);
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
        'photo_cover' => false,
        'photo_class' => '',
    ));
}

$body = elgg_view_layout('one_column', array(
    'content' => $content,
    'title' => $title,
));

echo elgg_view_page($title, $body);

