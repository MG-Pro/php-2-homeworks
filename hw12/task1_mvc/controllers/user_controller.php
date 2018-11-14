<?php
$msg = '';
if (isset($_GET['signout'])) {
  $_SESSION = [];
}
include_once 'models/user_model.php';
$userModel = new User($pdo);

if (isset($_SESSION['user']['login'])) {
  $users = $userModel->getList();
  include 'controllers/task_controller.php';
} elseif (isset($_POST['signin']) || isset($_POST['signup'])) {
  $login = $_POST['login'];
  $pass = $_POST['pass'];

  if (isset($_POST['signup'])) {
    if (strlen($login) < 3) {
      $msg = 'Логин должен быть не короче 3 символов' . "\n";
    } elseif (strlen($pass) < 3) {
      $msg .= 'Пароль должен быть не короче 3 символов' . "\n";
    } else {
      $result = $userModel->checkLogin($login);
      if (count($result) !== 0) {
        $msg = 'Пользователь с таким логином уже зарегистрирован';
      } else {
        $userId = $userModel->signUp($login, $pass);
        $_SESSION['user'] = ['login' => $login, 'id' => $result[0]['@@IDENTITY']];
        $users = $userModel->getList();
        include 'controllers/task_controller.php';
      }
    }
  } elseif (isset($_POST['signin'])) {
    $user = $userModel->signIn($login, $pass);
    if (count($user) === 0) {
      $msg = 'Неверный логин или пароль';
    } else {
      $_SESSION['user'] = $user[0];
      $users = $userModel->getList();
      include 'controllers/task_controller.php';
    }
  }
} elseif (isset($_GET['user'])) {
  if ($_GET['user'] === 'signup') {
    include 'views/signup.php';
  } elseif ($_GET['user'] === 'signin') {
    include 'views/signin.php';
  }
} else {
  include 'views/signin.php';
}
