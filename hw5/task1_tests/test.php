<?php
$msg = '';

function getFileData($filename) {
  global $msg;
  $json = file_get_contents(__DIR__  . "/tmp/$filename");
  if($json === false) {
     $msg = 'Файл не найден';
  } else {
    $jsonData = json_decode($json, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      $msg = "Не валидный JSON ($filename)!";
    } else {
      return $jsonData['questions'];
    }
  }
  return [];
}


if(array_key_exists('filename', $_GET)) {
  $data = getFileData($_GET['filename']);
} else if(array_key_exists('filename', $_POST)) {
  $data = getFileData($_POST['filename']);
  var_dump($_POST);
} else {
  $msg = 'Нет данных';
  $data = [];
}


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Test</title>
</head>
<body>
<?php if(count($data) !== 0):?>
<form action="test.php" method="post">
  <input type="hidden" name="fileName" value="<?php $_GET['filename'] ?>">
  <?php foreach ($data as $question) { ?>
    <p><b><?php echo $question['question'] ?></b></p>
    <?php foreach ($question['answers'] as $answer) { ?>
      <label>
        <input
          id="<?php echo $question['id'] ?>"
          type="radio"
          name="<?php echo 'answer' . $question['id'] ?>"
          value="<?php echo $answer['answer'] ?>"
        >
        <?php echo $answer['answer'] ?>
      </label>
    <?php } ?>
    <br>
  <?php } ?>
  <br>
  <button>Send</button>
</form>
<?php endif; ?>
<h4><?php echo $msg ?></h4>
</body>
</html>
