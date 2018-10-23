<?php
$isLoaded = false;

if (count($_FILES) !== 0) {
  $file = $_FILES['file'];

  if ($file['type'] !== 'application/json') {
    exit('Загрузите файл в формате JSON');
  }

  $fileList = glob('*.json');
  var_dump($file);
  foreach ($fileList as $item) {
    if($item = $file['name']) {
      exit("Файл с именем $item уже записан");
    }
  }


  $res = move_uploaded_file($file['tmp_name'], __DIR__ . "/tmp/testList.json");

  if (!$res) {
    exit('Ошибка записи файла');
  } else {
    $isLoaded = true;
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
<?php if (!$isLoaded): ?>
  <form action="admin.php" enctype="multipart/form-data" method="post">
    <input type="file" name="file">
    <button>Send</button>
  </form>
<?php endif; ?>
<?php if ($isLoaded): ?>
  <h2><?php echo "Файл успешно загружен" ?></h2>
<?php endif; ?>
</body>
</html>
