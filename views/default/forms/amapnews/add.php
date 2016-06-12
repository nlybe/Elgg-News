<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

// once elgg_view stops throwing all sorts of junk into $vars, we can use 
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

$guid = elgg_extract('guid', $vars, null);
$cguid = elgg_extract('cguid', $vars, null);
$group_guid = elgg_extract('group_guid', $vars, null);

$comments_input = elgg_view('input/dropdown', array(
    'name' => 'comments_on',
    'id' => 'amapnews_comments_on',
    'value' => elgg_extract('comments_on', $vars, ''),
    'options_values' => array('On' => elgg_echo('on'), 'Off' => elgg_echo('off'))
));

$connected_entity_exists = false;
$connected_entity_guid = ($cguid?$cguid:$connected_guid);
if ($connected_entity_guid) {
    $connected_entity_unit = get_entity($connected_entity_guid);

    if ($connected_entity_unit) {
        $connected_entity_exists = true;

        if (!$title)
            $title = $connected_entity_unit->title;

        if (!$excerpt)	{
            if ($connected_entity_unit->excerpt)    // case of entities with excerpt like blogs
                $excerpt = elgg_get_excerpt($connected_entity_unit->excerpt);
            else                    				// case of standard entities
                $excerpt = elgg_get_excerpt($connected_entity_unit->description);
        }
    }	
}

?>

<?php if ($connected_entity_exists) echo '<div style="" class="add_existed">'; ?>
<?php if ($connected_entity_exists) echo '<h3>'.elgg_echo('amapnews:add:connected_entity:title').'</h3>'; ?>

<?php
    echo elgg_format_element('p', [], elgg_echo('amapnews:add:requiredfields'));
    
    echo elgg_format_element('div', [], elgg_view_input('text', array(
        'name' => 'title',
        'value' => $title,
        'label' => elgg_echo('amapnews:add:title'),
        'help' => elgg_echo('amapnews:add:title:help'),
        'required' => true,
    )));
    
    echo elgg_format_element('div', [], elgg_view_input('text', array(
        'name' => 'excerpt',
        'value' => $excerpt,
        'label' => elgg_echo('amapnews:add:excerpt'),
        'help' => elgg_echo('amapnews:add:excerpt:help'),
        'required' => true,
    )));
    
    if (!$connected_entity_exists) { /* do not display description when is connected with other entity */
        echo elgg_format_element('div', [], elgg_view_input('longtext', array(
            'name' => 'description',
            'value' => $description,
            'label' => elgg_echo('amapnews:add:description'),
            'help' => elgg_echo('amapnews:add:description:help'),
        )));
    }

    echo elgg_format_element('div', ['class' => 'amapnews_featured'], elgg_view_input('checkbox', array(
        'name' => 'featured',
        'value' => AMAPNEWS_GENERAL_YES,
        'default' => AMAPNEWS_GENERAL_NO,
        'checked' => ($featured === AMAPNEWS_GENERAL_YES) ? true : false,
        'label' => elgg_echo('amapnews:add:featured'),
        'help' => elgg_echo('amapnews:add:featured:help'),
    )));
    
    echo elgg_format_element('div', [], elgg_view_input('text', array(
        'name' => 'tags',
        'value' => $tags,
        'label' => elgg_echo('amapnews:add:tags'),
        'help' => elgg_echo('amapnews:add:tags:help'),
    )));    
?>

<?php if (!$connected_entity_exists) { /* do not display comments when is connected with other entity */?>
<div>
    <label for="amapnews_comments_on"><?php echo elgg_echo('comments'); ?></label>
    <?php echo $comments_input; ?>
</div>
<?php } ?>

<div>
    <label><?php echo elgg_echo('access'); ?></label><br />
    <?php echo elgg_view('input/access', array('name' => 'access_id', 'value' => $access_id)); ?>
</div>
	
<div class="elgg-foot">
<?php

    if ($guid) {
        echo elgg_view('input/hidden', array('name' => 'amapnews_guid', 'value' => $guid));
    }
    if ($connected_entity_guid) {
        echo elgg_view('input/hidden', array('name' => 'connected_guid', 'value' => $connected_entity_guid));
    }  
    if ($group_guid) {
        echo elgg_view('input/hidden', array('name' => 'group_guid', 'value' => $group_guid));
    }  
    echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
    echo elgg_view('input/submit', array('value' => elgg_echo('amapnews:add:submit')));
?>
</div>

<?php if ($connected_entity_exists) echo '</div>'; ?>
