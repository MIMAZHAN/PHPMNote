<?php 
	if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"]))
	{
		require_once 'config.php';
		require_once 'functions.php';
		$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName);
		$name = validateData($_POST["name"]);
		$email = validateData($_POST["email"]);
		$password = sha1(validateData($_POST["password"]));
		if(strlen($name) > 0 && strlen($password)>0 && strlen($email)>0)
		{
			$alreadyUsedSQL = "SELECT * FROM $dbUserTable WHERE LOWER(NAME)='" . strtolower($name) . "' OR LOWER(EMAIL)='" . strtolower($email) . "' LIMIT 1;";
			if($result = $connection->query($alreadyUsedSQL))
			{
				$result = $result->fetch_array(MYSQLI_BOTH);
				if(count($result) == 0)
				{
					$insertUserQuery="INSERT INTO $dbUserTable (NAME,EMAIL,PASSWORD) VALUES ('$name','$email','$password');";
					if($result = $connection->query($insertUserQuery))
					{
						session_start();
						$_SESSION["logged"] = true;
						$_SESSION["userId"] = $connection->insert_id;
						$connection->close();
						header( 'Location: ../notes.php' );
					}
					else
					{
						header( 'Location: ../register.php?error=您的网络似乎不稳定，请重试！' );
					}
				}
				else
				header( 'Location: ../register.php?error=用户名或邮箱已被申请，请更换重试！');
			}
			else
			{
				header( 'Location: ../register.php?error=您的网络似乎不稳定，请重试！' );
			}
		}
		else
		{
			header( 'Location: ../register.php?error=您的网络似乎不稳定，请重试！' );
		}
	}
	else
	{
		header( 'Location: ../register.php?error=您的网络似乎不稳定，请重试！' );
	}
	?>