<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_library('elgg:amapnews');

// modified to be compatible with widget manager
$owner = get_entity($vars['entity']->owner_guid);
$url = elgg_get_site_url()."amapnews";

//the number of files to display
$num = (int) $vars['entity']->num_display;
if (!$num) {
	$num = 5;
}		
	
$options = array(
	'type'=>'object',
	'subtype'=>'amapnews', 
	'limit'=>$num,
	'full_view' => false,
	'pagination' => false,
	'size' => 'small'
);

if (elgg_instanceof($owner, 'user')) {
	$posts = elgg_get_entities($options);	
	if (is_array($posts) && sizeof($posts) > 0) {
		$content =  '<ul class="elgg-list">';	
		
		foreach($posts as $post) {
			$content .=  "<li class=\"pvs\">";
			
			$owner = $post->getOwnerEntity();		
			if (display_user_icon()) 
				$owner_icon = elgg_view_entity_icon($owner, 'small');
			else
				$owner_icon = '';
				
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
				
			$date = elgg_view_friendly_time($post->time_created);			
			
			$subtitle = "{$author_text} {$date}";
			$subtitle .= '<br />'.$post->excerpt;
			$params = array('entity' => $post,'subtitle' => $subtitle);
			$params = $params + $vars;
			$list_body = elgg_view('object/elements/summary', $params);
			$content .= elgg_view_image_block($owner_icon, $list_body);
			$content .= "</li>";
		}
				
		$content .= "</ul>";
	}	
} else {
	elgg_push_context('widgets');
	$content = elgg_list_entities($options);
	elgg_pop_context();	
}


if (!$content) {
	$content = '<p>' . elgg_echo('amapnews:none') . '</p>';
}

echo $content;

$more_link = elgg_view('output/url', array(
	'href' => $url,
	'text' => elgg_echo("amapnews:widget:viewall"),
	'is_trusted' => true,
));
echo "<span class=\"elgg-widget-more\">$more_link</span>";
