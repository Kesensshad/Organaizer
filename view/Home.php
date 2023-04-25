<?php 
session_start();
require_once('../Manipulators/TaskManagment.php');
// require_once('../Manipulators/TaskManipulator.php');
$_SESSION['user'] = 'test';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
</head>
<body>
<!-- 	<form action = "../Manipulators/TaskManipulator.php" method="post">
		<p><input type="text" placeholder="status" name="status" required></p>
		<p><input type="text" placeholder="priority" name="priority" required></p>
		<p><input type="text" placeholder="deadline" name="deadline" required></p>
		<p><input type="text" placeholder="title" name="title" required></p>
		<input type="hidden" name="actionWithATask" value="create">
		<p><input type="submit" value="Create"></p>
	</form> -->
	<!-- Home page -->
	<?php output_of_tasks(); ?>
</body>
</html>