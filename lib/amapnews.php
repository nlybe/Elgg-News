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
    
    if (!$show_user_icon || $show_user_icon === AMAPNEWS_GENERAL_YES)   {
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
    
    if (!$show_username || $show_username === AMAPNEWS_GENERAL_YES)   {
        return true;
    } 
    
    return false;
}

/**
 * Check if current user can set news as featured, according settings
 * 
 * @return boolean
 */
function can_set_featured_news() {
    if (elgg_is_admin_logged_in()) {
        return true;
    }
    error_log('111');    
    $user = elgg_get_logged_in_user_entity();
    if (!$user) {
        return false;
    }
    error_log('222');
    $featured_by_admin_only = trim(elgg_get_plugin_setting('featured_by_admin_only', 'amapnews'));
    
    error_log('---->'.$featured_by_admin_only);
    if ($user && $featured_by_admin_only === AMAPNEWS_GENERAL_NO)   {
        error_log('333');
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
    
    if (!$post_on_groups || $post_on_groups === AMAPNEWS_GENERAL_YES)   {
        return true;
    } 
    
    return false;
}

/**
 * Get entity icon URL
 * 
 * @param type $entity_guid
 * @param type $size
 * @param boolean $ignore_access: if is true, news photo will be displayed in walled garden sites
 * @return boolean
 */
function amapnews_getEntityIconUrl($entity_guid, $size = 'master', $ignore_access = false) {
    $entity = get_entity($entity_guid);

    if (!elgg_instanceof($entity)) {
        return false;
    }

    // Get the size
    $size = amapnews_getIconSize($size);
    $icon_time = $entity->time_updated;
    $icon_url = "amapnews/photo_view/$entity->guid/{$size}/{$icon_time}".($ignore_access?'/'.$ignore_access:'');

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
    
    // push also custom tag
    array_push($sizenames, 'custom');
    if (!in_array($size, $sizenames)) {
        $size = 'large';
    }

    return $size;
}

/**
 * Get custom photo width as is set in setting
 * 
 * @return int as width or 0
 */
function amapnews_getCustomPhotoWidth() {
    $custom_icon_width = trim(elgg_get_plugin_setting('custom_icon_width', 'amapnews'));
    
    if ($custom_icon_width && is_numeric($custom_icon_width) && $custom_icon_width>0)   {
        return $custom_icon_width;
    } 
    
    return 0;
}

/**
 * Get custom photo height as is set in setting
 * 
 * @return int as height or 0
 */
function amapnews_getCustomPhotoHeight() {
    $custom_icon_height = trim(elgg_get_plugin_setting('custom_icon_height', 'amapnews'));
    
    if ($custom_icon_height && is_numeric($custom_icon_height) && $custom_icon_height>0)   {
        return $custom_icon_height;
    } 
    
    return 0;
}

/**
 * Get the featured as has been set in settings or default
 * 
 * @return string: icon path
 */
function amapnews_getFeaturedIcon() {
    $featured_icon = trim(elgg_get_plugin_setting('featured_icon', 'amapnews'));
    
    if ($featured_icon)   {
        return elgg_get_simplecache_url("amapnews/featured/{$featured_icon}");
    } 
    
    return elgg_get_simplecache_url("amapnews/graphics/featured.png");
}

/**
 * Get the featured as has been set in settings or default
 * 
 * @return string: icon path
 */
function amapnews_getDefaultIcon() {
    $icons_icon = trim(elgg_get_plugin_setting('icons_icon', 'amapnews'));
    
    if ($icons_icon)   {
        return elgg_get_simplecache_url("amapnews/icons/{$icons_icon}");
    } 
    
    return elgg_get_simplecache_url("amapnews/graphics/amapnews.png");
}

/**
 * Get all files on a given directory
 * 
 * @param type $dir
 * @return string: list of files found
 */
function amapnews_getFiles($dir, $current_value, $field_name, $plugin_path) {
    $files_list = '';
    
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            $allowedExts = array("png", "PNG", "jpg", "JPG", "jpeg", "JPEG", "gif", "GIF");

            while (false !== ($file = readdir($dh))) {
                if (is_dir($dir.'/'.$file) && $file!='.' && $file!='..') {
                    // do nothing
                }
                else {
                    $tmp_arr = explode('.', $file);
                    $extension = end($tmp_arr);
                    if (in_array($extension, $allowedExts))	{
                        $files_list .= "<input type='radio' name='params[$field_name]' value='$file' ".($current_value==$file?'checked':'').">";
                        $files_list .= elgg_view('output/img', array(
                            'src' => elgg_get_simplecache_url($plugin_path.$file),
                            'style' => 'margin-right: 15px;',
                        ));
                    }
                }
            }
            closedir($dh);
        }
    }	

    return $files_list;
}

