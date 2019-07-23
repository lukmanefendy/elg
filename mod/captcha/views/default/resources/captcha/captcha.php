<?php
/**
 * Elgg captcha plugin graphics file generator
 *
 * @package ElggCaptcha
 */

$token = elgg_extract('captcha_token', $vars);

// Output captcha
if ($token) {
	// Generate captcha
	$captcha = captcha_generate_captcha($token);
	$width = 200;
    $height = 50;
    $image = ImageCreate($width,$height);
    // Colours
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
    $green = imagecolorallocate($image, 0, 255, 0);
    $brown = imagecolorallocate($image, 139, 69, 19);
    $orange = imagecolorallocate($image, 255, 69, 0);
    $grey = imagecolorallocate($image, 204, 204, 204);
    // Making Background
    imagefill($image, 0, 0, $grey);
    // Carving Text into the image
    $font= dirname(__FILE__) . "\Acme-Regular.ttf";
    imagettftext($image, 25, 10, 45, 45, $brown, elgg_get_plugins_path() . "captcha/fonts/1.ttf", $captcha);
    // Informing Browser there is a jpeg image file is coming
    header("Content-Type: image/jpeg");
    //Converting Image into JPEG
    imagejpeg($image);
    // Clearing Cache
    imagedestroy($image);
	// // Pick a random background image
	// $n = rand(1, CAPTCHA_NUM_BG);
	// $image = imagecreatefromjpeg(elgg_get_plugins_path() . "captcha/backgrounds/bg$n.jpg");
	// // Create a colour (black so its not a simple matter of masking out one colour and ocring the rest)
	// $colour = imagecolorallocate($image, 0,0,0);
	// // Write captcha to image
	// imagettftext($image, 30, 0, 10, 30, $colour, elgg_get_plugins_path() . "captcha/fonts/1.ttf", $captcha);
	// // Output image
	// ob_start(); // start a new output buffer
	// imagejpeg($image);
	// $ImageData = ob_get_contents();
	// $ImageDataLength = ob_get_length();
	// ob_end_clean(); // stop this output buffer
	// header("Content-Type: image/jpeg") ;
	// header("Content-Length: ".$ImageDataLength);
	// header('Cache-Control: no-cache, no-store, must-revalidate');
	// header('Pragma: no-cache');
	// header('Expires: 0');
	// echo $ImageData;
	// // Free memory
	// imagedestroy($image);
}
