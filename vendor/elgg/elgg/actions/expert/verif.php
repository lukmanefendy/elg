<?php

$vrf_guid = (int) get_input('vrf');

$vrf = get_user($vrf_guid);
if (!$vrf) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}
//$user = elgg_get_logged_in_user_entity();
$db_prefix = elgg_get_config('dbprefix');
$query = "UPDATE {$db_prefix}users_entity SET vrf = 'yes' WHERE guid = $vrf_guid";
update_data($query);
//$isvrf = get_data("SELECT vrf from elgg_users_entity where guid=$user->guid");

?>