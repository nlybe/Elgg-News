<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$ignore_access = elgg_extract('ia', $vars, '');
if ($ignore_access) {
    // set ignore access for loading non public objexts
    $ia = elgg_get_ignore_access();
    elgg_set_ignore_access(true);
}

$guid = elgg_extract('guid', $vars, '');
$entity = get_entity($guid);        

// Get the size
$size = strtolower(elgg_extract('size', $vars, ''));
$size = amapnews_getIconSize($size);

// If entity doesn't exist, return default icon
if (!$entity) {
    $url = elgg_get_simplecache_url("icons/default/{$size}.png");
    forward($url);
}

// Try and get the icon
$filehandler = new ElggFile();
$filehandler->owner_guid = $entity->owner_guid;
$filehandler->setFilename($entity->getSubtype()."/" . $entity->guid . $size . ".jpg");

$success = false;
try {	
    if ($filehandler->open("read")) {
        $contents = $filehandler->read($filehandler->getSize());
        if ($contents) {
            $success = true;
        }
    }
} 
catch (InvalidParameterException $e) {
    elgg_log("Unable to get photo for entity with GUID $entity->guid", 'ERROR');
}

if (!$success) {
    $size = ($size=='custom'?'large':$size); 
    $size = ($size=='master'?'large':$size);   
    $url = elgg_get_simplecache_url("icons/user/default{$size}.gif");
    forward($url);
}

header("Content-type: image/jpeg", true);
header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', strtotime("+6 months")), true);
header("Pragma: public", true);
header("Cache-Control: public", true);
header("Content-Length: " . strlen($contents));

echo $contents;

if ($ignore_access) {
    elgg_set_ignore_access($ia);
}
      
