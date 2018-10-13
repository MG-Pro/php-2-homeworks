<?php
$name = 'Batman';
$age = 33;
$email = 'gg@hrbr.mc';
$city = 'Gotem';
$bio = 'Full-stack developer'
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
<h3>Страница пользователя <?php echo $name ?></h3>
<b>Имя</b>
<dd><?php echo $name ?></dd>
<b>Возраст</b>
<dd><?php echo $age ?></dd>
<b>Адрес электронной почты</b>
<dd><?php echo $email ?></dd>
<b>Город</b>
<dd><?php echo $city ?></dd>
<b>О себе</b>
<dd><?php echo $bio ?></dd>
</body>
</html>

