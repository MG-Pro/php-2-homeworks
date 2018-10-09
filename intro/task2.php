<?php
$x = rand(0, 100);

$a = 1;
$b = 1;

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<?php
while ($a < $x) {
  $c = $a;
  $a += $b;
  $b = $c;
  echo $c . ' ';
}
if ($a > $x) {
  echo PHP_EOL . 'Число ' . $x . ' НЕ входит в числовой ряд' . PHP_EOL;
} elseif ($a === $x) {
  echo PHP_EOL . 'Число ' . $x . ' входит в числовой ряд' . PHP_EOL;
}

?>
</body>
</html>


