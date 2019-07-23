<?php
/**
 * Elgg user display (details)
 * @uses $vars['entity'] The user entity
 */

$user = elgg_get_page_owner_entity();

$profile_fields = elgg_get_config('profile_fields');

//ditambahkan:sql utk cek user apakah sudah verified
$isvrf = get_data("SELECT vrf, focal from elgg_users_entity where guid=$user->guid");

echo '<div id="profile-details" class="elgg-body pll">';
echo "<span class=\"hidden nickname p-nickname\">{$user->username}</span>";
//ditambahkan:img verified utk hal profile
//ditambahkan:italic utk focal point dlm hal profile
if ($isvrf[0]->vrf == 'yes'){
	$vrf=elgg_get_simplecache_url('check.png');
	if ($isvrf[0]->focal == 'yes')
		echo "<h2 class=\"p-name fn\"><i>{$user->name}</i><img src=".$vrf." class='img2' width='20' height='20'></h2>";
	else
		echo "<h2 class=\"p-name fn\">{$user->name}<img src=".$vrf." class='img2' width='20' height='20'></h2>";
}
else{
	if ($isvrf[0]->focal == 'yes')	
		echo "<h2 class=\"p-name fn\"><i>{$user->name}</i></h2>";
	else
		echo "<h2 class=\"p-name fn\">{$user->name}</h2>";
}



// the controller doesn't allow non-admins to view banned users' profiles
if ($user->isBanned()) {
	$title = elgg_echo('banned');
	$reason = ($user->ban_reason === 'banned') ? '' : $user->ban_reason;
	echo "<div class='profile-banned-user'><h4 class='mbs'>$title</h4>$reason</div>";
}

echo elgg_view("profile/status", array("entity" => $user));

$microformats = array(
	'mobile' => 'tel p-tel',
	'phone' => 'tel p-tel',
	'website' => 'url u-url',
	'contactemail' => 'email u-email',
);
//ditambahkan:diubah susunan aboutme, dipakai even_odd, div dan span
$even_odd = 'odd';
if (isset($profile_fields['description']) && $user->description) {
	echo "<p class='profile-aboutme-title'><b>" . elgg_echo("profile:aboutme") . "</b></p>";
	echo "<div class='profile-aboutme-contents ".$even_odd."'><span>";
	echo elgg_view('output/longtext', array('value' => $user->description, 'class' => 'mtn'));
	echo "</span></div>";
}

if (is_array($profile_fields) && sizeof($profile_fields) > 0) {
	foreach ($profile_fields as $shortname => $valtype) {
		if ($shortname == "description") {
			// skip about me and put at bottom
			continue;
		}
		$value = $user->$shortname;

		if (!is_null($value)) {

			// fix profile URLs populated by https://github.com/Elgg/Elgg/issues/5232
			// @todo Replace with upgrade script, only need to alter users with last_update after 1.8.13
			if ($valtype == 'url' && $value == 'http://') {
				$user->$shortname = '';
				continue;
			}

			// validate urls
			if ($valtype == 'url' && !preg_match('~^https?\://~i', $value)) {
				$value = "http://$value";
			}

			// this controls the alternating class
			$even_odd = ( 'odd' != $even_odd ) ? 'odd' : 'even';
			?>
			<div class="<?php echo $even_odd; ?>">
				<b><?php echo elgg_echo("profile:{$shortname}"); ?>: </b>
				<?php
					$params = array(
						'value' => $value
					);
					if (isset($microformats[$shortname])) {
						$class = $microformats[$shortname];
					} else {
						$class = '';
					}
					echo "<span class=\"$class\">";
					echo elgg_view("output/{$valtype}", $params);
					//ditambahkan:output file uploaded
					if ($shortname == 'location'){
						$name = htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8', false);
						$icon = elgg_view('output/img', array(
							'src' => $user->getIconURL($size),
							'alt' => $name,
							'title' => $name,
							'class' => 'large',
						));
						echo "</span>";
						//ditambahkan:output file uploaded
						echo "<div><a>$icon</a></div>";
					}
				?>
			</div>
			<?php
		}
	}
}
echo '</div>';