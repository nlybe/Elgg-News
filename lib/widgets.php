<?php
/**
 * Elgg News plugin
 * @package amapnews
 *
 * All widgets declarations
 */


/**
 * Inits the various widgets
 * @return void
 */
function amapnews_widgets_init() {
    
    // Add amapnews widget for displaying latest posts
    elgg_register_widget_type('amapnews', elgg_echo('amapnews:widget'), elgg_echo('amapnews:widget:description'), array("profile", "dashboard", "index", "groups"), false);

    // Add amapnews widget for displaying latest posts
    elgg_register_widget_type('amapnews_featured', elgg_echo('amapnews:widget:amapnews_featured'), elgg_echo('amapnews:widget:amapnews_featured:description'), array("dashboard", "index", "groups"), false);
    
}