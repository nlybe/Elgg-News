<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$subtypes = array(
    'amapnews' => 'Amapnews',
);

foreach ($subtypes as $subtype => $class) {
    if (!update_subtype('object', $subtype, $class)) {
        add_subtype('object', $subtype, $class);
    }
}
