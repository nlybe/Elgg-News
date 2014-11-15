<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

// Get engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

elgg_load_library('elgg:amapnews');

$connected_guid = get_input("cguid");
$entity_unit = get_entity($connected_guid);

if ($entity_unit && !elgg_instanceof($entity_unit, 'object', 'amapnews')) {

	$form_vars = array('name' => 'amapnewsForm', 'enctype' => 'multipart/form-data');

	$vars = amapnews_prepare_form_vars();
	$vars['cguid'] = $connected_guid;
	echo elgg_view_form('amapnews/add', $form_vars, $vars);

}
else {
	echo elgg_echo("amapnews:add:novalidentity");
}
