<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$full = elgg_extract('full_view', $vars, false);
$simplified_view = elgg_extract('simplified_view', $vars, false);

$entity = elgg_extract('entity', $vars, false);
if (!$entity instanceof ElggNews) {
    return;
}

$owner = $entity->getOwnerEntity();

if (NewsOptions::displayUserIcon()) {
    $news_icon = elgg_view_entity_icon($owner, 'small');
}
else {
    $news_icon = $entity->getNewsIcon();
}

if (NewsOptions::displayUsername()) {
    $owner_link = elgg_view('output/url', array(
        'href' => "news/owner/$owner->username",
        'text' => $owner->name,
        'is_trusted' => true,
    ));
    $author_text = elgg_echo('byline', array($owner_link));
}
else {
    $author_text = '';
}

$date = elgg_view_friendly_time($entity->time_created);
$subtitle = "$author_text $date $comments_link";

if ($full) {    
    // Check if entity has photo
    if ($entity->hasIcon('large')) {
        $entity_photo = elgg_view_entity_icon($entity, 'large', [
            'img_class' => 'elgg-photo',
            'use_link' => false,
        ]);
        $body .= elgg_format_element('div', ['class' => 'entity_photo'],$entity_photo);
    }
    $body .= elgg_format_element('div', ['class' => 'news-content elgg-content mts'], elgg_view('output/longtext', [
        'value' => $entity->description,
        'class' => 'pbl desc',
    ])); 
	
    $params = [
        'icon' => $news_icon,
        'show_summary' => true,
        'body' => $body, //elgg_format_element('div', ['class' => 'clearfix'], $body),
        'show_responses' => elgg_extract('show_responses', $vars, false),
        'show_navigation' => false,
        'subtitle' => $subtitle,
    ];
    $params = $params + $vars;

    echo elgg_view('object/elements/full', $params);
    
    return;
} 
else if ($simplified_view) {
    $params = [
        'content' => $entity->excerpt,
        'subtitle' => false,
        'icon' => false,
        'tags' => false,
        'metadata' => false,
    ];
    $params = $params + $vars;
    $body = elgg_view('object/elements/summary', $params);
    
    echo elgg_view_image_block(false, $body);    
}
else {  // brief view
    $params = [
        'content' => $entity->excerpt,
        'subtitle' => $subtitle,
        'icon' => false,
    ];
    $params = $params + $vars;
    $body = elgg_view('object/elements/summary', $params);
    
    echo elgg_view_image_block($news_icon, $body);    
}
