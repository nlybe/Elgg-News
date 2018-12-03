<?php
/**
 * Elgg News plugin
 * @package amapnews
 */
 
require_once(dirname(__FILE__) . '/lib/hooks.php');
require_once(dirname(__FILE__) . '/lib/widgets.php');

elgg_register_event_handler('init', 'system', 'amapnews_init');

/**
 * Initialization functions
 */
function amapnews_init() {
 	
    // register extra css
    elgg_extend_view('elgg.css', 'amapnews/amapnews.css');
        
    // add a site navigation item
    elgg_register_menu_item('site', [
        'name' => 'amapnews',
        'icon' => 'newspaper',
        'text' => elgg_echo('amapnews:menu'),
        'href' => elgg_generate_url('collection:object:news:all'),
    ]);    
    
    // add option to all site entities for adding to news
    elgg_register_plugin_hook_handler('register', 'menu:entity', 'amapnews_entity_menu_setup', 400);
    
    // show featured icon, if news entity is featured
    elgg_register_plugin_hook_handler('register', 'menu:social', 'amapnews_social_menu_setup');

    // add option for admin to add/remove user from news-staff
    elgg_register_plugin_hook_handler("register", "menu:user_hover", "amapnews_staff_user_hover_menu_hook");
    
    // Register menu item to an ownerblock. It is used to  register news menu item to groups
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'amapnews_owner_block_menu');
    
    // allow to be liked
    elgg_register_plugin_hook_handler('likes:is_likable', 'object:news', 'Elgg\Values::getTrue');
    
    // Register a URL handler for news
    elgg_register_plugin_hook_handler('entity:url', 'object', 'amapnews_set_url');
    
    // We don't want people commenting on news posts in the river
    elgg_register_plugin_hook_handler('permissions_check:comment', 'object', 'amapnews_comment_override');  
    
    // register database seed
    elgg_register_plugin_hook_handler('seeds', 'database', 'amapnews_register_db_seeds');
    
    // shop images custom sizes
    elgg_register_plugin_hook_handler('entity:icon:sizes', 'object', 'amapnews_set_custom_icon_sizes');
    
    if (NewsOptions::allowPostOnGroups()) {
        // Add group option
	elgg()->group_tools->register('news');  
    }
    
    // set photo sizes for news posts
    elgg_set_config('amapnews_photo_sizes', array(
        'topbar' => array('w' => 16, 'h' => 16, 'square' => true, 'upscale' => false),
        'tiny' => array('w' => 25, 'h' => 25, 'square' => true, 'upscale' => false),
        'small' => array('w' => 40, 'h' => 40, 'square' => true, 'upscale' => false),
        'medium' => array('w' => 100, 'h' => 100, 'square' => true, 'upscale' => false),
        'large' => array('w' => 200, 'h' => 200, 'square' => true, 'upscale' => false),
        'master' => array('w' => 2048, 'h' => 2048, 'square' => false, 'upscale' => false),
    ));  
}

/**
 * Add amapnews form parameters
 * 
 * @param type $entity
 * @return type
 */
function amapnews_prepare_form_vars($entity = null) {
    // input names => defaults
    $values = array(
        'title' => '',
        'description' => '',
        'excerpt' => '',
        'featured' => '',
        'photo' => '',
        'tags' => '',
        'connected_guid' => null,	// guid of entity connected
        'access_id' => ACCESS_DEFAULT,
        'container_guid' => elgg_get_page_owner_guid(),
        'entity' => $entity,
        'guid' => null,
        'comments_on' => NULL,
    ); 

    if ($entity) {
        foreach (array_keys($values) as $field) {
            if (isset($entity->$field)) {
                $values[$field] = $entity->$field;
            }
        }
    }

    if (elgg_is_sticky_form('amapnews')) {
        $sticky_values = elgg_get_sticky_values('amapnews');
        foreach ($sticky_values as $key => $value) {
            $values[$key] = $value;
        }
    }

    elgg_clear_sticky_form('amapnews');

    return $values;
}
