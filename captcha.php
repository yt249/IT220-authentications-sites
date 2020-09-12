<?php
session_start();

// --- identify kind send to the browser ---
header("Content-Type: image/png ");

// --- the large outside ---
$im = imagecreatetruecolor(400, 175);
$blue   = imagecolorallocate ($im, 0, 0, 255); 
imagefill($im, 0, 0, $blue);

// -- defining variables ---
$font = "LaBelleAurore.ttf";
$font2 = "RobotoCondensed-Regular.ttf";
$black 	= imagecolorallocate ($im, 0, 0, 0); //r g b
$yellow = imagecolorallocate ($im, 255, 255, 0); 
$green  = imagecolorallocate ($im, 0, 128, 0); 
$red    = imagecolorallocate ($im, 255, 0, 0); 


// --- the small inside ---
imagefilledrectangle($im, 10, 10, 390, 165, $yellow);

// mdr: concert to 32 character
// getting 4 characters starting from the first character
$text1 = substr( str_shuffle( md5( time() ) ), 0, 2 ); 
$text2 = substr( str_shuffle( md5( time() ) ), 0, 2 ); 
$session_id = "session id: " . session_id();
$captcha = "captcha: " . $text1 . $text2;
$_SESSION["captcha"] = $text1 . $text2;

//left
imagettftext($im, 30,  30,  70, 90,   $red, $font, $text1 ); //fontsize, angle, x, y, ...
//right
imagettftext($im, 25, -15, 110, 95, $green, $font, $text2 ); //fontsize, angle, x, y, ...
imagettftext($im, 15, 0, 12, 135, $black, $font2, $session_id );
imagettftext($im, 15, 0, 12, 155, $black, $font2, $captcha );


imagepng($im);
imagedestroy($im);


?>
