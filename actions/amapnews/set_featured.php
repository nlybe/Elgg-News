<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$entity_guid = (int) get_input("guid");
$entity = get_entity($entity_guid);

if (elgg_instanceof($entity, 'object', 'amapnews')) {
    if ($entity->is_featured())
        $entity->featured = AMAPNEWS_GENERAL_NO;
    else
        $entity->featured = AMAPNEWS_GENERAL_YES;
    
    if ($entity->save()) 
        system_message(elgg_echo("amapnews:save:success"));
    else
        system_message(elgg_echo("amapnews:save:success"));

} 
else {
    register_error(elgg_echo("InvalidParameterException:NoEntityFound"));
}

forward(REFERER);