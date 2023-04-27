<?php
// Not completed

function output_of_tasks()
{   // displays the user`s tasks on the home page 
	$conn = new mysqli("localhost", "root", "", "organaizer");
	if($conn->connect_error){
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM task WHERE create_by = '$_SESSION[user]'";
	if($result = $conn->query($sql)){
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
	    	$sql = "SELECT status_title FROM task_status WHERE status_id = $row[task_status]";
	    	$query = mysqli_query($conn, $sql);
	    	foreach($query as $statusInfo) {
	    		$status = $statusInfo['status_title'];
	    	}
	        echo "<tr>";
				echo '<td>'.$num.'</td>';
				echo '<td>'.$status. '</td>';
				echo '<td>'.$row['task_priority'].'</td>';
				echo '<td>'.$row['task_deadline'].'</td>';
				echo '<td>'.$row['task_title'].'</td>';
				echo '<td>'.$row['create_at'].'</td>';
				echo "<td>
						<form action='../Manipulators/TaskDelete.php' method='post'>
							<input type='hidden' name='task_id' value=$row[task_id]> 
							<input type='submit' name='delete' value='delete'>
						</form>
					</td>";
				echo "<td>
						<form action='../Manipulators/TaskUpdate.php' method='post'>
							<input type='hidden' name='task_id' value=$row[task_id]> 
							<input type='hidden' name='updateTask' value='false'>
							<input type='submit' name='update' value='update'>
						</form>
					</td>";
			echo "</tr>";
			$num++;
	    }
	    echo "</table>";
	    $result->free();
	} else{
	    echo "The request failed: " . $conn->error;
	}
	echo "</table>";
}