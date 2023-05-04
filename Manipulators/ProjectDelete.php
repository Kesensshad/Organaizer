<?php

if (isset($_POST['project_id'])) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "organaizer";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}

	$id = $_POST['project_id'];

	$sql = "DELETE FROM projects WHERE project_id = $id";

	if (mysqli_query($conn, $sql))
		header("Location: ../View/Home.php");
	else {
		echo "Data deletion error: " . $conn->error;
	}
}