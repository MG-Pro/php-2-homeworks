<header>
  <br>
    <a href="index.php">SignIn</a>
  <hr>
  <br>
</header>
<form action="index.php?signin" method="post">
  <h4>Форма авторизации</h4>
  <input type="text" name="login" placeholder="Login">
  <input type="text" name="pass" placeholder="Password">
  <button>Send</button>
</form>
<br>
<p><?php echo $msg ?></p>
