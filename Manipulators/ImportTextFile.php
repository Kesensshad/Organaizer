<?php
session_start();
if(isset($_POST['import'])) {
   $filename = $_FILES['fileToImport']['name'];
   $filetmp = $_FILES['fileToImport']['tmp_name'];

   $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
   if ($file_extension != 'txt') {
      echo "Error: Only text files (.txt) are allowed.";
   exit();
   }

   $file = fopen($filetmp, "r");

   $data = array();
   while (($line = fgets($file)) !== false) {
      $fields = explode(",", $line);
      $data[] = $fields;
   }

   fclose($file);

   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "organaizer";
   $conn = mysqli_connect($servername, $username, $password, $dbname);

   foreach ($data as $fields) {
      switch ($fields[0]){
         case 'Finished':
               $status = 1;
               break;
         case 'Not finished':
               $status = 2;
               break;
         case 'Delayed':
               $status = 3;
               break;
      }
      $priority = $fields[1];
      $deadline = $fields[2];
      $title = $fields[3];
      $create_by = $_SESSION['user'];

      $sql = "INSERT INTO tasks (task_status, task_priority, task_deadline, task_title, create_by, create_at) VALUES ('$status', '$priority', '$deadline', '$title', '$create_by', NOW())";
      if ($conn->query($sql) === TRUE) {
         header("Location: ../view/Home.php");
      } else {
         echo "Error adding data: " . $conn->error;
      }
   }

   mysqli_close($conn);
}