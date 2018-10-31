<?php
$pdo = new PDO("mysql:host=localhost;dbname=global;charset=UTF8", "root", "");

$author = $_GET['author'] ? $_GET['author'] : '%';
$name = $_GET['name'] ? $_GET['name'] : '%';
$isbn = $_GET['isbn'] ? $_GET['isbn'] : '%';

if($_GET['author']) {
  $_GET['author'];
}

$sql = "SELECT * FROM books WHERE author=$author AND name=$name AND isbn=$isbn";
$sth = $pdo->query($sql);
$result = $sth->fetchAll(PDO::FETCH_ASSOC);


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
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
<form method="GET" action=".">
  <input type="text" name="isbn" placeholder="ISBN" value="">
  <input type="text" name="name" placeholder="Название книги" value="">
  <input type="text" name="author" placeholder="Автор книги" value="">
  <input type="submit" value="Поиск">
</form>
<br><br>
<table>
  <tr>
    <th>№</th>
    <th>Название</th>
    <th>Автор</th>
    <th>Год выпуска</th>
    <th>ISBN</th>
    <th>Жанр</th>
  </tr>
  <?php foreach ($result as $row) { ?>
    <tr>
      <?php
      foreach ($row as $cell) {
        echo "<td>$cell</td>";
      }
      ?>
    </tr>
  <?php } ?>
</table>
</body>
</html>
