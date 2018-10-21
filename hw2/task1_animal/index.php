<?php
$animals = [
  'Africa'        => [
    'Avstralopitecus africanus',
    'Loxodonta africana',
    'Bitis albanica',
  ],
  'North America' => [
    'Ovibos moschatus ',
    'Bubo scandiacus',
    'Rangifer tarandus',
  ],
  'South America' => [
    'Leontopithecus rosali',
    'Tremarctos ornatus',
    'Lama guanicoe',
  ],
  'Eurasia'       => [
    'Ailuropoda melanoleuca',
    'Panthera tigris',
    'Ursus maritimus',
  ],
  'Australia'     => [
    'Macropus rufus',
    'Phascolarctos cinereus',
    'Ornithorhynchus anatinus',
  ],
  'Antarctica'    => [
    'Cryolophosaurus',
    'Aptenodytes forsteri',
    'Mirounga',
  ]
];

$twoWordsName = [];

foreach ($animals as $item) {
  foreach ($item as $name) {
    $count = count(explode(' ', $name));
    if($count >= 2 && $count < 3) {
      $twoWordsName[] = $name;
      $firstNamelist[] = explode(' ', $name)[0];
      $secondNamelist[] = explode(' ', $name)[1];
    }
  }
}

shuffle($secondNamelist);
shuffle($firstNamelist);
$randNames = [];

foreach ($firstNamelist as $key => $name) {
  $randNames[] = $name . ' ' . $secondNamelist[$key];
}

function find($arr, $str) {
  foreach ($arr as $key => $value) {
    $isInc = strpos($value, $str);
    if($isInc !== false) {
      return $key;
    }
  }
}

$fakeAnimals = [];

foreach ($animals as $key => $item) {
  foreach ($item as $num => $animal) {
    $index = find($randNames, explode(' ', $animal)[0]);
    if($index !== null) {
      $fakeAnimals[$key][] = $randNames[$index];
    }
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Animal</title>
</head>
<body>
<?php

// t2

print_r($twoWordsName);

// t3

print_r($randNames);

// ex. t1

foreach ($fakeAnimals as $key => $item) {
  echo "<h2>$key</h2>";
  echo implode(', ', $item) . '.';
}
?>
</body>
</html>
