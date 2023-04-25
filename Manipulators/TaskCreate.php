<?php
session_start();



if (isset($_POST['status']) && isset($_POST['task_priority']) && isset($_POST['deadline']) && isset($_POST['title']));
{
	$conn = new mysqli("localhost", "root", "", "organaizer");
	if($conn->connect_error){
		die("Ошибка: " . $conn->connect_error);
	}
	$status = $conn->real_escape_string($_POST["status"]);
	$priority = $conn->real_escape_string($_POST["task_priority"]);
	$deadline = $conn->real_escape_string($_POST["deadline"]);
	$title = $conn->real_escape_string($_POST["title"]);
	$user = $conn->real_escape_string($_SESSION['user']);
	$sql = "
		INSERT INTO task (task_status, task_priority, task_deadline, task_title, create_by, create_at) 
		VALUES ($status, $priority, $deadline, $title, $user, NOW())
	";
	// if($conn->query($sql)){
	//     echo "Задача добавленна";
	// } else {
	//     echo "Ошибка: " . $conn->error;
	// }
	$conn->close();
}


// <?php
// if (isset($_POST["username"]) && isset($_POST["userage"])) {
      
//     $conn = new mysqli("localhost", "root", "", "testdb2");
//     if($conn->connect_error){
//         die("Ошибка: " . $conn->connect_error);
//     }
//     $name = $conn->real_escape_string($_POST["username"]);
//     $age = $conn->real_escape_string($_POST["userage"]);
    // $sql = "INSERT INTO Users (name, age) VALUES ('$name', $age)";
//     if($conn->query($sql)){
//         echo "Данные успешно добавлены";
//     } else{
//         echo "Ошибка: " . $conn->error;
//     }
//     $conn->close();
// }
// ?>