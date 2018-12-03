<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$num_display = $vars['entity']->num_display;
if(empty($num_display) || !is_numeric($num_display)){
    $num_display = 5;
}

for($i=1; $i<=10; $i++) {
    $num_option .= "<option value='{$i}' ".($num_display == $i?'SELECTED':'')." >{$i}</option>";
}

echo elgg_echo("amapnews:widget:num_display");
echo elgg_format_element('select', ['name' => 'params[num_display]'], $num_option);
echo elgg_format_element('div', ['class' => 'clear_box'], '&nbsp;');
