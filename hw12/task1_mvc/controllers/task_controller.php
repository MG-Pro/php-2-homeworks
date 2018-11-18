<?php
include_once 'models/task_model.php';

class TaskController {
  private $msg = '';
  private $desc = '';
  private $taskModel;
  public function __construct($pdo) {
    $this->taskModel = new Task($pdo);
  }
  public function getTaskList($userId, $users) {
    $tasks = $this->taskModel->getList($userId);
    render('tasklist.php', ['tasks'=>$tasks, 'users'=>$users, 'msg'=> $this->msg, 'desc' => $this->desc]);
  }
  public function toggleDone($userId, $taskId, $users) {
    $this->taskModel->toggleDone($taskId);
    $this->getTaskList($userId, $users);
  }
  public function taskDelete($userId, $taskId, $users) {
    $this->taskModel->taskDelete($taskId);
    $this->msg = 'Задача удалена';
    $this->getTaskList($userId, $users);
  }
  public function addTask($userId, $users) {
      $this->desc = htmlspecialchars($_POST['desc']);
      $descLen = strlen($this->desc);
      if ($descLen < 3 || $descLen > 500) {
        $this->msg = 'Описание задачи не может быть пустым и длиннее 500 символов';
        $this->getTaskList($userId, $users);
      } else {
        $assignedUserId = strlen($_POST['user']) !== 0 ? $_POST['user'] : $userId;
        $this->taskModel->addTask($userId, $this->desc, $assignedUserId);
        $this->msg = 'Задача успешно добавлена';
        $this->desc = '';
        $this->getTaskList($userId, $users);
      }
  }
  public function updateTask($userId, $users) {
    $taskId = $_POST['update'];
    $assignedUserId = $_POST['assignedUserId'];
    $this->taskModel->taskUpdate($taskId, $assignedUserId);
    $this->msg = 'Задача успешно обновлена';
    $this->getTaskList($userId, $users);
  }
}









