<header>
  <br>
    <a href="index.php?user=signin">SignIn</a>
  <hr>
  <br>
</header>
<form action="index.php" method="post">
    <h4>Форма регистрации</h4>
  <input type="hidden" name="signup">
  <input type="text" name="login" placeholder="Login">
  <input type="text" name="pass" placeholder="Password">
  <button>Send</button>
</form>
<br>
<p><?php echo $msg ?></p>

