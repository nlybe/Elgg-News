<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

return [
    'entities' => [
        [
            'type' => 'object',
            'subtype' => 'news',
            'class' => 'ElggNews',
            'searchable' => true,
        ],
    ],
    'actions' => [
        'amapnews/add' => [],
        'amapnews/delete' => [],
        'amapnews/set_featured' => [],
        'amapnews/set_staff' => ['access' => 'admin'],
    ],
    'routes' => [
        'default:object:news' => [
            'path' => '/news',
            'resource' => 'amapnews/all',
        ],
        'collection:object:news:all' => [
            'path' => '/news/all/{lower?}/{upper?}',
            'resource' => 'amapnews/all',
            'requirements' => [
                'lower' => '\d+',
                'upper' => '\d+',
            ],
        ],        
        'collection:object:news:owner' => [
            'path' => '/news/owner/{username?}/{lower?}/{upper?}',
            'resource' => 'amapnews/owner',
            'requirements' => [
                'lower' => '\d+',
                'upper' => '\d+',
            ],
        ],
        'add:object:news' => [
            'path' => '/news/add/{guid?}',
            'resource' => 'amapnews/add',
        ],
        'edit:object:news' => [
            'path' => '/news/edit/{guid}',
            'resource' => 'amapnews/edit',
            'requirements' => [
                'revision' => '\d+',
            ],
            'middleware' => [
                \Elgg\Router\Middleware\Gatekeeper::class,
            ],
        ],
        'add_existed:object:news' => [
            'path' => '/news/add_existed/{guid}',
            'resource' => 'amapnews/add_existed',
        ],
        'view:object:news' => [
            'path' => '/news/view/{guid}/{title?}',
            'resource' => 'amapnews/view',
        ],
        'collection:object:news:group' => [
            'path' => '/news/group/{guid}/{subpage?}',
            'resource' => 'amapnews/owner',
            'defaults' => [
                'subpage' => 'all',
            ],
        ],
    ],
    'widgets' => [
        'amapnews' => [
            'description' => elgg_echo('amapnews:widget:description'),
            'context' => ['profile', 'dashboard', 'index', 'groups'],
        ],
        'amapnews_featured' => [
            'description' => elgg_echo('amapnews:widget:amapnews_featured:description'),
            'context' => ['dashboard', 'index', 'groups'],
        ],
    ],
    'views' => [
        'default' => [
            'amapnews/graphics/' => __DIR__ . '/graphics',
            'amapnews/icons/' => __DIR__ . '/graphics/icons',
        ],
    ],
    'upgrades' => [
        '\Elgg\News\Upgrades\MigrateNews',
    ],
];
