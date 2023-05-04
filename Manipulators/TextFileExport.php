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
$sql = "SELECT * FROM tasks WHERE create_by = '$_SESSION[user]'";
$result = mysqli_query($conn, $sql);

$filename = "../tasks.txt";
$file = fopen($filename, "w") or die("Unable to open file!");
if ($file) {
    // ects); $i++) {
    //  echo $i;
    //  if ($f[$i] == 1){
    //      $sql = "SELECT * FROM projects WHERE project_title = '$projects[$i]'";
    //      $project = mysqli_query($conn, $sql); $project = mysqli_fetch_assoc($project);
    //      if ($projects[$i] == $project['project_title'])
    //      {
    //          $sql = "INSERT INTO task_project (task_id, project_id) VALUES ($task_id, $project[project_id])";
    //          $task_id++;
    //          mysqli_query($conn, $sql);
    //      }
    //      else
    //      {
    //          $sql = "INSERT INTO projects (project_title, create_by, create_at) VALUES ($projects[$i], $_SESSION[user], NOW())";
    //          mysqli_query($conn, $sql);
    //          $sql = "SELECT MAX(project_id) FROM projects"; $proj = mysqli_query($conn, $sql); $proj = mysqli_fetch_assoc($proj); $proj = $proj['MAX(project_id)'];
    //          $sql = "INSERT INTO task_project (task_id, project_id) VALUES ($task_id, $proj)";
    //          $task++;
    //      }
    //  }
    //  else $task_id++;
    // }
    // header("Location: ../View/Hom
    foreach ($result as $row) {
        $file_str = "";
        $sql = "SELECT status_title FROM task_status WHERE status_id = $row[task_status]";
        $status = mysqli_query($conn, $sql); $status = mysqli_fetch_assoc($status);
        $file_str .= "$status[status_title] ";
        if (!empty($row['task_priority']))
            $file_str .= "($row[task_priority]) ";
        $file_str .= "$row[task_title] ";
        $sql = "SELECT * FROM task_project WHERE task_id = $row[task_id]";
        $task_project = mysqli_query($conn, $sql);
        foreach($task_project as $project_id)
        {
            $sql = "SELECT project_title FROM projects WHERE project_id = $project_id[project_id]";
            $project = mysqli_query($conn, $sql); $project = mysqli_fetch_assoc($project);
            $file_str .= "+$project[project_title] ";
        }
        $file_str .= "due: $row[task_deadline] ";
        fwrite($file, $file_str . "\n");
        header("Location: ../View/Home.php");
    }
}
else {
   echo "File open failed.";
}