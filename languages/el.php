<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

return [

    // menu items and titles
    'elgg-news' => "Ανακοινώσεις",
    'elggnews:menu' => "Ανακοινώσεις",
    'elggnews:edit' => "Επεξεργασία",
    'item:object:news' => "Ανακοινώσεις",
    'collection:object:news' => "Ανακοινώσεις",
    'elggnews:featured' => "Προτεινόμενες",
    'elggnews:read_more' => "Περισσότερα ",
    'elggnews_featured' => "Προτεινόμενα",
    
    // submit form
    'news:add' => "Νέα ανακοίνωση",
    'elggnews:add' => "Νέα ανακοίνωση",
    'elggnews:add:requiredfields' => "Τα πεδία με αστερίσκο (*) είναι υποχρεωτικά",
    'elggnews:add:title' => "Τίτλος",
    'elggnews:add:title:help' => "Συμπληρώστε τον τίτλο της δημοσίευσης.",
    'elggnews:add:excerpt' => "Εισαγωγή",
    'elggnews:add:excerpt:help' => "Συμπληρώστε ένα εισαγωγικό κείμενο για τη δημοσίευση. Θα εμφανίζεται στη λίστα των ανακοινώσεων.",
    'elggnews:add:description' => "Περιγραφή",
    'elggnews:add:description:help' => "Συμπληρώστε το κυρίως κείμενο της δημοσίευσης. Θα εμφανίζεται στη πλήρη προβολή της δημοσίευσης.",
    'elggnews:add:featured' => "Προτεινόμενο",
    'elggnews:add:featured:help' => "Επιλέξτε εάν θέλετε η δημοσίευση να εμφανίζεται ως προτεινόμενη.",
    'elggnews:add:unfeatured' => "Κατάργηση προτεινόμενου",
    'elggnews:add:tags' => "Ετικέτες",
    'elggnews:add:tags:help' => "Εισάγετε μερικές ετικέτες.",
    'elggnews:add:photo' => "Φωτογραφία",
    'elggnews:add:photo:help' => "Εάν υπάρχει διαθέσιμη φωτογραφία, επιλέξτε ένα αρχείο εικόνας. Επιτρεπτοί τύποι αρχείων: png, jpg, gif.",
    'elggnews:add:photo:invalid' => 'Μη έγκυρη φωτογραφία. Επιτρεπτοί τύποι αρχείων: png, jpg, gif.',
    'elggnews:add:submit' => "Υποβολή",
    'elggnews:add:tonews' => "Προσθήκη στις Ανακοινώσεις",
    'elggnews:add:novalidentity' => "Μη έγκυρη εγγραφή για προσθήκη στις ανακοινώσεις",
    'elggnews:none' => "Δεν υπάρχουν ανακοινώσεις", 
    'elggnews:add:noaccessforpost' => "Δεν έχετε δικαιώματα για δημοσίευση ανακοινώσεων",
    'elggnews:save:missing_title' => "Δεν συμπληρώσατε Τίτλο για την ανακοίνωση",
    'elggnews:save:missing_excerpt' => "Δεν συμπληρώσατε Εισαγωγή για την ανακοίνωση", 
    'elggnews:save:announcement' => "Ανακοίνωση", 
    'elggnews:save:failed' => "Η ανακοίνωση δεν μπορεί να δημοσιευτεί", 
    'elggnews:save:success' => "Η ανακοίνωση αποθηκεύτηκε με επιτυχία", 
    'elggnews:unknown_elggnews' => "Άγνωστη οντότητα",  
    'elggnews:delete:success' => "Η ανακοίνωση διαγράφτηκε με επιτυχία", 
    'elggnews:delete:failed' => "Η ανακοίνωση δεν μπορεί να διαγραφεί", 
    'elggnews:save:notvalid_access_id' => "Μη επιτρεπτό επίπεδο πρόσβασης. Θα πρέπει να ορίσετε τη δημοσίεσυη ως Ιδιωτικό ή να επιλέξετε πρόσβαση εντός της ομάδας σας.",
    'elggnews:add:connected_entity:title' => 'Προσθέστε αυτή τη δημοσίευση στις ανακοινώσεις',    
    
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
    'river:object:news:create' => '%s δημοσίευσε νέα ανακοίνωση με τίτλο %s',
    'river:comment:object:news' => '%s σχολίασε την ανακοίνωση %s',
    
    // widget
    'elggnews:widget' => 'Νέα / Ανακοινώσεις', 
    'elggnews:widget:description' => 'Προβολή πρόσφατων ανακοινώσεων',  
    'elggnews:widget:viewall' => 'Προβολή όλων', 
    'elggnews:widget:viewall' => 'Προβολή όλων',  
    'elggnews:widget:elggnews_featured' => 'Προτεινόμενα', 
    'elggnews:widget:elggnews_featured:description' => 'Προβολή πιο πρόσφατων προτεινόμενων ανακοινώσεων',     
    'elggnews:widget:elggnews_featured:viewall' => 'Προβολή όλων',
    
    // groups
    'elggnews:group' => 'Ανακοινώσεις Ομάδας', 
    'groups:tool:news' => 'Ενεργοποίηση ανακοινώσεων ομάδας', 
    'elggnews:owner' => "νέα του/της %s",

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
