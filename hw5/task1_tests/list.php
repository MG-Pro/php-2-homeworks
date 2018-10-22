<?php


$json = file_get_contents(__DIR__  . "/tmp/testList.json");

$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
  exit('Не валидный JSON!');
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
  <ol>
  <?php foreach ($data as $question) { ?>
    <li><b><a href="test.php&id=<?php echo $question['id'] ?>"><?php echo $question['question'] ?></a></b></li>
  <?php } ?>
  </ol>
</body>
</html>
