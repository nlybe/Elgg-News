<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_library('elgg:amapnews');

$group_guid = (int) get_input('group_guid');
$group_entity = get_entity($group_guid);

$user = elgg_get_logged_in_user_entity();
$staff = $user->news_staff;

// post news only for admins or groups owners and staff (if allowed by admins)
if (elgg_is_admin_logged_in() || (allow_post_on_groups() && elgg_instanceof($group_entity, 'group') && $group_entity->canEdit()) || $staff)	{
    
    // Get variables
    $title = get_input("title");
    $description = get_input("description");
    $excerpt = get_input("excerpt");
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
    
    // Check if photo uploaded
    if ($_FILES["photo"]["error"] != 4) {
        $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
        $temp = explode(".", $_FILES["photo"]["name"]);
        $extension = end($temp);
        if (((	$_FILES["photo"]["type"] == "image/gif") 
            || ($_FILES["photo"]["type"] == "image/jpeg") 
            || ($_FILES["photo"]["type"] == "image/jpg")
            || ($_FILES["photo"]["type"] == "image/pjpeg") 
            || ($_FILES["photo"]["type"] == "image/x-png") 
            || ($_FILES["photo"]["type"] == "image/png"))
            && (in_array($extension, $allowedExts))	)	 {

            $photo_sizes = elgg_get_config('amapnews_photo_sizes');
        }
        else
        {
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
    $entity->featured = $featured;
    $entity->tags = $tagarray;
    $entity->connected_guid = $connected_guid;
    $entity->container_guid = $container_guid;
    $entity->comments_on = $comments_on;
    $entity->access_id = $access_id;
    if ($_FILES["photo"]["error"] != 4) { 
        $entity->photo = time(); 
    }    

    if ($entity->save()) {
        elgg_clear_sticky_form('amapnews');
        
	// upload photo if any
	if ($_FILES["photo"]["error"] != 4) {
            foreach ($photo_sizes as $name => $photo_info) {
                $resized = get_resized_image_from_uploaded_file('photo', $photo_info['w'], $photo_info['h'], $photo_info['square'], $photo_info['upscale']);

                if ($resized) {
                    $file = new ElggFile();
                    $file->owner_guid = $entity->owner_guid;
                    $file->container_guid = $entity->getGUID();
                    $file->access_id = $access_id;
                    $file->setFilename("amapnews/".$entity->getGUID().$name.".jpg");
                    $file->open('write');
                    $file->write($resized);
                    $file->close();
                    $files[] = $file;
                } 
            }
	}          
        
        system_message(elgg_echo('amapnews:save:success'));

        //add to river only if new
        if ($new_entity) {
            elgg_create_river_item(array(
                'view' => 'river/object/amapnews/create',
                'action_type' => 'create',
                'subject_guid' => $entity->owner_guid,
                'target_guid' => $entity->container_guid,
                'object_guid' => $entity->getGUID(),
            ));
        }

        if (elgg_instanceof($group_entity, 'group')) {
            forward(elgg_get_site_url() . "news/group/".$group_entity->guid."/all");
        }
        else {
            forward($entity->getURL());
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
