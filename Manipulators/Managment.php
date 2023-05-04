<?php
// Not completed

function output_of_tasks()
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "organaizer";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if($conn->connect_error){
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM tasks WHERE create_by = '$_SESSION[user]'";
	if($result = $conn->query($sql)){
	    echo '
			<table>
				<tr>
					<td>№</td>
					<td>Status</td>
					<td>Priority</td>
					<td>Deadline</td>
					<td>Title</td>
					<td>Project</td>
					<td>Create at</td>
				</tr>
		';
		$num = 1;
	    foreach($result as $task) {
	    	$sql = "SELECT status_title FROM task_status WHERE status_id = $task[task_status]";
	    	$query = mysqli_query($conn, $sql);
	    	$data = mysqli_fetch_assoc($query);
	    	$status = $data['status_title'];
	    	$sql = "SELECT * FROM task_project WHERE task_id = $task[task_id]";
	    	$query = mysqli_query($conn, $sql);
	    	$task_project = array();
	    	while ($data = mysqli_fetch_assoc($query)) {
	    		$task_project[] = $data['project_id'];
	    	}
	    	echo "<tr>";
	    	echo "<td>$num</td>";
	    	echo "<td>$status</td>";
	    	echo "<td>$task[task_priority]</td>";
	    	echo "<td>$task[task_deadline]</td>";
	    	echo "<td>$task[task_title]</td>";
	    	if (!empty($task_project))
	    	{
	    		echo "<td>";
	    		foreach ($task_project as $row)
	    		{
	    			$sql = "SELECT project_id, project_title FROM projects WHERE project_id = $row";
	    			$query = mysqli_query($conn, $sql);
	    			while ($data = mysqli_fetch_assoc($query)){
	    				$project_id = $data['project_id'];
	    				$project_title = $data['project_title'];
	    				echo "<a href='../View/Home.php?project_id=$row'>$data[project_title]</a><br>";
	    			}
	    		}
	    		echo "</td>";
	    	}
	    	else echo '<td>-</td>';
	    	echo "<td>$task[create_at]</td>";
	    	echo "<td>
					<form action='../Manipulators/TaskDelete.php' method='post'>
						<input type='hidden' name='task_id' value=$task[task_id]> 
						<input type='submit' name='delete' value='delete'>
					</form>
				</td>";
			echo "<td>
					<form action='TaskUpdate.php' method='post'>
						<input type='hidden' name='task_id' value=$task[task_id]> 
						<input type='hidden' name='updateTask' value='false'>
						<input type='submit' name='update' value='update'>
					</form>
				</td>";
			echo "<td>
					<form action='AddProject.php' method='post'>
						<input type='hidden' name='task_id' value=$task[task_id]> 
						<input type='submit' name='AddProject' value='Add project'>
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

function output_of_tasks_by_project($project_id)
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "organaizer";
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	$sql = "SELECT * FROM projects WHERE project_id = $project_id";

	$result = mysqli_query($conn, $sql);

	if ($project = mysqli_fetch_assoc($result)) {
		$num = 1;
	    echo "<h2>$project[project_title]
	    <form action='AddTask.php' method='post'>
	    	<input type='hidden' name='project_id' value='$_GET[project_id]'>
	    	<input type='submit' name='AddTasks' value='Add tasks'>
	    </form>
	    <form action='../Manipulators/ProjectDelete.php' method='post'>
	    	<input type='hidden' name='project_id' value='$_GET[project_id]'>
	    	<input type='submit' name='ProjectDelete' value='Delete project'>
	    </form>
	    </h2>";
	    $sql = "SELECT * FROM tasks t INNER JOIN task_project tp ON t.task_id = tp.task_id WHERE tp.project_id = $project[project_id]";
	    $result_tasks = mysqli_query($conn, $sql);
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
	    while ($task = mysqli_fetch_assoc($result_tasks)) {
	    	$sql = "SELECT * FROM projects WHERE project_id = $task[project_id]";
	    	$result_project = mysqli_query($conn, $sql);
	    	$project = mysqli_fetch_assoc($result_project);
	        echo 
	        "<tr>
	        	<td>".$num++."</td>
		        <td>$status</td>
		        <td>$task[task_priority]</td>
		        <td>$task[task_deadline]</td>
		        <td>$task[task_title]</td>
		        <td>$task[create_at]</td>
	        </tr>";
	    }
	    echo 
	    	'</table>';
	}

	if (mysqli_num_tasks($result) == 0) {
	    echo "No projects found.";
	}

	mysqli_close($conn);
}

function output_of_projects()
{   // displays the user`s tasks on the home page 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "organaizer";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if($conn->connect_error){
		die("Connect error: " . $conn->connect_error);
	}
	echo "<p><a href='../View/Home.php'>All tasks</a></p>";
	$sql = "SELECT * FROM projects WHERE create_by = '$_SESSION[user]'";
	if($result = mysqli_query($conn, $sql)){
	    foreach($result as $row){
	    	$project_id = $row['project_id'];
	    	$project_title = $row['project_title'];
			echo "<p><a href='../View/Home.php?project_id=$project_id'>$project_title</a></p>";
	    }
	    echo "</table>";
	    $result->free();
	}
}