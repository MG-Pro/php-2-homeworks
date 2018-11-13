<?php

if (isset($_SESSION['user']['login'])) {
  header('Location: tasks.php');
  exit;
}
$msg = '';
if (isset($_GET['action'])) {
  if ($_GET['action'] === 'signup') {
    include 'views/signup.php';
  } elseif ($_GET['action'] === 'signin') {
    include 'views/signin.php';
  }


  if (isset($_POST['action'])) {


    $login = $_POST['login'];
    $pass = $_POST['pass'];
    if (strlen($login) < 3) {
      $msg = 'Логин должен быть не короче 3 символов' . "\n";
    } elseif (strlen($pass) < 3) {
      $msg .= 'Пароль должен быть не короче 3 символов' . "\n";
    } else {

      if (isset($_GET['formSignup'])) {
        $sth = $pdo->query("SELECT id FROM user WHERE login='$login' LIMIT 1");
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) !== 0) {
          $msg = 'Пользователь с таким логином уже зарегистрирован';
        } else {
          $sql = "INSERT INTO user SET login='$login', password='$pass'";
          $sth = $pdo->query($sql);
          $result = $sth->fetchAll(PDO::FETCH_ASSOC);
          $sth = $pdo->query("SELECT @@IDENTITY");
          $result = $sth->fetchAll(PDO::FETCH_ASSOC);
          $_SESSION['user'] = ['login' => $login, 'id' => $result[0]['@@IDENTITY']];
          header('Location: tasks.php');
          exit;
        }
      } elseif (isset($_GET['formSignin'])) {
        $sql = "SELECT id, login FROM user WHERE login='$login' AND password='$pass' LIMIT 1";
        $sth = $pdo->query($sql);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) === 0) {
          $msg = 'Неверный логин или пароль';
        } else {
          $_SESSION['user'] = $result[0];
          header('Location: tasks.php');
          exit;
        }
      }
    }
  }

} else {
  include 'views/signin.php';
}
