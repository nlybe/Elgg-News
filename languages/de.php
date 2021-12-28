<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

return [

    // menu items and titles
    'elgg-news' => "Neuigkeiten",
    'elggnews:menu' => "Neuigkeiten",
    'elggnews:edit' => "Eintrag bearbeiten",
    'item:object:news' => "Neuigkeiten",
    'collection:object:news' => "News",
    'elggnews:featured' => "Featured",
    'elggnews:read_more' => "Read more ",
    'elggnews_featured' => "Featured News",
 
    // submit form
    'news:add' => "Neuigkeit veröffentlichen",
    'elggnews:add' => "Neuigkeit veröffentlichen",
    'elggnews:add:requiredfields' => "Eingabefelder mit Sternchen (*) sind verpflichtend",
    'elggnews:add:title' => "Titel",
    'elggnews:add:title:help' => "Set the title of this post.",
    'elggnews:add:excerpt' => "Zusammenfassung",
    'elggnews:add:excerpt:help' => "Set a summary for this post. It will be displayed in news list.",
    'elggnews:add:description' => "Beschreibung",
    'elggnews:add:description:help' => "Enter the main text for this post. It will be displayed on full view.",
    'elggnews:add:featured' => "Set featured",
    'elggnews:add:featured:help' => "Check this for setting this item as featured. It could be used in special sections like widgets, landing page etc.",
    'elggnews:add:unfeatured' => "Unset featured",
    'elggnews:add:tags' => "Schlagworte",
    'elggnews:add:tags:help' => "Enter some tags.",
    'elggnews:add:photo' => "Photo",
    'elggnews:add:photo:help' => "If photo is available, upload a valid image file (.png or .jpg or gif).",
    'elggnews:add:photo:invalid' => 'Invalid file type for photo. It must be png or gif or jpg.',
    'elggnews:add:submit' => "Speichern",
    'elggnews:add:tonews' => "Zu den Neuigkeiten hinzufügen",
    'elggnews:add:novalidentity' => "Kein gültiger Inhalt für das Hinzufügen von Neuigkeiten",
    'elggnews:none' => "Noch keine Neuigkeiten", 
    'elggnews:add:noaccessforpost' => "Keine gültige Berechtigung zur Veröffentlichung von Neuigkeiten",
    'elggnews:save:missing_title' => "Titel fehlt. Der Beitrag konnte nicht veröffentlicht werden.",
    'elggnews:save:missing_excerpt' => "Zusammenfassung fehlt. Der Beitrag konnte nicht veröffentlicht werden.", 
    'elggnews:save:announcement' => "Ankündigung", 
    'elggnews:save:failed' => "Beitrag konnte nicht veröffentlicht werden", 
    'elggnews:save:success' => "Beitrag wurde veröffentlicht", 
    'elggnews:unknown_elggnews' => "Unbekannter Inhalt",     
    'elggnews:delete:success' => "Beitrag wurde gelöscht", 
    'elggnews:delete:failed' => "Beitrag kann nicht gelöscht werden", 
    'elggnews:save:notvalid_access_id' => "Keine gültige Zugangsberechtigung. Entweder auf \"privat\" oder \"nur für Gruppen\" angeben",
    'elggnews:add:connected_entity:title' => 'Add this entity to news',
    
    // settings
    'elggnews:settings:no' => "Nein",
    'elggnews:settings:yes' => "Ja",   
    'elggnews:settings:general' => "General Settings",     
    'elggnews:settings:show_user_icon' => "Profilbild anzeigen",    
    'elggnews:settings:show_user_icon:note' => "Profilbild auf einer Liste oder als Einzelbild anzeigen. Bei \"Nein\" wird das Bild der Neuigkeiten angezeigt.",    
    'elggnews:settings:show_username' => "Benutzername anzeigen",    
    'elggnews:settings:show_username:note' => "Benutzernamen in der Listen- oder Einzelansicht anzeigen",   
    'elggnews:settings:post_on_groups' => "Neuigkeiten in Gruppen veröffentlichen",    
    'elggnews:settings:post_on_groups:note' => "Erlaube Gruppen-Eigentümern, Neuigkeiten/Ankündigungen innerhalb von Gruppen zu veröffentlichen", 
    'elggnews:settings:featured_by_admin_only' => "Restrict featured news to admin",    
    'elggnews:settings:featured_by_admin_only:note' => "Select Yes if want to restrict setting Featured News only to administrators", 
    'elggnews:settings:post_users' => "Alle Benutzer dürfen Neuigkeiten veröffentlichen",    
    'elggnews:settings:post_users:note' => "Alle Benutzer dürfen Mitteilungen und Ankündigungen veröffentlichen. Einschränkung durch Benutzer-Rollen möglich.", 
    'elggnews:settings:custom_icon' => "Custom size for news photos",  
    'elggnews:settings:custom_icon:intro' => "If need to customize news photo size for using a custom view (e.g. in index page), determine width and height below.",  
    'elggnews:settings:custom_icon_width' => "Width",    
    'elggnews:settings:custom_icon_width:note' => "Set custom photo's width in px", 
    'elggnews:settings:custom_icon_height' => "Height",    
    'elggnews:settings:custom_icon_height:note' => "Set custom photo's height in px", 
    'elggnews:settings:show_featured_on_sidebar' => 'Show Featured News on Sidebar',
    'elggnews:settings:show_featured_on_sidebar:note' => 'Check this if want to display latest featured news on list sidebar', 
    'elggnews:settings:staff' => 'Redaktions-Team',
    'elggnews:settings:nostaff' => "Keine Teilnehmer ausgewählt. Benutzer können mit dem Benutzer-Menü hinzugefügt werden.",    
    'elggnews:settings:managestaff' => "Teilnehmer könnten mit dem Benutzer-Menü entfernt werden.", 
    'elggnews:settings:icon:icons' => 'Default News Icon',
    'elggnews:settings:icon:icons:intro' => 'Select the default icon to use on news list, when not uploading photo',
    'elggnews:settings:icon:featured' => 'Featured News Icon',
    'elggnews:settings:icon:featured:intro' => 'Select an icon to use for featured news',
     
    // river
    'river:object:news:create' => '%s hat eine Neuigkeit mit dem Titel %s veröffentlicht',
    'river:comment:object:news' => '%s kommentierte %s',
    
    // widget
    'elggnews:widget' => 'Neuigkeiten & Ankündigungen', 
    'elggnews:widget:description' => 'Zeige die letzten Neuigkeiten',  
    'elggnews:widget:viewall' => 'Alle anzeigen', 
    'elggnews:widget:viewall' => 'View all',  
    'elggnews:widget:elggnews_featured' => 'Featured News', 
    'elggnews:widget:elggnews_featured:description' => 'Display latest featured/important news and announcements',     
    'elggnews:widget:elggnews_featured:viewall' => 'View all news', 
    
    // groups
    'elggnews:group' => 'Neuigkeiten in Gruppen', 
    'groups:tool:news' => 'Neuigkeiten für Gruppen aktivieren', 
    'elggnews:owner' => "Neuigkeiten von %s",

    // staff
    'elggnews:menu_user_hover:make_staff' => "Dem Reaktions-Team hinzufügen",
    'elggnews:menu_user_hover:remove_staff' => "Aus dem Redaktions-Team entfernen",
    'elggnews:action:news_staff:removed' => "Benutzer wurde vom Redaktions-Team entfernt",
    'elggnews:action:news_staff:added' => "Benutzer wurde dem Redaktions-Team hinzugefügt",
    // upgrades
   'elggnews:upgrade:2017110700:title' => "Migrate amapnews to news entities",
   'elggnews:upgrade:2017110700:description' => "Changes the subtype of all amapnews to 'news'.",

   'elggnews:upgrade:2017110701:title' => "Migrate amapnews river entries",
   'elggnews:upgrade:2017110701:description' => "Changes the subtype of all river items for amapnews to 'news'.",

];
