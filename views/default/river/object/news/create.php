<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

$object = $vars['item']->getObjectEntity();

echo elgg_view('river/elements/layout', [
    'item' => $vars['item'],
    'message' => $object->excerpt?elgg_get_excerpt($object->excerpt):'',
]);



