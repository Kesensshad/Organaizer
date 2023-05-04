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
	$task_id = $_POST['task_id'];
	?>
	<center>
		<form action="AddProject.php" method="post">
			<?php
			$sql = "SELECT * FROM tasks WHERE task_id = $task_id";
			$task = mysqli_query($conn, $sql); 
			$task = mysqli_fetch_assoc($task); $task = $task['task_title'];
			echo '<h1>'.$task.'</h1>';
			echo "<input type='hidden' name='task_id' value='$_POST[task_id]'>";
			?>
			<h3>Add project:</h3>
				<?php
				$sql = "SELECT * FROM task_project WHERE task_id = $task_id";
				$query = mysqli_query($conn, $sql);
				$task_project = array();
				while ($data = mysqli_fetch_assoc($query)) {
					$task_project[] = array($data['project_id'], $data['task_id']);
				}
				$sql = "SELECT * FROM projects WHERE create_by = '$_SESSION[user]'";
				if($result = $conn->query($sql)){
					$sql = "SELECT project_id FROM task_project WHERE task_id = $task_id"; 
					$input = "";
				    foreach($result as $row)
				    {
				    	$res = 0;
						foreach($task_project as $project_id)
						{
					    	if ($row['project_id'] == $project_id[0]) {
					    		$res = 1;
					    		break;
					    	}
						}
						if ($res == 0)
							$input .= "<p><input type='checkbox' id='$row[project_id]' name='projects[]' value='$row[project_id]'><label for='$row[project_id]'>$row[project_title]</label></p>";
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
if (isset($_POST['projects'])){
	foreach($_POST['projects'] as $project_id){
		$sql = "INSERT INTO task_project (task_id, project_id) VALUES ($task_id, $project_id)";
		echo $sql.'<br>';
		mysqli_query($conn, $sql);
	}
	header("Location: Home.php");
}