<?php

if (isset($_POST['task_id'])){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "organaizer";

	$conn = new mysqli($servername, $username, $password, $dbname);

	
	if ($conn->connect_error) {
	    die("Connect error: " . $conn->connect_error);
	} 

	$id = $_POST['task_id'];

	$sql = "DELETE FROM task WHERE task_id = $id";

	if ($conn->query($sql) === TRUE) {
	    header("Location: ../view/Home.php");
	} else {
	    echo "Data deletion error: " . $conn->error;
	}

	
	$conn->close();
}