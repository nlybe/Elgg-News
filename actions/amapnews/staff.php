<?php

$user_guid = (int) get_input("guid");

if (!empty($user_guid)) {
	if ($user = get_user($user_guid)) {
		if ($user->news_staff) {
			unset($user->news_staff);
			system_message(elgg_echo("amapnews:action:news_staff:removed"));
		} else {
			$user->news_staff = time();
			system_message(elgg_echo("amapnews:action:news_staff:added"));
		}
	} else {
		register_error(elgg_echo("InvalidParameterException:NoEntityFound"));
	}
} else {
	register_error(elgg_echo("InvalidParameterException:MissingParameter"));
}

forward(REFERER);