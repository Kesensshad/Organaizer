<?php session_start(); 
	if ($_GET['message'] == "Exists")
		echo "<script>alert('User already exist!');</script>";
	if ($_GET['message'] == "Password")
		echo "<script>alert('Password mismatch!');</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script>
		function showPasswords() {
			var passwordField = document.getElementById("password");
			var confirmPasswordField = document.getElementById("confirm");

			if (passwordField.type === "password") {
				passwordField.type = "text";
				confirmPasswordField.type = "text";
			} else {
				passwordField.type = "password";
				confirmPasswordField.type = "password";
			}
		}
	</script>
</head>
<body>
	<h1>Registration</h1>
	<form action="../UsersManager/Registration.php" method="post">
		<p><input type="text" placeholder="login" name="login" required /></p>
		<p><input type="password" id="password" placeholder="password" name="password" required /></p>
		<p><input type="password" id="confirm" placeholder="confirm" name="confirm" required /></p>
		<button type="button" onclick="showPasswords()">Показать пароль</button>
	    <input type="submit" value="Sign up">
	</form>
	
	<a href="auth.php">Sign in</a>
</body>
</html>
