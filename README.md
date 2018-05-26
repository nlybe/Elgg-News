Elgg News Plugin
================

This version is NOT recommended for any production Elgg site.

![Elgg 3.0](https://img.shields.io/badge/Elgg-3.0-orange.svg?style=flat-square)

Elgg plugin for posting news and announcements by administrators, group owners or news staff.

## Features

This plugin offers admins the options:

- Post news items
- Add other Elgg entities as news items
- Option to determine more users who can post news/announcements
- Option to allow post news/announcements on groups, only by group owners
- Option to change the default news icon and featured news icon in settings
- Customizable news list view
- Option to allow or not staff news to set/unset news as featured

As an example for 2nd case, if there is blog post by any user, administrator can add this as news post. So it will be displayed in list of news but if users click on this item, will redirected to original blog post. The same action could apply to any post like pages, bookmarks, videos etc. 

Also administrator can allow to group owners for posting new/announcements inside the group only.

Summarizing permissions, the following options are available:
#### Who can post site news
- Administrators
- News Staff

#### Who can set/unset site news as featured
- Administrators
- News Staff (if enabled in settings)

#### Who can post group news (if enabled in settings)
- Administrators
- Group owner/managers

#### Who can set/unset group news as featured (if enabled in settings)
- Administrators
- Group owner/managers


## How to use a customizable news list view
If need to have a different view for listing news, e.g. in a custom front page, you could use the following code:

```php
echo elgg_view('amapnews/custom_list_view', array(
    'entities' => $entities,    // list of news entities, previously retrieved
    'read_more' => true,        // set true if want to add a "Read more" link for each news item
    'item_class' => '',         // set a custom class on news items, so it could be customized through CSS
    'photo_size' => 'custom',   // set the size of the news photo, see more details below
    'photo_cover' => false,     // set true if want to use the news as cover image, otherwise it will be displayed inline with title and intro
    'photo_class' => '',        // set a custom class on news photo
));
```

You can see an example about how to use this view at:
- amapnews/views/default/resources/amapnews/custom_list_view.php

This sample view will be accessible at http://www.YOURCOMMUNITYURL.com/news/custom_list

Especially about photo size, you can use any of the predefined photo size, which are:
```php
elgg_set_config('amapnews_photo_sizes', array(
    'tiny' => array('w' => 25, 'h' => 25, 'square' => TRUE, 'upscale' => FALSE),
    'small' => array('w' => 40, 'h' => 40, 'square' => TRUE, 'upscale' => FALSE),
    'medium' => array('w' => 100, 'h' => 100, 'square' => TRUE, 'upscale' => FALSE),
    'large' => array('w' => 150, 'h' => 150, 'square' => TRUE, 'upscale' => FALSE),
    'master' => array('w' => 215, 'h' => 215, 'square' => TRUE, 'upscale' => FALSE),
    'default' => array('w' => 1200, 'h' => 1200, 'square' => FALSE, 'upscale' => FALSE),
));
```

Or you can set a custom photo size (width and height) in plugin settings, so for each photo upload on news item, it will be saved in this size too.

## How to change the default icon
Site administrators are able to select in plugin settings the icons to use for:
1. Default news icon
2. Featured news icon

If need to add a custom icon, just uploaded it to folders **mod/amapnews/graphics/icons** for default news icon or to **mod/amapnews/graphics/featured** for featured news icon. All file uploads will be available for selection in plugin settings.
