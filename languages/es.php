<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$lang = array(

    // menu items and titles
    'amapnews' => "Noticias",
    'amapnews:menu' => "Noticias",
    'amapnews:edit' => "Editar publicación",
    'item:object:amapnews' => "Noticia",
    'amapnews:featured' => "Destacado",
 
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
    'amapnews:settings:show_user_icon' => "Mostrar avatar",    
    'amapnews:settings:show_user_icon:note' => "Muestra el avatar en lista y vista principal. Si se selecciona No, un ícono de Noticias se verá en su lugar.",    
    'amapnews:settings:show_username' => "Mostrar nombre de usuario",    
    'amapnews:settings:show_username:note' => "Muestra nombre de usuario en lista y vista principal.",   
    'amapnews:settings:post_on_groups' => "Publicar noticias en grupos",    
    'amapnews:settings:post_on_groups:note' => "Autoriza a los administradores de grupo a publicar noticias/anuncios en los mismos.", 

    'amapnews:settings:post_users' => "Usuario regular puede publicar Noticias",    
    'amapnews:settings:post_users:note' => "Autoriza a usuarios regulares a publicar noticias y anuncios en el sitio. Puede restringir esta opción con roles de usuario", 

    'amapnews:settings:staff' => 'Equipo de Noticias',
    'amapnews:settings:nostaff' => "No hay participantes seleccionados. Puedes agregar usuarios mediante el menú de usuarios.",    
    'amapnews:settings:managestaff' => "Puedes borrar usuarios mediante el menú de usuarios.", 
     
    // river
    'river:create:object:amapnews' => '%s publicó una noticia con el título %s',
    'river:comment:object:amapnews' => '%s comentó en %s',
    'vouchers:river:annotate' => 'un comentario en ',
    'vouchers:river:item' => 'una noticia',  
    
    // widget
    'amapnews:widget' => 'Noticias y Anuncios', 
    'amapnews:widget:description' => 'Muestra las últimas noticias y anuncios', 
    'amapnews:widget:num_display' => 'Numero de noticias a mostrar: ',
    'amapnews:widget:viewall' => 'Ver todas',  
    'amapnews:widget:amapnews_featured' => 'Noticias Destacadas', 
    'amapnews:widget:amapnews_featured:description' => 'Muestra las últimas noticias o anuncios destacados.',     
    
    // groups
    'amapnews:group' => 'Noticias de Grupo', 
    'amapnews:group:enable' => 'Activar Noticias en Grupos', 
    'amapnews:owner' => "Noticias de %s",

    // staff
    'amapnews:menu_user_hover:make_staff' => "Agregar al Equipo de Noticias",
    'amapnews:menu_user_hover:remove_staff' => "Quitar del Equipo de Noticias",
    'amapnews:action:news_staff:removed' => "El usuario fue removido del Equipo de Noticias",
    'amapnews:action:news_staff:added' => "El usuario fue agregado al Equipo de Noticias",

);

return $lang;
