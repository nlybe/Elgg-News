<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_library('elgg:amapnews');

$entities = elgg_extract('entities', $vars);
$read_more = elgg_extract('read_more', $vars, true);
$custom_item_class = elgg_extract('item_class', $vars, '');
$photo_size = elgg_extract('photo_size', $vars, 'master');
$photo_cover = elgg_extract('photo_cover', $vars, false);
$photo_class = elgg_extract('photo_class', $vars, '');

$default_item_class = ($photo_cover?'news_item_cover':'news_item');
if ($entities) {
    foreach ($entities as $e) {
        $entity_photo = elgg_view('output/img', array(
            'src' => amapnews_getEntityIconUrl($e->getGUID(), $photo_size, true),
            'alt' => $e->title,
            'class' => "elgg-photo $photo_class",
        )); 
        $news_photo = elgg_view('output/url', array(
            'text' => $entity_photo,
            'href' => $e->getURL(),
            'title' => $e->title,
            'class' => "thumbnail",
        ));  
        $news_photo = elgg_format_element('div', ['class' => 'photo_box'], $news_photo);  
        
               
        $news_body = elgg_format_element('div', [], $e->title);
        $news_body .= elgg_format_element('div', [], $e->excerpt);
        if ($read_more) {
            $news_body .= elgg_format_element('div', [], elgg_view('output/url', array(
                'text' => elgg_echo('amapnews:read_more'),
                'href' => $e->getURL(),
                'title' => $e->title,
            )));     
        }
        
        $news_body = elgg_format_element('div', ['class' => 'news_body'],$news_body);        
        echo elgg_format_element('div', ['class' => "$default_item_class $custom_item_class"], $news_photo.$news_body);
        
    }
}
