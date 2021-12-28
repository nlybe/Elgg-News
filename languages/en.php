<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

return [

    // menu items and titles
    'elgg-news' => "News",
    'elggnews:menu' => "News",
    'elggnews:edit' => "Edit post",
    'item:object:news' => "News",
    'collection:object:news' => "News",
    'elggnews:featured' => "Featured",
    'elggnews:read_more' => "Read more ",
    'elggnews_featured' => "Featured News",
    'add:object:news' => 'Post News',
 
    // submit form
    'news:add' => "Post News",
    'elggnews:add' => "Post News",
    'elggnews:add:requiredfields' => "Fields with an asterisk (*) are required",
    'elggnews:add:title' => "Title",
    'elggnews:add:title:help' => "Set the title of this post.",
    'elggnews:add:excerpt' => "Summary",
    'elggnews:add:excerpt:help' => "Set a summary for this post. It will be displayed in news list.",
    'elggnews:add:description' => "Description",
    'elggnews:add:description:help' => "Enter the main text for this post. It will be displayed on full view.",
    'elggnews:add:featured' => "Set featured",
    'elggnews:add:featured:help' => "Check this for setting this item as featured. It could be used in special sections like widgets, landing page etc.",
    'elggnews:add:unfeatured' => "Unset featured",
    'elggnews:add:tags' => "Tags",
    'elggnews:add:tags:help' => "Enter some tags.",
    'elggnews:add:photo' => "Photo",
    'elggnews:add:photo:help' => "If photo is available, upload a valid image file (.png or .jpg or gif).",
    'elggnews:add:photo:invalid' => 'Invalid file type for photo. It must be png or gif or jpg.',
    'elggnews:add:submit' => "Submit",
    'elggnews:add:tonews' => "Add to news",
    'elggnews:add:novalidentity' => "No valid entity for adding to news",
    'elggnews:none' => "No news yet", 
    'elggnews:add:noaccessforpost' => "Not valid permission for this action",
    'elggnews:save:missing_title' => "Title is missing. Post cannot be saved.",
    'elggnews:save:missing_excerpt' => "Summary is missing. Post cannot be saved.", 
    'elggnews:save:announcement' => "Announcement", 
    'elggnews:save:failed' => "Post cannot be saved", 
    'elggnews:save:success' => "Post was successfully saved", 
    'elggnews:unknown_elggnews' => "Unknown entity",     
    'elggnews:delete:success' => "Post was successfully deleted", 
    'elggnews:delete:failed' => "Post cannot be deleted", 
    'elggnews:save:notvalid_access_id' => "Not valid Access Level. You have to set as private or allow only to group.",
    'elggnews:add:connected_entity:title' => 'Add this entity to news',
    
    // settings
    'elggnews:settings:no' => "No",
    'elggnews:settings:yes' => "Yes",
    'elggnews:settings:general' => "General Settings",    
    'elggnews:settings:show_user_icon' => "Display user icon",    
    'elggnews:settings:show_user_icon:note' => "Display user icon on list or single view. If uncheck, a news icon or uploaded photo will be displayed as icon.",
    'elggnews:settings:show_username' => "Display username",    
    'elggnews:settings:show_username:note' => "Display username on list or single view",   
    'elggnews:settings:post_on_groups' => "Post news on groups",    
    'elggnews:settings:post_on_groups:note' => "Allow group's owners to post news/announcements inside groups", 
    'elggnews:settings:featured_by_admin_only' => "Restrict featured news to admin",    
    'elggnews:settings:featured_by_admin_only:note' => "Select Yes if want to restrict setting Featured News only to administrators", 
    'elggnews:settings:post_users' => "Regular User can post News",    
    'elggnews:settings:post_users:note' => "Allow users  to post site-news/announcements. Restict this with user-roles.", 
    'elggnews:settings:custom_icon' => "Custom size for news photos",  
    'elggnews:settings:custom_icon:intro' => "If need to customize news photo size for using a custom view (e.g. in index page), determine width and height below.",  
    'elggnews:settings:custom_icon_width' => "Width",    
    'elggnews:settings:custom_icon_width:note' => "Set custom photo's width in px", 
    'elggnews:settings:custom_icon_height' => "Height",    
    'elggnews:settings:custom_icon_height:note' => "Set custom photo's height in px", 
    'elggnews:settings:show_featured_on_sidebar' => 'Show Featured News on Sidebar',
    'elggnews:settings:show_featured_on_sidebar:note' => 'Check this if want to display latest featured news on list sidebar', 
    'elggnews:settings:staff' => 'News staff',
    'elggnews:settings:nostaff' => "No participants selected. You can add users via the user menu.",    
    'elggnews:settings:managestaff' => "You can remove participants via the user menu.", 
    'elggnews:settings:icon:icons' => 'Default News Icon',
    'elggnews:settings:icon:icons:intro' => 'Select the default icon to use on news list, when not uploading photo',
    'elggnews:settings:icon:featured' => 'Featured News Icon',
    'elggnews:settings:icon:featured:intro' => 'Select an icon to use for featured news',
     
    // river
    'river:object:news:create' => '%s posted a news item with title %s',
    'river:comment:object:news' => '%s commented on %s',
    
    // widget
    'elggnews:widget' => 'News & Announcements', 
    'elggnews:widget:description' => 'Display latest news and announcements', 
    'elggnews:widget:num_display' => 'Number of items to display: ',
    'elggnews:widget:viewall' => 'View all',  
    'elggnews:widget:elggnews_featured' => 'Featured News', 
    'elggnews:widget:elggnews_featured:description' => 'Display latest featured/important news and announcements',     
    'elggnews:widget:elggnews_featured:viewall' => 'View all news',
    
    // groups
    'elggnews:group' => 'Group news', 
    'groups:tool:news' => 'Enable group news', 
    'elggnews:owner' => "%s's news",

    // staff
    'elggnews:menu_user_hover:make_staff' => "Set news staff",
    'elggnews:menu_user_hover:remove_staff' => "Unset news staff",
    'elggnews:action:news_staff:removed' => "User was removed from news staff",
    'elggnews:action:news_staff:added' => "User added to news staff",
    
    // upgrades
   'elggnews:upgrade:2017110700:title' => "Migrate amapnews to news entities",
   'elggnews:upgrade:2017110700:description' => "Changes the subtype of all amapnews to 'news'.",

   'elggnews:upgrade:2017110701:title' => "Migrate amapnews river entries",
   'elggnews:upgrade:2017110701:description' => "Changes the subtype of all river items for amapnews to 'news'.",

];
