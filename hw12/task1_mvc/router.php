<?php
include_once 'controllers/user_controller.php';
include_once 'controllers/task_controller.php';
$userController = new UserController($pdo);
$taskController = new TaskController($pdo);

if (isset($_GET['user'])) {
  if ($_GET['user'] === 'signout') {
    $userController->signOut();
    $userController->signIn();
  } elseif ($_GET['user'] === 'signup') {
    $userController->signUp();
  } elseif ($_GET['user'] === 'signin') {
    $userController->signIn();
  }
}
elseif (isset($_GET['task'])) {
  $taskId = $_REQUEST['id'];
  $users = $userController->getUserList();
  if ($_GET['task'] === 'toggleDone') {
    $taskController->toggleDone($_SESSION['user']['id'], $taskId, $users);
  }
  if ($_GET['task'] === 'delete') {
    $taskController->taskDelete($_SESSION['user']['id'], $taskId, $users);
  }
}
elseif (isset($_POST['add'])) {
  $users = $userController->getUserList();
  $taskController->addTask($_SESSION['user']['id'], $users);
}
elseif (isset($_POST['update'])) {
  $users = $userController->getUserList();
  $taskController->updateTask($_SESSION['user']['id'], $users);
}
elseif (isset($_SESSION['user']['login'])) {
  $users = $userController->getUserList();
  $taskController->getTaskList($_SESSION['user']['id'], $users);
}
elseif (isset($_POST['signin']) || isset($_POST['signup'])) {
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
else {
  $userController->signIn();
}

