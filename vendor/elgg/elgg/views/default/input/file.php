<?php
/**
 * Elgg file input
 * Displays a file input field
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['value'] The current value if any
 * @uses $vars['class'] Additional CSS class
 */

if (!empty($vars['value'])) {
	echo elgg_echo('fileexists') . "<br />";
}

$vars['class'] = elgg_extract_class($vars, 'elgg-input-file');

$defaults = array(
	'disabled' => false,
	'type' => 'file'
);
//menambahkan 2 button upload file
$vars = array_merge($defaults, $vars);
$name = $vars['name'];
$vars['name'] .= '-published';
$vars['class']['3'] = "academic";
echo elgg_format_element('input', $vars);
//$vars['name']  = $name.'-recommend';
//unset($vars['class']['3']);
//$vars['class']['3'] = "practioners";
//echo elgg_format_element('input', $vars);
