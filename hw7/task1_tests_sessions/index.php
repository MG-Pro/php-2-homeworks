<?php
session_start();
$msg = '';

if (isset($_POST['name'])) {
  $userName = $_POST['name'];
  if (strlen($userName) >= 2 && strlen($_POST['pas']) >= 2) {
    if (!file_exists(($userName . '.json'))) {
      header($_SERVER['SERVER_PROTOCOL'] . ' 401 Unauthorized');
      $msg = 'Нет такого пользователя! :(';
    } else {
      if (!isset($_SESSION['name']) || $_SESSION['role'] !== 'admin') {
        $file = file_get_contents($userName . '.json', true);
        $user = json_decode($file, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
          $msg = "Ошибка чтения данных о пользователе $userName!";
        } else {
          if ($user['name'] === $userName && $user['pas'] === $_POST['pas']) {
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['role'] = 'admin';
            header('Location: admin.php');
          } else {
            $msg = "Данные о пользователе $userName и пароль не совпадают!";
          }
        }
      } else {
        header('Location: admin.php');
      }
    }
  } else {
    $msg = 'Введите логин и пароль или войдите как гость';
  }
} elseif (isset($_POST['guestName'])) {
  $guestName = $_POST['guestName'];
  if (strlen($guestName) >= 2) {
    $_SESSION['name'] = $guestName;
    $_SESSION['role'] = 'guest';
    header('Location: list.php');
  } else {
    $msg = 'Введите гостевое имя';
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
  <title>Index</title>
</head>
<body>
<center>
  <form action="." method="post">
    <p><b>Форма авторизации</b></p>
    <label>Имя: <br>
      <input type="text" name="name">
    </label>
    <br><br>
    <label>
      Пароль: <br>
      <input type="password" name="pas">
    </label>
    <br><br>
    <button>Send</button>
  </form>
  <form action="." method="post">
    <p><b>Или войдите как гость</b></p>
    <label>Имя: <br>
      <input type="text" name="guestName" >
    </label>
    <br><br>
    <button>Send</button>
  </form>
  <p><b><?php echo $msg ?></b></p>
</center>
</body>
</html>

