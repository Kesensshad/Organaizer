<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "organaizer";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if($conn->connect_error){
	die("Connect error: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="Home.php">
		<button><h1>Home</h1></button>
	</form>
	<?php
	echo '<h1>'.$_SESSION['user'].'</h1>';
	?>
	<center>
		<form action="ProjectCreate.php" method="post">
			<p><input type="text" name="project_title" placeholder="Project name"></p>

			<h3>Select tasks:</h3>
				<?php
				$sql = "SELECT * FROM tasks WHERE create_by = '$_SESSION[user]'";
				if($result = $conn->query($sql)){
				    foreach($result as $row)
				    	echo "<p><input type='checkbox' id='$row[task_id]' name='tasks[]' value='$row[task_id]'><label for='$row[task_id]'>$row[task_title]</label></p>";
				} else{
				    echo "The request failed: " . $conn->error;
				}
				?>
			<input type="submit" name="CreateProject" value="Create project">
		</form>
	</center>
</body>
</html>
<?php
if (isset($_POST['project_title'])){
	$sql = "INSERT INTO projects(project_title, create_by, create_at) VALUES ('$_POST[project_title]', '$_SESSION[user]', NOW())";
	if ($conn->query($sql) === TRUE) {
		
		if (isset($_POST['tasks']))
		{
			$sql = "SELECT MAX(project_id) FROM projects";
			$query = mysqli_query($conn, $sql); $project_id = mysqli_fetch_assoc($query);
			$project_id = $project_id['MAX(project_id)'];
			$tasks = $_POST['tasks'];
			$sql = "INSERT INTO task_project(task_id, project_id) VALUES ";
			foreach($tasks as $task)
			{
				$sql .='('.$task.', '.$project_id.'),';
			}
			$sql = substr($sql, 0, -1);
			if (mysqli_query($conn, $sql)) 
				header('Location: Home.php');
			else
				echo "Error adding data: " . $conn->error;
		}
		else
			header('Location: Home.php');
	} else {
		echo "Error adding data: " . $conn->error;
	}
}