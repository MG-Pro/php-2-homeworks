<?php
include_once 'config.php';
session_start();
$pdo = new PDO(
  "mysql:host=localhost;dbname=global;charset=UTF8",
  DB_LOGIN,
  DB_PASS);

include_once 'views/main.php';
include_once 'controllers/user_controller.php';
include_once 'views/footer.php';
