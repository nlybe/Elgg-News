<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

$entities = elgg_extract('entities', $vars);
$read_more = elgg_extract('read_more', $vars, true);
$custom_item_class = elgg_extract('item_class', $vars, '');
$photo_size = elgg_extract('photo_size', $vars, 'master');
$photo_cover = elgg_extract('photo_cover', $vars, false);
$photo_class = elgg_extract('photo_class', $vars, '');

$default_item_class = ($photo_cover?'news_item_cover':'news_item');

if (!$entities) {
    return;
}

foreach ($entities as $e) {
    $entity_photo = '';
    if ($e->hasIcon($photo_size)) {
        $entity_photo = elgg_format_element('div', [], elgg_view_entity_icon($e, $photo_size, [
            'img_class' => 'elgg-photo $photo_class',
            'alt' => $e->title,
            'use_link' => false,
        ]));
        $body .= elgg_format_element('div', ['class' => 'entity_photo'],$entity_photo);
    }
    
    $news_photo = elgg_view('output/url', [
        'text' => $entity_photo,
        'href' => $e->getURL(),
        'title' => $e->title,
        'class' => "thumbnail",
    ]);
    $news_photo = elgg_format_element('div', ['class' => 'photo_box'], $news_photo);  

    $news_body = elgg_format_element('div', [], $e->title);
    $news_body .= elgg_format_element('div', [], $e->excerpt);
    if ($read_more) {
        $news_body .= elgg_format_element('div', [], elgg_view('output/url', [
            'text' => elgg_echo('elggnews:read_more') . elgg_view_icon('angle-double-right'),
            'href' => $e->getURL(),
            'title' => $e->title,
        ]));
    }

    $news_body = elgg_format_element('div', ['class' => 'news_body'],$news_body);        
    echo elgg_format_element('div', ['class' => "$default_item_class $custom_item_class"], $news_photo.$news_body);
}

