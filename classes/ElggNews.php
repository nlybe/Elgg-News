<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

use ElggNews\NewsOptions;

class ElggNews extends ElggObject {

    const SUBTYPE = "news";

    protected $meta_defaults = [
        "title" => NULL,
        "description" => NULL,
        "excerpt" => NULL,
        "featured" => NULL,
        "photo" => NULL,
        "tags" => NULL,
        "connected_guid" => NULL,
        "comments_on" => NULL,
    ];

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes["subtype"] = self::SUBTYPE;
    }

    /**
     * Can a user comment on this News post?
     *
     * @see ElggObject::canComment()
     *
     * @param int  $user_guid User guid (default is logged in user)
     */
    public function canComment(int $user_guid = 0): bool {
        if ($this->comments_on === 'Off') {
            return false;
        }

        return true;
    }

    /**
     * Check if current item is featured
     * @return boolean
     */
    function isFeatured() {
        if ($this->featured === NewsOptions::NEWS_YES) {
            return true;
        }

        return false;
    }

    /**
     * Get icon of entity
     * 
     * @return icon photo
     */
    function getNewsIcon() {
        if ($this->hasIcon('small')) {
            return elgg_view_entity_icon($this, 'small', ['img_class' => 'elgg-photo']);
        }
         
        return elgg_view('output/img', [
            'src' => NewsOptions::getDefaultIcon(),
            'alt' => elgg_echo('elgg-news'),
        ]);
    }

    /**
     * Delete item photo from disk space
     * 
     * @return boolean
     */
    public function delPhotos() {
        $photo_sizes = elgg_get_config('elggnews_photo_sizes');
        foreach ($photo_sizes as $name => $photo_info) {
            $file = new ElggFile();
            $file->owner_guid = $this->owner_guid;
            $file->setFilename("elgg-news/{$this->getGUID()}{$name}.jpg");
            $filepath = $file->getFilenameOnFilestore();
            if (!$file->delete()) {
                // do nothing
            }
        }

        return true;
    }

}
