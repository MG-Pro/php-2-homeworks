<?php
session_start();
if (isset($_GET['signout'])) {
  $_SESSION = [];
  header('Location: index.php');
  exit;
}
if (!isset($_SESSION['user']['login'])) {
  header($_SERVER['SERVER_PROTOCOL'] . ' 401 Unauthorized');
  exit();
}
// $pdo = new PDO("mysql:host=localhost;dbname=global;charset=UTF8", "root", "");
$pdo = new PDO("mysql:host=localhost;dbname=global;charset=UTF8", "mgladkih", "neto1853");

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

$sth = $pdo->query("SELECT id, login FROM user");
$users = $sth->fetchAll(PDO::FETCH_ASSOC);
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

$sth = $pdo->query($sqlTaskList);
$tasks = $sth->fetchAll(PDO::FETCH_ASSOC);


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tasks</title>
  <style>
    table {
      border: 1px solid;
      border-collapse: collapse;
    }
    td, th {
      border: 1px solid;
      padding: 3px 5px;
    }
    form {
      margin: 0;
    }
  </style>
</head>
<body>
<header>
  <br>
  <div>
    <span><?php echo $_SESSION['user']['login'] ?></span>
    (<a href="tasks.php?signout">выйти</a>)
  </div>
  <hr>
</header>
<form action="tasks.php" method="post">
  <fieldset>
    <legend>Новая задача</legend>
    <label>
      Описание задачи: <br>
      <textarea name="desc" cols="30" rows="5"><?php echo $desc ?></textarea>
    </label>
    <label>
      Кому назначить:
      <select name="user">
        <option value="">Не выбран</option>
        <?php foreach ($users as $user): ?>
          <option value="<?php echo $user['id'] ?>">
            <?php echo $user['login'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <br>
    <button name="add">Сохранить</button>
  </fieldset>
</form>
<p><?php echo $msg ?></p>
<hr>
<main>
  <h3>Список задач</h3>
  <?php if (count($tasks) > 0): ?>
    <table>
      <thead>
      <tr>
        <th>Дата добавления</th>
        <th>Описание</th>
        <th>Выполнение</th>
        <th>Исполнитель</th>
        <th>Делегировать</th>
        <th>Действия</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($tasks as $task): ?>
        <tr>
          <?php foreach ($task as $key => $value): ?>
            <?php if ($key === 'id') continue; ?>
            <td>
              <?php
              if ($key === 'date_added') {
                echo date('d.m.Y H:i', strtotime($value));
              } elseif ($key === 'is_done') {
                $str = $value === '0' ? 'Выполнить' : 'Невыполнено';
                $taskId = $task['id'];
                echo "<a href='tasks.php?toggleDone=$taskId'>$str</a>";
              } else {
                echo $value;
              }
              ?>
            </td>
          <?php endforeach; ?>
          <td>
            <form action="tasks.php" method="post">
              <input type="hidden" name="taskId" value="<?php echo $taskId ?>">
              <select name="assignedUserId">
                <?php foreach ($users as $user): ?>
                  <option value="<?php echo $user['id'] ?>">
                    <?php echo $user['login'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <button>Изменить</button>
            </form>
          </td>
          <td>
            <a href="tasks.php?delete=<?php echo $taskId ?>">Удалить</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Пока нет задач</p>
  <?php endif; ?>
</main>
</body>
</html>
