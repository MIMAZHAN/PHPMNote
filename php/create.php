<?php 
	session_start();
	if(isset($_SESSION["logged"]))
	{
		if(isset($_POST["title"]) && isset($_POST["text"]) && !empty($_POST["title"]) && !empty($_POST["text"]))
		{
			$userId = $_SESSION["userId"];
			require_once 'config.php';
			require_once 'functions.php';
			$title = validateData($_POST["title"]);
			$text = validateData($_POST["text"]);
			$title = urlencode($title);
			$text = urlencode($text);
			$insertQuery = "INSERT INTO $dbNotesTable (USER,TITLE,NOTE,PUBLICID) VALUES ('$userId','$title','$text','');";
			echo $insertQuery;
			$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName);
			if($result = $connection->query($insertQuery))
			{
				header( 'Location: ../notes.php');
				$connection->close();
			}
			else
			{
				header( 'Location: ../create.php?error=保存失败，请重试！');
				$connection->close();
			}
		}
		else
		{
			header( 'Location: ../create.php?error=缺少内容！');
		}
	}
	else
	{
		header( 'Location: ../login.php');
	}	


 ?>