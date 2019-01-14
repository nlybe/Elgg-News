<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$user_guid = (int) get_input("guid");

if (empty($user_guid)) {
    return elgg_error_response(elgg_echo('InvalidParameterException:MissingParameter'));
}

$user = get_user($user_guid);
if (!($user instanceof ElggUser)) {
    return elgg_error_response(elgg_echo('InvalidParameterException:NoEntityFound'));
}

if ($user->news_staff) {
    unset($user->news_staff);
    return elgg_ok_response('', elgg_echo('amapnews:action:news_staff:removed'), REFERER);
} 
else {
    $user->news_staff = time();
    return elgg_ok_response('', elgg_echo('amapnews:action:news_staff:added'), REFERER);
}

