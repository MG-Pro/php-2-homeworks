<?php
define("URL", 'https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8');
define('RESERVE_URL', 'https://raw.githubusercontent.com/netology-code/php-2-homeworks/master/files/countries/opendata.csv');

if(count($argv) < 2) {
  exit("Введите название страны");
}

$data = file_get_contents(URL);

if($data === false) {
  $data = file_get_contents(RESERVE_URL);
}
if($data === false) {
  exit("Данные недоступны");
}

$data = explode(PHP_EOL, $data);
array_shift($data);


$list = [];

foreach ($data as $item) {
  $country = str_getcsv($item);
  array_shift($country);
  array_splice($country, 1, 2);
  $list[] = $country;
}

$targetCountry = false;

foreach ($list as $country) {
  if($country[0] === $argv[1]) {
    $targetCountry = $country;
    break;
  }
}
if ($targetCountry === false) {
  echo "Страна $argv[1] не найдена";
} else {
  echo "$country[0]: $country[1]";
}

?>

