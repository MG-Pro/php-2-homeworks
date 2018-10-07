<?php

$x = rand(0,100);
echo $x;
echo PHP_EOL;

$a = 1;
$b = 1;

while (true) {
  if($a > $x) {
    echo PHP_EOL . 'Число ' . $x . ' НЕ входит в числовой ряд';
    break;
  } elseif ($a === $x) {
    echo PHP_EOL . 'Число ' . $x . ' входит в числовой ряд';
    break;
  } else {
    $c = $a;
    $a += $b;
    $b = $c;
    echo $c . ' ';
  }
}



