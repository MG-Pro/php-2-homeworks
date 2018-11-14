<?php
class Task {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  private function request($sql) {
    return $this->pdo->query($sql);
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
    WHERE t.user_id='$userId'
    ORDER BY t.date_added";

    return $this->request($sqlTaskList)->fetchAll(PDO::FETCH_ASSOC);
  }


}
