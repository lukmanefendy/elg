<?php

    $function = 'elgg_user_account_page_handler';
    $identifier = 'register';
	$response = call_user_func($function, $identifier);
                
    function elgg_user_account_page_handler($handler) {

	switch ($handler) {
		case 'login':
			echo elgg_view_resource("account/login");
			break;
		case 'forgotpassword':
			echo elgg_view_resource("account/forgotten_password");
			break;
		case 'changepassword':
			echo elgg_view_resource("account/change_password");
			break;
		case 'register':
			echo elgg_view_resource("account/register");
			break;
		case 'regopt':
			echo elgg_view_resource("account/regopt");
			break;
		default:
			return false;
	}

	return true;
    }
?>