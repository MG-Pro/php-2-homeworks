<?php

header("Content-type: image/png");
$string = $_GET['result'];

$arr = explode(';', $string);

$im = imagecreatetruecolor(180, count($arr) * 20);

$text_color = imagecolorallocate($im, 67, 126, 177);
$bg = imagecolorallocate($im, 255, 0, 0);

$font = __DIR__ . '\arial.ttf';
$i = 20;

foreach ($arr as $item) {
  $item = wordwrap($item, 80);
  $res = imagettftext($im, 14, 0, 5, $i, $text_color, $font, $item);
  $i += 30;
}

imagepng($im);
imagedestroy($im);
