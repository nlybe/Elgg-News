<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

namespace ElggNews;

class NewsOptions {

    const PLUGIN_ID = 'elgg-news';                   // current plugin ID
    const NEWS_YES = 'yes';                         // general purpose value for yes
    const NEWS_NO = 'no';                           // general purpose value for no
    
    /**
     * Get param value from settings
     * 
     * @return type
     */
    Public Static function getParams($setting_param = ''){
        if (!$setting_param) {
            return false;
        }
        
        return trim(elgg_get_plugin_setting($setting_param, self::PLUGIN_ID)); 
    }
    
    /**
    * Check if display user icon on news list or entity view
    * 
    * @return boolean
    */
    Public Static function displayUserIcon() {
        $show_user_icon = self::getParams('show_user_icon');
        if ($show_user_icon === self::NEWS_YES) {
            return true;
        }

        return false;
    }
   
    /**
     * Check if display username on news list or entity view
     * 
     * @return boolean
     */
    Public Static function displayUsername() {
        $show_username = self::getParams('show_username');
        if ($show_username === self::NEWS_YES) {
            return true;
        } 

        return false;
    }   
    
    /**
     * Check if current user can set news as featured, according settings
     * 
     * @return boolean
     */
    Public Static function canSetFeaturedNews() {
        if (elgg_is_admin_logged_in()) {
            return true;
        }

        $user = elgg_get_logged_in_user_entity();
        if (!$user || !$user->news_staff) {
            return false;
        }

        $featured_by_admin_only = self::getParams('featured_by_admin_only');
        if ($featured_by_admin_only !== self::NEWS_YES) {
            return true;
        }

        return false;
    }    
    
    /**
     * Check if allow group's owners to post news/announcements inside groups
     * 
     * @return boolean
     */
    Public Static function allowPostOnGroups() {
        $post_on_groups = self::getParams('post_on_groups');

        if ($post_on_groups === self::NEWS_YES) {
            return true;
        } 

        return false;
    }
    
    /**
     * Check if current user can post news on site or on current group
     * 
     * @param type $page_owner
     * @param type $user
     * @return boolean
     */
    Public Static function allowPost($page_owner = null, $user = null) {
        if (elgg_is_admin_logged_in() ) {
            return true;
        }

        if (!$user) {
            $user = elgg_get_logged_in_user_entity();
        }

        if (!$user) {
            return false;
        }

        if ($page_owner instanceof \ElggGroup) {
            return self::allowPostOnGroups() && $page_owner->canEdit()?true:false;
        }
        else {
            return $user->news_staff?true:false;
        }

        return false;
    }   
    
    /**
     * Get custom photo width as is set in setting
     * 
     * @return int as width or 0
     */
    Public Static function getCustomPhotoWidth() {
        $custom_icon_width = self::getParams('custom_icon_width');
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
    Public Static function getCustomPhotoHeight() {
        $custom_icon_height = self::getParams('custom_icon_height');
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
    Public Static function getDefaultIcon() {
        $icons_icon = self::getParams('icons_icon');
        if ($icons_icon)   {
            return elgg_get_simplecache_url("elgg-news/icons/{$icons_icon}");
        } 

        return elgg_get_simplecache_url("elgg-news/graphics/elgg-news.png");
    }    
    
    /**
     * Get all files on a given directory
     * 
     * @param type $dir
     * @return string: list of files found
     */
    function getFiles($dir, $current_value, $field_name, $plugin_path) {
        $files_list = '';

        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                $allowedExts = [ "png", "PNG", "jpg", "JPG", "jpeg", "JPEG", "gif", "GIF", "webp", "WEBP" ];

                while (false !== ($file = readdir($dh))) {
                    if (is_dir($dir.'/'.$file) && $file!='.' && $file!='..') {
                        // do nothing
                    }
                    else {
                        $tmp_arr = explode('.', $file);
                        $extension = end($tmp_arr);
                        if (in_array($extension, $allowedExts))	{
                            $files_list .= "<input type='radio' name='params[$field_name]' value='$file' ".($current_value==$file?'checked':'').">";
                            $files_list .= elgg_view('output/img', [
                                'src' => elgg_get_simplecache_url($plugin_path.$file),
                                'style' => 'margin-right: 15px;',
                            ]);
                        }
                    }
                }
                closedir($dh);
            }
        }	

        return $files_list;
    }   
    
    /**
     * Check if latest featured news on list sidebar
     * 
     * @return boolean
     */
    Public Static function showFeaturedOnSidebar() {
        $show_featured_on_sidebar = self::getParams('show_featured_on_sidebar');
        if ($show_featured_on_sidebar === self::NEWS_YES) {
            return true;
        } 

        return false;
    }
      
}
