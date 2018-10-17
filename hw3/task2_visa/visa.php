<?php
define("URL", 'https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8');
define('RESERVE_URL', 'https://raw.githubusercontent.com/netology-code/php-2-homeworks/master/files/countries/opendata.csv');

$data = file_get_contents(URL);

if($data === false) {
  $data = file_get_contents(RESERVE_URL);
}

var_dump($data)

?>

