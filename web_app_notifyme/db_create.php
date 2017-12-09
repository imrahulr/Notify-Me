<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_notifyme";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$result=mysqli_query($conn,"SELECT * FROM notifications");
$count = $result->num_rows;

if ($count<151) {
	if (isset($_POST['title']) && isset($_POST['text'])) {
	
		$title = $_POST['title'];
		$text = $_POST['text'];
		$sql = "INSERT INTO notifications (title, text) VALUES ('$title', '$text')";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}
else {
	if (isset($_POST['title']) && isset($_POST['text'])) {
		
		mysqli_query($conn,'TRUNCATE TABLE notifications');
		$title = $_POST['title'];
		$text = $_POST['text'];
		$sql = "INSERT INTO notifications (title, text) VALUES ('$title', '$text')";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}

$conn->close();

?>
