<?php 
session_start(); 
if ($_GET['message'] == "Password")
	echo "<script>alert('Incorrect password!');</script>";
if ($_GET['message'] == "Exists")
	echo "<script>alert('User does not exist!');</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script>
		function showPassword() {
			var passwordField = document.getElementById("password");

			if (passwordField.type === "password") {
				passwordField.type = "text";
			} else {
				passwordField.type = "password";
			}
		}
	</script>
</head>
<body>
	<h1>Authorization</h1>
	<form action="../UsersManager/Authorization.php" method="post">
		<p><input type="text" placeholder="login" name="login" required /></p>
		<p><input type="password" id="password" placeholder="password" name="password" required /></p>
		<button type="button" onclick="showPassword()">Показать пароль</button>
	    <input type="submit" value="Sign up">
	</form>
	
	<a href="reg.php">Sign up</a>
</body>
</html>
