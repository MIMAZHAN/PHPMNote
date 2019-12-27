<?php
	session_start();
	if(isset($_SESSION["logged"]) && isset($_SESSION["userId"]))
	{
		if($_SESSION["logged"]==true)
			header( 'Location: ../notes.php');
	}
	else 
	if(isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"]))
	{
		require_once 'config.php';
		require_once 'functions.php';
		$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName);
		$email = validateData($_POST["email"]);
		$password = sha1(validateData($_POST["password"]));
		if(strlen($password)>0 && strlen($email)>0)
		{
			$canLogin = "SELECT * FROM $dbUserTable WHERE LOWER(EMAIL)='" . strtolower($email) . "' AND PASSWORD='" . $password . "' LIMIT 1;";
			if($result = $connection->query($canLogin))
			{
				$result = $result->fetch_array(MYSQLI_BOTH);
				if(count($result) == 0)
				{
						header( 'Location: ../login.php?error=登陆失败，不合法的账号或密码！' );
				}
				else
				{
					session_start();
					$_SESSION["logged"] = true;
					$_SESSION["userId"] = $result["ID"];
					$_SESSION["userName"] = $result["NAME"];
					$connection->close();
					header( 'Location: ../notes.php');
				}
			}
			else
			{
				header( 'Location: ../login.php?error=您的网络似乎不稳定，请重试！' );
				$connection->close();
			}
		}
		else
		{
			header( 'Location: ../login.php?error=您的网络似乎不稳定，请重试！');
			$connection->close();
		}
	}
	else
	{
		header( 'Location: ../login.php?error=您的网络似乎不稳定，请重试！' );
	}

 ?>