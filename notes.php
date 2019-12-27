<?php 
session_start();
if(isset($_SESSION["logged"]))
{

	$userId = $_SESSION["userId"];
	require_once 'php/config.php';
	require_once 'php/functions.php';
	require_once 'php/body/header.php';

	$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName);
	$queryGetNotes = "SELECT * FROM $dbNotesTable WHERE USER = $userId ORDER BY DATETIME DESC";

		if($result = $connection->query($queryGetNotes))
		{
			if(isset($_GET["error"]))
			{
				echo "<br><div class='alert alert-danger'>" . validateData($_GET["error"]) . "</div>";
			} 
			if($result->num_rows == 0)
			{
				echo '<a href="create.php" ><div class="glyphicon glyphicon-plus addNote" title="Add a note"> </div></a>';
				echo '<div class="alert alert-info"><strong>你好： '.$_SESSION["userName"].'</strong> 你的笔记现在是空的，快去添加一条吧！</div>';
			}
			else
			{
				echo '<a href="create.php" ><div class="glyphicon glyphicon-plus addNote" title="Add a note"> </div></a>';
				while ($row = $result->fetch_assoc()) 
				{

					echo 	'<div class="note">
					<div class="noteTitle">' . urldecode(trim($row['TITLE'])) . '
						<span class="noteButtons">
							<a href="#" ><span class="glyphicon glyphicon-pencil" title="Edit this note"></span></a>
							<a href="#" ><span class="glyphicon glyphicon-bullhorn" title="Make this note public"></span></a>
							<a href="#" ><span class="glyphicon glyphicon-trash" title="Delete this note"></span></a>
						</span>
					</div>
					<div class="noteText">' . urldecode(trim($row['NOTE'])) . '</div>
					<div class="noteDateTime">' . trim($row['DATETIME']) . '</div>
				</div>';
			}

		}

		echo '<span class="logout"><a href="php/logout.php">Logout</a></span>';
	}
	else
	{
		echo '<div class="alert alert-danger"><strong>出错了！</strong>笔记内容加载失败，请刷新重试！</div>';
	}

	require_once 'php/body/footer.php';
	echo '<script src="js/notes.js"></script>';

	$connection->close();
}
else
{
	header( 'Location: login.php' );
}

?>