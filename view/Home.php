<?php 
session_start();
require_once('../Manipulators/TaskManagment.php');
// require_once('../Manipulators/TaskCreate.php');
$_SESSION['user'] = 'test';
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
		<p><input type="text" placeholder="status" name="status" required></p>
		<p><input type="text" placeholder="priority" name="priority" required></p>
		<p><input type="date" placeholder="deadline" name="deadline" required></p>
		<p><input type="text" placeholder="title" name="title" required></p>
		<p><input type="submit" name=send value="Create"></p>
	</form>
	
	<script type="text/javascript">
		function sendForm(e){ 
			 alert(<?php echo $message; ?>);
		}
		var sendButton = document.search.send;
		sendButton.addEventListener("click", sendForm);
	</script>
	<center><?php output_of_tasks(); ?></center>
</body>
</html>