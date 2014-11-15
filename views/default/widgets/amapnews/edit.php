<?php
/**
 * Elgg News plugin
 * @package amapnews
 */

$num_display = $vars['entity']->num_display;
if($num_display == ''){
	$num_display = '5';
} 
?>

<p>
		<?php echo elgg_echo("amapnews:widget:num_display"); ?>:
		<select name="params[num_display]">
			<option value="1" <?php if($num_display == 1) echo "SELECTED"; ?>>1</option>
			<option value="2" <?php if($num_display == 2) echo "SELECTED"; ?>>2</option>
			<option value="3" <?php if($num_display == 3) echo "SELECTED"; ?>>3</option>
			<option value="4" <?php if($num_display == 4) echo "SELECTED"; ?>>4</option>
			<option value="5" <?php if($num_display == 5) echo "SELECTED"; ?>>5</option>
		</select>
</p>

