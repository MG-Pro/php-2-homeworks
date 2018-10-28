<?php
session_start();

if (isset($_SESSION['name']) && $_SESSION['name'] === 'admin') {
  $isAdmin = true;
} elseif (isset($_SESSION['name'])) {
  $isAdmin = false;
} else {
  header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
  header('Location: index.php');
  exit;
}

$msg = '';

if (isset($_GET['delFileName']) && $isAdmin) {
  $fileName = $_GET['delFileName'];
  if (!file_exists($fileName)) {
    $msg = 'Файл ненайден';
  } else {
    $res = unlink($fileName);
    if($res) {
      $msg = 'Файл с тестом успешно удален';
    } else {
      $msg = 'Ошибка при удалении';
    }
  }
}

$fileList = glob('tmp/*.json');

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
  <?php if ($isAdmin) : ?>
    <a href="admin.php">Загрузка тестов</a>
  <?php endif; ?>
</header>
<hr>
<ol>
  <?php foreach ($data as $question) { ?>
    <li>
      <form action=".">
        <b><a href="test.php?filename=<?php echo $question['fileName'] ?>"><?php echo $question['name'] ?></a></b>
        <?php if ($isAdmin) : ?>
          <input type="hidden" name="delFileName" value="<?php echo $question['fileName'] ?>">
          <button type="submit">X</button>
        <?php endif; ?>
      </form>
    </li>
  <?php } ?>
</ol>
<h4><?php echo $msg ?></h4>
</body>
</html>
