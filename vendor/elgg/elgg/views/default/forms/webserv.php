<?php
/**
 * Elgg register form for webserv
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
$instansi = get_input('instansi');
$gdpn = get_input('gelarDepan');
$gblkg = get_input('gelarBelakang');
$email = get_input('email');
$password = $password2 = '';
$country = get_input('country');
if(!isset($country))
	$country = "IDN";
//$username = elgg_extract('username', $values, get_input('nama'));
//$email = elgg_extract('email', $values, get_input('e'));
$name = elgg_extract('name', $values, get_input('nama'));
if ($gdpn != ""){
	$name = $gdpn.". ".$name;
}
if ($gblkg != ""){
	$name .= ", ".$gblkg.".";
}

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
		'value' => $name,
		'autofocus' => true,
		'required' => true,
	],
	[
		'#type' => 'text',
		'#label' => $country=="IDN"?elgg_echo('N I P'):elgg_echo('ID Number'),
		'#class' => 'mtm',
		'name' => 'nip',
		'value' => $nip,
		'autofocus' => true,
		'required' => true,
	],
	[
		'#type' => 'text',
		'#label' => elgg_echo('Username (Login)'),
		'name' => 'username',
		'value' => '',
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
		'#label' => elgg_echo('Retype Password'),
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
		'#label' => elgg_echo('Hand Phone'),
		'name' => 'hp',
		'value' => '',
		'required' => true
	],
	[
		'#type' => 'text',
		'#label' => elgg_echo('Institution'),
		'name' => 'instansi',
		'value' => $instansi,
		'required' => true
	],
	[
		'#type' => 'hidden',
		'name' => 'country',
		'value' => $country,
	]
]; 

foreach ($fields as $field) {
	echo elgg_view_field($field);
}

$token = captcha_generate_token();

echo '<div class="captcha">';
echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'captcha_token',
	'value' => $token,
]);

echo '<div class="captcha-right">';
echo elgg_view('output/img', [
	'src' => "captcha/$token",
	'alt' => "captcha_image",
	'class' => 'captcha-input-image',
]);
echo '</div>';

echo '<div class="captcha-left">';
echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('captcha:entercaptcha'),
	'name' => 'captcha_input',
	'class' => 'captcha-input-text',
	'required' => true,
]);
$captcha = captcha_generate_captcha($token);
print("<input value=\"$captcha\" type=\"hidden\" name=\"captcha_hidden\" class=\"elgg-input-text captcha-input-text\" id=\"elgg-field-b460x4\">");
echo '</div>';
echo '</div>';
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
