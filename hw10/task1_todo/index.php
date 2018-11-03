<?php
session_start();
$isSignIn = true;
$msg = '';
if (isset($_GET['signup'])) {
  $isSignIn = false;
}

if (isset($_POST['login']) && isset($_GET['formSignup'])) {
  $login = $_POST['login'];
  $pass = $_POST['pass'];
  if (strlen($login) <= 3) {
    $msg = 'Логин должен быть не короче 3 символов' . "\n";
  } elseif (strlen($pass) <= 3) {
    $msg .= 'Пароль должен быть не короче 3 символов' . "\n";
  } else {
    $pdo = new PDO("mysql:host=localhost;dbname=global;charset=UTF8", "root", "");
    // $pdo = new PDO("mysql:host=localhost;dbname=global;charset=UTF8", "mgladkih", "neto1853");

    $sth = $pdo->query("SELECT id FROM user WHERE login='$login' LIMIT 1");
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) !== 0) {
      $msg = 'Пользователь с таким логином зарегистрирован';
    } else {
      $sql = "INSERT INTO user SET login='$login', password='$pass'";
      $sth = $pdo->query($sql);
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      $_SESSION['login'] = $login;
      header('Location: tasks.php');
      exit;
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
  <title>ToDo</title>
</head>
<body>
<header>
  <br>
  <?php if ($isSignIn): ?>
    <a href="index.php?signup">SignUp</a>
  <?php else: ?>
    <a href="index.php">SignIn</a>
  <?php endif; ?>
  <hr>
  <br>
</header>
<form action="index.php?<?php echo $isSignIn ? 'signin&formSignin' : 'signup&formSignup' ?>" method="post">
  <?php if ($isSignIn): ?>
    <h4>Форма авторизации</h4>
  <?php else: ?>
    <h4>Форма регистрации</h4>
  <?php endif; ?>
  <input type="text" name="login" placeholder="Login">
  <input type="text" name="pass" placeholder="Password">
  <button>Send</button>
</form>
<br>
<p><?php echo $msg ?></p>
</body>
</html>
