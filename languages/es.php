<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

return [

    // menu items and titles
    'elgg-news' => "Noticias",
    'elggnews:menu' => "Noticias",
    'elggnews:edit' => "Editar publicación",
    'item:object:news' => "Noticia",
    'collection:object:news' => "Noticias",
    'elggnews:featured' => "Destacado",
    'elggnews:read_more' => "Read more ",
    'elggnews_featured' => "Featured News",
 
    // submit form
    'news:add' => "Publicar Noticia",
    'elggnews:add' => "Publicar Noticia",
    'elggnews:add:requiredfields' => "Completar campos con asterico (*)",
    'elggnews:add:title' => "Título",
    'elggnews:add:title:help' => "El título de esta publicación.",
    'elggnews:add:excerpt' => "Resumen",
    'elggnews:add:excerpt:help' => "El resumen de esta publicación. Se verá en el listado de noticias.",
    'elggnews:add:description' => "Descripción",
    'elggnews:add:description:help' => "Ingresa el cuerpo principal de esta publicación. Sólo se verá en la vista completa.",
    'elggnews:add:featured' => "Destacar publicación",
    'elggnews:add:featured:help' => "Marca para destacar esta publicación. Puede ser utilizada en secciones especiales como widgets, pagina principal, etc.",
    'elggnews:add:unfeatured' => "Quitar destacado",
    'elggnews:add:tags' => "Etiquetas",
    'elggnews:add:tags:help' => "Ingresa algunas etiquetad que describan tu publicación.",
    'elggnews:add:photo' => "Foto",
    'elggnews:add:photo:help' => "Sube un archivo de imagen válido para ilustrar la publicación (png, jpg o gif).",
    'elggnews:add:photo:invalid' => 'Archivo de imagen inválido. Debe ser png, jgp o gif.',
    'elggnews:add:submit' => "Enviar",
    'elggnews:add:tonews' => "Agregar a noticias",
    'elggnews:add:novalidentity' => "No es una elemento válido para agregar a Noticias",
    'elggnews:none' => "No hay noticias todavía", 
    'elggnews:add:noaccessforpost' => "No tiene permisos para publicar noticias",
    'elggnews:save:missing_title' => "Falta el título. La publicación no puede guardarse.",
    'elggnews:save:missing_excerpt' => "Falta el resumen. La publicación no puede guardarse.", 
    'elggnews:save:announcement' => "Anuncio", 
    'elggnews:save:failed' => "La publicación no puede guardarse", 
    'elggnews:save:success' => "La publicación se guardo exitosamente.", 
    'elggnews:unknown_elggnews' => "Elemento desconocido",     
    'elggnews:delete:success' => "La publicación fue borrada exitosamente", 
    'elggnews:delete:failed' => "La publicación no puese ser borrada", 
    'elggnews:save:notvalid_access_id' => "No es válido el nivel de acceso. Usted ha marcado el acceso como privado o solamente para un grupo.",
    'elggnews:add:connected_entity:title' => 'Agregar este elemento a Noticias',
    
    // settings
    'elggnews:settings:no' => "No",
    'elggnews:settings:yes' => "Si",    
    'elggnews:settings:general' => "General Settings", 
    'elggnews:settings:show_user_icon' => "Mostrar avatar",    
    'elggnews:settings:show_user_icon:note' => "Muestra el avatar en lista y vista principal. Si se selecciona No, un ícono de Noticias se verá en su lugar.",    
    'elggnews:settings:show_username' => "Mostrar nombre de usuario",    
    'elggnews:settings:show_username:note' => "Muestra nombre de usuario en lista y vista principal.",   
    'elggnews:settings:post_on_groups' => "Publicar noticias en grupos",    
    'elggnews:settings:post_on_groups:note' => "Autoriza a los administradores de grupo a publicar noticias/anuncios en los mismos.", 
    'elggnews:settings:featured_by_admin_only' => "Restrict featured news to admin",    
    'elggnews:settings:featured_by_admin_only:note' => "Select Yes if want to restrict setting Featured News only to administrators", 
    'elggnews:settings:post_users' => "Usuario regular puede publicar Noticias",    
    'elggnews:settings:post_users:note' => "Autoriza a usuarios regulares a publicar noticias y anuncios en el sitio. Puede restringir esta opción con roles de usuario", 
    'elggnews:settings:custom_icon' => "Custom size for news photos",  
    'elggnews:settings:custom_icon:intro' => "If need to customize news photo size for using a custom view (e.g. in index page), determine width and height below.",  
    'elggnews:settings:custom_icon_width' => "Width",    
    'elggnews:settings:custom_icon_width:note' => "Set custom photo's width in px", 
    'elggnews:settings:custom_icon_height' => "Height",    
    'elggnews:settings:custom_icon_height:note' => "Set custom photo's height in px", 
    'elggnews:settings:show_featured_on_sidebar' => 'Show Featured News on Sidebar',
    'elggnews:settings:show_featured_on_sidebar:note' => 'Check this if want to display latest featured news on list sidebar', 
    'elggnews:settings:staff' => 'Equipo de Noticias',
    'elggnews:settings:nostaff' => "No hay participantes seleccionados. Puedes agregar usuarios mediante el menú de usuarios.",    
    'elggnews:settings:managestaff' => "Puedes borrar usuarios mediante el menú de usuarios.", 
    'elggnews:settings:icon:icons' => 'Default News Icon',
    'elggnews:settings:icon:icons:intro' => 'Select the default icon to use on news list, when not uploading photo',
    'elggnews:settings:icon:featured' => 'Featured News Icon',
    'elggnews:settings:icon:featured:intro' => 'Select an icon to use for featured news',
     
    // river
    'river:object:news:create' => '%s publicó una noticia con el título %s',
    'river:comment:object:news' => '%s comentó en %s',
    
    // widget
    'elggnews:widget' => 'Noticias y Anuncios', 
    'elggnews:widget:description' => 'Muestra las últimas noticias y anuncios', 
    'elggnews:widget:num_display' => 'Numero de noticias a mostrar: ',
    'elggnews:widget:viewall' => 'Ver todas',  
    'elggnews:widget:elggnews_featured' => 'Noticias Destacadas', 
    'elggnews:widget:elggnews_featured:description' => 'Muestra las últimas noticias o anuncios destacados.',     
    'elggnews:widget:elggnews_featured:viewall' => 'View all news',
    
    // groups
    'elggnews:group' => 'Noticias de Grupo', 
    'groups:tool:news' => 'Activar Noticias en Grupos', 
    'elggnews:owner' => "Noticias de %s",

    // staff
    'elggnews:menu_user_hover:make_staff' => "Agregar al Equipo de Noticias",
    'elggnews:menu_user_hover:remove_staff' => "Quitar del Equipo de Noticias",
    'elggnews:action:news_staff:removed' => "El usuario fue removido del Equipo de Noticias",
    'elggnews:action:news_staff:added' => "El usuario fue agregado al Equipo de Noticias",

    // upgrades
   'elggnews:upgrade:2017110700:title' => "Migrate amapnews to news entities",
   'elggnews:upgrade:2017110700:description' => "Changes the subtype of all amapnews to 'news'.",

   'elggnews:upgrade:2017110701:title' => "Migrate amapnews river entries",
   'elggnews:upgrade:2017110701:description' => "Changes the subtype of all river items for amapnews to 'news'.",

];
