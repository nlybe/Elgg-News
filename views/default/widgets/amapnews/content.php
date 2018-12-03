<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

// modified to be compatible with widget manager
$owner = get_entity($vars['entity']->owner_guid);

//the number of files to display
$num = (int) $vars['entity']->num_display;
if (!$num) {
    $num = 5;
}		

$options = array(
    'type'=>'object',
    'subtype'=>'news', 
    'limit'=>$num,
    'full_view' => false,
    'pagination' => false,
    'size' => 'small'
);

if (elgg_instanceof($owner, 'user')) {
    if (!elgg_in_context('dashboard')) {
        $options['owner_guid'] = $owner->guid;
    }
    
    $posts = elgg_get_entities($options);	
	
    if (is_array($posts) && sizeof($posts) > 0) {
        $content = '<ul class="elgg-list">';	

        foreach($posts as $post) {
            $content .=  "<li class=\"pvs\">";

            $owner = $post->getOwnerEntity();		
            if (NewsOptions::displayUserIcon()) 
                $news_icon = elgg_view_entity_icon($owner, 'small');
            else
                $news_icon = $post->getNewsIcon();

            if (NewsOptions::displayUsername()) {
                $owner_link = elgg_view('output/url', array(
                    'href' => "news/owner/$owner->username",
                    'text' => $owner->name,
                    'is_trusted' => true,
                ));
                $author_text = elgg_echo('byline', array($owner_link));
            }
            else
                $author_text = '';

            $date = elgg_view_friendly_time($post->time_created);			

            $subtitle = "{$author_text} {$date}";
            $subtitle .= '<br />'.$post->excerpt;
            $params = array('entity' => $post,'subtitle' => $subtitle);
            $params = $params + $vars;
            $list_body = elgg_view('object/elements/summary', $params);
            $content .= elgg_view_image_block($news_icon, $list_body);
            $content .= "</li>";
        }
        $content .= "</ul>";
    }	
} 
elseif (elgg_instanceof($owner, 'group')) {
    $options['container_guid']= elgg_get_page_owner_guid();

    elgg_push_context('widgets');
    $content = elgg_list_entities($options);
    elgg_pop_context();	
} 
else {
    elgg_push_context('widgets');
    $content = elgg_list_entities($options);
    elgg_pop_context();	
}

if ($content) {
    echo $content;

    $text = elgg_echo("amapnews:widget:viewall").elgg_view_icon('angle-double-right');
    echo elgg_format_element('div', ['class' => 'elgg-widget-more'], elgg_view('output/url', [
        'href' => elgg_normalize_url('news'),
        'text' => $text,
        'is_trusted' => true,
    ]));    
}
else {
    echo elgg_format_element('p', [], elgg_echo('amapnews:none'));
}


