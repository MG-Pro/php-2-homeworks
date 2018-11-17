<?php
include_once 'controllers/user_controller.php';
include_once 'controllers/task_controller.php';
$userController = new UserController($pdo);
$taskController = new TaskController($pdo);


if (isset($_GET['user'])) {
  if ($_GET['user'] === 'signout') {
    $userController->signOut();
  } elseif ($_GET['user'] === 'signup') {
    $userController->signUp();
  } elseif ($_GET['user'] === 'signin') {
    $userController->signIn();
  }

} elseif (isset($_GET['task'])) {
  $taskId = $_REQUEST['id'];
  if ($_GET['task'] === 'toggleDone') {
    $taskController->toggleDone($taskId);
  }
  if ($_GET['task'] === 'delete') {
    $taskController->taskDelete($taskId);
  }
  header('Location: index.php');
  exit;
} else {
  $userController->signIn();
}

if (isset($_SESSION['user']['login'])) {
  $users = $userController->getUserList();
  $taskController->getTaskList($_SESSION['user']['id'], $users);
} elseif (isset($_POST['signin']) || isset($_POST['signup'])) {
  $login = $_POST['login'];
  $pass = $_POST['pass'];
  if (isset($_POST['signup'])) {
    $userId = $userController->signUp($login, $pass);
    if ($userId !== false) {
      $users = $userController->getUserList();
      $taskController->getTaskList($_SESSION['user']['id'], $users);
    }
  } elseif (isset($_POST['signin'])) {
    $userId = $userController->signIn($login, $pass);
    if ($userId !== false) {
      $users = $userController->getUserList();
      $taskController->getTaskList($_SESSION['user']['id'], $users);
    }
  }
}

