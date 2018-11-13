<header>
  <br>
    <a href="index.php?action=signin">SignUp</a>
  <hr>
  <br>
</header>
<form action="index.php?action=signup" method="post">
    <h4>Форма регистрации</h4>
  <input type="text" name="login" placeholder="Login">
  <input type="text" name="pass" placeholder="Password">
  <button>Send</button>
</form>
<br>
<p><?php echo $msg ?></p>

