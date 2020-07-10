<?php
/**
 * Elgg News plugin
 * @package amapnews
 *
 * All hooks are here
 */
 
use Amapnews\NewsOptions;

/**
 * Add option to set as new by admin to entity menu at end of the menu
 * 
 * @param \Elgg\Hook $hook 'register', 'menu:entity'
 *
 * @return void|ElggMenuItem[]
 */
function amapnews_entity_menu_setup(\Elgg\Hook $hook) {
    $user = elgg_get_logged_in_user_entity();
    if (!$user) {
        return;
    }
    
    $return = $hook->getValue();
    $entity = $hook->getEntityParam();
    if (!$entity || $entity instanceof \ElggUser) {
        return;
    }
    
    if (!($entity instanceof \ElggNews) && (elgg_is_admin_logged_in() || $user->news_staff))    {        
        $return[] = \ElggMenuItem::factory([
            'name' => 'setasnew',
            'icon' => 'plus-circle',
            'text' => elgg_echo("amapnews:add:tonews"),
            'href' => elgg_generate_url('add_existed:object:news', [
                'guid' => $entity->guid,
            ]),
            'link_class' => 'elgg-lightbox',
	    ]);
    }
    else if ($entity instanceof \ElggNews) {
        $featured_menu_item = false;
        $container = $entity->getContainerEntity();

        if ($container instanceof \ElggGroup) {
            $featured_menu_item = $container->canEdit()?true:false;
        }
        else if (NewsOptions::canSetFeaturedNews()) {
            $featured_menu_item = true;
        }

        if ($featured_menu_item) {  // amapnews entity
            $text = ($entity->isFeatured()?elgg_echo("amapnews:add:unfeatured"):elgg_echo("amapnews:add:featured"));
            $return[] = \ElggMenuItem::factory([
                'name' => 'setasfeatured',
                'icon' => 'star',
                'text' => $text,
                'href' => elgg_normalize_url("action/amapnews/set_featured/?guid={$entity->guid}"),
                'priority' => 40,
                'is_action' => true,
            ]);
        }
    }        

    return $return;
}

/**
 * News-Staff
 * 
 * @param type $hook
 * @param type $type
 * @param array $return
 * @param type $params
 * @return type
 */
function amapnews_staff_user_hover_menu_hook(\Elgg\Hook $hook) {
    
    $return = $hook->getValue();

    $user = elgg_get_logged_in_user_entity();
    if (empty($user) || !$user->isAdmin()) {
        return $return;
    }

    // $entity_subtype = $hook->getParam('entity_subtype');
    // $entity = elgg_extract("entity", $params);
    $entity = $hook->getEntityParam();
    if ($entity->getGUID() == $user->getGUID()) {
        return $return;
    }

    $text = elgg_echo("amapnews:menu_user_hover:make_staff");
    if ($entity->news_staff) {
        $text = elgg_echo("amapnews:menu_user_hover:remove_staff");
    }
    
    $return[] = \ElggMenuItem::factory([
        'name' => 'amapnews_staff',
        'icon' => 'plus-circle',
        'text' => $text,
        'href' => elgg_normalize_url("action/amapnews/set_staff?guid=" . $entity->getGUID()),
        'confirm' => elgg_echo("question:areyousure"),
        'section' => 'admin'
    ]);

    return $return;
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
function amapnews_set_url(\Elgg\Hook $hook) {
    $entity = $hook->getEntityParam();

    if (!$entity instanceof \ElggNews) {
		return;
	}

    $friendly_title = elgg_get_friendly_title($entity->title);
    if ($entity->connected_guid) {
        $connected_entity = get_entity($entity->connected_guid);
        
        if ($connected_entity) {
            return $connected_entity->getURL();
        }
        else {
            return "news/view/{$entity->guid}/$friendly_title";
        }
    }
    else {
        return "news/view/{$entity->guid}/$friendly_title";
    }
    
}

/**
 * Add a menu item to an ownerblock
 *
 * @param \Elgg\Hook $hook 'register', 'menu:owner_block'
 *
 * @return ElggMenuItem[]
 */
function amapnews_owner_block_menu(\Elgg\Hook $hook) {
	$entity = $hook->getEntityParam();
	$return = $hook->getValue();
	
	if ($entity instanceof \ElggUser) {
        return $return;
    } 
    elseif ($entity instanceof \ElggGroup && NewsOptions::allowPostOnGroups() && $entity->isToolEnabled('news')) {
        $url = "news/group/{$entity->guid}/all";
        $item = new ElggMenuItem('amapnews', elgg_echo('amapnews:group'), $url);
        $return[] = $item;
    }

    return $return;
}

// /**
//  * We don't want people commenting on news posts in the river - OBS since 20200708
//  *
//  * @param string $hook
//  * @param string $type
//  * @param string $return
//  * @param array  $params
//  * @return bool
//  */
// function amapnews_comment_override($hook, $type, $return, $params) {
//     $entity = $params['entity'];
//     if ($entity instanceof \ElggNews) {
//         if ($entity->canComment()) {
//             return true;
//         }
//     }
    
//     return $return;
// }

/**
 * Register database seed
 *
 * @elgg_plugin_hook seeds database
 *
 * @param \Elgg\Hook $hook Hook
 * @return array
 */
function amapnews_register_db_seeds(\Elgg\Hook $hook) {

    $seeds = $hook->getValue();

    $seeds[] = \Elgg\News\Seeder::class;

    return $seeds;
}

/**
 * Set custom icon sizes for news objects
 *
 * @param string $hook   "entity:icon:url"
 * @param string $type   "object"
 * @param array  $return Sizes
 * @param array  $params Hook params
 * @return array
 */
function amapnews_set_custom_icon_sizes(\Elgg\Hook $hook) {

    // $entity_subtype = elgg_extract('entity_subtype', $params);
    $entity_subtype = $hook->getParam('entity_subtype');
    if ($entity_subtype !== ElggNews::SUBTYPE) {
        return;
    }
    
    $cWidth = NewsOptions::getCustomPhotoWidth();
    $cHeight = NewsOptions::getCustomPhotoHeight();
    
    $photo_sizes = elgg_get_config('amapnews_photo_sizes');
    $photo_sizes['custom'] = array('w' => $cWidth, 'h' => $cHeight, 'square' => false, 'upscale' => false);
    
    return $photo_sizes;
}

/**
 * Show featured icon, if news entity is featured
 *
 * @param \Elgg\Hook $hook 'register' 'menu:social'
 * @return void|ElggMenuItem[]
 * @since 3.0
 */
function amapnews_social_menu_setup(\Elgg\Hook $hook) {
    $entity = $hook->getEntityParam();
    if (!$entity) {
        return;
    }

    if (!$entity instanceof ElggNews) {
        return;
    }

    $return = $hook->getValue();
    if ($entity->isFeatured()) {
        $return[] = \ElggMenuItem::factory([
            'name' => 'featured_news',
            'icon' => 'star',
            'text' => elgg_echo('amapnews:featured'),
            'href' => '#',
            'priority' => 40,
        ]);
    }

    return $return;
}