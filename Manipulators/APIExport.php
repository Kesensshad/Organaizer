<?php
session_start();

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";
$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connect error: " . mysqli_connect_error());
}


$sql = "SELECT * FROM tasks WHERE create_by = $_SESSION['user']";
$result = mysqli_query($conn, $sql);


$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><tasks></tasks>');


foreach ($result as $row) {
    $task = $xml->addChild('task');
    $task->addChild('id', $row['id']);
    $task->addChild('status', $row['status']);
    $task->addChild('priority', $row['priority']);
    $task->addChild('deadline', $row['deadline']);
    $task->addChild('title', $row['title']);
    $task->addChild('created_at', $row['created_at']);
}


header('Content-type: text/xml');
echo $xml->asXML();


mysqli_close($conn);