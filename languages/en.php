<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$lang = array(

    // menu items and titles
    'amapnews' => "News",
    'amapnews:menu' => "News",
    'amapnews:edit' => "Edit post",
    'item:object:amapnews' => "News",
    'amapnews:featured' => "Featured",
    'amapnews:read_more' => "Read more ",
 
    // submit form
    'news:add' => "Post News",
    'amapnews:add' => "Post News",
    'amapnews:add:requiredfields' => "Fields with an asterisk (*) are required",
    'amapnews:add:title' => "Title",
    'amapnews:add:title:help' => "Set the title of this post.",
    'amapnews:add:excerpt' => "Summary",
    'amapnews:add:excerpt:help' => "Set a summary for this post. It will be displayed in news list.",
    'amapnews:add:description' => "Description",
    'amapnews:add:description:help' => "Enter the main text for this post. It will be displayed on full view.",
    'amapnews:add:featured' => "Set featured",
    'amapnews:add:featured:help' => "Check this for setting this item as featured. It could be used in special sections like widgets, landing page etc.",
    'amapnews:add:unfeatured' => "Unset featured",
    'amapnews:add:tags' => "Tags",
    'amapnews:add:tags:help' => "Enter some tags.",
    'amapnews:add:photo' => "Photo",
    'amapnews:add:photo:help' => "If photo is available, upload a valid image file (.png or .jpg or gif).",
    'amapnews:add:photo:invalid' => 'Invalid file type for photo. It must be png or gif or jpg.',
    'amapnews:add:submit' => "Submit",
    'amapnews:add:tonews' => "Add to news",
    'amapnews:add:novalidentity' => "No valid entity for adding to news",
    'amapnews:none' => "No news yet", 
    'amapnews:add:noaccessforpost' => "Not valid permission for post news",
    'amapnews:save:missing_title' => "Title is missing. Post cannot be saved.",
    'amapnews:save:missing_excerpt' => "Summary is missing. Post cannot be saved.", 
    'amapnews:save:announcement' => "Announcement", 
    'amapnews:save:failed' => "Post cannot be saved", 
    'amapnews:save:success' => "Post was successfully saved", 
    'amapnews:unknown_amapnews' => "Unknown entity",     
    'amapnews:delete:success' => "Post was successfully deleted", 
    'amapnews:delete:failed' => "Post cannot be deleted", 
    'amapnews:save:notvalid_access_id' => "Not valid Access Level. You have to set as private or allow only to group.",
    'amapnews:add:connected_entity:title' => 'Add this entity to news',
    
    // settings
    'amapnews:settings:no' => "No",
    'amapnews:settings:yes' => "Yes",    
    'amapnews:settings:show_user_icon' => "Display user icon",    
    'amapnews:settings:show_user_icon:note' => "Display user icon on list or single view. If select no, a news icon will be displayed.",    
    'amapnews:settings:show_username' => "Display username",    
    'amapnews:settings:show_username:note' => "Display username on list or single view",   
    'amapnews:settings:post_on_groups' => "Post news on groups",    
    'amapnews:settings:post_on_groups:note' => "Allow group's owners to post news/announcements inside groups", 
    'amapnews:settings:featured_by_admin_only' => "Restrict featured news to admin",    
    'amapnews:settings:featured_by_admin_only:note' => "Select Yes if want to restrict setting Featured News only to administrators", 
    'amapnews:settings:post_users' => "Regular User can post News",    
    'amapnews:settings:post_users:note' => "Allow users  to post site-news/announcements. Restict this with user-roles.", 
    'amapnews:settings:custom_icon' => "Custom size for news photos",  
    'amapnews:settings:custom_icon:intro' => "If need to customize news photo size for using a custom view (e.g. in index page), determine width and height below.",  
    'amapnews:settings:custom_icon_width' => "Width",    
    'amapnews:settings:custom_icon_width:note' => "Set custom photo's width in px", 
    'amapnews:settings:custom_icon_height' => "Height",    
    'amapnews:settings:custom_icon_height:note' => "Set custom photo's height in px", 

    'amapnews:settings:staff' => 'News staff',
    'amapnews:settings:nostaff' => "No participants selected. You can add users via the user menu.",    
    'amapnews:settings:managestaff' => "You can remove participants via the user menu.", 
    'amapnews:settings:icon:icons' => 'Default News Icon',
    'amapnews:settings:icon:icons:intro' => 'Select the default icon to use on news list, when not uploading photo',
    'amapnews:settings:icon:featured' => 'Featured News Icon',
    'amapnews:settings:icon:featured:intro' => 'Select an icon to use for featured news',    
     
    // river
    'river:create:object:amapnews' => '%s posted a news item with title %s',
    'river:comment:object:amapnews' => '%s commented on %s',
    'vouchers:river:annotate' => 'a comment on ',
    'vouchers:river:item' => 'an item',  
    
    // widget
    'amapnews:widget' => 'News & Announcements', 
    'amapnews:widget:description' => 'Display latest news and announcements', 
    'amapnews:widget:num_display' => 'Number of items to display: ',
    'amapnews:widget:viewall' => 'View all',  
    'amapnews:widget:amapnews_featured' => 'Featured News', 
    'amapnews:widget:amapnews_featured:description' => 'Display latest featured/important news and announcements',     
    
    // groups
    'amapnews:group' => 'Group news', 
    'amapnews:group:enable' => 'Enable News on group', 
    'amapnews:owner' => "%s's news",

    // staff
    'amapnews:menu_user_hover:make_staff' => "Add to news staff",
    'amapnews:menu_user_hover:remove_staff' => "Remove from news staff",
    'amapnews:action:news_staff:removed' => "User was removed from news staff",
    'amapnews:action:news_staff:added' => "User added to news staff",

);

add_translation("en", $lang);
