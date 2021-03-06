<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

use Amapnews\NewsOptions;

$plugin = elgg_get_plugin_from_id('amapnews');

$potential_yes_no = array(
    NewsOptions::NEWS_YES => elgg_echo('amapnews:settings:yes'),
    NewsOptions::NEWS_NO => elgg_echo('amapnews:settings:no'),
); 

// set if display user icon on list or single view
$general_settings .= elgg_view_field([
    'id' => 'show_user_icon',
    '#type' => 'checkbox',
    'name' => 'params[show_user_icon]',
    '#label' => elgg_echo('amapnews:settings:show_user_icon'),
    '#help' => elgg_echo('amapnews:settings:show_user_icon:note'),
    'checked' => ($plugin->show_user_icon || !isset($plugin->show_user_icon) ? true : false),
]);

// set if display username on list or single view
$general_settings .= elgg_view_field([
    'id' => 'show_username',
    '#type' => 'checkbox',
    'name' => 'params[show_username]',
    '#label' => elgg_echo('amapnews:settings:show_username'),
    '#help' => elgg_echo('amapnews:settings:show_username:note'),
    'checked' => ($plugin->show_username || !isset($plugin->show_username) ? true : false),
]);

// set if allow group's owners to post news/announcements inside groups
$general_settings .= elgg_view_field([
    'id' => 'post_on_groups',
    '#type' => 'checkbox',
    'name' => 'params[post_on_groups]',
    '#label' => elgg_echo('amapnews:settings:post_on_groups'),
    '#help' => elgg_echo('amapnews:settings:post_on_groups:note'),
    'checked' => ($plugin->post_on_groups || !isset($plugin->post_on_groups) ? true : false),
]);

// set if allow group's owners to post news/announcements inside groups
$general_settings .= elgg_view_field([
    'id' => 'featured_by_admin_only',
    '#type' => 'checkbox',
    'name' => 'params[featured_by_admin_only]',
    '#label' => elgg_echo('amapnews:settings:featured_by_admin_only'),
    '#help' => elgg_echo('amapnews:settings:featured_by_admin_only:note'),
    'checked' => ($plugin->featured_by_admin_only || !isset($plugin->featured_by_admin_only) ? true : false),
]);

// set if allow group's owners to post news/announcements inside groups
$general_settings .= elgg_view_field([
    'id' => 'show_featured_on_sidebar',
    '#type' => 'checkbox',
    'name' => 'params[show_featured_on_sidebar]',
    '#label' => elgg_echo('amapnews:settings:show_featured_on_sidebar'),
    '#help' => elgg_echo('amapnews:settings:show_featured_on_sidebar:note'),
    'checked' => ($plugin->show_featured_on_sidebar || !isset($plugin->show_featured_on_sidebar) ? true : false),
]);
echo elgg_view_module("inline", elgg_echo('amapnews:settings:general'), $general_settings);


// custom icon size
$custom_icon_size .= elgg_format_element('p', [], elgg_echo('amapnews:settings:custom_icon:intro'));
$custom_icon_size .= elgg_view_field([
    'id' => 'custom_icon_width',
    '#type' => 'text',
    'name' => 'params[custom_icon_width]',
    'value' => $plugin->custom_icon_width,
    '#label' => elgg_echo('amapnews:settings:custom_icon_width'),
    '#help' => elgg_echo('amapnews:settings:custom_icon_width:note'),
]);

$custom_icon_size .= elgg_view_field([
    'id' => 'custom_icon_height',
    '#type' => 'text',
    'name' => 'params[custom_icon_height]',
    'value' => $plugin->custom_icon_height,
    '#label' => elgg_echo('amapnews:settings:custom_icon_height'),
    '#help' => elgg_echo('amapnews:settings:custom_icon_height:note'),
]);

echo elgg_view_module("inline", elgg_echo('amapnews:settings:custom_icon'), $custom_icon_size);


// default news icon
$icons_path = elgg_get_plugins_path().'amapnews/graphics/icons';
$icons_icon = elgg_format_element('p', [], elgg_echo('amapnews:settings:icon:icons:intro'));
$icons_icon .= NewsOptions::getFiles($icons_path, $plugin->icons_icon, 'icons_icon', 'amapnews/icons/');
echo elgg_view_module("inline", elgg_echo('amapnews:settings:icon:icons'), $icons_icon);


// manage news-staff
$staff = elgg_list_entities(array(
    'type' => 'user',
    'subtype'=> null,
    'metadata_name_value_pairs' => array (
        'name'	=> 'news_staff',
        'value'	=> '1',
        'operand' => '>',
    ),
    'full_view' => false,
));

if($staff) {
    $output = elgg_format_element('p', ['class' => 'elgg-subtext'], elgg_echo('amapnews:settings:managestaff'));
    $output.= $staff;
} 
else {
    $output = elgg_format_element('p', ['class' => 'elgg-subtext'], elgg_echo('amapnews:settings:nostaff'));
}
echo elgg_view_module("inline", elgg_echo('amapnews:settings:staff'), $output);
