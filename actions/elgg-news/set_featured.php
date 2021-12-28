<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

use ElggNews\NewsOptions;

$entity_guid = (int) get_input("guid");
$entity = get_entity($entity_guid);

$container = $entity->getContainerEntity();
if (($container instanceof \ElggGroup) && !$container->canEdit()) {
    // only administrators or group admins can handle featured news
    return elgg_error_response(elgg_echo('elggnews:add:noaccessforpost'));
}
else if (!$entity->canEdit() && !NewsOptions::canSetFeaturedNews()) {
    return elgg_error_response(elgg_echo('elggnews:add:noaccessforpost'));
}

if ($entity instanceof \ElggNews) {
    if (!$entity->canEdit()) {
        // enable ignore access for staff news
        $ia = elgg_get_ignore_access();
        elgg_set_ignore_access(true);
    }
    
    if ($entity->isFeatured()) {
        $entity->featured = NewsOptions::NEWS_NO;
    }
    else {
        $entity->featured = NewsOptions::NEWS_YES;
    }
    
    if ($entity->save())  {
        if (!$entity->canEdit()) {
            elgg_set_ignore_access($ia);
        }
        return elgg_ok_response('', elgg_echo('elggnews:save:success'), REFERER);
    }
    else {
        return elgg_error_response(elgg_echo('elggnews:save:failed'));
    }
        
} 
else {
    return elgg_error_response(elgg_echo('InvalidParameterException:NoEntityFound'));
}
