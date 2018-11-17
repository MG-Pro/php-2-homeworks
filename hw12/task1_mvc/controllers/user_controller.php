<?php

include_once 'models/user_model.php';

class UserController {

  public $msg = '';
  private $userModel;
  public function __construct($pdo) {
    $this->userModel = new User($pdo);
  }

  public function signIn($login = null, $pass = null) {
    if ($login !== null) {
      $user = $this->userModel->signIn($login, $pass);
      if (count($user) === 0) {
        $this->msg = 'Неверный логин или пароль';
        render('signin.php', ['msg'=> $this->msg]);
      } else {
        $_SESSION['user'] = $user[0];
        return $user[0]['id'];
      }
    } else {
      render('signin.php', ['msg' => $this->msg]);
    }
    return false;
  }
  public function signOut() {
    $_SESSION = [];
  }
  public function signUp($login = null, $pass = null) {
    if($login !== null) {
      if (strlen($login) < 3) {
        $this->msg = 'Логин должен быть не короче 3 символов' . "\n";
        render('signup.php', ['msg' => $this->msg]);
      } elseif (strlen($pass) < 3) {
        $this->msg .= 'Пароль должен быть не короче 3 символов' . "\n";
        render('signup.php', ['msg' => $this->msg]);
      } else {
        $result = $this->userModel->checkLogin($login);
        if (count($result) !== 0) {
          $this->msg = 'Пользователь с таким логином уже зарегистрирован';
          render('signup.php', ['msg' => $this->msg]);
        } else {
          $res = $this->userModel->signUp($login, $pass);
          $userId = $res[0]["@@IDENTITY"];
          $_SESSION['user'] = ['login' => $login, 'id' => $userId];
          return $userId;
        }
      }
    } else {
      render('signup.php', ['msg' => $this->msg]);
    }
    return false;
  }
  public function getUserList() {
    return $this->userModel->getList();
  }

}


