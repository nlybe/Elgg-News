<?php
/**
 * Elgg News plugin
 * @package amapnews
 */
 
if (!function_exists('elgg_get_version')) {
	function elgg_get_version($human_readable = false) {
		global $CONFIG;

		static $version, $release;

		if (isset($CONFIG->path)) {
			if (!isset($version) || !isset($release)) {
				if (!include($CONFIG->path . "version.php")) {
					return false;
				}
			}
			return $human_readable ? $release : $version;
		}

		return false;
	}
}

require_once(dirname(__FILE__) . "/lib/run_once.php"); 

elgg_register_event_handler('init', 'system', 'amapnews_init');

define('AMAPNEWS_GENERAL_YES', 'yes');	// general purpose string for yes
define('AMAPNEWS_GENERAL_NO', 'no');	// general purpose string for no

/**
 * amapnews plugin initialization functions.
 */
function amapnews_init() {
    // Register subtype
    run_function_once('amapnews_manager_run_once_subtypes');
 	
    // register a library of helper functions
    elgg_register_library('elgg:amapnews', elgg_get_plugins_path() . 'amapnews/lib/amapnews.php');
    
    // Register entity_type for search
    elgg_register_entity_type('object', Amapnews::SUBTYPE);
    
    // Site navigation
    $item = new ElggMenuItem('amapnews', elgg_echo('amapnews:menu'), 'news');
    elgg_register_menu_item('site', $item); 
    
    // add option to all site entities for adding to news
    elgg_register_plugin_hook_handler('register', 'menu:entity', 'amapnews_entity_menu_setup', 400);
    
	// Register a page handler, so we can have nice URLs
    elgg_register_page_handler('news', 'amapnews_page_handler');
    elgg_register_page_handler('amapnews', 'amapnews_page_handler');

	// get current elgg version
	$release = elgg_get_version(true);
	    
	// Register a URL handler for agora
	if ($release < 1.9)  // version 1.8
		elgg_register_entity_url_handler('object', 'amapnews', 'amapnews_url');
	else { // use this since Elgg 1.9
		elgg_register_plugin_hook_handler('entity:url', 'object', 'amapnews_set_url');
	}	
    
    // Register actions
    $action_path = elgg_get_plugins_path() . 'amapnews/actions/amapnews';
    elgg_register_action('amapnews/add', "$action_path/add.php");    
    elgg_register_action('amapnews/delete', "$action_path/delete.php");
    
    // Add amapnews widget for displaying latest posts
	elgg_register_widget_type('amapnews', elgg_echo('amapnews:widget'), elgg_echo('amapnews:widget:description'), 'dashboard');
}

/**
 *  Dispatches amapnews pages.
 *
 * @param array $page
 * @return bool
 */
function amapnews_page_handler($page) {
    elgg_push_breadcrumb(elgg_echo('amapnews'), 'amapnews');
    
	if (!isset($page[0])) {
		$page[0] = 'all';
	}    
	$vars = array();
	$vars['page'] = $page[0];	

    $base = elgg_get_plugins_path() . 'amapnews/pages/amapnews';

    switch ($page[0]) {
	    case "add":
            admin_gatekeeper();
            include "$base/add.php";
            break;
            
	    case "addexisted":
            admin_gatekeeper();
            include "$base/addexisted.php";
            break;            
            
	    case "edit":
            admin_gatekeeper();
            set_input('guid', $page[1]);
            include "$base/edit.php";
            break;
            
        case "view":
            set_input('guid', $page[1]);
            include "$base/view.php";
            break;            
            
        default:
            include "$base/all.php";
            return false;
    }

    elgg_pop_context();
    return true;
}

/**
 * Populates the ->getUrl() method for amapnews objects for 1.8
 */
function amapnews_url($entity) {
	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	
	if ($entity->connected_guid) {
		$connected_entity = get_entity($entity->connected_guid);
		
		if ($connected_entity) 
			return $connected_entity->getURL();
		else	
			return elgg_get_site_url() . "news/view/" . $entity->getGUID() . "/" . elgg_get_friendly_title($entity->title);
	}
	else
		return elgg_get_site_url() . "news/view/" . $entity->getGUID() . "/" . elgg_get_friendly_title($entity->title);
}

/**
 * Format and return the URL for news objects, since 1.9.
 *
 * @param string $hook
 * @param string $type
 * @param string $url
 * @param array  $params
 * @return string URL of amapnews
 */
function amapnews_set_url($hook, $type, $url, $params) {
	$entity = $params['entity'];
	
	if (elgg_instanceof($entity, 'object', 'amapnews')) {
		if ($entity->connected_guid) {
			$connected_entity = get_entity($entity->connected_guid);
			$friendly_title = elgg_get_friendly_title($entity->title);
			
			if ($connected_entity) 
				return $connected_entity->getURL();
			else	
				return "news/view/{$entity->guid}/$friendly_title";
		}
		else
			return "news/view/{$entity->guid}/$friendly_title";
	}
}


/**
 * Add option so set as new by admin to entity menu at end of the menu
 */
function amapnews_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_is_admin_logged_in()) { 
		$entity = $params['entity'];
		
		if (!elgg_instanceof($entity, 'object', 'amapnews'))	{
			elgg_load_js('lightbox');
			elgg_load_css('lightbox');	
			   
			$url = elgg_get_site_url() . "mod/amapnews/addexisted.php?cguid=".$entity->guid;
			
			$options = array(
				'name' => 'setasnew',
				'text' => elgg_echo("amapnews:add:tonews"),
				'href' =>  $url,
				'priority' => 50,
				'class' => 'elgg-lightbox',
			);
			$return[] = ElggMenuItem::factory($options);
			return $return;
		}
	}
	
	return false;
}

?>
