<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$group_guid = (int) get_input('group_guid');
$group_entity = get_entity($group_guid);

$user = elgg_get_logged_in_user_entity();
$staff = $user->news_staff;

// post news only for admins or groups owners and staff (if allowed by admins)
if (elgg_is_admin_logged_in() || (allow_post_on_groups() && elgg_instanceof($group_entity, 'group') && $group_entity->canEdit()) || $staff)	{
    
    // Get variables
    $title = get_input("title");
    $description = get_input("description");
    $excerpt = nl2br(get_input('excerpt'));
    $featured = get_input("featured");
    $photo = get_input("photo");
    $tags = get_input("tags");
    $access_id = (int) get_input("access_id");
    $guid = (int) get_input('amapnews_guid');
    $connected_guid = (int) get_input('connected_guid');
    $container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());
    $comments_on = get_input("comments_on");
    
    elgg_make_sticky_form('amapnews');

    if (!$title) {
        register_error(elgg_echo('amapnews:save:missing_title'));
        forward(REFERER);
    }
    
    if (!$excerpt) {
        register_error(elgg_echo('amapnews:save:missing_excerpt'));
        forward(REFERER);
    }  
    
    $uploaded_files = elgg_get_uploaded_files('photo');
    if ($uploaded_files) {   
        $uploaded_file = array_shift($uploaded_files);
        if (!$uploaded_file->isValid()) {
            register_error(elgg_get_friendly_upload_error($uploaded_file->getError()));
            forward(REFERER);
        }

        $supported_mimes = [
            'image/jpeg',
            'image/png',
            'image/gif',
        ];

        $mime_type = ElggFile::detectMimeType($uploaded_file->getPathname(), $uploaded_file->getClientMimeType());
        if (!in_array($mime_type, $supported_mimes)) {
            register_error(elgg_echo('amapnews:add:photo:invalid')); 
            forward(REFERER);
        }    
    }
    
    // if not admin but group owners, check if a access level is limited only to group
    if (!elgg_is_admin_logged_in() && elgg_instanceof($group_entity, 'group') && $group_entity->canEdit())	{
        if ($access_id > 0 && $access_id < 3)	{
            register_error(elgg_echo('amapnews:save:notvalid_access_id'));
            forward(REFERER);
        }
    }
    
    // check whether this is a new object or an edit
    $new_entity = true;
    if ($guid > 0) {
        $new_entity = false;
    }
    
    if ($guid == 0) {
        $entity = new ElggObject;
        $entity->subtype = "amapnews";
        
        $entity->container_guid = $container_guid;
        $new = true;
        // if no title on new upload, grab filename
        if (empty($title)) {
            $title = elgg_echo('amapnews:save:announcement');
        }        
    } else {
        $entity = get_entity($guid);
        if (!$entity->canEdit()) {
            system_message(elgg_echo('amapnews:save:failed'));
            forward(REFERRER);
        }
        if (!$title) {
            // user blanked title, but we need one
            $title = $entity->title;
        }    
    }

    $tagarray = string_to_tag_array($tags);

    $entity->title = $title;
    $entity->description = $description;
    $entity->excerpt = $excerpt;
    if (can_set_featured_news()) {
        $entity->featured = $featured;
    }
    $entity->tags = $tagarray;
    $entity->connected_guid = $connected_guid;
    $entity->container_guid = $container_guid;
    $entity->comments_on = $comments_on;
    $entity->access_id = $access_id;
    if ($uploaded_file) {
        $entity->photo = time(); 
    }    

    if ($entity->save()) {
        elgg_clear_sticky_form('amapnews');
        // upload photo if any
        if ($uploaded_file) {
                $photo_sizes = elgg_get_config('amapnews_photo_sizes');

                // get the images and save their file handlers into an array, so we can do clean up if one fails.
                $files = array();
                foreach ($photo_sizes as $name => $photo_info) {
                    $image = new ElggFile();
                    $image->owner_guid = $entity->owner_guid;
                    $image->container_guid = $entity->getGUID();
                    $image->access_id = $access_id;
                    $image->setFilename("amapnews/".$entity->getGUID().$name.".jpg");
                    $image->open('write');
                    $image->close();

                    $resized = elgg_save_resized_image($uploaded_file->getPathname(), $image->getFilenameOnFilestore(), array(
                        'w' => $photo_info['w'],
                        'h' => $photo_info['h'],
                        'square' => $photo_info['square'],
                        'upscale' => $photo_info['upscale'],
                    ));           

                    if ($resized) {
                        $files[] = $file;
                    } else { // cleanup on fail
                        foreach ($files as $file) {
                            $file->delete();
                        }
                    }

                    unset($resized);                 
                }
                
                // check also if custom size has been set in settings
                $cWidth = amapnews_getCustomPhotoWidth();
                $cHeight = amapnews_getCustomPhotoHeight();
                if ($cWidth && $cHeight) {
                    $image = new ElggFile();
                    $image->owner_guid = $entity->owner_guid;
                    $image->container_guid = $entity->getGUID();
                    $image->access_id = $access_id;
                    $image->setFilename("amapnews/".$entity->getGUID().'custom'.".jpg");
                    $image->open('write');
                    $image->close();

                    $resized = elgg_save_resized_image($uploaded_file->getPathname(), $image->getFilenameOnFilestore(), array(
                        'w' => $cWidth,
                        'h' => $cHeight,
                        'square' => false,
                        'upscale' => false,
                    )); 
                    unset($resized);                 
                }
        }          
        
        system_message(elgg_echo('amapnews:save:success'));

        //add to river only if new
        if ($new_entity) {
            elgg_create_river_item(array(
                'view' => 'river/object/amapnews/create',
                'action_type' => 'create',
                'subject_guid' => $entity->owner_guid,
                //'target_guid' => $entity->container_guid,
                'object_guid' => $entity->getGUID(),
            ));
        }

        if (elgg_instanceof($group_entity, 'group')) {
            forward(elgg_get_site_url() . "news/group/".$group_entity->guid."/all");
        }
        else {
            // forward($entity->getURL()); //
            forward(elgg_get_site_url() . "news");
        }
		
    } 
    else {
        register_error(elgg_echo('amapnews:save:failed'));
        forward(REFERER);
    }

} 
else    {  
    register_error(elgg_echo('amapnews:add:noaccessforpost'));  
    forward(REFERER);    
}
