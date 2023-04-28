<?php 
if (isset($_POST['task_id']))
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "organaizer";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connect error: " . $conn->connect_error);
	} 
	$id = $_POST['task_id'];
	$sql = "SELECT * FROM tasks WHERE task_id = $id";
	// echo $sql;
	$result = mysqli_query($conn, $sql);
	foreach ($result as $row)
	{
		$status = $row['task_status'];
		$priority = $row['task_priority'];
		$deadline = $row['task_deadline'];
		$title = $row['task_title'];
	}
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
	<center>
		<?php 
		echo "<form action = 'TaskUpdate.php' method='post'>";
		echo '<select size="1" name="status">
				<option value="1">Finished</option>
				<option selected value="2">Not finished</option>
				<option value="3">Delayed</option>
			</select>';
		echo	"<p><input type='text' placeholder='priority' name='priority' value=$priority></p>";
		echo	"<p><input type='date' placeholder='deadline' name='deadline' value=$deadline></p>";
		echo	"<p><input type='text' placeholder='title' name='title' value=$title required></p>";
		echo	"<p><input type='hidden' name='updateTask' value='true'></p>";
		echo	"<p><input type='hidden' name='task_id' value=$id></p>";
		echo	"<p><input type='submit' onclick='alert('Task updated!');return true;' value='Update'></p>";
		echo "</form>";
		?>
	</center>
</body>
</html>
<?php

if(isset($_POST['updateTask'])){
	if ($_POST['updateTask'] == true){
		$update_status = $_POST['status'];
		$update_priority = $_POST['priority'];
		$update_deadline = $_POST['deadline'];
		$update_title = $_POST['title'];

		$sql = "UPDATE tasks SET 
		task_status = $update_status, 
		task_priority = '$update_priority', 
		task_deadline = '$update_deadline', 
		task_title = '$update_title' 
		WHERE task_id = $id";
		if ($conn->query($sql) === TRUE) {
		    header("Location: ../view/Home.php");
		} else {
		    echo "Data update error: " . $conn->error;
		}
	}
}


?>