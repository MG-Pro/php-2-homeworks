<?php

$msg = '';
$pdo = null;

if (isset($_GET['name'])) {
  $tableName = $_GET['name'];
  // $pdo = new PDO("mysql:host=localhost;dbname=global;charset=UTF8", "root", "");
$pdo = new PDO("mysql:host=localhost;dbname=global;charset=UTF8", "mgladkih", "neto1853");


}

if (isset($_GET['delete'])) {
  $field = $_GET['delete'];
  $sqlDelField = "ALTER TABLE $tableName DROP COLUMN $field";
  $sth = $pdo->query($sqlDelField);
  $fields = $sth->fetchAll(PDO::FETCH_ASSOC);
  header("Location: table.php?name=$tableName");
  exit;
}

if (isset($_POST['changeType'])) {
  $type = $_POST['type'];
  if(strlen($type) < 3) {
    $msg = 'Error: Empty type!';
  } else {
    $field = $_POST['changeType'];
    $sqlDelField = "ALTER TABLE $tableName MODIFY $field $type";
    $sth = $pdo->query($sqlDelField);
    $sth->fetchAll(PDO::FETCH_ASSOC);
    header("Location: table.php?name=$tableName");
    exit;
  }
}

if (isset($_POST['changeName'])) {
  $name = $_POST['name'];
  if(strlen($name) < 3) {
    $msg = 'Error: Empty name!';
  } else {
    $field = $_POST['changeName'];
    $sqlDelField = "ALTER TABLE $tableName CHANGE $field $name VARCHAR(50)";
    $sth = $pdo->query($sqlDelField);
    $sth->fetchAll(PDO::FETCH_ASSOC);
    header("Location: table.php?name=$tableName");
    exit;
  }
}

if($pdo !== null) {
  $sqlFields = "DESCRIBE `$tableName`";
  $sth = $pdo->query($sqlFields);
  $fields = $sth->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo "Table: $tableName" ?></title>
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
<h3><?php echo $tableName ?></h3>
<p><?php echo $msg?></p>
<hr>
<table>
  <thead>
  <tr>
    <th>Name</th>
    <th>Type</th>
    <th>Change name</th>
    <th>Change type</th>
    <th>Delete</th>
  </tr>
  </thead>
  <?php foreach ($fields as $item): ?>
    <tr>
      <?php foreach ($item as $key => $field): ?>
        <?php if ($key !== 'Field' && $key !== 'Type') {
          continue;
        } ?>
        <td><?php echo $field ?></td>
      <?php endforeach; ?>
      <td>
        <form action="table.php?name=<?php echo $tableName ?>" method="post">
          <input type="hidden" name="changeName" value="<?php echo $item['Field'] ?>">
          <input type="text" name="name" placeholder="Name">
          <button>OK</button>
        </form>
      </td>
      <td>
        <form action="table.php?name=<?php echo $tableName ?>" method="post">
          <input type="hidden" name="changeType" value="<?php echo $item['Field'] ?>">
          <input type="text" name="type" placeholder="Type">
          <button>OK</button>
        </form>
      </td>
      <td><a href="table.php?delete=<?php echo $item['Field'] . "&name=$tableName" ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
