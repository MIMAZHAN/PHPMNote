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
    <form class="form-signin" method="post" action="php/register.php">
      <h3 class="form-signin-heading">输入您的注册信息：</h3>
      <input type="text" name="name" id="name" class="form-control" placeholder="输入昵称" required autofocus>
      <input type="email" name="email" id="email"  class="form-control" placeholder="输入邮箱" required>
      <input type="password" name="password" id="password" class="form-control" placeholder="输入密码" required>
      <?php
      if(isset($_GET["error"]))
      {
        require_once 'php/functions.php';
        echo "<br><div class='alert alert-danger'>" . validateData($_GET["error"]) . "</div>";
      } 
      ?>
      <button class="btn btn-lg btn-primary btn-block" type="submit">立即注册</button>
      <br><a class="registerNow" href="login.php">已有账号？点我登陆</a>
    </form>


<?php
require_once 'php/body/footer.php';
?>
