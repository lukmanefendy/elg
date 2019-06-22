<?php
/**
 * Elgg register form
 *
 * @package Elgg
 * @subpackage Core
 */
//ditambahkan dengan mengganti register -> webserv
if (elgg_is_sticky_form('webserv')) {
	$values = elgg_get_sticky_values('webserv');

	// Add the sticky values to $vars so views extending
	// register/extend also get access to them.
	$vars = array_merge($vars, $values);

	elgg_clear_sticky_form('register');
} else {
	$values = array();
}

$nip = get_input('nip');
$lastdik = 'S-2 MAGISTER MANAJEMEN';
$lastjab = 'KEPALA BIRO PERENCANAAN';
$dispname = "Heru Purwaka";
//$dispname = elgg_extract('name', $values, get_input('nama'));
$email = get_input('email');
$password = $password2 = '';
$username = elgg_extract('username', $values, get_input('nama'));
//$email = elgg_extract('email', $values, get_input('e'));
$name = elgg_extract('name', $values, get_input('nama'));

/* $fields = [
	[
		'#type' => 'hidden',
		'name' => 'friend_guid',
		'value' => elgg_extract('friend_guid', $vars),
	],
	[
		'#type' => 'hidden',
		'name' => 'invitecode',
		'value' => elgg_extract('invitecode', $vars),
	],
	[
		'#type' => 'text',
		'name' => 'name',
		'value' => 'tes',
	],
	[
		'#type' => 'text',
		'name' => 'email',
		'value' => 'a@a.com',
	],
	[
		'#type' => 'text',
		'#label' => elgg_echo('NIK'),
		'name' => 'username',
		'value' => $username,
		'required' => true,
	],
	[
		'#type' => 'password',
		'#label' => elgg_echo('password'),
		'name' => 'password',
		'value' => $password,
		'required' => true,
	],
	[
		'#type' => 'password',
		'#label' => elgg_echo('passwordagain'),
		'name' => 'password2',
		'value' => $password2,
		'required' => true,
	],
];
 */
//Original Fields Register
 $fields = [
	[
		'#type' => 'hidden',
		'name' => 'friend_guid',
		'value' => elgg_extract('friend_guid', $vars),
	],
	[
		'#type' => 'hidden',
		'name' => 'invitecode',
		'value' => elgg_extract('invitecode', $vars),
	],
	[
		'#type' => 'text',
		'#label' => elgg_echo('Display Name'),
		'#class' => 'mtm',
		'name' => 'dispname',
		'value' => $dispname,
		'autofocus' => true,
		'required' => true,
	],
	[
		'#type' => 'text',
		'#label' => elgg_echo('NIP'),
		'#class' => 'mtm',
		'name' => 'nip',
		'value' => $nip,
		'autofocus' => true,
		'required' => true,
	],
	[
		'#type' => 'text',
		'#label' => elgg_echo('username'),
		'name' => 'username',
		'value' => $username,
		'required' => true,
	],
	[
		'#type' => 'password',
		'#label' => elgg_echo('password'),
		'name' => 'password',
		'value' => $password,
		'required' => true,
	],
	[
		'#type' => 'password',
		'#label' => elgg_echo('passwordagain'),
		'name' => 'password2',
		'value' => $password2,
		'required' => true,
	],
	[
		'#type' => 'email',
		'#label' => elgg_echo('email'),
		'name' => 'email',
		'value' => $email,
		'required' => true,
	],
	[
		'#type' => 'text',
		'#label' => elgg_echo('Pendidikan Terakhir'),
		'name' => 'lastdik',
		'value' => $lastdik,
	],
	[
		'#type' => 'text',
		'#label' => elgg_echo('Jabatan Terakhir'),
		'name' => 'lastjab',
		'value' => $lastjab,
	]
]; 

foreach ($fields as $field) {
	echo elgg_view_field($field);
}

// view to extend to add more fields to the registration form
//echo elgg_view('register/extend', $vars);

// Add captcha hook
//echo elgg_view('input/captcha', $vars);

$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('register'),
]);

elgg_set_form_footer($footer);
/* if (isset($nip)){
	
	$_GET['__elgg_uri']="/webserv";
	unset($_POST['nip']);
	unset($_POST['act']);
	unset($_POST['rdo1']);
	unset($_POST['__elgg_token']);
	unset($_POST['__elgg_ts']);
	
	unset($_REQUEST['__elgg_uri']);
	unset($_REQUEST['nip']);
	unset($_REQUEST['act']);
	unset($_REQUEST['rdo1']);
	unset($_REQUEST['__elgg_token']);
	unset($_REQUEST['__elgg_ts']);
	$_REQUEST['__elgg_uri']="webserv";
	} */
