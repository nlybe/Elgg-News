<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

// once elgg_view stops throwing all sorts of junk into $vars, we can use 
$title = elgg_extract('title', $vars, '');
$description = elgg_extract('description', $vars, '');
$excerpt = elgg_extract('excerpt', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$connected_guid = elgg_extract('connected_guid', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
if (!$container_guid) {
	$container_guid = elgg_get_logged_in_user_guid();
}
$guid = elgg_extract('guid', $vars, null);
$cguid = elgg_extract('cguid', $vars, null);

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

<?php if ($connected_entity_exists) echo '<div style="padding:20px;display:block;min-width:500px;">'; ?>
	
<p><?php echo elgg_echo('amapnews:add:requiredfields'); ?></p>
<div>
    <label><?php echo elgg_echo('amapnews:add:title'); ?></label> <span style="color:red;">(*)</span>
    <span class='amapnews_custom_fields_more_info' id='more_info_title' title='<?php echo elgg_echo('amapnews:add:title:note'); ?>'></span>
    <br /><?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title)); ?>
</div>

<div>
    <label><?php echo elgg_echo('amapnews:add:excerpt'); ?></label> <span style="color:red;">(*)</span>
    <span class='amapnews_custom_fields_more_info' id='more_info_excerpt' excerpt='<?php echo elgg_echo('amapnews:add:excerpt:note'); ?>'></span>
    <br /><?php echo elgg_view('input/text', array('name' => 'excerpt', 'value' => $excerpt)); ?>
</div>

<?php if (!$connected_entity_exists) { /* do not display description when is connected with other entity */?>
<div>
    <label><?php echo elgg_echo('amapnews:add:description'); ?></label>
    <span class='amapnews_custom_fields_more_info' id='more_info_description' description='<?php echo elgg_echo('amapnews:add:description:note'); ?>'></span>
    <br /><?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $description)); ?>
</div>

<?php } ?>

<div style="display:block; clear:both;">
    <label><?php echo elgg_echo('amapnews:add:tags'); ?></label>
    <?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags)); ?>
</div>

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
    echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
    echo elgg_view('input/submit', array('value' => elgg_echo('amapnews:add:submit')));
?>
</div>

<?php if ($connected_entity_exists) echo '</div>'; ?>
