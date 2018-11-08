<?php

// $pdo = new PDO("mysql:host=localhost;dbname=global;charset=UTF8", "root", "");
$pdo = new PDO("mysql:host=localhost;dbname=global;charset=UTF8", "mgladkih", "neto1853");

$sth = $pdo->query("SHOW TABLES LIKE 'cars'");
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

$sqlCreateTable = "
CREATE TABLE `cars` (
`id` int NOT NULL AUTO_INCREMENT,
`brand` varchar(15) NULL,
`model`varchar(15) NULL,
`color` varchar(30) NULL,
`power` tinyint NULL,
`price` int NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

if (count($result) === 0) {
  $sth = $pdo->query($sqlCreateTable);
  $result = $sth->fetchAll(PDO::FETCH_ASSOC);
}

$sth = $pdo->query("SHOW TABLES");
$tables = $sth->fetchAll(PDO::FETCH_ASSOC);


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>db</title>
</head>
<body>
<table>
  <?php foreach ($tables as $table): ?>
    <tr>
      <td><a href="table.php?name=<?php echo $table['Tables_in_global']?>"><?php echo $table['Tables_in_global']?></a></td>
    </tr>
  <?php endforeach; ?>
</table>

</body>
</html>

