<?php
/**
 * Elgg News plugin
 * @package amapnews
 */
	
elgg_load_library('elgg:amapnews');
$plugin = elgg_get_plugin_from_id('amapnews');

$potential_yes_no = array(
    AMAPNEWS_GENERAL_YES => elgg_echo('amapnews:settings:yes'),
    AMAPNEWS_GENERAL_NO => elgg_echo('amapnews:settings:no'),
); 

// set if display user icon on list or single view
$show_user_icon = $plugin->show_user_icon;
echo  elgg_view_input('dropdown', array(
    'id' => 'show_user_icon',
    'name' => 'params[show_user_icon]',
    'value' => empty($show_user_icon)?AMAPNEWS_GENERAL_YES:$show_user_icon,
    'options_values' => $potential_yes_no,
    'label' => elgg_echo('amapnews:settings:show_user_icon'),
    'help' => elgg_echo('amapnews:settings:show_user_icon:note'),
    'required' => false,
));

// set if display username on list or single view
$show_username = $plugin->show_username;
echo  elgg_view_input('dropdown', array(
    'id' => 'show_username',
    'name' => 'params[show_username]',
    'value' => empty($show_username)?AMAPNEWS_GENERAL_YES:$show_username,
    'options_values' => $potential_yes_no,
    'label' => elgg_echo('amapnews:settings:show_username'),
    'help' => elgg_echo('amapnews:settings:show_username:note'),
    'required' => false,
));

// set if allow group's owners to post news/announcements inside groups
$post_on_groups = $plugin->post_on_groups;
echo  elgg_view_input('dropdown', array(
    'id' => 'post_on_groups',
    'name' => 'params[post_on_groups]',
    'value' => empty($post_on_groups)?AMAPNEWS_GENERAL_YES:$post_on_groups,
    'options_values' => $potential_yes_no,
    'label' => elgg_echo('amapnews:settings:post_on_groups'),
    'help' => elgg_echo('amapnews:settings:post_on_groups:note'),
    'required' => false,
));

// set if allow group's owners to post news/announcements inside groups
$featured_by_admin_only = $plugin->featured_by_admin_only;
echo  elgg_view_input('dropdown', array(
    'id' => 'featured_by_admin_only',
    'name' => 'params[featured_by_admin_only]',
    'value' => empty($featured_by_admin_only)?AMAPNEWS_GENERAL_YES:$featured_by_admin_only,
    'options_values' => $potential_yes_no,
    'label' => elgg_echo('amapnews:settings:featured_by_admin_only'),
    'help' => elgg_echo('amapnews:settings:featured_by_admin_only:note'),
    'required' => false,
));

$custom_icon_size .= elgg_format_element('p', [], elgg_echo('amapnews:settings:custom_icon:intro'));
$custom_icon_size .= elgg_view_input('text', array(
    'id' => 'custom_icon_width',
    'name' => 'params[custom_icon_width]',
    'value' => $plugin->custom_icon_width,
    'label' => elgg_echo('amapnews:settings:custom_icon_width'),
    'help' => elgg_echo('amapnews:settings:custom_icon_width:note'),
    'required' => false,
));

$custom_icon_size .= elgg_view_input('text', array(
    'id' => 'custom_icon_height',
    'name' => 'params[custom_icon_height]',
    'value' => $plugin->custom_icon_height,
    'label' => elgg_echo('amapnews:settings:custom_icon_height'),
    'help' => elgg_echo('amapnews:settings:custom_icon_height:note'),
    'required' => false,
));
echo elgg_view_module("inline", elgg_echo('amapnews:settings:custom_icon'), $custom_icon_size);

// default news icon
$icons_path = elgg_get_plugins_path().'amapnews/graphics/icons';
$icons_icon = elgg_format_element('p', [], elgg_echo('amapnews:settings:icon:icons:intro'));
$icons_icon .= amapnews_getFiles($icons_path, $plugin->icons_icon, 'icons_icon', 'amapnews/icons/');
echo elgg_view_module("inline", elgg_echo('amapnews:settings:icon:icons'), $icons_icon);

// featured news icon
$featured_path = elgg_get_plugins_path().'amapnews/graphics/featured';
$featured_icon = elgg_format_element('p', [], elgg_echo('amapnews:settings:icon:featured:intro'));
$featured_icon .= amapnews_getFiles($featured_path, $plugin->featured_icon, 'featured_icon', 'amapnews/featured/');
echo elgg_view_module("inline", elgg_echo('amapnews:settings:icon:featured'), $featured_icon);

// manage news-staff
$staff = elgg_list_entities_from_metadata(array(
    'type' => 'user',
    'subtype'=> null,
    'metadata_name_value_pairs' => array (
        'name'	=> 'news_staff',
        'value'	=> '1',
        'operand' => '>',
    ),
    'full_view' => FALSE
));
if($staff) {
    $output = '<p class="elgg-subtext">'.elgg_echo('amapnews:settings:managestaff').'</p>';
    $output.= $staff;
} else {
    $output = '<p class="elgg-subtext">'.elgg_echo('amapnews:settings:nostaff').'</p>';
}
echo elgg_view_module("inline", elgg_echo('amapnews:settings:staff'), $output);
