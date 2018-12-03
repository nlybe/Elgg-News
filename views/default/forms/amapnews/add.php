<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$title = elgg_extract('title', $vars, '');
$description = elgg_extract('description', $vars, '');
$excerpt = elgg_extract('excerpt', $vars, '');
$featured = elgg_extract('featured', $vars, false);
$tags = elgg_extract('tags', $vars, '');
$connected_guid = elgg_extract('connected_guid', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
if (!$container_guid) {
    $container_guid = elgg_get_page_owner_guid();
}

if ($excerpt) {
    $excerpt = str_replace('<br />','',$excerpt);
}

$guid = elgg_extract('guid', $vars, null);
$cguid = elgg_extract('cguid', $vars, null);
$group_guid = elgg_extract('group_guid', $vars, null);

$connected_entity_exists = false;
$connected_entity_guid = ($cguid?$cguid:$connected_guid);
if ($connected_entity_guid) {
    $connected_entity_unit = get_entity($connected_entity_guid);

    if ($connected_entity_unit) {
        $connected_entity_exists = true;

        if (!$title) {
            $title = $connected_entity_unit->title;
        }

        if (!$excerpt)	{
            if ($connected_entity_unit->excerpt) {    // case of entities with excerpt like blogs
                $excerpt = elgg_get_excerpt($connected_entity_unit->excerpt);
            }
            else {  // case of standard entities 
                $excerpt = elgg_get_excerpt($connected_entity_unit->description);
            }
        }
    }	
}

if ($connected_entity_exists) {
    echo '<div class="add_existed">'; 
    echo elgg_format_element('h3', [], elgg_echo('amapnews:add:connected_entity:title'));
}

echo elgg_format_element('p', [], elgg_echo('amapnews:add:requiredfields'));

echo elgg_view_field([
    '#type' => 'text',
    'name' => 'title',
    'value' => $title,
    '#label' => elgg_echo('amapnews:add:title'),
    '#help' => elgg_echo('amapnews:add:title:help'),
    'required' => true,
]);

echo elgg_view_field([
    '#type' => 'plaintext',
    'name' => 'excerpt',
    'value' => $excerpt,
    '#label' => elgg_echo('amapnews:add:excerpt'),
    '#help' => elgg_echo('amapnews:add:excerpt:help'),
    'required' => true,
]);

if (!$connected_entity_exists) { /* do not display description when is connected with other entity */
    echo elgg_view_field([
        '#type' => 'longtext',
        'name' => 'description',
        'value' => $description,
        '#label' => elgg_echo('amapnews:add:description'),
        '#help' => elgg_echo('amapnews:add:description:help'),
    ]);
}
    
if ($guid) {
    $entity = get_entity($guid);
    if ($entity->hasIcon('medium')) {
        echo elgg_format_element('div', ['style' => 'float: right;'], elgg_view_entity_icon($entity, 'medium', ['img_class' => 'elgg-photo']));
    }
}
echo elgg_view_field([
    '#type' => 'file',
    'name' => 'photo',
    '#label' => elgg_echo('amapnews:add:photo'),
    '#help' => elgg_echo('amapnews:add:photo:help'),
]);

if (NewsOptions::canSetFeaturedNews()) {
    echo elgg_view_field([
        '#type' => 'checkbox',
        'name' => 'featured',
        'value' => NewsOptions::NEWS_YES,
        'default' => NewsOptions::NEWS_NO,
        'checked' => ($featured === NewsOptions::NEWS_YES) ? true : false,
        '#label' => elgg_echo('amapnews:add:featured'),
        '#help' => elgg_echo('amapnews:add:featured:help'),
    ]);
}

echo elgg_view_field([
    '#type' => 'tags',
    'name' => 'tags',
    'value' => $tags,
    '#label' => elgg_echo('amapnews:add:tags'),
    '#help' => elgg_echo('amapnews:add:tags:help'),
]);

if (!$connected_entity_exists) { /* do not display comments when is connected with other entity */
    echo elgg_view_field([
        '#type' => 'dropdown',
        'id' => 'amapnews_comments_on',
        'name' => 'comments_on',
        'value' => elgg_extract('comments_on', $vars, ''),
        'options_values' => array('On' => elgg_echo('on'), 'Off' => elgg_echo('off')),
        '#label' => elgg_echo('comments'),
    ]);
}

echo elgg_view_field([
    '#type' => 'access',
    'name' => 'access_id',
    'value' => $access_id,
    '#label' => elgg_echo('access'),
]);


$footer_fields = [
    [
        '#type' => 'hidden',
        'name' => 'connected_guid',
        'value' => $connected_entity_guid,
    ],
    [
        '#type' => 'hidden',
        'name' => 'group_guid',
        'value' => $group_guid,
    ],
    [
        '#type' => 'hidden',
        'name' => 'container_guid',
        'value' => $container_guid,
    ],
    [
        '#type' => 'hidden',
        'name' => 'amapnews_guid',
        'value' => elgg_extract('guid', $vars),
    ],
    [
        '#type' => 'submit',
        'value' => elgg_echo('amapnews:add:submit'),
    ],
];

foreach ($footer_fields as $field) {
    $footer .= elgg_view_field($field);
}

elgg_set_form_footer($footer);

if ($connected_entity_exists) { 
    echo '</div>';
}
