<?php
/**
 * Elgg registration action for regopt
 *
 * @package Elgg.Core
 * @subpackage User.Account
 */

//elgg_make_sticky_form('register');

// Get variables
$nip = get_input('nip');
//$nama = "heru";
//$password = get_input('password', null, false);
//$password2 = get_input('password2', null, false);
//$email = get_input('email');
//$name = get_input('name');
$friend_guid = (int) get_input('friend_guid', 0);
$invitecode = get_input('invitecode');
//forward("http://localhost/elgg-2.3.9/webserv");
//echo elgg_view_resource("account/webserv");

//$noinput = $_POST["noinput"];
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://wsrv-auth.bkn.go.id/oauth/token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "client_id=renkalclient&grant_type=client_credentials&undefined=",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Basic cmVua2FsY2xpZW50OjEyMzQ1Njc4OQ==",
      "Content-Type: application/x-www-form-urlencoded",
      "Origin: http://localhost:20000",
      "Postman-Token: 6ff3ace6-5949-4473-8c48-3694cfb343e1",
      "cache-control: no-cache"
		),
));
$response = curl_exec($curl);
//echo $response;
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} 
else {
		$json_obj0 = json_decode($response);
    $curl2 = curl_init();
    curl_setopt_array($curl2, array(
        CURLOPT_URL => "https://wsrv.bkn.go.id/api/pns/data-utama/$nip",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => array(
          "Authorization: Bearer ".$json_obj0->access_token,
        // "Authorization: Bearer 7aaece55-2800-4a78-9cfd-5a3a5f50a153",
          "Content-Type: application/x-www-form-urlencoded",
          "Origin: http://localhost:20000",
          "Postman-Token: 2d9c3c24-39cf-4431-8a98-c22b7694ae50",
          "cache-control: no-cache"
        ),
		));
		$datut = curl_exec($curl2);
    $err = curl_error($curl2);
		curl_close($curl2);
		if ($err) {
        echo "cURL Error #:" . $err;
		} 
		else {
        $datutres = stripslashes($datut);
        $json_obj = json_decode($datut,true);
				$json_obj3 = json_decode($json_obj['data'],true);
		}
}
			

/* if (elgg_get_config('allow_registration')) {
		try {
		/* if (trim($password) == "" || trim($password2) == "") {
			throw new RegistrationException(elgg_echo('RegistrationException:EmptyPassword'));
		}

		if (strcmp($password, $password2) != 0) {
			throw new RegistrationException(elgg_echo('RegistrationException:PasswordMismatch'));
		} 

		$guid = register_user($username, $password, $name, $email);

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
					forward($forward_url);
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
}*/
//elgg_echo($nip);


if ($json_obj3['nama'] == "") {
		register_error(elgg_echo("NIP is unregistered in Badan Kepegawaian Negara."));
		forward(REFERRER);
}
else forward("webserv/?nip=".$nip."&nama=".$json_obj3['nama'].
	"&instansi=".$json_obj3['instansiIndukNama']."&email=".$json_obj3['email'].
	"&gelarDepan=".$json_obj3['gelarDepan']."&gelarBelakang=".$json_obj3['gelarBelakang']);
//forward("http://localhost/elgg-2.3.9/webserv/?nip=".$nip."&nama=".$nama);
//forward(REFERER);
