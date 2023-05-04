<?php 
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "organaizer";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error){
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
	$project_id = $_POST['project_id'];
	?>
	<center>
		<form action="AddTask.php" method="post">
			<?php
			$sql = "SELECT * FROM projects WHERE project_id = $project_id";
			$project = mysqli_query($conn, $sql); 
			$project = mysqli_fetch_assoc($project); $project = $project['task_title'];
			echo '<h1>'.$project.'</h1>';
			echo "<input type='hidden' name='project_id' value='$_POST[project_id]'>";
			?>
			<h3>Add task:</h3>
				<?php
				$sql = "SELECT * FROM task_project WHERE project_id = $project_id";
				$query = mysqli_query($conn, $sql);
				$task_project = array();
				while ($data = mysqli_fetch_assoc($query)) {
					$task_project[] = array($data['project_id'], $data['task_id']);
				}
				$sql = "SELECT * FROM tasks WHERE create_by = '$_SESSION[user]'";
				if($result = $conn->query($sql)){
					$sql = "SELECT task_id FROM task_project WHERE project_id = $project_id"; 
					$input = "";
				    foreach($result as $row)
				    {
				    	$res = 0;
						foreach($task_project as $task_id)
						{
					    	if ($row['task_id'] == $task_id[1]) {
					    		$res = 1;
					    		break;
					    	}
						}
						if ($res == 0)
							$input .= "<p><input type='checkbox' id='$row[task_id]' name='tasks[]' value='$row[task_id]'><label for='$row[task_id]'>$row[task_title]</label></p>";
					}
					echo $input;
				} else{
				    echo "The request failed: " . $conn->error;
				}
				?>
			<input type="submit" name="AddProjects" value="Add projects">
		</form>
	</center>
</body>
</html>
<?php
if (isset($_POST['tasks']))
{
	foreach($_POST['tasks'] as $task_id){
		$sql = "INSERT INTO task_project(task_id, project_id) VALUES ($task_id, $project_id)";
		echo $sql.'<br>';
		mysqli_query($conn, $sql);
	}
	header('Location: Home.php');
}