<?php
header('Location: /list.php');
exit;

$file = $_FILES['file'];
print_r($file);
if ($file['type'] !== 'application/json') {
  exit('Загрузите файл в формате JSON');
}

$res = move_uploaded_file($file['tmp_name'], __DIR__  . "/tmp/testList.json");

if(!$res) {
  exit('Ошибка записи файла');
} else {
  header('Location: /list.php');
  exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin</title>
</head>
<body>
<form action="list.php" enctype="multipart/form-data" method="post">
  <input type="file" name="file">
  <button>Send</button>
</form>
</body>
</html>
