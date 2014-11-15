<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

function amapnews_manager_run_once_subtypes()	{
	
	add_subtype('object', Amapnews::SUBTYPE, "Amapnews");
}
