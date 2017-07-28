<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

elgg_load_library('elgg:amapnews');

$guid = elgg_extract('guid', $vars, '');
$submitter = get_entity($guid);

$user = elgg_get_logged_in_user_entity();

// post news only for admins or groups owners (if allowed by admins)
if (allow_post($submitter, $user)) {

    $title = elgg_echo('amapnews:add');
	$page_owner = elgg_get_page_owner_entity();
	$crumbs_title = $page_owner->name;
	if (elgg_instanceof($page_owner, 'group')) {
		elgg_push_breadcrumb($crumbs_title, "news/group/$page_owner->guid/all");
	}  
    elgg_push_breadcrumb($title);

    // build sidebar 
    $sidebar = '';

    // create form
    $form_vars = array('name' => 'amapnewsForm', 'enctype' => 'multipart/form-data');
    
    $vars = amapnews_prepare_form_vars();
    if (allow_post_on_groups() && elgg_instanceof($submitter, 'group') && $submitter->canEdit()) {
		$vars['group_guid'] = $submitter->guid;
	}
    $content = elgg_view_form('amapnews/add', $form_vars, $vars);

    $body = elgg_view_layout('content', array(
        'content' => $content,
        'title' => $title,
        'sidebar' => $sidebar,
        'filter' => '',
    ));

    echo elgg_view_page($title, $body);
} 
else    {  
    register_error(elgg_echo('amapnews:add:noaccessforpost'));  
    forward(REFERER);    
}



