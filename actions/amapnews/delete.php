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
$entity_unit = get_entity($guid);

if (elgg_instanceof($entity_unit, 'object', 'amapnews') && $entity_unit->canEdit()) {
    $container = $entity_unit->getContainerEntity();
    if ($entity_unit->delete()) {
        system_message(elgg_echo("amapnews:delete:success"));
        forward("amapnews/all");
    }
}

register_error(elgg_echo("amapnews:delete:failed"));
forward(REFERER);
