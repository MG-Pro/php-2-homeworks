<?php
class Task {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  private function request($sql) {
    return $this->pdo->query($sql);
  }
  public function toggleDone($taskId) {
    $sqlDoneToggle = "UPDATE task SET is_done=NOT is_done WHERE id=$taskId LIMIT 1";
    return $this->request($sqlDoneToggle)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function taskDelete($taskId) {
    $sqlDelTask = "DELETE FROM task WHERE id=$taskId LIMIT 1";
    return $this->request($sqlDelTask)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function addTask($userId, $desc, $assignedUserId) {
    $sqlAddTask = "
    INSERT INTO task 
    SET 
      user_id ='$userId', 
      description='$desc', 
      assigned_user_id='$assignedUserId', 
      is_done=false, 
      date_added=NOW()";
    return $this->request($sqlAddTask)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function taskUpdate($taskId, $assignedUserId) {
    $sqlChangeUser = "
    UPDATE task 
    SET assigned_user_id=$assignedUserId 
    WHERE id=$taskId 
    LIMIT 1";
    return $this->request($sqlChangeUser)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getList($userId) {
    $sqlTaskList = "
    SELECT 
      t.id as id, 
      t.date_added as date_added, 
      t.description as description, 
      t.is_done as is_done, 
      u.login as login 
    FROM task t 
    JOIN user u 
    ON t.assigned_user_id=u.id 
    WHERE t.user_id='$userId' OR t.assigned_user_id=$userId
    ORDER BY t.date_added";
    return $this->request($sqlTaskList)->fetchAll(PDO::FETCH_ASSOC);
  }
}
