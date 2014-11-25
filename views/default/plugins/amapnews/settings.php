<?php
/**
 * Elgg News plugin
 * @package amapnews
 */
	
$plugin = elgg_get_plugin_from_id('amapnews');

$potential_yes_no = array(
    AMAPNEWS_GENERAL_YES => elgg_echo('amapnews:settings:yes'),
    AMAPNEWS_GENERAL_no => elgg_echo('amapnews:settings:no'),
); 

// set if display user icon on list or single view
$show_user_icon = $plugin->show_user_icon;
if(empty($show_user_icon)){
	$show_user_icon = AMAPNEWS_GENERAL_YES;
}    
$show_user_icon_output = elgg_view('input/dropdown', array('name' => 'params[show_user_icon]', 'value' => $show_user_icon, 'options_values' => $potential_yes_no));
$show_user_icon_output .= "<span class='elgg-subtext'>" . elgg_echo('amapnews:settings:show_user_icon:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('amapnews:settings:show_user_icon'), $show_user_icon_output);


// set if display username on list or single view
$show_username = $plugin->show_username;
if(empty($show_username)){
	$show_username = AMAPNEWS_GENERAL_YES;
}    
$show_username_output = elgg_view('input/dropdown', array('name' => 'params[show_username]', 'value' => $show_username, 'options_values' => $potential_yes_no));
$show_username_output .= "<span class='elgg-subtext'>" . elgg_echo('amapnews:settings:show_username:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('amapnews:settings:show_username'), $show_username_output);

// set if allow group's owners to post news/announcements inside groups
$post_on_groups = $plugin->post_on_groups;
if(empty($post_on_groups)){
	$post_on_groups = AMAPNEWS_GENERAL_YES;
}    
$post_on_groups_output = elgg_view('input/dropdown', array('name' => 'params[post_on_groups]', 'value' => $post_on_groups, 'options_values' => $potential_yes_no));
$post_on_groups_output .= "<span class='elgg-subtext'>" . elgg_echo('amapnews:settings:post_on_groups:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('amapnews:settings:post_on_groups'), $post_on_groups_output);

