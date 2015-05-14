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
 
    // submit form
    'news:add' => "Post News",
    'amapnews:add' => "Post News",
    'amapnews:add:requiredfields' => "Fields with an asterisk (*) are required",
    'amapnews:add:title' => "Title",
    'amapnews:add:excerpt' => "Summary",
    'amapnews:add:description' => "Description",
    'amapnews:add:tags' => "Tags",
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
    
    // settings
    'amapnews:settings:no' => "No",
    'amapnews:settings:yes' => "Yes",    
    'amapnews:settings:show_user_icon' => "Display user icon",    
    'amapnews:settings:show_user_icon:note' => "Display user icon on list or single view. If select no, a news icon will be displayed.",    
    'amapnews:settings:show_username' => "Display username",    
    'amapnews:settings:show_username:note' => "Display username on list or single view",   
    'amapnews:settings:post_on_groups' => "Post news on groups",    
    'amapnews:settings:post_on_groups:note' => "Allow group's owners to post news/announcements inside groups", 

    'amapnews:settings:post_users' => "Regular User can post News",    
    'amapnews:settings:post_users:note' => "Allow users  to post site-news/announcements. Restict this with user-roles.", 

	'amapnews:settings:staff' => 'News staff',
    'amapnews:settings:nostaff' => "No participants selected. You can add users via the user menu.",    
    'amapnews:settings:managestaff' => "You can remove participants via the user menu.", 
     
    // river
    'river:create:object:amapnews' => '%s posted new with title %s',
    'river:comment:object:amapnews' => '%s commented on %s',
    'vouchers:river:annotate' => 'a comment on ',
    'vouchers:river:item' => 'an item',  
    
    // widget
    'amapnews:widget' => 'News & Announcements', 
    'amapnews:widget:description' => 'Display latest site news',  
    'amapnews:widget:viewall' => 'View all',  
    
	// groups
	'amapnews:group' => 'Group news', 
	'amapnews:group:enable' => 'Enable News on group', 
	'amapnews:owner' => "%s's news",
	
	// staff
	'amapnews:menu_user_hover:make_staff' => "Add to the news staff",
 	'amapnews:menu_user_hover:remove_staff' => "Remove from the news staff",
 	'amapnews:action:news_staff:removed' => "User was removed from news staff",
 	'amapnews:action:news_staff:added' => "User added to news staff",

);

add_translation("en", $lang);
