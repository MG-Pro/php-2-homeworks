<?php
$data = [];
$data[] = date('Y-m-d');
$data[] = (int)$argv[1];
$data[] = trim(implode(' ', array_slice($argv, 2)));

var_dump($data);

$fp = fopen('money.csv', 'a');
fputcsv($fp, $data);
fclose($fp);

?>

