<?php
session_start();

$base = "organaizer";
$user = "root";
$pswd = "";
$host = "localhost";


	$connection = new PDO("mysql:host=".$host.";dbname=".$base, $user, $pswd);
	$connection->prepare("set character_set_client='utf8'")->execute();
	$connection->prepare("set character_set_results='utf8'")->execute();
	$connection->prepare("set collation_connection='utf8_general_ci'")->execute();
	return $connection;

// $conn = new mysqli("localhost", "root", "", "organaizer");
// if($conn->connect_error){
// 	die("Ошибка: " . $conn->connect_error);
// }