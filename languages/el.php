<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$lang = array(

    // menu items and titles
    'amapnews' => "Ανακοινώσεις",
    'amapnews:menu' => "Ανακοινώσεις",
    'amapnews:edit' => "Επεξεργασία",
    'item:object:amapnews' => "Ανακοινώσεις",
    
    // submit form
    'news:add' => "Νέα ανακοίνωση",
    'amapnews:add' => "Νέα ανακοίνωση",
    'amapnews:add:requiredfields' => "Τα πεδία με αστερίσκο (*) είναι υποχρεωτικά",
    'amapnews:add:title' => "Τίτλος",
    'amapnews:add:excerpt' => "Εισαγωγή",
    'amapnews:add:description' => "Περιγραφή",
    'amapnews:add:tags' => "Ετικέτες",
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
    'amapnews:delete:failed' => "Η ανακοίνωση δεν μπορεί να διαγραφτεί", 
    
    // settings
    'amapnews:settings:no' => "No",
    'amapnews:settings:yes' => "Yes",    
    'amapnews:settings:show_user_icon' => "Display user icon",    
    'amapnews:settings:show_user_icon:note' => "Display user icon on list or single view. If select no, a news icon will be displayed.",    
    'amapnews:settings:show_username' => "Display username",    
    'amapnews:settings:show_username:note' => "Display username on list or single view",    
    
    // river
    'river:create:object:amapnews' => '%s δημοσίευσε νέα ανακοίνωση με τίτλο %s',
    'river:comment:object:amapnews' => '%s σχολίασε την ανακοίνωση %s',
    'vouchers:river:annotate' => 'σχόλιο στην ανακοίνωση ',
    'vouchers:river:item' => 'μία εγγραφή',  
    
    // widget
    'amapnews:widget' => 'Νέα / Ανακοινώσεις', 
    'amapnews:widget:description' => 'Προβολή πρόσφατων ανακοινώσεων',  
    'amapnews:widget:viewall' => 'Προβολή όλων',  
    

);

add_translation("el", $lang);
