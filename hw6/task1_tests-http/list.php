<?php
$fileList = glob('tmp/*.json');
$msg = '';
$data = [];
if (count($fileList) === 0) {
  $msg = 'Нет ни одного теста :(';
} else {
  foreach ($fileList as $item) {
    $name = basename($item);
    $json = file_get_contents(__DIR__ . "/tmp/$name");
    $jsonData = json_decode($json, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      $msg = "Не валидный JSON ($name)!";
    } else {
      $jsonData['fileName'] = $name;
      $data[] = $jsonData;
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
  <title>List</title>
</head>
<body>
<header>
  <a href="admin.php">Загрузка тестов</a>
</header>
<hr>
<ol>
  <?php foreach ($data as $question) { ?>
    <li><b><a href="test.php?filename=<?php echo $question['fileName'] ?>"><?php echo $question['name'] ?></a></b></li>
  <?php } ?>
</ol>
<h4><?php echo $msg ?></h4>
</body>
</html>
