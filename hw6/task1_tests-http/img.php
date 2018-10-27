<?php

header("Content-type: image/png");
$string = $_GET['result'];
// $string =  iconv('windows-1251','utf-8', $string);
// $arr = explode(' ', $string);


$im = imagecreatetruecolor(700, 320);

$text_color = imagecolorallocate($im, 67, 126, 177);
$bg = imagecolorallocate($im, 255, 0, 0);
// imagefill($im, 1, 1, $bg);

// imagestring($im, 2, 5, 5,  $string, $text_color);
// putenv('GDFONTPATH=' . realpath('.'));
$font='C:\Repositories\php-2-homeworks\hw6\task1_tests-http\arial.ttf';

$res = imagettftext($im, 14, 0, 5, 20, $text_color, $font, $string);
imagepng($im);
imagedestroy($im);
