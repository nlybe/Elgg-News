<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

use ElggNews\NewsOptions;

$group_guid = (int) get_input('group_guid');
$group_entity = get_entity($group_guid);

$user = elgg_get_logged_in_user_entity();
$staff = $user->news_staff;

if (    !elgg_is_admin_logged_in() && 
        !(NewsOptions::allowPostOnGroups() && ($group_entity instanceof \ElggGroup) && $group_entity->canEdit()) && 
        !$staff) {
    return elgg_error_response(elgg_echo('elggnews:add:noaccessforpost'));
}
    
// Get variables
$title = get_input("title");
$description = get_input("description");
$excerpt = nl2br(get_input('excerpt'));
$featured = get_input("featured");
$tags = get_input("tags");
$access_id = (int) get_input("access_id");
$guid = (int) get_input('elggnews_guid');
$connected_guid = (int) get_input('connected_guid');
$container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());
$comments_on = get_input("comments_on");

elgg_make_sticky_form('elggnews');

if (!$title) {
    return elgg_error_response(elgg_echo('elggnews:save:missing_title'));
}

if (!$excerpt) {
    return elgg_error_response(elgg_echo('elggnews:save:missing_excerpt'));
}  

$uploaded_files = elgg_get_uploaded_files('photo');
if ($uploaded_files) {  
    $uploaded_file = array_shift($uploaded_files);
    if ($uploaded_file && !$uploaded_file->isValid()) {
        return elgg_error_response(elgg_get_friendly_upload_error($uploaded_file->getError()));
    }

    if ($uploaded_file) {
        $supported_mimes = [
            'image/jpeg',
            'image/png',
            'image/gif',
        ];

        // $mime_type = ElggFile::detectMimeType($uploaded_file->getPathname(), $uploaded_file->getClientMimeType());
        $mime_type = elgg()->mimetype->getMimeType($uploaded_file->getPathname());
        if (!in_array($mime_type, $supported_mimes)) {
            return elgg_error_response(elgg_echo('elggnews:add:photo:invalid'));
        }    
    }
}
    
// if not admin but group owners, check if a access level is limited only to group
if (!elgg_is_admin_logged_in() && ($group_entity instanceof \ElggGroup) && $group_entity->canEdit())	{
    if ($access_id > 0 && $access_id < 3)	{
        return elgg_error_response(elgg_echo('elggnews:save:notvalid_access_id'));
    }
}

$new = true;
if ($guid == 0) {
    $entity = new ElggNews;
    $entity->container_guid = $container_guid;
    // if no title on new upload, grab filename
    if (empty($title)) {
        $title = elgg_echo('elggnews:save:announcement');
    }        
} else {
    $new = false;
    $entity = get_entity($guid);
    if (!$entity->canEdit()) {
        return elgg_error_response(elgg_echo('elggnews:save:failed'));
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
if (NewsOptions::canSetFeaturedNews()) {
    $entity->featured = $featured;
}
$entity->tags = $tagarray;
$entity->connected_guid = $connected_guid;
$entity->container_guid = $container_guid;
$entity->comments_on = $comments_on;
$entity->access_id = $access_id;

if ($entity->save()) {
    elgg_clear_sticky_form('elggnews');
    
    // upload photo if any
    if ($uploaded_file) {
        $entity->deleteIcon();
        $entity->saveIconFromUploadedFile('photo');
    }         

    //add to river only if new
    if ($new) {
        elgg_create_river_item([
            'view' => 'river/object/news/create',
            'action_type' => 'create',
            'object_guid' => $entity->getGUID(),
            'subject_guid' => $entity->owner_guid,
        ]);
    }        

    if ($group_entity instanceof \ElggGroup) {
        $forward_url = elgg_get_site_url() . "news/group/".$group_entity->guid."/all";
    }
    else {
        $forward_url = $entity->getURL();
    }

    return elgg_ok_response('', elgg_echo('elggnews:save:success'), $forward_url);

} 
else {
    return elgg_error_response(elgg_echo('elggnews:save:failed'));
}
