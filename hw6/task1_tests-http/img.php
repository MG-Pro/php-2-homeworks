<?php

header("Content-type: image/png");
$string = $_GET['result'];
$name = $_GET['name'];
$arr = explode(';', $string);

$im = imagecreatetruecolor(180, count($arr) * 20 + 30);

$text_color = imagecolorallocate($im, 67, 126, 177);
$bg = imagecolorallocate($im, 255, 0, 0);

$font = __DIR__ . '/arial.ttf';
$i = 50;

$res = imagettftext($im, 14, 0, 5, 20, $text_color, $font, 'Имя: ' . $name . PHP_EOL);

foreach ($arr as $item) {
  $item = wordwrap($item, 80);
  $res = imagettftext($im, 14, 0, 5, $i, $text_color, $font, $item);
  $i += 30;
}

imagepng($im);
imagedestroy($im);
