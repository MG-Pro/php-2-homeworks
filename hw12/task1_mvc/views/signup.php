<header>
  <br>
    <a href="index.php?signup">SignUp</a>
  <hr>
  <br>
</header>
<form action="index.php?signup" method="post">
    <h4>Форма регистрации</h4>
  <input type="text" name="login" placeholder="Login">
  <input type="text" name="pass" placeholder="Password">
  <button>Send</button>
</form>
<br>
<p><?php echo $msg ?></p>

