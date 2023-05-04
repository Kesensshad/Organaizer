<?php
session_start();
if (isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {
	$conn = new mysqli("localhost", "root", "", "organaizer");
	if($conn->connect_error){
		die("Connect error: " . $conn->connect_error);
	}
	$login = $_POST["login"];
	$password = $_POST["password"];
	$confirm = $_POST["confirm"];

	$sql = "SELECT * FROM users WHERE login = '$login'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	echo $count.' '.$login;
	if ($count > 0) {
		header("Location: ../View/reg.php?message=Exists");
	} else {
		if ($password != $confirm) {
			header("Location: ../View/reg.php?message=Password");
		} else {
			$hashed_password = md5($password);

			$sql = "INSERT INTO users (login, password) VALUES ('$login', '$hashed_password')";
			if (mysqli_query($conn, $sql)) {
				$_SESSION['user'] = $login;
				header("Location: ../View/Home.php");
			} else {
				echo "Error: " . mysqli_error($conn);
			}		
		}
	}
	$conn->close();
}
