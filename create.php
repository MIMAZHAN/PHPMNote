<?php 
  session_start();
  if(!isset($_SESSION["logged"]))
  {
    header("Location: login.php?error=Error: Please login to create a note.");
  }
  require_once 'php/body/header.php';
  if(isset($_GET["error"]))
  {
    require_once 'php/functions.php';
    echo "<br><div class='alert alert-danger'>" . validateData($_GET["error"]) . "</div>";
  }
    ?>
    <form class="createNote" method="post" action="php/create.php" autocomplete="off">
        <input autocomplete="off" class="form-control title" type="text" id="title" name="title" placeholder="请输入标题" autofocus>
        <textarea name="text" id="text" cols="30" rows="10" class="form-control text" placeholder="请输入内容" ></textarea>
        <button class="btn btn-lg btn-primary btn-block" type="submit">保存</button>
    </form>

  </div> 
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
    $('.createNote').submit(function()
    {
        if ($(this).children('.title').val().trim().length == 0 || $(this).children('.text').val().trim().length == 0) { 
            alert("缺少内容！")
            return false; 
        }
    });
  </script> 
</body>
</html>