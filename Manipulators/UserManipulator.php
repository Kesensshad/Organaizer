<?php
session_start();
if ($_POST["userWants"] == "reg"){
	if (isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {
		$conn = new mysqli("localhost", "root", "", "organaizer");
		if($conn->connect_error){
			die("Ошибка: " . $conn->connect_error);
		}
		$login = $_POST["login"];
		$password = $_POST["password"];
		$confirm = $_POST["confirm"];

			// Проверяем, что логин не занят другим пользователем
		$sql = "SELECT * FROM users WHERE login = '$login'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		echo $count.' '.$login;
		if ($count > 0) {
			header("Location: ../view/reg.php?message=Exists");
		} else {
			        // Проверяем, что пароль и подтверждение пароля совпадают
			if ($password != $confirm) {
				header("Location: ../view/reg.php?message=Password");
			} else {
			            // Хешируем пароль
				$hashed_password = md5($password);

			            // Добавляем пользователя в базу данных
				$sql = "INSERT INTO users (login, password) VALUES ('$login', '$hashed_password')";
				if (mysqli_query($conn, $sql)) {
					$_SESSION['user'] = $login;
					header("Location: ../view/Home.php");
				} else {
					echo "Ошибка: " . mysqli_error($conn);
				}		
			}
		}
		$conn->close();
	}
}



if ($_POST["userWants"] == "auth"){
	if (isset($_POST["login"]) && isset($_POST["password"])) {
		$conn = new mysqli("localhost", "root", "", "organaizer");
		if($conn->connect_error){
			die("Ошибка: " . $conn->connect_error);
		}
		$login = $_POST["login"];
		$password = $_POST["password"];

			// Проверяем, что логин не занят другим пользователем
		$sql = "SELECT * FROM users WHERE login = '$login'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$hashed_password = md5($password);
			foreach($result as $row)
				$password = $row['password'];
			if ($hashed_password == $password){
				$_SESSION['user'] = $login;
				header("Location: ../view/Home.php");
			}
			else 
				header("Location: ../view/auth.php?message=Password");
		}
		else 
			header("Location: ../view/auth.php?message=Exists");	
		$conn->close();
	}
}