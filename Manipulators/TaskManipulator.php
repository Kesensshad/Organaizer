<?php
session_start();

$conn = new mysqli("localhost", "root", "", "organaizer");
if($conn->connect_error){
	die("Ошибка: " . $conn->connect_error);
}


function delete(){// describe deletion
}
function update(){// describe updation
}


if ($_POST['actionWithATask'] == 'create');
	// create($_POST['status'], $_POST['priority'], $_POST['deadline'], $_POST['title'], $_SESSION['user']);
// if ($_POST['actionWithATask'] == 'delete')
// 	delete();
// if ($_POST['actionWithATask'] == 'update')
// 	update();
// $sql = "INSERT INTO Users (name, age)
 // VALUES ('Tom', 37)";
// if($conn->query($sql)){
//     echo "Данные успешно добавлены";
// } else{
//     echo "Ошибка: " . $conn->error;
// }