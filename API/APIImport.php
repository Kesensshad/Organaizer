<?php
$xml = simplexml_load_file('data.xml');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "organaizer";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connect error: " . mysqli_connect_error());
}

$sql = "INSERT INTO tasks (task_status, task_priority, task_deadline, task_title, create_by, create_at) VALUES ";
$values = array();
foreach ($xml->task as $task) {
    $values[] = "(
        '{$task->task_status}',
        '{$task->task_priority}',
        '{$task->task_deadline}',
        '{$task->task_title}',
        '{$task->create_by}',
        '{$task->create_at}'
    )";
}
$sql .= implode(",", $values);

if (mysqli_query($conn, $sql)) {
    echo "Data imported successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);