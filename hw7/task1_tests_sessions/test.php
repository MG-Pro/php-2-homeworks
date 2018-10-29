<?php
session_start();
if (isset($_SESSION['name']) && $_SESSION['role'] === 'admin') {
  $isAdmin = true;
} elseif (isset($_SESSION['name']) && $_SESSION['role'] === 'guest') {
  $isAdmin = false;
} else {
  header($_SERVER['SERVER_PROTOCOL'] . ' 401 Unauthorized');
  header('Location: index.php');
  exit;
}

$msg = '';
function getFileData($filename) {
  global $msg;
  if (!file_exists($filename)) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    exit('Файл с ланными отсутствует');
  }
  $json = file_get_contents(__DIR__ . "/tmp/$filename");
  if ($json === false) {
    $msg = 'Файл не найден';
    exit();
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

function findTrue($arr) {
  foreach ($arr as $item) {
    if ($item['isTrue']) {
      return $item;
    }
  }
  return false;
}

$resultStr = '';
$result = [];
$userName = 'Samebody';

if (array_key_exists('filename', $_GET)) {
  $data = getFileData($_GET['filename']);
} elseif (array_key_exists('filename', $_POST)) {
  $data = getFileData($_POST['filename']);
  $post = $_POST;
  unset($post['filename']);

  if (count($data) !== count($post) && !isset($post['name'])) {
    $msg = 'Выбраны не все ответы';
  } else {
    $userName = $_SESSION['name'];
    foreach ($post as $i => $userAnswer) {
      $trueAnswer = findTrue($data[ (int) $i - 1 ]['answers']);
      $result[] = [
        'question'   => $data[ (int) $i - 1 ]['question'],
        'userAnswer' => $userAnswer,
        'trueAnswer' => $trueAnswer['answer'],
        'isTrue'     => $userAnswer === $trueAnswer['answer'] ? 'true' : 'false'
      ];
      $resIndex = count($result) - 1;
      $resultStr .= 'Вопрос №' . $i . ': ' . $result[$resIndex]['isTrue'] . ';';
    }
    $data = [];
  }

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
<?php if (count($data) !== 0): ?>
  <form action="test.php" method="post">
    <input type="hidden" name="filename" value="<?php echo $_GET['filename'] ?>">
    <?php foreach ($data as $question) { ?>
      <p><b><?php echo $question['question'] ?></b></p>
      <?php foreach ($question['answers'] as $answer) { ?>
        <label>
          <input
            type="radio"
            name="<?php echo $question['id'] ?>"
            value="<?php echo $answer['answer'] ?>"
            required
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
<?php if (count($result) !== 0): ?>
  <h4>Результат</h4>
  <p>Имя: <b><?php echo $userName ?></b></p>
  <?php foreach ($result as $item) { ?>
    <span><b>Вопрос:</b> <?php echo $item['question'] ?></span> <br>
    <span><b>Результат:</b> <?php echo $item['isTrue'] ?></span>
    <div>
      <span><b>Ваш ответ:</b> <?php echo $item['userAnswer'] ?></span> <br>
      <span><b>Правильный ответ:</b> <?php echo $item['trueAnswer'] ?></span>
    </div>
    <hr>
  <?php } ?>
  <img src="img.php?name=<?php echo $userName?>&result=<?php echo $resultStr?>" alt="">
<?php endif; ?>
<h4><?php echo $msg ?></h4>
</body>
</html>
