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
    return elgg_call(ELGG_IGNORE_ACCESS, function() use ($entity) {
        if ($entity->isFeatured()) {
            $entity->featured = NewsOptions::NEWS_NO;
        }
        else {
            $entity->featured = NewsOptions::NEWS_YES;
        }
        
        if ($entity->save())  {
            return elgg_ok_response('', elgg_echo('elggnews:save:success'), REFERRER);
        }
        else {
            return elgg_error_response(elgg_echo('elggnews:save:failed'));
        }
    });        
} 
else {
    return elgg_error_response(elgg_echo('InvalidParameterException:NoEntityFound'));
}
