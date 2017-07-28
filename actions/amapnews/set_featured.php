<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_library('elgg:amapnews');

$entity_guid = (int) get_input("guid");
$entity = get_entity($entity_guid);

$container = $entity->getContainerEntity();
if (elgg_instanceof($container, 'group') && !$container->canEdit()) {
    // only administrators or group admins can handle featured news
    register_error(elgg_echo('amapnews:add:noaccessforpost'));  
    forward(REFERER);
}
else if (!$entity->canEdit() && !can_set_featured_news()) {
    register_error(elgg_echo('amapnews:add:noaccessforpost'));  
    forward(REFERER);
}

if (elgg_instanceof($entity, 'object', 'amapnews')) {
    if (!$entity->canEdit()) {
        // enable ignore access for staff news
        $ia = elgg_get_ignore_access();
        elgg_set_ignore_access(true);
    }
    
    if ($entity->is_featured()) {
        $entity->featured = AMAPNEWS_GENERAL_NO;
    }
    else {
        $entity->featured = AMAPNEWS_GENERAL_YES;
    }
    
    if ($entity->save())  {
        system_message(elgg_echo("amapnews:save:success"));
    }
    else {
        system_message(elgg_echo("amapnews:save:failed"));
    }
    
    if (!$entity->canEdit()) {
        elgg_set_ignore_access($ia);
    }
} 
else {
    register_error(elgg_echo("InvalidParameterException:NoEntityFound"));
}

forward(REFERER);