<?php 
session_start();
if(isset($_SESSION["logged"]))
{
  if($_SESSION["logged"]==true)
    header("Location: login.php?error=Error: Please login to create a note.");
}
require_once 'php/body/header.php';
?>

    <div class="alert alert-info">
      <h2>这是您的 MNote 私有化笔记程序</h2><b>
      <div class="alert alert-success"><h3>开始您的笔记之旅，请先注册或登陆吧：<b><a href="login.php"><font color='black'>点我开始</h3></font></a></b></div>
      </div>

<?php
require_once 'php/body/footer.php';
?>