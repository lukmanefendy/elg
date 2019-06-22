<?php
/**
 * New users admin widget
 */

$widget = elgg_extract('entity', $vars);

$num_display = sanitize_int($widget->num_display, false);
// set default value for display number
if (!$num_display) {
	$num_display = 5;
}

//ditambahkan: instansi untuk filter focal melihat user di instansinya saja
$user_admin = elgg_get_logged_in_user_entity();
if ($user_admin->focal == 'no')
	echo elgg_list_entities([
		'type' => 'user',
		'subtype'=> null,
		'full_view' => false,
		'pagination' => false,
		'limit' => $num_display,
	]);
else 
	echo elgg_list_entities([
	'instansi' => 'Badan Kepegawaian Negara',
	'type' => 'user',
	'subtype'=> null,
	'full_view' => false,
	'pagination' => false,
	'limit' => $num_display,
]);