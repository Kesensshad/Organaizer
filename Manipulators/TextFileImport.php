<?php
session_start();

if (isset($_POST['import'])) {
	$filename = $_FILES['fileToImport']['name'];
	$filetmp = $_FILES['fileToImport']['tmp_name'];

	$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
	if ($file_extension !== 'txt') {
		echo "Error: Only text files (.txt) are allowed.";
		exit();
	}

	$data = file($filetmp, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "organaizer";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	$sql = "SELECT MAX(task_id) FROM tasks"; $task_id = mysqli_query($conn, $sql); $task_id = mysqli_fetch_assoc($task_id); $task_id = $task_id['MAX(task_id)'];
	$sql = "INSERT INTO tasks (task_id, task_status, task_priority, task_deadline, task_title, create_by, create_at) VALUES ";
	$counter = $task_id;
	// echo $task_id.'<br>';
	$f = array();
	$task_id++;
	$projects = array();
	foreach ($data as $fields) {
		$priority = '';
		$title = '';
		$deadline = '';
		if (strtolower($fields[0]) == 'x'){
			$status = 1;
			$fields = substr_replace($fields, '', 0, 2);
		}
		else{
			$status = 2;
			$fields = substr_replace($fields, '', 0, 1);
		}
		if (strpos($fields, '(') !== false) {
			$priority = $fields[strpos($fields, '(') + 1];
			$fields = substr_replace($fields, '', 0, 3);
		}
		if (strpos($fields, '+') !== false){
			$title = substr($fields, 0, strpos($fields, '+') - 1);
			$fields = substr_replace($fields, '', 0, strpos($fields, '+') - 1);
		}
		elseif(strpos($fields, 'due:') !== false){
			$title = substr($fields, 0, strpos($fields, 'due:') - 1);
			$fields = substr_replace($fields, '', 0, strpos($fields, 'due:') - 1);
		}
		else{
			$title = $fields;
			$fields = '';
		}
		$characters = substr_count($fields, '+');
		if ($characters > 0)
			$f[] = 1;
		else 
			$f[] = 0;
		for ($i = 0; $i < $characters; $i++){
			if (substr_count($fields, '+') > 1) {
				$projects[] = substr($fields, 2, strpos($fields, '+', 2) - 2);
				$fields = substr_replace($fields, '', 0, strpos($fields, '+', 2) - 1);
			}
			else
			{
				$projects[] = substr($fields, 2, strpos($fields, 'due:', 2) - 2);
				$fields = substr_replace($fields, '', 0, strpos($fields, 'due', 2) - 1);
			}
		}
		if (strpos($fields, 'due:', 0) == 1) {
			$fields = substr_replace($fields, '', 0, 5);
			$deadline = $fields;
		} else {
			$deadline = "CURRENT_DATE()";
		}
		$counter++;
		$sql .= "($counter, '$status', '$priority', '$deadline', '$title', '$_SESSION[user]', NOW()), ";
	}
	$sql = rtrim($sql, ", ");
	// mysqli_query($conn, $sql);
	// for ($i = 0; $i < count($projects); $i++) {
	// 	echo $i;
	// 	if ($f[$i] == 1){
	// 		$sql = "SELECT * FROM projects WHERE project_title = '$projects[$i]'";
	// 		$project = mysqli_query($conn, $sql); $project = mysqli_fetch_assoc($project);
	// 		if ($projects[$i] == $project['project_title'])
	// 		{
	// 			$sql = "INSERT INTO task_project (task_id, project_id) VALUES ($task_id, $project[project_id])";
	// 			$task_id++;
	// 			mysqli_query($conn, $sql);
	// 		}
	// 		else
	// 		{
	// 			$sql = "INSERT INTO projects (project_title, create_by, create_at) VALUES ($projects[$i], $_SESSION[user], NOW())";
	// 			mysqli_query($conn, $sql);
	// 			$sql = "SELECT MAX(project_id) FROM projects"; $proj = mysqli_query($conn, $sql); $proj = mysqli_fetch_assoc($proj); $proj = $proj['MAX(project_id)'];
	// 			$sql = "INSERT INTO task_project (task_id, project_id) VALUES ($task_id, $proj)";
	// 			$task++;
	// 		}
	// 	}
	// 	else $task_id++;
	// }
	// header("Location: ../View/Home.php");
	mysqli_close($conn);
}