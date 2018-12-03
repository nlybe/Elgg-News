<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$user = elgg_get_logged_in_user_entity();
$staff = $user->news_staff;

$guid = get_input('guid');
$entity = get_entity($guid);

if (elgg_instanceof($entity, 'object', 'news') && $entity->canEdit()) {
    //delete files connected with this entity
    $entity->delPhotos();
    
    $container = $entity->getContainerEntity();
        
    if ($entity->delete()) {
        system_message(elgg_echo("amapnews:delete:success"));
        
        if (elgg_instanceof($container, 'group')) {
            forward(elgg_normalize_url("news/group/{$container->getGUID()}/all"));
        }
        else {
            forward("news/all");
        }
    }
}

register_error(elgg_echo("amapnews:delete:failed"));
forward(REFERER);
