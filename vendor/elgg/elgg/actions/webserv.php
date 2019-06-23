<?php
/**
 * Elgg registration action for webserv
 *
 * @package Elgg.Core
 * @subpackage User.Account
 */

elgg_make_sticky_form('webserv');
//ditambahkan nip untuk mendapatkan nilai NIP
// Get variables
$nip = get_input('nip');
$username = get_input('username');
$password = get_input('password', null, false);
$password2 = get_input('password2', null, false);
$email = get_input('email');
$name = get_input('dispname');
$hp = get_input('hp');
$instansi = get_input('instansi');
$friend_guid = (int) get_input('friend_guid', 0);
$invitecode = get_input('invitecode');
$captchaInput = get_input('captcha_input');
$captcha = get_input('captcha_hidden');

if ($captchaInput != $captcha) {
	register_error(elgg_echo("Captcha yang anda masukan salah"));
	forward(REFERRER);
} else {

if (elgg_get_config('allow_registration')) {
	try {
		if (trim($password) == "" || trim($password2) == "")  {
			throw new RegistrationException(elgg_echo('RegistrationException:EmptyPassword'));
		}
		//ditambahkan:nip dan hp dan instansi
		$guid = register_user($nip, $hp, $instansi, $username, $password, $name, $email);

		if ($guid) {
			$new_user = get_entity($guid);

			// allow plugins to respond to self registration
			// note: To catch all new users, even those created by an admin,
			// register for the create, user event instead.
			// only passing vars that aren't in ElggUser.
			$params = array(
				'user' => $new_user,
				'password' => $password,
				'friend_guid' => $friend_guid,
				'invitecode' => $invitecode
			);

			// @todo should registration be allowed no matter what the plugins return?
			if (!elgg_trigger_plugin_hook('register', 'user', $params, TRUE)) {
				$ia = elgg_set_ignore_access(true);
				$new_user->delete();
				elgg_set_ignore_access($ia);
				// @todo this is a generic messages. We could have plugins
				// throw a RegistrationException, but that is very odd
				// for the plugin hooks system.
				throw new RegistrationException(elgg_echo('registerbad'));
			}

			elgg_clear_sticky_form('register');

			if ($new_user->enabled == "yes") {
				system_message(elgg_echo("registerok", array(elgg_get_site_entity()->name)));

				// if exception thrown, this probably means there is a validation
				// plugin that has disabled the user
				try {
					login($new_user);
					// set forward url
					$session = elgg_get_session();
					if ($session->has('last_forward_from')) {
						$forward_url = $session->get('last_forward_from');
						$forward_source = 'last_forward_from';
					} else {
						// forward to main index page
						$forward_url = '';
						$forward_source = null;
					}
					$params = array('user' => $new_user, 'source' => $forward_source);
					$forward_url = elgg_trigger_plugin_hook('login:forward', 'user', $params, $forward_url);
					//forward($forward_url);
					//forward("profile/".$new_user->username."/edit");
					//ditambahkan:edit profile
					forward("profile/".$new_user->username."/edit");
				} catch (LoginException $e) {
					register_error($e->getMessage());
					forward(REFERER);
				}
			}

			// Forward on success, assume everything else is an error...
			forward();
		} else {
			register_error(elgg_echo("registerbad"));
		}
	} catch (RegistrationException $r) {
		register_error($r->getMessage());
	}
} else {
	register_error(elgg_echo('registerdisabled'));
}
}

forward(REFERER);
