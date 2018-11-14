<?php
include_once 'models/task_model.php';
$taskModel = new Task($pdo);

if (isset($_GET['toggleDone'])) {
  $taskId = $_GET['toggleDone'];
  $sqlDoneToggle = "UPDATE task SET is_done=NOT is_done WHERE id=$taskId LIMIT 1";
  $sth = $pdo->query($sqlDoneToggle);
  $sth->fetchAll(PDO::FETCH_ASSOC);
  header('Location: tasks.php');
  exit;
}

if (isset($_GET['delete'])) {
  $taskId = $_GET['delete'];
  $sqlDelTask = "DELETE FROM task WHERE id=$taskId LIMIT 1";
  $sth = $pdo->query($sqlDelTask);
  $sth->fetchAll(PDO::FETCH_ASSOC);
  header('Location: tasks.php');
  exit;
}

$msg = '';
$userId = $_SESSION['user']['id'];
$desc = '';

if (isset($_POST['add'])) {
  $desc = htmlspecialchars($_POST['desc']);
  if (strlen($desc) < 3 && strlen($desc) > 500) {
    $msg = 'Описание задачи не может быть пустым и длиннее 500 символов';
  } else {
    $assignedUserId = strlen($_POST['user']) !== 0 ? $_POST['user'] : $userId;
    $sqlAddTask = "INSERT INTO task SET user_id ='$userId', description='$desc', assigned_user_id='$assignedUserId', is_done=false, date_added=NOW()";
    $sth = $pdo->query($sqlAddTask);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    $msg = 'Задача успешно добавлена';
    $desc = '';
    header('Location: tasks.php');
    exit;
  }
}

if (isset($_POST['assignedUserId'])) {
  $taskId = $_POST['taskId'];
  $assignedUserId = $_POST['assignedUserId'];
  $sqlChangeUser = "
  UPDATE task 
  SET assigned_user_id=$assignedUserId 
  WHERE id=$taskId 
  LIMIT 1";
  $sth = $pdo->query($sqlChangeUser);
  $sth->fetchAll(PDO::FETCH_ASSOC);
  header('Location: tasks.php');
  exit;
}

$tasks = $taskModel->getList($userId);

include 'views/tasklist.php';
