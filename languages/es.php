<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

return [

    // menu items and titles
    'amapnews' => "Noticias",
    'amapnews:menu' => "Noticias",
    'amapnews:edit' => "Editar publicación",
    'item:object:news' => "Noticia",
    'collection:object:news' => "Noticias",
    'amapnews:featured' => "Destacado",
    'amapnews:read_more' => "Read more ",
    'amapnews_featured' => "Featured News",
 
    // submit form
    'news:add' => "Publicar Noticia",
    'amapnews:add' => "Publicar Noticia",
    'amapnews:add:requiredfields' => "Completar campos con asterico (*)",
    'amapnews:add:title' => "Título",
    'amapnews:add:title:help' => "El título de esta publicación.",
    'amapnews:add:excerpt' => "Resumen",
    'amapnews:add:excerpt:help' => "El resumen de esta publicación. Se verá en el listado de noticias.",
    'amapnews:add:description' => "Descripción",
    'amapnews:add:description:help' => "Ingresa el cuerpo principal de esta publicación. Sólo se verá en la vista completa.",
    'amapnews:add:featured' => "Destacar publicación",
    'amapnews:add:featured:help' => "Marca para destacar esta publicación. Puede ser utilizada en secciones especiales como widgets, pagina principal, etc.",
    'amapnews:add:unfeatured' => "Quitar destacado",
    'amapnews:add:tags' => "Etiquetas",
    'amapnews:add:tags:help' => "Ingresa algunas etiquetad que describan tu publicación.",
    'amapnews:add:photo' => "Foto",
    'amapnews:add:photo:help' => "Sube un archivo de imagen válido para ilustrar la publicación (png, jpg o gif).",
    'amapnews:add:photo:invalid' => 'Archivo de imagen inválido. Debe ser png, jgp o gif.',
    'amapnews:add:submit' => "Enviar",
    'amapnews:add:tonews' => "Agregar a noticias",
    'amapnews:add:novalidentity' => "No es una elemento válido para agregar a Noticias",
    'amapnews:none' => "No hay noticias todavía", 
    'amapnews:add:noaccessforpost' => "No tiene permisos para publicar noticias",
    'amapnews:save:missing_title' => "Falta el título. La publicación no puede guardarse.",
    'amapnews:save:missing_excerpt' => "Falta el resumen. La publicación no puede guardarse.", 
    'amapnews:save:announcement' => "Anuncio", 
    'amapnews:save:failed' => "La publicación no puede guardarse", 
    'amapnews:save:success' => "La publicación se guardo exitosamente.", 
    'amapnews:unknown_amapnews' => "Elemento desconocido",     
    'amapnews:delete:success' => "La publicación fue borrada exitosamente", 
    'amapnews:delete:failed' => "La publicación no puese ser borrada", 
    'amapnews:save:notvalid_access_id' => "No es válido el nivel de acceso. Usted ha marcado el acceso como privado o solamente para un grupo.",
    'amapnews:add:connected_entity:title' => 'Agregar este elemento a Noticias',
    
    // settings
    'amapnews:settings:no' => "No",
    'amapnews:settings:yes' => "Si",    
    'amapnews:settings:general' => "General Settings", 
    'amapnews:settings:show_user_icon' => "Mostrar avatar",    
    'amapnews:settings:show_user_icon:note' => "Muestra el avatar en lista y vista principal. Si se selecciona No, un ícono de Noticias se verá en su lugar.",    
    'amapnews:settings:show_username' => "Mostrar nombre de usuario",    
    'amapnews:settings:show_username:note' => "Muestra nombre de usuario en lista y vista principal.",   
    'amapnews:settings:post_on_groups' => "Publicar noticias en grupos",    
    'amapnews:settings:post_on_groups:note' => "Autoriza a los administradores de grupo a publicar noticias/anuncios en los mismos.", 
    'amapnews:settings:featured_by_admin_only' => "Restrict featured news to admin",    
    'amapnews:settings:featured_by_admin_only:note' => "Select Yes if want to restrict setting Featured News only to administrators", 
    'amapnews:settings:post_users' => "Usuario regular puede publicar Noticias",    
    'amapnews:settings:post_users:note' => "Autoriza a usuarios regulares a publicar noticias y anuncios en el sitio. Puede restringir esta opción con roles de usuario", 
    'amapnews:settings:custom_icon' => "Custom size for news photos",  
    'amapnews:settings:custom_icon:intro' => "If need to customize news photo size for using a custom view (e.g. in index page), determine width and height below.",  
    'amapnews:settings:custom_icon_width' => "Width",    
    'amapnews:settings:custom_icon_width:note' => "Set custom photo's width in px", 
    'amapnews:settings:custom_icon_height' => "Height",    
    'amapnews:settings:custom_icon_height:note' => "Set custom photo's height in px", 
    'amapnews:settings:show_featured_on_sidebar' => 'Show Featured News on Sidebar',
    'amapnews:settings:show_featured_on_sidebar:note' => 'Check this if want to display latest featured news on list sidebar', 
    'amapnews:settings:staff' => 'Equipo de Noticias',
    'amapnews:settings:nostaff' => "No hay participantes seleccionados. Puedes agregar usuarios mediante el menú de usuarios.",    
    'amapnews:settings:managestaff' => "Puedes borrar usuarios mediante el menú de usuarios.", 
    'amapnews:settings:icon:icons' => 'Default News Icon',
    'amapnews:settings:icon:icons:intro' => 'Select the default icon to use on news list, when not uploading photo',
    'amapnews:settings:icon:featured' => 'Featured News Icon',
    'amapnews:settings:icon:featured:intro' => 'Select an icon to use for featured news',
     
    // river
    'river:object:news:create' => '%s publicó una noticia con el título %s',
    'river:comment:object:news' => '%s comentó en %s',
    
    // widget
    'amapnews:widget' => 'Noticias y Anuncios', 
    'amapnews:widget:description' => 'Muestra las últimas noticias y anuncios', 
    'amapnews:widget:num_display' => 'Numero de noticias a mostrar: ',
    'amapnews:widget:viewall' => 'Ver todas',  
    'amapnews:widget:amapnews_featured' => 'Noticias Destacadas', 
    'amapnews:widget:amapnews_featured:description' => 'Muestra las últimas noticias o anuncios destacados.',     
    'amapnews:widget:amapnews_featured:viewall' => 'View all news',
    
    // groups
    'amapnews:group' => 'Noticias de Grupo', 
    'groups:tool:news' => 'Activar Noticias en Grupos', 
    'amapnews:owner' => "Noticias de %s",

    // staff
    'amapnews:menu_user_hover:make_staff' => "Agregar al Equipo de Noticias",
    'amapnews:menu_user_hover:remove_staff' => "Quitar del Equipo de Noticias",
    'amapnews:action:news_staff:removed' => "El usuario fue removido del Equipo de Noticias",
    'amapnews:action:news_staff:added' => "El usuario fue agregado al Equipo de Noticias",

    // upgrades
   'amapnews:upgrade:2017110700:title' => "Migrate amapnews to news entities",
   'amapnews:upgrade:2017110700:description' => "Changes the subtype of all amapnews to 'news'.",

   'amapnews:upgrade:2017110701:title' => "Migrate amapnews river entries",
   'amapnews:upgrade:2017110701:description' => "Changes the subtype of all river items for amapnews to 'news'.",

];
