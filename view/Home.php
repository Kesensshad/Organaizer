<?php 
session_start();
if (!$_SESSION['user'])
	header("Location: auth.php");
require_once('../Manipulators/TaskManagment.php');
echo $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	
</head>
<body><!-- Home page -->
	<form action = "../Manipulators/TaskCreate.php" method="post">
		<p><input type="text" placeholder="status" name="status" value="1"></p>
		<p><input type="text" placeholder="priority" name="priority" value=""></p>
		<p><input type="date" placeholder="deadline" name="deadline" value="2023-12-12" id="calendarForTasks"></p>
		<p><input type="text" placeholder="title" name="title" required></p>
		<p><input type="submit" onclick="alert('Задача создана');return true;" value="Create"></p>
	</form>
	<script type="text/javascript">
		function showCurrentDate(){
			var d = new Date(),
			new_value=d.toISOString().slice(0,10);
			document.getElementById("calendarForTasks").value=new_value;
		}
		showCurrentDate();
	</script>
	<center><?php output_of_tasks(); ?></center>
</body>
</html>