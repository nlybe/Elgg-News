<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

return [

    // menu items and titles
    'amapnews' => "Neuigkeiten",
    'amapnews:menu' => "Neuigkeiten",
    'amapnews:edit' => "Eintrag bearbeiten",
    'item:object:news' => "Neuigkeiten",
    'collection:object:news' => "News",
    'amapnews:featured' => "Featured",
    'amapnews:read_more' => "Read more ",
    'amapnews_featured' => "Featured News",
 
    // submit form
    'news:add' => "Neuigkeit veröffentlichen",
    'amapnews:add' => "Neuigkeit veröffentlichen",
    'amapnews:add:requiredfields' => "Eingabefelder mit Sternchen (*) sind verpflichtend",
    'amapnews:add:title' => "Titel",
    'amapnews:add:title:help' => "Set the title of this post.",
    'amapnews:add:excerpt' => "Zusammenfassung",
    'amapnews:add:excerpt:help' => "Set a summary for this post. It will be displayed in news list.",
    'amapnews:add:description' => "Beschreibung",
    'amapnews:add:description:help' => "Enter the main text for this post. It will be displayed on full view.",
    'amapnews:add:featured' => "Set featured",
    'amapnews:add:featured:help' => "Check this for setting this item as featured. It could be used in special sections like widgets, landing page etc.",
    'amapnews:add:unfeatured' => "Unset featured",
    'amapnews:add:tags' => "Schlagworte",
    'amapnews:add:tags:help' => "Enter some tags.",
    'amapnews:add:photo' => "Photo",
    'amapnews:add:photo:help' => "If photo is available, upload a valid image file (.png or .jpg or gif).",
    'amapnews:add:photo:invalid' => 'Invalid file type for photo. It must be png or gif or jpg.',
    'amapnews:add:submit' => "Speichern",
    'amapnews:add:tonews' => "Zu den Neuigkeiten hinzufügen",
    'amapnews:add:novalidentity' => "Kein gültiger Inhalt für das Hinzufügen von Neuigkeiten",
    'amapnews:none' => "Noch keine Neuigkeiten", 
    'amapnews:add:noaccessforpost' => "Keine gültige Berechtigung zur Veröffentlichung von Neuigkeiten",
    'amapnews:save:missing_title' => "Titel fehlt. Der Beitrag konnte nicht veröffentlicht werden.",
    'amapnews:save:missing_excerpt' => "Zusammenfassung fehlt. Der Beitrag konnte nicht veröffentlicht werden.", 
    'amapnews:save:announcement' => "Ankündigung", 
    'amapnews:save:failed' => "Beitrag konnte nicht veröffentlicht werden", 
    'amapnews:save:success' => "Beitrag wurde veröffentlicht", 
    'amapnews:unknown_amapnews' => "Unbekannter Inhalt",     
    'amapnews:delete:success' => "Beitrag wurde gelöscht", 
    'amapnews:delete:failed' => "Beitrag kann nicht gelöscht werden", 
    'amapnews:save:notvalid_access_id' => "Keine gültige Zugangsberechtigung. Entweder auf \"privat\" oder \"nur für Gruppen\" angeben",
    'amapnews:add:connected_entity:title' => 'Add this entity to news',
    
    // settings
    'amapnews:settings:no' => "Nein",
    'amapnews:settings:yes' => "Ja",   
    'amapnews:settings:general' => "General Settings",     
    'amapnews:settings:show_user_icon' => "Profilbild anzeigen",    
    'amapnews:settings:show_user_icon:note' => "Profilbild auf einer Liste oder als Einzelbild anzeigen. Bei \"Nein\" wird das Bild der Neuigkeiten angezeigt.",    
    'amapnews:settings:show_username' => "Benutzername anzeigen",    
    'amapnews:settings:show_username:note' => "Benutzernamen in der Listen- oder Einzelansicht anzeigen",   
    'amapnews:settings:post_on_groups' => "Neuigkeiten in Gruppen veröffentlichen",    
    'amapnews:settings:post_on_groups:note' => "Erlaube Gruppen-Eigentümern, Neuigkeiten/Ankündigungen innerhalb von Gruppen zu veröffentlichen", 
    'amapnews:settings:featured_by_admin_only' => "Restrict featured news to admin",    
    'amapnews:settings:featured_by_admin_only:note' => "Select Yes if want to restrict setting Featured News only to administrators", 
    'amapnews:settings:post_users' => "Alle Benutzer dürfen Neuigkeiten veröffentlichen",    
    'amapnews:settings:post_users:note' => "Alle Benutzer dürfen Mitteilungen und Ankündigungen veröffentlichen. Einschränkung durch Benutzer-Rollen möglich.", 
    'amapnews:settings:custom_icon' => "Custom size for news photos",  
    'amapnews:settings:custom_icon:intro' => "If need to customize news photo size for using a custom view (e.g. in index page), determine width and height below.",  
    'amapnews:settings:custom_icon_width' => "Width",    
    'amapnews:settings:custom_icon_width:note' => "Set custom photo's width in px", 
    'amapnews:settings:custom_icon_height' => "Height",    
    'amapnews:settings:custom_icon_height:note' => "Set custom photo's height in px", 
    'amapnews:settings:show_featured_on_sidebar' => 'Show Featured News on Sidebar',
    'amapnews:settings:show_featured_on_sidebar:note' => 'Check this if want to display latest featured news on list sidebar', 
    'amapnews:settings:staff' => 'Redaktions-Team',
    'amapnews:settings:nostaff' => "Keine Teilnehmer ausgewählt. Benutzer können mit dem Benutzer-Menü hinzugefügt werden.",    
    'amapnews:settings:managestaff' => "Teilnehmer könnten mit dem Benutzer-Menü entfernt werden.", 
    'amapnews:settings:icon:icons' => 'Default News Icon',
    'amapnews:settings:icon:icons:intro' => 'Select the default icon to use on news list, when not uploading photo',
    'amapnews:settings:icon:featured' => 'Featured News Icon',
    'amapnews:settings:icon:featured:intro' => 'Select an icon to use for featured news',
     
    // river
    'river:object:news:create' => '%s hat eine Neuigkeit mit dem Titel %s veröffentlicht',
    'river:comment:object:news' => '%s kommentierte %s',
    
    // widget
    'amapnews:widget' => 'Neuigkeiten & Ankündigungen', 
    'amapnews:widget:description' => 'Zeige die letzten Neuigkeiten',  
    'amapnews:widget:viewall' => 'Alle anzeigen', 
    'amapnews:widget:viewall' => 'View all',  
    'amapnews:widget:amapnews_featured' => 'Featured News', 
    'amapnews:widget:amapnews_featured:description' => 'Display latest featured/important news and announcements',     
    'amapnews:widget:amapnews_featured:viewall' => 'View all news', 
    
    // groups
    'amapnews:group' => 'Neuigkeiten in Gruppen', 
    'groups:tool:news' => 'Neuigkeiten für Gruppen aktivieren', 
    'amapnews:owner' => "Neuigkeiten von %s",

    // staff
    'amapnews:menu_user_hover:make_staff' => "Dem Reaktions-Team hinzufügen",
    'amapnews:menu_user_hover:remove_staff' => "Aus dem Redaktions-Team entfernen",
    'amapnews:action:news_staff:removed' => "Benutzer wurde vom Redaktions-Team entfernt",
    'amapnews:action:news_staff:added' => "Benutzer wurde dem Redaktions-Team hinzugefügt",
    // upgrades
   'amapnews:upgrade:2017110700:title' => "Migrate amapnews to news entities",
   'amapnews:upgrade:2017110700:description' => "Changes the subtype of all amapnews to 'news'.",

   'amapnews:upgrade:2017110701:title' => "Migrate amapnews river entries",
   'amapnews:upgrade:2017110701:description' => "Changes the subtype of all river items for amapnews to 'news'.",

];
