<?php
/**
 * Elgg image view
 *
 * @uses string $vars['src'] The image src url (required).
 * @uses string $vars['alt'] The alternate text for the image (required).
 */

if (!isset($vars['alt'])) {
	elgg_log("The view output/img requires that the alternate text be set.", 'NOTICE');
}

$vars['src'] = elgg_normalize_url($vars['src']);
$vars['src'] = elgg_format_url($vars['src']);
if($vars['class'] == ''){
	$time = microtime(false);
	//$time = str_replace(["0."," "], "A", $time);
	$time = substr($time,2,4);
	$vars['class'] = "vsmall".$time;
	//$vars['class'] = "vsmall";	
	//$vars['class'] = elgg_extract_class($vars, 'photo u-photo'.$time);
}
//ditambahkan:vrf untuk foto user yang telah diverifikasi
if ($vars['vrf'] != ''){
	$vrf = $vars['vrf'];
	unset($vars['vrf']);
	echo "<img src=".$vars['src']." class='img1' hidden='true'>";
	echo "<img src=".$vrf." class='img2' hidden='true'>";
	$attributes = elgg_format_attributes($vars);
	echo "<canvas $attributes></canvas>";
	$canv = <<<__CANV
<script>
window.onload = function () {
var img1 = document.getElementsByClassName('img1');
	var img2 = document.getElementsByClassName('img2');
	
__CANV;
	if ($vars['class'] == "vsmall".$time)
		$canvclass = 'var canvas = document.getElementsByClassName("vsmall'.$time.'");
					  var context = canvas[0].getContext("2d");';

	//if ($vars['class'] == "vsmall")
	//	$canvclass = 'var canvas = document.getElementsByClassName("vsmall")';
	else if ($vars['class'] == "u-photo")
		$canvclass = 'var canvas = document.getElementsByClassName("u-photo")';
	if ($vars['class'] == "vsmall".$time){
		$canvclass2 = '
					   var canvas[0].width = 40;
					   var canvas[0].height = 40;
					   context.drawImage(img1[0], 0, 1, 40, 40);
					   context.drawImage(img2[0], 0, 0, 40, 40);
					};
					</script>';
	}
	else if ($vars['class'] == "u-photo"){
		$canvclass2 = '
					   var canvas[0].width = 200;
					   var canvas[0].height = 166;
					   context.drawImage(img1[0], 0, 1, 200, 166);
					   context.drawImage(img2[0], 0, 0, 200, 166);
					};
					</script>';
	}

	/* context.drawImage(img1[0], 0, 1, width, height);
    var image1 = context.getImageData(0, 0, width, height);
    var imageData1 = image1.data;
    context.drawImage(img2[0], 0, 0, width, height);
    var image2 = context.getImageData(0, 0, width, height);
	var imageData2 = image2.data; */
	
	echo $canv;
	echo $canvclass;
	echo $canvclass2;
	//echo $canv2;
}
else{
	$attributes = elgg_format_attributes($vars);
	echo "<img $attributes/>";
}