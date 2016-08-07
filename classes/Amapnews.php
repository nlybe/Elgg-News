<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

class Amapnews extends ElggObject {
    const SUBTYPE = "amapnews";
    
    protected $meta_defaults = array(
        "title"             => NULL,
        "description"       => NULL,
        "excerpt"           => NULL,
        "featured"          => NULL, 
        "photo"             => NULL,
        "tags"              => NULL,
        "connected_guid"    => NULL,
        "comments_on"       => NULL,
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
    
    /**
     * Delete item photo from diskspace
     * 
     * @return boolean
     */
    public function del_photo() {
        $photo_sizes = elgg_get_config('amapnews_photo_sizes');
        foreach ($photo_sizes as $name => $photo_info) {
            $file = new ElggFile();
            $file->owner_guid = $this->owner_guid;
            $file->setFilename("amapnews/{$this->getGUID()}{$name}.jpg");
            $filepath = $file->getFilenameOnFilestore();
            if (!$file->delete()) {
                // do nothing
            }
        }

        return true;
    }    
    
    /**
     * Can a user comment on this neww?
     *
     * @see ElggObject::canComment()
     *
     * @param int $user_guid User guid (default is logged in user)
     * @return bool
     */
    public function canComment($user_guid = 0) {
        $result = parent::canComment($user_guid);
        if ($result == false) {
            return $result;
        }

        if ($this->comments_on == 'Off') {
            return false;
        }

        return true;
    }    
 
}
