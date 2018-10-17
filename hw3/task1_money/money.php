<?php
if(!$argv[1] === '--today' && count($argv) < 3) {
  exit('Ошибка! Аргументы не заданы. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}');
}

$today = date('Y-m-d');

if($argv[1] === '--today') {
  $fp = fopen('money.csv', 'r');
  $fileData = [];
  while(!feof($fp))
  {
    $fileStr = fgetcsv($fp);
    if($fileStr != false) {
      $fileData[] = $fileStr;
    }
  }
  fclose($fp);

  $count = 0;

  foreach ($fileData as $item) {
    if((strtotime($today) === strtotime($item[0]))) {
      $count += (int)$item[1];
    }
  }
  if ($count === 0) {
    echo "$today расходов не было!";
  } else {
    echo "$today расход за день: $count";
  }
  exit();
}

$data = [];
$data[] = $today;
$data[] = (int)$argv[1];
$data[] = trim(implode(' ', array_slice($argv, 2)));;

$fp = fopen('money.csv', 'a+');
fputcsv($fp, $data);
fclose($fp);
echo "Добавлена строка: $data[0], $data[1], $data[2],";

?>

