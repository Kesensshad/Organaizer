<?php

require_once('Connect.php');
// $connection = connect_db();
// Not completed

echo $connection->query("select 1");
function output_of_tasks()
{   // displays the user`s tasks on the home page 
	// $connection = new PDO("mysql:host=localhost;dbname=organaizer", 'root', '');

	// foreach($connection->query('SELECT * FROM task') as $row) {
	//     echo $row['task_id'] . ' ' . $row['task_title'];

	echo '
	<table>
		<tr>
			<td>№</td>
			<td>Status</td>
			<td>Priority</td>
			<td>Deadline</td>
			<td>Title</td>
			<td>Create at</td>
		</tr>
	';

/////////////////////////////////////////////////////////////////////////////////////////
	// $conn = new mysqli("localhost", "root", "", "organaizer");
	// if($conn->connect_error){
	// 	die("Ошибка: " . $conn->connect_error);
	// }
	// $sql = "SELECT * FROM task";
	// if($result = $conn->query($sql)){
	//     $rowsCount = $result->num_rows; // количество полученных строк
	//     echo "<p>Получено объектов: $rowsCount</p>";
	//     echo "<table><tr><th>Id</th><th>Имя</th><th>Возраст</th></tr>";
	//     foreach($result as $row){
	//         echo "<tr>";
	//             echo "<td>" . $row["task_id"] . "</td>";
	//             echo "<td>" . $row["task_priority"] . "</td>";
	//             echo "<td>" . $row["task_title"] . "</td>";
	//         echo "</tr>";
	//     }
	//     echo "</table>";
	//     $result->free();
	// } else{
	//     echo "Ошибка: " . $conn->error;
	// }
///////////////////////////////////////////////////////////////////////////////////////////
	// $sql = "SELECT task_status, task_priority, task_deadline, task_title, create_at FROM task WHERE task_status = 1";
	// echo $sql;
	// $sql = $DBH->prepare($sql)->execute();
	// echo 111;
	// print_r($sql->fetchAll());
	// $sql->setFetchMode(PDO::FETCH_ASSOC);
	// echo 111;
	// foreach ($row = $DBH->query($sql)) {
	// 	echo "<tr>";
	// 		echo '<td>'.$num.'</td>';
	// 		echo '<td>'.$row['task_status'].'</td>';
	// 		echo '<td>'.$row['task_priority'].'</td>';
	// 		echo '<td>'.$row['task_deadline'].'</td>';
	// 		echo '<td>'.$row['task_title'].'</td>';
	// 		echo '<td>'.$row['create_at'].'</td>';
	// 	echo "</tr>";
	// 	$num++;
	// }
	echo "</table>";
}