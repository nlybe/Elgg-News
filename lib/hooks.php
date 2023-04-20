<?php
/**
 * Elgg News plugin
 * @package elgg-news
 *
 * All hooks are here
 */
 
use ElggNews\NewsOptions;

/**
 * Add option to set as new by admin to entity menu at end of the menu
 * 
 * @param \Elgg\Hook $hook 'register', 'menu:entity'
 *
 * @return void|ElggMenuItem[]
 */
function elggnews_entity_menu_setup(\Elgg\Hook $hook) {
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
            'text' => elgg_echo("elggnews:add:tonews"),
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

        if ($featured_menu_item) {  
            $text = ($entity->isFeatured()?elgg_echo("elggnews:add:unfeatured"):elgg_echo("elggnews:add:featured"));
            $return[] = \ElggMenuItem::factory([
                'name' => 'setasfeatured',
                'icon' => 'star',
                'text' => $text,
                'href' => elgg_normalize_url("action/elgg-news/set_featured/?guid={$entity->guid}"),
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
 * @param \Elgg\Hook $hook
 * 
 * @return type
 */
function elggnews_staff_user_hover_menu_hook(\Elgg\Hook $hook) {
    
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

    $text = elgg_echo("elggnews:menu_user_hover:make_staff");
    if ($entity->news_staff) {
        $text = elgg_echo("elggnews:menu_user_hover:remove_staff");
    }
    
    $return[] = \ElggMenuItem::factory([
        'name' => 'elggnews_staff',
        'icon' => 'plus-circle',
        'text' => $text,
        'href' => elgg_normalize_url("action/elgg-news/set_staff?guid=" . $entity->getGUID()),
        'confirm' => elgg_echo("question:areyousure"),
        'section' => 'admin'
    ]);

    return $return;
}

/**
 * Format and return the URL for news objects, since 1.9.
 *
 * @param \Elgg\Hook $hook
 * 
 * @return string URL of news
 */
function elggnews_set_url(\Elgg\Hook $hook) {
    $entity = $hook->getEntityParam();

    if (!$entity instanceof \ElggNews) {
		return;
	}

    $friendly_title = NewsOptions::includeTitleOnNewsItemUrl()?elgg_get_friendly_title($entity->title):"";
    if ($entity->connected_guid) {
        $connected_entity = get_entity($entity->connected_guid);        
        if ($connected_entity) {
            return $connected_entity->getURL();
        }
        else {
            return elgg_normalize_url("news/view/{$entity->guid}/$friendly_title");
        }
    }
    else {
        return elgg_normalize_url("news/view/{$entity->guid}/$friendly_title");
    }
    
}

/**
 * Add a menu item to an ownerblock
 *
 * @param \Elgg\Hook $hook 'register', 'menu:owner_block'
 *
 * @return ElggMenuItem[]
 */
function elggnews_owner_block_menu(\Elgg\Hook $hook) {
	$entity = $hook->getEntityParam();
	$return = $hook->getValue();
	
	if ($entity instanceof \ElggUser) {
        return $return;
    } 
    elseif ($entity instanceof \ElggGroup && NewsOptions::allowPostOnGroups() && $entity->isToolEnabled('news')) {
        $url = "news/group/{$entity->guid}/all";
        $item = new ElggMenuItem('elggnews', elgg_echo('elggnews:group'), $url);
        $return[] = $item;
    }

    return $return;
}

/**
 * Register database seed
 *
 * @elgg_plugin_hook seeds database
 *
 * @param \Elgg\Hook $hook Hook
 * 
 * @return array
 */
function elggnews_register_db_seeds(\Elgg\Hook $hook) {

    $seeds = $hook->getValue();

    $seeds[] = \Elgg\News\Seeder::class;

    return $seeds;
}

/**
 * Set custom icon sizes for news objects
 *
 * @param \Elgg\Hook $hook
 * 
 * @return array
 */
function elggnews_set_custom_icon_sizes(\Elgg\Hook $hook) {

    $entity_subtype = $hook->getParam('entity_subtype');
    if ($entity_subtype !== ElggNews::SUBTYPE) {
        return;
    }
    
    $photo_sizes = elgg_get_config('elggnews_photo_sizes');

    $cWidth = NewsOptions::getCustomPhotoWidth();
    $cHeight = NewsOptions::getCustomPhotoHeight();
    if (is_numeric($cWidth) && is_numeric($cHeight)) {
        $photo_sizes['custom'] = ['w' => $cWidth, 'h' => $cHeight, 'square' => false, 'upscale' => false];
    }
    
    return $photo_sizes;
}

/**
 * Show featured icon, if news entity is featured
 *
 * @param \Elgg\Hook $hook 'register' 'menu:social'
 * @return void|ElggMenuItem[]
 * @since 3.0
 */
function elggnews_social_menu_setup(\Elgg\Hook $hook) {
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
            'text' => elgg_echo('elggnews:featured'),
            'href' => '#',
            'priority' => 40,
        ]);
    }

    return $return;
}