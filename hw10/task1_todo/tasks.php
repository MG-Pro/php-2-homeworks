<?php
session_start();
if (isset($_GET['signout'])) {
  $_SESSION = [];
  header('Location: index.php');
  exit;
}
if (!isset($_SESSION['user']['login'])) {
  header($_SERVER['SERVER_PROTOCOL'] . ' 401 Unauthorized');
  exit;
}
$pdo = new PDO("mysql:host=localhost;dbname=global;charset=UTF8", "root", "");
// $pdo = new PDO("mysql:host=localhost;dbname=global;charset=UTF8", "mgladkih", "neto1853");

$sth = $pdo->query("SELECT id, login FROM user");
$users = $sth->fetchAll(PDO::FETCH_ASSOC);
$msg = '';
$userId = $_SESSION['user']['id'];

if (isset($_POST['add'])) {
  $desc = htmlspecialchars($_POST['desc']);
  if (strlen($desc) < 3 && strlen($desc) > 500) {
    $msg = 'Описание задачи не может быть пустым и длиннее 500 символов';
  } else {
    $assignedUserId = $_POST['user'];
    $sql = "INSERT INTO task SET user_id ='$userId', description='$desc', assigned_user_id='$assignedUserId', is_done=false, date_added=NOW()";
    $sth = $pdo->query($sql);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    $msg = 'Задача успешно добавлена';
    $desc = '';
  }
}

$sth = $pdo->query("SELECT date_added, description, is_done, assigned_user_id FROM task WHERE user_id='$userId' AND is_done=false ORDER BY date_added");
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
      padding: 3px;
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
  <?php if(count($tasks) > 0): ?>
  <table>
    <thead>
    <tr>
      <?php foreach ($tasks[0] as $key => $item): ?>
        <th><?php echo $key ?></th>
      <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task): ?>
      <tr>
        <?php foreach ($task as $value): ?>
          <td><?php echo $value ?></td>
        <?php endforeach; ?>
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
