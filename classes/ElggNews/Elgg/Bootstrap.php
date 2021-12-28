<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

namespace ElggNews\Elgg;

use Elgg\DefaultPluginBootstrap;
use ElggNews\NewsOptions;

class Bootstrap extends DefaultPluginBootstrap {
	
	const HANDLERS = [];
	
	/**
	 * {@inheritdoc}
	 */
	public function init() {
		$this->initViews();
	}

	/**
	 * Init views
	 *
	 * @return void
	 */
	protected function initViews() {
		// register extra css
		elgg_extend_view('elgg.css', 'elgg-news/elgg-news.css');
				
		// add a site navigation item
		elgg_register_menu_item('site', [
			'name' => 'elgg-news',
			'icon' => 'newspaper',
			'text' => elgg_echo('elggnews:menu'),
			'href' => elgg_generate_url('collection:object:news:all'),
		]);    
		
		// add option to all site entities for adding to news
		elgg_register_plugin_hook_handler('register', 'menu:entity', 'elggnews_entity_menu_setup', 400);
		
		// show featured icon, if news entity is featured
		elgg_register_plugin_hook_handler('register', 'menu:social', 'elggnews_social_menu_setup');

		// add option for admin to add/remove user from news-staff
		elgg_register_plugin_hook_handler("register", "menu:user_hover", "elggnews_staff_user_hover_menu_hook");
		
		// Register menu item to an ownerblock. It is used to  register news menu item to groups
		elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'elggnews_owner_block_menu');
		
		// allow to be liked
		elgg_register_plugin_hook_handler('likes:is_likable', 'object:news', 'Elgg\Values::getTrue');
		
		// Register a URL handler for news
		elgg_register_plugin_hook_handler('entity:url', 'object', 'elggnews_set_url');
		
		// register database seed
		elgg_register_plugin_hook_handler('seeds', 'database', 'elggnews_register_db_seeds');
		
		// shop images custom sizes
		elgg_register_plugin_hook_handler('entity:icon:sizes', 'object', 'elggnews_set_custom_icon_sizes');
		
		if (NewsOptions::allowPostOnGroups()) {
			// Add group option
			elgg()->group_tools->register('news');  
		}
		
		// set photo sizes for news posts
		elgg_set_config('elggnews_photo_sizes', [
			'topbar' => ['w' => 16, 'h' => 16, 'square' => true, 'upscale' => false],
			'tiny' => ['w' => 25, 'h' => 25, 'square' => true, 'upscale' => false],
			'small' => ['w' => 40, 'h' => 40, 'square' => true, 'upscale' => false],
			'medium' => ['w' => 100, 'h' => 100, 'square' => true, 'upscale' => false],
			'large' => ['w' => 200, 'h' => 200, 'square' => true, 'upscale' => false],
			'master' => ['w' => 2048, 'h' => 2048, 'square' => false, 'upscale' => false],
		]);
	}
}
