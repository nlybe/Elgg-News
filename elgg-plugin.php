<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

use ElggNews\Elgg\Bootstrap;

require_once(dirname(__FILE__) . '/lib/events.php');
require_once(dirname(__FILE__) . '/lib/functions.php');

return [
    'plugin' => [
        'name' => 'News',
		'version' => '5.24.1',
		'dependencies' => [],
	],	
    'bootstrap' => Bootstrap::class,
	'settings' => [
		'show_user_icon' => 'yes',
		'show_username' => 'yes',
		'post_on_groups' => 'yes',
		'featured_by_admin_only' => 'yes',
		'show_featured_on_sidebar' => 'yes',
		'news_url_include_title' => 'yes',
		'custom_icon_width' => '600',
		'custom_icon_height' => '360',
	],
    'entities' => [
        [
            'type' => 'object',
            'subtype' => 'news',
            'class' => 'ElggNews',
            'capabilities' => [
				'commentable' => true,
				'searchable' => true,
				'likable' => true,
			],
        ],
    ],
    'actions' => [
        'elgg-news/add' => [],
        'elgg-news/delete' => [],
        'elgg-news/set_featured' => [],
        'elgg-news/set_staff' => ['access' => 'admin'],
    ],
    'routes' => [
        'default:object:news' => [
            'path' => '/news',
            'resource' => 'elgg-news/all',
        ],
        'collection:object:news:all' => [
            'path' => '/news/all/{lower?}/{upper?}',
            'resource' => 'elgg-news/all',
            'requirements' => [
                'lower' => '\d+',
                'upper' => '\d+',
            ],
        ],        
        'collection:object:news:owner' => [
            'path' => '/news/owner/{username?}/{lower?}/{upper?}',
            'resource' => 'elgg-news/owner',
            'requirements' => [
                'lower' => '\d+',
                'upper' => '\d+',
            ],
        ],
        'add:object:news' => [
            'path' => '/news/add/{guid?}',
            'resource' => 'elgg-news/add',
            'middleware' => [
                \Elgg\Router\Middleware\Gatekeeper::class,
            ],
        ],
        'edit:object:news' => [
            'path' => '/news/edit/{guid}',
            'resource' => 'elgg-news/edit',
            'requirements' => [
                'revision' => '\d+',
            ],
            'middleware' => [
                \Elgg\Router\Middleware\Gatekeeper::class,
            ],
        ],
        'add_existed:object:news' => [
            'path' => '/news/add_existed/{guid}',
            'resource' => 'elgg-news/add_existed',
            'middleware' => [
                \Elgg\Router\Middleware\Gatekeeper::class,
            ],
        ],
        'view:object:news' => [
            'path' => '/news/view/{guid}/{title?}',
            'resource' => 'elgg-news/view',
        ],
        'collection:object:news:group' => [
            'path' => '/news/group/{guid}/{subpage?}',
            'resource' => 'elgg-news/owner',
            'defaults' => [
                'subpage' => 'all',
            ],
        ],
        'custom_list:object:news' => [
            'path' => '/news/custom_list',
            'resource' => 'elgg-news/custom_list_view',
        ],
    ],
	'events' => [
		'entity:url' => [
			'object' => [
				'elggnews_set_url' => [],
			],
		],
		'register' => [
			'menu:entity' => [
				'elggnews_entity_menu_setup' => []
			],
			'menu:social' => [
				'elggnews_social_menu_setup' => [],
			],
			'menu:user_hover' => [
				'elggnews_staff_user_hover_menu_hook' => [],
			],
			'menu:owner_block' => [
				'elggnews_owner_block_menu' => [],
			],
		],
		'entity:icon:sizes' => [
			'object' => [
				'elggnews_set_custom_icon_sizes' => [],
			],
		],
		'seeds' => [
			'database' => [
				'elggnews_register_db_seeds' => [],
			],
		],
	],
    'widgets' => [
        'elgg-news' => [
            'description' => elgg_echo('elggnews:widget:description'),
            'context' => ['profile', 'dashboard', 'index', 'groups'],
        ],
        'elgg-news-featured' => [
            'description' => elgg_echo('elggnews:widget:elgg-news-featured:description'),
            'context' => ['dashboard', 'index', 'groups'],
        ],
    ],
    'views' => [
        'default' => [
            'elgg-news/graphics/' => __DIR__ . '/graphics',
            'elgg-news/icons/' => __DIR__ . '/graphics/icons',
        ],
    ],
	'view_extensions' => [
		'elgg.css' => [
			'elgg-news/elgg-news.css' => [],
		],
	],
    'upgrades' => [
        '\Elgg\News\Upgrades\MigrateNews',
    ],
];
