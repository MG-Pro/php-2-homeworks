<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>List</title>
</head>
<body>
<form action="">
  <?php foreach ($data as $question) { ?>
    <p><b><?php echo $question['question'] ?></b></p>
    <?php foreach ($question['answers'] as $answer) { ?>
      <label>
        <input
          id="<?php echo $question['id'] ?>"
          type="radio"
          name="<?php echo 'question' . $question['id'] ?>"
          value="<?php echo $answer['answer'] ?>"
        >
        <?php echo $answer['answer'] ?>
      </label>
    <?php } ?>
    <br>
  <?php } ?>
  <button>Send</button>
</form>
</body>
</html>
