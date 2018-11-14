<?php
class User {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  private function request($sql) {
    return $this->pdo->query($sql);
  }
  public function getList() {
    $sqlUserList = "SELECT id, login FROM user";
    return $this->request($sqlUserList)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function signIn($login, $pass) {
    $sqlSignIn = "SELECT id, login FROM user WHERE login='$login' AND password='$pass' LIMIT 1";
    return $this->request($sqlSignIn)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function signUp($login, $pass) {
    $sqlSignUp = "INSERT INTO user SET login='$login', password='$pass'";
    $sqlLastUserId = "SELECT @@IDENTITY";
    $this->request($sqlSignUp)->fetchAll(PDO::FETCH_ASSOC);
    return $this->request($sqlLastUserId)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function checkLogin($login) {
    $sqlCheckLogin = "SELECT id FROM user WHERE login='$login' LIMIT 1";
    return $this->request($sqlCheckLogin)->fetchAll(PDO::FETCH_ASSOC);
  }
}
