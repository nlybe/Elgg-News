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
