<?php
include_once 'config.php';
session_start();
$pdo = new PDO(
  "mysql:host=localhost;dbname=global;charset=UTF8",
  DB_LOGIN,
  DB_PASS);


function render($template, $params = []) {
  $fileTemplate = 'views/' . $template;
  if (is_file($fileTemplate)) {
    ob_start();
    if (count($params) > 0) {
      extract($params);
    }
    include $fileTemplate;
    echo ob_get_clean();
  }
}

render('main.php');
include_once 'router.php';
include_once 'views/footer.php';
