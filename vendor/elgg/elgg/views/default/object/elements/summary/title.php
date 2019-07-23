<?php

/**
 * Outputs object title
 * @uses $vars['title'] Title
 */

$title = elgg_extract('title', $vars);
if (!$title) {
	return;
}
//ditambahkan:sql dan vrf image utk tiny size
//ditambahkan:sql focal utk italic dlm tiny size
else if ($vars['entity']->type == 'user'){
	$isvrf = get_data("SELECT vrf, focal from elgg_users_entity where guid=".$vars['entity']->guid);
	if ($isvrf[0]->vrf == 'yes'){
		$vrf=elgg_get_simplecache_url('check.png');
		$vrfimg = "<img src=".$vrf." class='img2' width='12' height='12'>";
	}
	else $vrfimg = "";
}

//ditambahkan:focal cek utk italic di profile kecil sebelah kanan
if ($isvrf[0]->focal == 'yes'){
	$title = "<i>$title</i>";
}
//ditambahkan:img di profile kecil sebelah kanan
?>
<h3 class="elgg-listing-summary-title"><?= $title.$vrfimg ?></h3>