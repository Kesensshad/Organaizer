<?php
// Not completed

function output_of_tasks()
{   // displays the user`s tasks on the home page 
	$conn = new mysqli("localhost", "root", "", "organaizer");
	if($conn->connect_error){
		die("Ошибка: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM task WHERE create_by = '$_SESSION[user]'";
	if($result = $conn->query($sql)){
	    // $rowsCount = $result->num_rows; // количество полученных строк
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
	$num = 1;
	    foreach($result as $row){
	        echo "<tr>";
				echo '<td>'.$num.'</td>';
				echo '<td>'.$row['task_status'].'</td>';
				echo '<td>'.$row['task_priority'].'</td>';
				echo '<td>'.$row['task_deadline'].'</td>';
				echo '<td>'.$row['task_title'].'</td>';
				echo '<td>'.$row['create_at'].'</td>';
			echo "</tr>";
			$num++;
	    }
	    echo "</table>";
	    $result->free();
	} else{
	    echo "Ошибка: " . $conn->error;
	}
	echo "</table>";
}