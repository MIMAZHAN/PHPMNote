<?php 
  session_start();
  if(isset($_SESSION["logged"]) && isset($_SESSION["userId"]))
  {
    if($_SESSION["logged"]==true)
    {
      header( 'Location: ./notes.php');
      exit();
    }
  }
  require_once 'php/body/header.php';
 ?>
    <form class="form-signin" method="post" action="php/login.php">
      <h3 class="form-signin-heading">输入您的账号和密码：</h3>
      <input type="email" class="form-control" id="email" name="email" placeholder="输入邮箱" required autofocus>
      <input type="password" class="form-control" id="password" name="password" placeholder="输入密码" required>
      <?php
      if(isset($_GET["error"]))
      {
        require_once 'php/functions.php';
        //echo "<br><div class='alert alert-danger'>" . validateData($_GET["error"]) . "</div>";
        echo "<br><div class='alert alert-danger'>" . $_GET["error"] . "</div>";
      }
      ?>
      <button class="btn btn-lg btn-primary btn-block" type="submit">立即登陆</button>
      <br><a class="registerNow" href="register.php">没有账号？点我注册</a>
    </form>

<?php
require_once 'php/body/footer.php';
?>
