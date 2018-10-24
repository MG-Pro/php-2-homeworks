<?php
$msg = '';
if (count($_FILES) !== 0) {
  $file = $_FILES['file'];
  $name = $file['name'];

  if ($file['type'] !== 'application/json') {
    $msg = 'Загрузите файл в формате JSON';
  }

  function find($arr, $str) {
    foreach ($arr as $value) {
      $isInc = strpos(basename($value), $str);
      if($isInc !== false) {
        return true;
      }
    }
    return false;
  }

  $fileList = glob('tmp/*.json');
  if(find($fileList, $file['name'])) {
    $msg = "Файл с именем $name уже записан";
  } else {
    $res = move_uploaded_file($file['tmp_name'], __DIR__ . "/tmp/" . $file['name']);
    if (!$res) {
      $msg = 'Ошибка записи файла';
    } else {
      $msg = "Файл $name успешно загружен";
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
  <title>Admin</title>
</head>
<body>
  <form action="admin.php" enctype="multipart/form-data" method="post">
    <input type="file" name="file">
    <button>Send</button>
  </form>
  <h4><?php echo $msg ?></h4>
</body>
</html>
