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
    if(count(explode(' ', $name)) >= 2) {
      $twoWordsName[] = trim($name);
    }
  }
}

print_r($twoWordsName);
$randNames = [];

function getNames($arr, $pos) {
  foreach ($arr as $name) {
    $result[] = explode(' ', $name)[$pos];
  }
  return $result;
}
$firsNamelist = getNames($twoWordsName, 0);
$secondNamelist = getNames($twoWordsName, 1);
shuffle($secondNamelist);

$randNames = [];

foreach ($firsNamelist as $key => $name) {
  $randNames[] = $name . ' ' . $secondNamelist[$key];
}



print_r($randNames);
// print_r($secondNamelist)







?>
</body>
</html>
