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

    // add option for admin to add/remove user from news-staff
	elgg_register_plugin_hook_handler("register", "menu:user_hover", "news_staff_user_hover_menu_hook");
    
	// Register a page handler, so we can have nice URLs
    elgg_register_page_handler('news', 'amapnews_page_handler');
    elgg_register_page_handler('amapnews', 'amapnews_page_handler');

    // extend group main page 
    elgg_extend_view('groups/tool_latest', 'amapnews/group_module');
    
    // add the group news tool option
    add_group_tool_option('amapnews', elgg_echo('amapnews:group:enable'), true);   
    
    // Register menu item to an ownerblock
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'amapnews_owner_block_menu');
    
	// get current elgg version
	$release = elgg_get_version(true);
	// Register a URL handler for news
	elgg_register_plugin_hook_handler('entity:url', 'object', 'amapnews_set_url');
	
    // Register actions
    $action_path = elgg_get_plugins_path() . 'amapnews/actions/amapnews';
    elgg_register_action('amapnews/add', "$action_path/add.php");    
    elgg_register_action('amapnews/delete', "$action_path/delete.php");
    elgg_register_action('amapnews/staff', "$action_path/staff.php", "admin");
    
    // Add amapnews widget for displaying latest posts
	elgg_register_widget_type('amapnews', elgg_echo('amapnews:widget'), elgg_echo('amapnews:widget:description'), array("profile", "dashboard", "index", "groups"), true);
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
            //admin_gatekeeper();
            set_input('guid', $page[1]);
            include "$base/add.php";
            break;
            
	    case "addexisted":
            admin_gatekeeper();
            include "$base/addexisted.php";
            break;            
            
	    case "edit":
            set_input('guid', $page[1]);
            include "$base/edit.php";
            break;
            
        case "view":
            set_input('guid', $page[1]);
            include "$base/view.php";
            break;   
            
        case "owner":
			include "$base/owner.php";
            break;   
            
        case "group":
            group_gatekeeper();
            include "$base/owner.php";
            break;
            
        case "all":
            include "$base/all.php";
            break;   
            
        default:
            include "$base/all.php";
            return false;
    }

    elgg_pop_context();
    return true;
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
 * Add option to set as new by admin to entity menu at end of the menu
 */
function amapnews_entity_menu_setup($hook, $type, $return, $params) {
	
	$user = elgg_get_logged_in_user_entity();
	$staff = $user->news_staff;
	
	if (elgg_is_admin_logged_in() || $staff) { 
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
				'link_class' => 'elgg-lightbox',
			);
			$return[] = ElggMenuItem::factory($options);
			return $return;
		}
	}
	
	return $return;
}

/**
 * Add a menu item to an ownerblock
 */
function amapnews_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        /* Macht zur Zeit keinen Sinn 
        $url = "amapnews/owner/{$params['entity']->username}";
        $item = new ElggMenuItem('amapnews', elgg_echo('amapnews'), $url);
        $return[] = $item;
        */
        return false;
    } else {
        if ($params['entity']->amapnews_enable != 'no') {
            $url = "news/group/{$params['entity']->guid}/all";
            $item = new ElggMenuItem('amapnews', elgg_echo('amapnews:group'), $url);
            $return[] = $item;
        }
    }

    return $return;
}

/* News-Staff */

function news_staff_user_hover_menu_hook($hook, $type, $return_value, $params) {
	
	$user = elgg_get_logged_in_user_entity();
	
	if (empty($user) || !$user->isAdmin()) {
		return $return_value;
	}
	
	if (empty($params) || !is_array($params)) {
		return $return_value;
	}
	
	$entity = elgg_extract("entity", $params);
	
	if ($entity->getGUID() == $user->getGUID()) {
		return $return_value;
	}
	
	$text = elgg_echo("amapnews:menu_user_hover:make_staff");
	
	if ($entity->news_staff) {
		$text = elgg_echo("amapnews:menu_user_hover:remove_staff");
	}
	
	$return_value[] = ElggMenuItem::factory(array(
		"name" => "amapnews_staff",
		"text" => $text,
		"href" => "action/amapnews/staff?guid=" . $entity->getGUID(),
		"confirm" => elgg_echo("question:areyousure"),
		"section" => "admin"
	));
	
	return $return_value;
}


?>
