<?php
session_start();


if (isset($_POST['status']) && isset($_POST['priority']) && isset($_POST['deadline']) && isset($_POST['title'])){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "organaizer";

	// Создание соединения с базой данных
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Проверка соединения на ошибки
	if ($conn->connect_error) {
	    die("Ошибка подключения: " . $conn->connect_error);
	} 

	// Получение данных из формы
	$status = $_POST['status'];
	$priority = $_POST['priority'];
	$deadline = $_POST['deadline'];
	$title = $_POST['title'];
	$create_by = $_SESSION['user'];

	$sql = "INSERT INTO task (task_status, task_priority, task_deadline, task_title, create_by, create_at) VALUES ('$status', '$priority', '$deadline', '$title', '$create_by', NOW())";
	echo $sql;

	if ($conn->query($sql) === TRUE) {
	    header("Location: ../view/Home.php");
	} else {
	    echo "Ошибка добавления кортежа: " . $conn->error;
	}

	
	$conn->close();
}