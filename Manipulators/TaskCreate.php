<?php
session_start();


if (isset($_POST['status']) && isset($_POST['priority']) && isset($_POST['deadline']) && isset($_POST['title'])){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "organaizer";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connect error: " . $conn->connect_error);
	} 

	$status = $_POST['status'];
	$priority = $_POST['priority'];
	$deadline = $_POST['deadline'];
	$title = $_POST['title'];
	$create_by = $_SESSION['user'];

	$sql = "INSERT INTO task (task_status, task_priority, task_deadline, task_title, create_by, create_at) VALUES ('$status', '$priority', '$deadline', '$title', '$create_by', NOW())";

	if ($conn->query($sql) === TRUE) {
	    header("Location: ../view/Home.php");
	} else {
	    echo "Error adding data: " . $conn->error;
	}

	
	$conn->close();
}