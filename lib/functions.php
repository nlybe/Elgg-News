<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */
 
/**
 * Add elggnews form parameters
 * 
 * @param type $entity
 * @return type
 */
function elggnews_prepare_form_vars($entity = null) {
    // input names => defaults
    $values = [
        'title' => '',
        'description' => '',
        'excerpt' => '',
        'featured' => '',
        'photo' => '',
        'tags' => '',
        'connected_guid' => null,	// guid of entity connected
        'access_id' => ACCESS_DEFAULT,
        'container_guid' => elgg_get_page_owner_guid(),
        'entity' => $entity,
        'guid' => null,
        'comments_on' => NULL,
    ];

    if ($entity) {
        foreach (array_keys($values) as $field) {
            if (isset($entity->$field)) {
                $values[$field] = $entity->$field;
            }
        }
    }

    if (elgg_is_sticky_form('elggnews')) {
        $sticky_values = elgg_get_sticky_values('elggnews');
        foreach ($sticky_values as $key => $value) {
            $values[$key] = $value;
        }
    }

    elgg_clear_sticky_form('elggnews');

    return $values;
}
