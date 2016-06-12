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
        "tags" 		 => NULL,
        "connected_guid" => NULL,
        "comments_on"	 => NULL,
    );    

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes["subtype"] = self::SUBTYPE;
    }
 
}
