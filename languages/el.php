<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

return [

    // menu items and titles
    'amapnews' => "Ανακοινώσεις",
    'amapnews:menu' => "Ανακοινώσεις",
    'amapnews:edit' => "Επεξεργασία",
    'item:object:news' => "Ανακοινώσεις",
    'collection:object:news' => "Ανακοινώσεις",
    'amapnews:featured' => "Προτεινόμενες",
    'amapnews:read_more' => "Περισσότερα ",
    'amapnews_featured' => "Προτεινόμενα",
    
    // submit form
    'news:add' => "Νέα ανακοίνωση",
    'amapnews:add' => "Νέα ανακοίνωση",
    'amapnews:add:requiredfields' => "Τα πεδία με αστερίσκο (*) είναι υποχρεωτικά",
    'amapnews:add:title' => "Τίτλος",
    'amapnews:add:title:help' => "Συμπληρώστε τον τίτλο της δημοσίευσης.",
    'amapnews:add:excerpt' => "Εισαγωγή",
    'amapnews:add:excerpt:help' => "Συμπληρώστε ένα εισαγωγικό κείμενο για τη δημοσίευση. Θα εμφανίζεται στη λίστα των ανακοινώσεων.",
    'amapnews:add:description' => "Περιγραφή",
    'amapnews:add:description:help' => "Συμπληρώστε το κυρίως κείμενο της δημοσίευσης. Θα εμφανίζεται στη πλήρη προβολή της δημοσίευσης.",
    'amapnews:add:featured' => "Προτεινόμενο",
    'amapnews:add:featured:help' => "Επιλέξτε εάν θέλετε η δημοσίευση να εμφανίζεται ως προτεινόμενη.",
    'amapnews:add:unfeatured' => "Κατάργηση προτεινόμενου",
    'amapnews:add:tags' => "Ετικέτες",
    'amapnews:add:tags:help' => "Εισάγετε μερικές ετικέτες.",
    'amapnews:add:photo' => "Φωτογραφία",
    'amapnews:add:photo:help' => "Εάν υπάρχει διαθέσιμη φωτογραφία, επιλέξτε ένα αρχείο εικόνας. Επιτρεπτοί τύποι αρχείων: png, jpg, gif.",
    'amapnews:add:photo:invalid' => 'Μη έγκυρη φωτογραφία. Επιτρεπτοί τύποι αρχείων: png, jpg, gif.',
    'amapnews:add:submit' => "Υποβολή",
    'amapnews:add:tonews' => "Προσθήκη στις Ανακοινώσεις",
    'amapnews:add:novalidentity' => "Μη έγκυρη εγγραφή για προσθήκη στις ανακοινώσεις",
    'amapnews:none' => "Δεν υπάρχουν ανακοινώσεις", 
    'amapnews:add:noaccessforpost' => "Δεν έχετε δικαιώματα για δημοσίευση ανακοινώσεων",
    'amapnews:save:missing_title' => "Δεν συμπληρώσατε Τίτλο για την ανακοίνωση",
    'amapnews:save:missing_excerpt' => "Δεν συμπληρώσατε Εισαγωγή για την ανακοίνωση", 
    'amapnews:save:announcement' => "Ανακοίνωση", 
    'amapnews:save:failed' => "Η ανακοίνωση δεν μπορεί να δημοσιευτεί", 
    'amapnews:save:success' => "Η ανακοίνωση αποθηκεύτηκε με επιτυχία", 
    'amapnews:unknown_amapnews' => "Άγνωστη οντότητα",  
    'amapnews:delete:success' => "Η ανακοίνωση διαγράφτηκε με επιτυχία", 
    'amapnews:delete:failed' => "Η ανακοίνωση δεν μπορεί να διαγραφεί", 
    'amapnews:save:notvalid_access_id' => "Μη επιτρεπτό επίπεδο πρόσβασης. Θα πρέπει να ορίσετε τη δημοσίεσυη ως Ιδιωτικό ή να επιλέξετε πρόσβαση εντός της ομάδας σας.",
    'amapnews:add:connected_entity:title' => 'Προσθέστε αυτή τη δημοσίευση στις ανακοινώσεις',    
    
    // settings
    'amapnews:settings:no' => "No",
    'amapnews:settings:yes' => "Yes",   
    'amapnews:settings:general' => "General Settings",   
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
    'amapnews:settings:show_featured_on_sidebar' => 'Show Featured News on Sidebar',
    'amapnews:settings:show_featured_on_sidebar:note' => 'Check this if want to display latest featured news on list sidebar', 
    'amapnews:settings:staff' => 'News staff',
    'amapnews:settings:nostaff' => "No participants selected. You can add users via the user menu.",    
    'amapnews:settings:managestaff' => "You can remove participants via the user menu.", 
    'amapnews:settings:icon:icons' => 'Default News Icon',
    'amapnews:settings:icon:icons:intro' => 'Select the default icon to use on news list, when not uploading photo',
    'amapnews:settings:icon:featured' => 'Featured News Icon',
    'amapnews:settings:icon:featured:intro' => 'Select an icon to use for featured news',
    
    // river
    'river:object:news:create' => '%s δημοσίευσε νέα ανακοίνωση με τίτλο %s',
    'river:comment:object:news' => '%s σχολίασε την ανακοίνωση %s',
    
    // widget
    'amapnews:widget' => 'Νέα / Ανακοινώσεις', 
    'amapnews:widget:description' => 'Προβολή πρόσφατων ανακοινώσεων',  
    'amapnews:widget:viewall' => 'Προβολή όλων', 
    'amapnews:widget:viewall' => 'Προβολή όλων',  
    'amapnews:widget:amapnews_featured' => 'Προτεινόμενα', 
    'amapnews:widget:amapnews_featured:description' => 'Προβολή πιο πρόσφατων προτεινόμενων ανακοινώσεων',     
    'amapnews:widget:amapnews_featured:viewall' => 'Προβολή όλων',
    
    // groups
    'amapnews:group' => 'Ανακοινώσεις Ομάδας', 
    'groups:tool:news' => 'Ενεργοποίηση ανακοινώσεων ομάδας', 
    'amapnews:owner' => "νέα του/της %s",

    // staff
    'amapnews:menu_user_hover:make_staff' => "Set news staff",
    'amapnews:menu_user_hover:remove_staff' => "Unset news staff",
    'amapnews:action:news_staff:removed' => "User was removed from news staff",
    'amapnews:action:news_staff:added' => "User added to news staff",
    
    // upgrades
   'amapnews:upgrade:2017110700:title' => "Migrate amapnews to news entities",
   'amapnews:upgrade:2017110700:description' => "Changes the subtype of all amapnews to 'news'.",

   'amapnews:upgrade:2017110701:title' => "Migrate amapnews river entries",
   'amapnews:upgrade:2017110701:description' => "Changes the subtype of all river items for amapnews to 'news'.",
    
];
