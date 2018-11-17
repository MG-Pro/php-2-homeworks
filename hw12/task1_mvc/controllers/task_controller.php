<?php
include_once 'models/task_model.php';

class TaskController {
  public $msg = '';
  private $desc = '';
  private $taskModel;
  public function __construct($pdo) {
    $this->taskModel = new Task($pdo);

  }
  public function getTaskList($userId, $users) {
    $tasks = $this->taskModel->getList($userId);
    render('tasklist.php', ['tasks'=>$tasks, 'users'=>$users, 'msg'=> $this->msg]);
  }
  public function toggleDone($taskId) {
    $this->taskModel->toggleDone($taskId);
  }
  public function taskDelete($taskId) {
    $this->taskModel->taskDelete($taskId);
  }
  public function addTask($taskId, $desc) {
    $this->taskModel->addTask($taskId, $desc);
  }
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


