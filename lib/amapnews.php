<?php
/**
 * Elgg News plugin
 * @package amapnews
 */


/**
 * Add amapnews form parameters
 * 
 * @param type $entity_unit
 * @return type
 */
function amapnews_prepare_form_vars($entity_unit = null) {
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
        'entity' => $entity_unit,
        'guid' => null,
        'comments_on' => NULL,
    ); 

    if ($entity_unit) {
        foreach (array_keys($values) as $field) {
            if (isset($entity_unit->$field)) {
                $values[$field] = $entity_unit->$field;
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

/**
 * Check if display user icon on news list or entity view
 * 
 * @return boolean
 */
function display_user_icon() {
    $show_user_icon = trim(elgg_get_plugin_setting('show_user_icon', 'amapnews'));
    
    if ($show_user_icon === AMAPNEWS_GENERAL_YES)   {
        return true;
    } 
    
    return false;
}

/**
 * Check if display username on news list or entity view
 * 
 * @return boolean
 */
function display_username() {
    $show_username = trim(elgg_get_plugin_setting('show_username', 'amapnews'));
    
    if ($show_username === AMAPNEWS_GENERAL_YES)   {
        return true;
    } 
    
    return false;
}

/**
 * Check if allow group's owners to post news/announcements inside groups
 * 
 * @return boolean
 */
function allow_post_on_groups() {
    $post_on_groups = trim(elgg_get_plugin_setting('post_on_groups', 'amapnews'));
    
    if ($post_on_groups === AMAPNEWS_GENERAL_YES)   {
        return true;
    } 
    
    return false;
}

/**
 * Get entity icon URL
 * 
 * @param type $entity_guid
 * @param type $size
 * @return boolean
 */
function amapnews_getEntityIconUrl($entity_guid, $size = 'master') {
    $entity = get_entity($entity_guid);

    if (!elgg_instanceof($entity)) 
        return false;

    // Get the size
    $size = amapnews_getIconSize($size);
    $icon_time = $entity->time_updated;
    $icon_url = "amapnews/photo_view/$entity->guid/{$size}/{$icon_time}";

    return elgg_normalize_url($icon_url);
}

/**
 * Get entity icon size
 * 
 * @param string $size
 * @return string
 */
function amapnews_getIconSize($size = 'master') {
    $photo_sizes = elgg_get_config('amapnews_photo_sizes');
    $sizenames = array();
    foreach ($photo_sizes as $name => $photo_info) {
        array_push($sizenames, $name);
    }
    if (!in_array($size, $sizenames)) {
        $size = 'medium';
    }

    return $size;
}