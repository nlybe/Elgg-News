<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

$user = elgg_get_logged_in_user_entity();
$staff = $user->news_staff;

$guid = get_input('guid');
$entity = get_entity($guid);

if ($entity instanceof \ElggNews && $entity->canEdit()) {
    //delete files connected with this entity
    $entity->delPhotos();
    
    $container = $entity->getContainerEntity();
        
    if ($entity->delete()) {
        $forward_url = "news/all";
        if ($container instanceof \ElggGroup) {
            $forward_url = elgg_normalize_url("news/group/{$container->getGUID()}/all");
        }
        
        return elgg_ok_response('', elgg_echo('elggnews:delete:success'), $forward_url);
    }
}

return elgg_error_response(elgg_echo('elggnews:delete:failed'));
