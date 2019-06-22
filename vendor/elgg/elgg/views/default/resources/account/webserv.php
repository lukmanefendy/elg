<?php
/**
 * Assembles and outputs the registration page.
 *
 * Since 1.8, registration can be disabled via administration.  If this is
 * the case, calls to this page will forward to the network front page.
 *
 * If the user is logged in, this page will forward to the network
 * front page.
 *
 * @package Elgg.Core
 * @subpackage Registration
 */

// check new registration allowed jika tdk diijikan dialihkan ke halaman depan
if (elgg_get_config('allow_registration') == false) {
	register_error(elgg_echo('registerdisabled'));
	forward(); //jika tdk diijikan dialihkan ke halaman depan
}

$friend_guid = (int) get_input('friend_guid', 0);
$invitecode = get_input('invitecode');

// only logged out people need to register
if (elgg_is_logged_in()) {
	forward();
}

$title = elgg_echo("register");

$form_params = array(
	'class' => 'elgg-form-account',
);

$body_params = array(
	'friend_guid' => $friend_guid,
	'invitecode' => $invitecode
);
//isi tampilan page register diubah ke page cek web service
$content = elgg_view_form('webserv', $form_params, $body_params);

//$content .= elgg_view('help/register');

if (elgg_get_config('walled_garden')) {
	elgg_load_css('elgg.walled_garden');
	$body = elgg_view_layout('walled_garden', array('content' => $content));
	echo elgg_view_page($title, $body, 'walled_garden');
} else {
	$body = elgg_view_layout('one_column', array(
		'title' => $title,
		'content' => $content,
	));
	echo elgg_view_page($title, $body);
}