<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_library('elgg:amapnews');

if (elgg_is_admin_logged_in())	{

    $title = elgg_echo('amapnews:add');
    elgg_push_breadcrumb($title);

    // build sidebar 
    $sidebar = '';

    // create form
    $form_vars = array('name' => 'amapnewsForm', 'enctype' => 'multipart/form-data');
    
    $vars = amapnews_prepare_form_vars();
    $content = elgg_view_form('amapnews/add', $form_vars, $vars);

    $body = elgg_view_layout('content', array(
        'content' => $content,
        'title' => $title,
        'sidebar' => $sidebar,
        'filter' => '',
    ));

    echo elgg_view_page($title, $content);
} 
else    {  
    register_error(elgg_echo('amapnews:add:noaccessforpost'));  
    forward(REFERER);    
}



