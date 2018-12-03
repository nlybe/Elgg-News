<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$object = $vars['item']->getObjectEntity();

echo elgg_view('river/elements/layout', array(
    'item' => $vars['item'],
    'message' => elgg_get_excerpt($object->excerpt),
));



