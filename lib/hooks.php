<?php
/**
 * Elgg News plugin
 * @package amapnews
 *
 * All hooks are here
 */
 
/**
 * Add option to set as new by admin to entity menu at end of the menu
 * 
 * @param type $hook
 * @param type $type
 * @param type $return
 * @param type $params
 * @return type
 */
function amapnews_entity_menu_setup($hook, $type, $return, $params) {
    $user = elgg_get_logged_in_user_entity();
    $staff = $user->news_staff;

    $entity = $params['entity'];
        
    if (!elgg_instanceof($entity, 'object', 'amapnews') && (elgg_is_admin_logged_in() || $staff))	{
        elgg_load_js('lightbox');
        elgg_load_css('lightbox');	

        $url = elgg_normalize_url("news/add_existed/{$entity->guid}");

        $options = array(
            'name' => 'setasnew',
            'text' => elgg_echo("amapnews:add:tonews"),
            'href' =>  $url,
            'priority' => 50,
            'link_class' => 'elgg-lightbox',
        );
        $return[] = ElggMenuItem::factory($options);
    }
    else if (elgg_instanceof($entity, 'object', 'amapnews')) {
        $featured_menu_item = false;
        $container = $entity->getContainerEntity();

        if (elgg_instanceof($container, 'group')) {
            $featured_menu_item = $container->canEdit()?true:false;
        }
        else if (can_set_featured_news()) {
            $featured_menu_item = true;
        }

        if ($featured_menu_item) {  // amapnews entity
            $url = elgg_normalize_url("action/amapnews/set_featured/?guid={$entity->guid}");
            $text = ($entity->is_featured()?elgg_echo("amapnews:add:unfeatured"):elgg_echo("amapnews:add:featured"));

            $options = array(
                'name' => 'setasfeatured',
                'text' => $text,
                'href' =>  $url,
                'priority' => 40,
                'is_action' => true,
            );
            $return[] = ElggMenuItem::factory($options);
        }
    }        

    return $return;
}

/**
 * News-Staff
 * 
 * @param type $hook
 * @param type $type
 * @param array $return_value
 * @param type $params
 * @return type
 */
function news_staff_user_hover_menu_hook($hook, $type, $return_value, $params) {
	
    $user = elgg_get_logged_in_user_entity();

    if (empty($user) || !$user->isAdmin()) {
        return $return_value;
    }

    if (empty($params) || !is_array($params)) {
        return $return_value;
    }

    $entity = elgg_extract("entity", $params);

    if ($entity->getGUID() == $user->getGUID()) {
        return $return_value;
    }

    $text = elgg_echo("amapnews:menu_user_hover:make_staff");

    if ($entity->news_staff) {
        $text = elgg_echo("amapnews:menu_user_hover:remove_staff");
    }

    $return_value[] = ElggMenuItem::factory(array(
        "name" => "amapnews_staff",
        "text" => $text,
        "href" => "action/amapnews/staff?guid=" . $entity->getGUID(),
        "confirm" => elgg_echo("question:areyousure"),
        "section" => "admin"
    ));

    return $return_value;
}

/**
 * Format and return the URL for news objects, since 1.9.
 *
 * @param string $hook
 * @param string $type
 * @param string $url
 * @param array  $params
 * @return string URL of amapnews
 */
function amapnews_set_url($hook, $type, $url, $params) {
    $entity = $params['entity'];

    if (elgg_instanceof($entity, 'object', 'amapnews')) {
        if ($entity->connected_guid) {
            $connected_entity = get_entity($entity->connected_guid);
            $friendly_title = elgg_get_friendly_title($entity->title);

            if ($connected_entity) {
                return $connected_entity->getURL();
            }
            else	 {
                return "news/view/{$entity->guid}/$friendly_title";
            }
        }
        else {
            return "news/view/{$entity->guid}/$friendly_title";
        }
    }
}

/**
 * Add a menu item to an ownerblock
 * 
 * @param type $hook
 * @param type $type
 * @param type $return
 * @param type $params
 * @return boolean|\ElggMenuItem
 */
function amapnews_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        return $return;
    } 
    else {
        if ($params['entity']->amapnews_enable != 'no') {
            $url = "news/group/{$params['entity']->guid}/all";
            $item = new ElggMenuItem('amapnews', elgg_echo('amapnews:group'), $url);
            $return[] = $item;
        }
    }

    return $return;
}

/**
 * We don't want people commenting on news posts in the river
 *
 * @param string $hook
 * @param string $type
 * @param string $return
 * @param array  $params
 * @return bool
 */
function amapnews_comment_override($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'object', 'amapnews')) {
        if ($params['entity']->comments_on == 'On') {
            return true;
        }
        
        return false;
    }
}

