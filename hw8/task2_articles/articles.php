<?php

class Article {
  private $text;
  private $author;
  private $date;
  private $comments;

  private function setDate() {
    return date('Y-m-d H:i:s');
  }

  public function setArticle($author, $text) {
    $this->author = $author;
    $this->text = $text;
    $this->date = $this->setDate();
  }

  public function printArticle() {
    echo "<h2>$this->author</h2>";
    echo "<p>$this->text</p>";
    echo "<p>$this->date</p>";

  }

  public function getComments($comments) {
    foreach ($comments->getComments() as $comment) {
      $user = $comment['user'];
      $text = $comment['text'];
      $date = $comment['date'];
      echo "<h4>$user</h4>";
      echo "<p>$text</p>";
      echo "<p>$date</p>";
    }

  }
}

class Comments {
  private $items = [];

  public function setComment($item, $user) {
    $comment['text'] = $item;
    $comment['user'] = $user;
    $comment['date'] = date('Y-m-d H:i:s');
    $this->items[] = $comment;
  }

  public function getComments() {
    return $this->items;
  }
}

$comments1 = new Comments();
$comments1->setComment('fficia porro reiciendis sunt, temporibus vel volistinctio dolorum facere facilis hic id ipsam laborum laudantium necessitatibus, nemo neque ', 'user1');

$comments1->setComment('fficia poribus vel voluptate. Ab ad animi blanditiis deleniti distinctio dolorum facere facilis hic id ipsam laborum laudantium necessitatibus, nemo neque ', 'user2');

$comments1->setComment('fficia porro reiciendis sunt, temporibus vel voluptate. Ab ad animi blanditiis deleniti distinctio dolorum facere facilis hic id ipsam laborum laudantium necessitatibus, nemo neque ', 'user3');

$comments1->setComment('ciendis sunt, temporibus vel voluptaere facilis hic id ipsam laborum laudantium necessitatibus, nemo neque ', 'user4');


$articles = [];

$article1 = new Article();
$article1->setArticle('Author1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aperiam debitis doloribus ducimus fugit iste laudantium rerum suscipit vel vitae.');
$articles[] = $article1;


$article2 = new Article();
$article2->setArticle('Author2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est laborum, quidem. Commodi dicta ea, eum facere fugit ipsam, iste laboriosam magnam necessitatibus officia porro reiciendis sunt, temporibus vel voluptate. Ab ad animi blanditiis deleniti distinctio dolorum facere facilis hic id ipsam laborum laudantium necessitatibus, nemo neque optio reprehenderit, vitae. Ipsa.');
$articles[] = $article2;

$article3 = new Article();
$article3->setArticle('Author3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus atque commodi, consequatur cumque debitis dignissimos ducimus ea eligendi eos est excepturi facere id iure iusto libero magnam maiores minima minus modi neque nesciunt nisi odit placeat quaerat quia recusandae reiciendis repellat sequi veniam? Architecto distinctio doloribus impedit laboriosam nemo numquam perferendis perspiciatis tempora! Adipisci animi at aut blanditiis commodi debitis delectus doloribus ea, eius eos eveniet facere facilis laudantium magnam necessitatibus optio provident quas quibusdam rem repudiandae saepe temporibus voluptas voluptatem. Accusantium architecto atque distinctio eligendi, eos exercitationem quibusdam reprehenderit sit sunt voluptas? Atque beatae in natus omnis similique?');
$articles[] = $article3;

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Articles</title>
</head>
<body>
<?php foreach ($articles as $article) {
  $article->printArticle();
  echo '<p><b>Comments</b></p>';
  $article->getComments($comments1);
}
?>
</body>
</html>
