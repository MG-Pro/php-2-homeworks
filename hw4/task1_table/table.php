<?php
define("URL", 'http://jsonplaceholder.typicode.com/users');

$users = file_get_contents(URL);
$users = json_decode($users, true);

if (json_last_error() !== JSON_ERROR_NONE) {
  exit('Ошибка данных!');
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<table>
  <?php foreach ($users as $user) { ?>
    <tr>
      <td><?php echo $user['id']; ?></td>
      <td><?php echo $user['name']; ?></td>
      <td><?php echo $user['phone']; ?></td>
      <td><?php echo $user['address']['city'] . ', ' . $user['address']['street'] . ', ' . $user['address']['suite']; ?></td>
    </tr>
  <?php } ?>
</table>
</body>
</html>
