<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

class Amapnews extends ElggObject {
    const SUBTYPE = "amapnews";
    
    protected $meta_defaults = array(
        "title" 	 => NULL,
        "description" 	 => NULL,
        "excerpt" 	 => NULL,
        "featured" 	 => NULL, 
        "tags" 		 => NULL,
        "connected_guid" => NULL,
        "comments_on"	 => NULL,
    );    

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes["subtype"] = self::SUBTYPE;
    }
    
    /**
     * Check if current item is featured
     * @return boolean
     */
    function is_featured() {
        if ($this->featured === AMAPNEWS_GENERAL_YES) {
            return true;
        }
        
        return false;
    }    
 
}
