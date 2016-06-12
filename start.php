<?php
/**
 * Elgg News plugin
 * @package amapnews
 */
 
require_once(dirname(__FILE__) . '/lib/hooks.php');
require_once(dirname(__FILE__) . '/lib/widgets.php');

elgg_register_event_handler('init', 'system', 'amapnews_init');

define('AMAPNEWS_GENERAL_YES', 'yes');	// general purpose string for yes
define('AMAPNEWS_GENERAL_NO', 'no');	// general purpose string for no

/**
 * amapnews plugin initialization functions.
 */
function amapnews_init() {
 	
    // register a library of helper functions
    elgg_register_library('elgg:amapnews', elgg_get_plugins_path() . 'amapnews/lib/amapnews.php');
    
    // register extra css
    elgg_extend_view('elgg.css', 'amapnews/amapnews.css');
        
    // Register entity_type for search
    elgg_register_entity_type('object', Amapnews::SUBTYPE);
    
    // Site navigation
    $item = new ElggMenuItem('amapnews', elgg_echo('amapnews:menu'), 'news');
    elgg_register_menu_item('site', $item); 
    
    // add option to all site entities for adding to news
    elgg_register_plugin_hook_handler('register', 'menu:entity', 'amapnews_entity_menu_setup', 400);

    // add option for admin to add/remove user from news-staff
    elgg_register_plugin_hook_handler("register", "menu:user_hover", "news_staff_user_hover_menu_hook");

    // Register menu item to an ownerblock. It is used to  register news menu item to groups
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'amapnews_owner_block_menu');
    
    // Register a URL handler for news
    elgg_register_plugin_hook_handler('entity:url', 'object', 'amapnews_set_url');
    
    // Register a page handler, so we can have nice URLs
    elgg_register_page_handler('news', 'amapnews_page_handler');
    elgg_register_page_handler('amapnews', 'amapnews_page_handler');

    // extend group main page 
    elgg_extend_view('groups/tool_latest', 'amapnews/group_module');
    
    // add the group news tool option
    add_group_tool_option('amapnews', elgg_echo('amapnews:group:enable'), true);   
	
    // loads the widgets
    amapnews_widgets_init();
    
    // Register actions
    $action_path = elgg_get_plugins_path() . 'amapnews/actions/amapnews';
    elgg_register_action('amapnews/add', "$action_path/add.php");    
    elgg_register_action('amapnews/delete', "$action_path/delete.php");
    elgg_register_action('amapnews/staff', "$action_path/staff.php", "admin");
    elgg_register_action('amapnews/set_featured', "$action_path/set_featured.php", "admin");    
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

    $resource_vars = array();
    switch ($page[0]) {
        case "add":
            $resource_vars['guid'] = elgg_extract(1, $page);
            echo elgg_view_resource('amapnews/add', $resource_vars);
            break;
            
        case "add_existed":
            $resource_vars['cguid'] = elgg_extract(1, $page);
            echo elgg_view_resource('amapnews/add_existed', $resource_vars);
            break;            
            
        case "edit":
            $resource_vars['guid'] = elgg_extract(1, $page);
            echo elgg_view_resource('amapnews/edit', $resource_vars);
            break;
            
        case "view":
            $resource_vars['guid'] = elgg_extract(1, $page);
            echo elgg_view_resource('amapnews/view', $resource_vars);
            break;   
            
        case "owner":
            echo elgg_view_resource('amapnews/owner');
            break;   
            
        case "group":
            group_gatekeeper();
            echo elgg_view_resource('amapnews/owner');
            break;
            
        case "all":
            echo elgg_view_resource('amapnews/all');
            break;   
            
        default:
            echo elgg_view_resource('amapnews/all');
            return false;
    }

    elgg_pop_context();
    return true;
}

?>
