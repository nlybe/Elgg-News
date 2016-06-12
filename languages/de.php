<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$lang = array(

    // menu items and titles
    'amapnews' => "Neuigkeiten",
    'amapnews:menu' => "Neuigkeiten",
    'amapnews:edit' => "Eintrag bearbeiten",
    'item:object:amapnews' => "Neuigkeiten",
 
    // submit form
    'news:add' => "Neuigkeit veröffentlichen",
    'amapnews:add' => "Neuigkeit veröffentlichen",
    'amapnews:add:requiredfields' => "Eingabefelder mit Sternchen (*) sind verpflichtend",
    'amapnews:add:title' => "Titel",
    'amapnews:add:excerpt' => "Zusammenfassung",
    'amapnews:add:description' => "Beschreibung",
    'amapnews:add:tags' => "Schlagworte",
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
    
    // settings
    'amapnews:settings:no' => "Nein",
    'amapnews:settings:yes' => "Ja",    
    'amapnews:settings:show_user_icon' => "Profilbild anzeigen",    
    'amapnews:settings:show_user_icon:note' => "Profilbild auf einer Liste oder als Einzelbild anzeigen. Bei \"Nein\" wird das Bild der Neuigkeiten angezeigt.",    
    'amapnews:settings:show_username' => "Benutzername anzeigen",    
    'amapnews:settings:show_username:note' => "Benutzernamen in der Listen- oder Einzelansicht anzeigen",   
    'amapnews:settings:post_on_groups' => "Neuigkeiten in Gruppen veröffentlichen",    
    'amapnews:settings:post_on_groups:note' => "Erlaube Gruppen-Eigentümern, Neuigkeiten/Ankündigungen innerhalb von Gruppen zu veröffentlichen", 

    'amapnews:settings:post_users' => "Alle Benutzer dürfen Neuigkeiten veröffentlichen",    
    'amapnews:settings:post_users:note' => "Alle Benutzer dürfen Mitteilungen und Ankündigungen veröffentlichen. Einschränkung durch Benutzer-Rollen möglich.", 

	'amapnews:settings:staff' => 'Redaktions-Team',
    'amapnews:settings:nostaff' => "Keine Teilnehmer ausgewählt. Benutzer können mit dem Benutzer-Menü hinzugefügt werden.",    
    'amapnews:settings:managestaff' => "Teilnehmer könnten mit dem Benutzer-Menü entfernt werden.", 
     
    // river
    'river:create:object:amapnews' => '%s hat eine Neuigkeit mit dem Titel %s veröffentlicht',
    'river:comment:object:amapnews' => '%s kommentierte %s',
    'vouchers:river:annotate' => 'ein Kommentar zu ',
    'vouchers:river:item' => 'ein Artikel',  
    
    // widget
    'amapnews:widget' => 'Neuigkeiten & Ankündigungen', 
    'amapnews:widget:description' => 'Zeige die letzten Neuigkeiten',  
    'amapnews:widget:viewall' => 'Alle anzeigen',  
    
    // groups
    'amapnews:group' => 'Neuigkeiten in Gruppen', 
    'amapnews:group:enable' => 'Neuigkeiten für Gruppen aktivieren', 
    'amapnews:owner' => "Neuigkeiten von %s",

    // staff
    'amapnews:menu_user_hover:make_staff' => "Dem Reaktions-Team hinzufügen",
    'amapnews:menu_user_hover:remove_staff' => "Aus dem Redaktions-Team entfernen",
    'amapnews:action:news_staff:removed' => "Benutzer wurde vom Redaktions-Team entfernt",
    'amapnews:action:news_staff:added' => "Benutzer wurde dem Redaktions-Team hinzugefügt",

);

add_translation("de", $lang);
