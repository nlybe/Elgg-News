<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_library('elgg:amapnews');

$full = elgg_extract('full_view', $vars, FALSE);
$entity = elgg_extract('entity', $vars, FALSE);

if (!$entity) { 
    return;
}

$owner = $entity->getOwnerEntity();

if (display_user_icon()) {
    $owner_icon = elgg_view_entity_icon($owner, 'small');
}
else {
    $owner_icon = elgg_view('output/img', array(
        'src' => elgg_get_simplecache_url('amapnews/icon/amapnews.png'),
        'alt' => elgg_echo('amapnews'),
    ));
}

$featured = '';
if ($entity->is_featured()) {
    $featured_icon = elgg_view('output/img', array(
        'src' => elgg_get_simplecache_url('amapnews/icon/featured.png'),
        'alt' => elgg_echo('amapnews:featured'),
    ));    
    $featured = elgg_format_element('div', array('style' => "float:right;"), $featured_icon);
}  

if (display_username()) {
    $owner_link = elgg_view('output/url', array(
        'href' => "amapnews/owner/$owner->username",
        'text' => $owner->name,
        'is_trusted' => true,
    ));
    $author_text = elgg_echo('byline', array($owner_link));
}
else
    $author_text = '';

$date = elgg_view_friendly_time($entity->time_created);

//only display if there are commments
if ($entity->comments_on != 'Off') {
    $comments_count = $entity->countComments();
    //only display if there are commments
    if ($comments_count != 0) {
        $text = elgg_echo("comments") . " ($comments_count)";
        $comments_link = elgg_view('output/url', array(
            'href' => $entity->getURL() . '#amapnews-comments',
            'text' => $text,
            'is_trusted' => true,
        ));
    } else {
        $comments_link = '';
    }
} else {
    $comments_link = '';
}

$metadata = elgg_view_menu('entity', array(
    'entity' => $vars['entity'],
    'handler' => 'amapnews',
    'sort_by' => 'priority',
    'class' => 'elgg-menu-hz',
));

$subtitle = "$author_text $date $comments_link $featured";

if ($full && !elgg_in_context('gallery')) {
    $params = array(
        'entity' => $entity,
        'title' => false,
        'metadata' => $metadata,
        'subtitle' => $subtitle,
    );
    $params = $params + $vars;
    $summary = elgg_view('object/elements/summary', $params);

    $body = '';
    $body .= '<div class="elgg-image-block clearfix">';
    
    if ($entity->description) 
        $body .= '<div class="desc">'.$entity->description.'</div>';
    else 
        $body .= '<div class="desc">&nbsp;</div>';

    $body .= '</div>';

    echo elgg_view('object/elements/full', array(
        'entity' => $entity,
        'icon' => $owner_icon,
        'summary' => $summary,
        'body' => $body,
    ));
} 
else {
    // we want small thumb on group views
    $page_owner = elgg_get_page_owner_entity();
    if (elgg_instanceof($page_owner, 'group'))  
        $thumbsize = 'small';
    else
        $thumbsize = 'medium';
	
    $display_text = $url;
   
    $content =  $entity->excerpt;
    $params = array(
        'entity' => $entity,
        'metadata' => $metadata,
        'subtitle' => $subtitle,
        'content' => $content,
    );
    $params = $params + $vars;
    $body = elgg_view('object/elements/summary', $params);

    echo elgg_view_image_block($owner_icon, $body);
    
}
