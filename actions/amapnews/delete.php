<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$user = elgg_get_logged_in_user_entity();
$staff = $user->news_staff;

// check if admin user is loggedin or staff
if ( !(elgg_is_admin_logged_in()||$staff) )
	forward(REFERER);

$guid = get_input('guid');
$entity = get_entity($guid);

if (elgg_instanceof($entity, 'object', 'amapnews') && $entity->canEdit()) {
    $container = $entity->getContainerEntity();

    //delete files connected with this entity
    if ($entity->photo)
        $entity->del_photo();
        
    if ($entity->delete()) {
        system_message(elgg_echo("amapnews:delete:success"));
        forward("amapnews/all");
    }
}

register_error(elgg_echo("amapnews:delete:failed"));
forward(REFERER);
