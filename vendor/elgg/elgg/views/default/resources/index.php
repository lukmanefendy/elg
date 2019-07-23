<?php

//tambahan untuk menghilangkan content river (saat hal depan diakses)
if (elgg_is_logged_in()) {
	//forward('activity');
	$content = elgg_list_river();
}
else
	$content='';


//$title = elgg_echo('content:latest');

//ditambahkan untuk menghilangkan content river (saat hal depan diakses)
//sebaiknya dibuat fork saat login berhasil
//if (elgg_get_logged_in_user_entity())
//$content='';
//	$content = elgg_list_river();
//else
//	$content='';
//if (!$content) {
//	$content = elgg_echo('river:none');
//}

$login_box = elgg_view('core/account/login_box');

$params = array(
		'title' => $title,
		'content' => $content,
		'sidebar' => $login_box
);
$body = elgg_view_layout('one_sidebar', $params);

$body = '<div class="test" style="
margin-right: 100px;
">' . $body . '</div>';

echo elgg_view_page(null, $body);
