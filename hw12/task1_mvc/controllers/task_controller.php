<?php
include_once 'models/task_model.php';
$taskModel = new Task($pdo);
$msg = '';
$userId = $_SESSION['user']['id'];
$desc = '';

if(isset($_GET['task'])) {
  $taskId = $_REQUEST['id'];
  if ($_GET['task'] === 'toggleDone') {
    $taskModel->toggleDone($taskId);
  }
  if ($_GET['task'] === 'delete') {
    $taskModel->taskDelete($taskId);
  }
  header('Location: index.php');
  exit;
}

if (isset($_POST['add'])) {
  $desc = htmlspecialchars($_POST['desc']);
  if (strlen($desc) < 3 && strlen($desc) > 500) {
    $msg = 'Описание задачи не может быть пустым и длиннее 500 символов';
  } else {
    $assignedUserId = strlen($_POST['user']) !== 0 ? $_POST['user'] : $userId;
    $result = $taskModel->taskDelete($userId, $desc, $assignedUserId);
    $msg = 'Задача успешно добавлена';
    $desc = '';
  }
}

if (isset($_POST['update'])) {
  $taskId = $_POST['update'];
  $assignedUserId = $_POST['assignedUserId'];
  $taskModel->taskUpdate($userId, $assignedUserId);
  $msg = 'Задача успешно обновлена';
}

$tasks = $taskModel->getList($userId);

include 'views/tasklist.php';
