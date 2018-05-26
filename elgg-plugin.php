<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

return [
    'entities' => [
        [
            'type' => 'object',
            'subtype' => 'amapnews',
            'class' => 'Amapnews',
            'searchable' => true,
        ],
    ],
    'actions' => [
        'amapnews/add' => [],
        'amapnews/delete' => [],
        'amapnews/set_featured' => [],
        'amapnews/staff' => [],
    ],
    'routes' => [
        'default:object:amapnews' => [
            'path' => '/news',
            'resource' => 'amapnews/all',
        ],
        'collection:object:amapnews:all' => [
            'path' => '/news/all/{lower?}/{upper?}',
            'resource' => 'amapnews/all',
            'requirements' => [
                'lower' => '\d+',
                'upper' => '\d+',
            ],
        ],        
        'collection:object:blog:owner' => [
            'path' => '/amapnews/owner/{username?}/{lower?}/{upper?}',
            'resource' => 'amapnews/owner',
            'requirements' => [
                'lower' => '\d+',
                'upper' => '\d+',
            ],
        ],
        'add:object:amapnews' => [
            'path' => '/amapnews/add/{guid?}',
            'resource' => 'amapnews/add',
            'middleware' => [
                \Elgg\Router\Middleware\Gatekeeper::class,
            ],
        ],
        'edit:object:amapnews' => [
            'path' => '/amapnews/edit/{guid}',
            'resource' => 'amapnews/edit',
            'requirements' => [
                'revision' => '\d+',
            ],
            'middleware' => [
                \Elgg\Router\Middleware\Gatekeeper::class,
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
];