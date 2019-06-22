<?php
/**
 * Elgg register form
 *
 * @package Elgg
 * @subpackage Core
 */

if (elgg_is_sticky_form('regopt')) {
	$values = elgg_get_sticky_values('regopt');

	// Add the sticky values to $vars so views extending
	// register/extend also get access to them.
	$vars = array_merge($vars, $values);

	elgg_clear_sticky_form('regopt');
} else {
	$values = array();
}

$password = $password2 = '';
$username = elgg_extract('username', $values, get_input('u'));
$email = elgg_extract('email', $values, get_input('e'));
$name = elgg_extract('name', $values, get_input('n'));

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
		'#label' => elgg_echo('Indonesia'),
		'#class' => 'mtm',
		'name' => 'name',
		'value' => $name,
		'autofocus' => true,
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
]; 

/* foreach ($fields as $field) {
	echo elgg_view_field($field);
} */

// view to extend to add more fields to the registration form
//echo elgg_view('register/extend', $vars);

// Add captcha hook
//echo elgg_view('input/captcha', $vars);

$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('Next'),
]);
//ditambahkan Bendera2
$flag = <<<__FLAG

<div class="col-md-6">
	<br /><br>
	<b> Choose Your Nation:</font></b><br /><br />
	<b>Brunei Darussalam</b><br>
	<a href="register" class="borderit2"><img src="images/BenderaBrunei.png" vspace="5"></a><br>
	<br><br>
	<b>Cambodia</b><br>
	<img src="images/BenderaKamboja.png" vspace="5"><br>
	<br><br>
	<b>Indonesia</b><br>
	<a href="webserv" class="borderit2"><img src="images/BenderaIndonesia.png" vspace="5"></a><br>
	<br><br>
	<b>Lao PDR</b><br>
	<img src="images/BenderaLaos.png" vspace="5"><br>
	<br><br>
	<b>Malaysia</b><br>
	<img src="images/BenderaMalaysia.png" vspace="5"><br>
	<br><br>
	<b>Myanmar</b><br>
	<img src="images/BenderaMyanmar.png" vspace="5"><br>
	<br><br>
	<b>Philippines</b><br>
	<img src="images/BenderaFiliphina.png" vspace="5"><br>
	<br><br>
	<b>Singapore</b><br>
	<img src="images/BenderaSingapur.png" vspace="5"><br>
	<br><br>
	<b>Thailand</b><br>
	<img src="images/BenderaThailand.png" vspace="5"><br>
	<br><br>
	<b>Vietnam</b><br>
	<img src="images/BenderaVietnam.png" vspace="5"><br>
	<br><br>
</div>

__FLAG;
echo $flag;

//elgg_set_form_footer($footer);
