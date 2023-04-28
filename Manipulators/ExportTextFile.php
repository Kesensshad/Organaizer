<?php
session_start();
error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "organaizer";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT task_status, task_priority, task_deadline, task_title FROM tasks WHERE create_by = '$_SESSION[user]'";
$result = mysqli_query($conn, $sql);

$filename = "../tasks.txt";
$file = fopen($filename, "w") or die("Unable to open file!");
if ($file) {
    foreach ($result as $row) {
        $sql = "SELECT status_title FROM task_status WHERE status_id = $row[task_status]";
        $status = mysqli_query($conn, $sql);
        foreach ($status as $task_status)
            $row['task_status'] = $task_status['status_title'].',';
        $row['task_priority'] = $row['task_priority'].',';
        $row['task_deadline'] = $row['task_deadline'].',';
        $row['task_title'] = $row['task_title'];
        // echo $row['task_status'];
        $line = implode("\t", $row);
        fwrite($file, $line . "\n");
    }
}
else {
   echo "File open failed.";
}
fclose($file);
mysqli_close($conn);
header("Location: ../view/Home.php");