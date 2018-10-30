<?php

class Machine {
  public $color;
  private $type;

  public function __construct($color) {
    $this->color = $color;
  }

  public function setType($type) {
    $this->type = $type;
  }
}

$terminator = new Machine('silver');
$terminator->setType('cyborg');

$crane = new Machine('red');
$crane->setType('crane');

class Television {
  private $brand;
  private $size;
  public $price = 0;


  public function __construct($brand, $size) {
    $this->brand = $brand;
    $this->size = $size;
  }

  public function getInfo() {
    if ($this->price === 0) {
      echo 'Цена не указана' . "\n";
    } else {
      echo "$this->brand, $this->size, $this->price" . "\n";
    }
  }
}

$lg = new Television('LG', '42 in');
$lg->getInfo();

$samsung = new Television('Samsung', '108 in');
$samsung->price = 500000;
$samsung->getInfo();

class Pen {
  private $color = null;

  public function setColor($color) {
    $this->color = $color;
  }

  public function getColor() {
    return $this->color;
  }
}

class Ballpen extends Pen {
  private $inkLevel;

  public function __construct($inkLevel) {
    $this->inkLevel = $inkLevel;
  }

  public function getInfo() {
    $color = $this->getColor();
    echo "$color, $this->inkLevel" . "\n";
  }
}

$redPen = new Ballpen(20);
$redPen->setColor('red');
$redPen->getInfo();

$blackPen = new Ballpen(100);
$blackPen->getInfo();


class Duck {
  private $gender;
  private $state = 'alive';

  public function __construct($gender) {
    $this->gender = $gender;
  }

  public function changeGender() {
    echo 'Утки не могут менять пол' . "\n";
  }

  public function killDuck() {
    $this->state = 'dead';
    echo "Duck is $this->state" . "\n";
  }
}

$maleDuck = new Duck('male');
$maleDuck->changeGender();

$femaleDuck = new Duck('female');
$femaleDuck->killDuck();


class Product {
  private $category;
  private $name;
  private $price;
  public $count;

  private function totalSum() {
    return $this->count * $this->price;
  }

  public function __construct($cat, $name, $price) {
    $this->category = $cat;
    $this->name = $name;
    $this->price = $price;
  }

  public function getTotal() {
    if($this->count !== null) {
      echo $this->totalSum() . "\n";
    } else {
      echo 'Не указано количество' . "\n";
    }
  }
}

$iPhone = new Product('phones', 'iPhone', 70000);
$iPhone->count = 10;
$iPhone->getTotal();

$pencil = new Product('stationery', 'pencil', 50);
$pencil->getTotal();
