<?php 
session_start();
if(isset($_SESSION["logged"]))
{
	if(isset($_POST["title"]) && isset($_POST["text"]) && isset($_POST["dateTime"]))
	{
		$userId = $_SESSION["userId"];
		require_once 'config.php';
		require_once 'functions.php';

		$title = validateData($_POST["title"]);
		$text = validateData($_POST["text"]);
		$dateTime = validateData($_POST["dateTime"]);
		$title = urlencode($title);
		$text = urlencode($text);
		$queryUpdate = "UPDATE $dbNotesTable SET TITLE='" . $title . "', NOTE='" .$text. "', DATETIME =NOW() WHERE DATETIME = '" . $dateTime . "' AND USER = $userId"  ;
		$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName) or die("Error " . mysqli_error($connection));
		if($result = $connection->query($queryUpdate))
		{
			header( 'Location: ../notes.php');
			$connection->close();
		}
		else
		{
			header( 'Location: ../notes.php?error=您的网络似乎不稳定，请重试！');
			$connection->close();
		}
	}
	else
	{
		header( 'Location: ../notes.php');
	}
}
else
{
	header( 'Location: ../login.php');
}	


?>