<?php
session_start();
if (isset($_POST["login"]) && isset($_POST["password"])) {
	$conn = new mysqli("localhost", "root", "", "organaizer");
	if($conn->connect_error){
		die("Connect error: " . $conn->connect_error);
	}
	$login = $_POST["login"];
	$password = $_POST["password"];

	$sql = "SELECT * FROM users WHERE login = '$login'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	if ($count > 0) {
		$hashed_password = md5($password);
		foreach($result as $row)
			$password = $row['password'];
		if ($hashed_password == $password){
			$_SESSION['user'] = $login;
			header("Location: ../View/Home.php");
		}
		else 
			header("Location: ../View/auth.php?message=Password");
	}
	else 
		header("Location: ../View/auth.php?message=Exists");	
	$conn->close();
}

?>