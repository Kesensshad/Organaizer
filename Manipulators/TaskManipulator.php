<?php
session_start();
require_once('Connect.php');
connect();

function create($status = 1, $priority = '', $deadline = 'NULL', $title, $user){// describe creation
	$require = $connection->prepare("
		INSERT INTO task (task_status, task_priority, task_deadline, task_title, create_by, create_at) 
		VALUES (:status, :priority, :deadline, :title, :user, NOW())
	");
	$require->bindValue(':status', $status);
	$require->bindValue(':priority', $priority);
	$require->bindValue(':deadline', $deadline);
	$require->bindValue(':title', $title);
	$require->bindValue(':user', $user);
	$require->execute();
}
function delete(){// describe deletion
}
function update(){// describe updation
}


if ($_POST['actionWithATask'] == 'create')
	create($_POST['status'], $_POST['priority'], $_POST['deadline'], $_POST['title'], $_SESSION['user']);
if ($_POST['actionWithATask'] == 'delete')
	delete();
if ($_POST['actionWithATask'] == 'update')
	update();