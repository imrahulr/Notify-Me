<font face="Comic Sans MS" color="white" >

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

$sqr = "SELECT DISTINCT title, text FROM notifications WHERE No<=50";
$result = $conn->query($sqr);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo "  " . $row['title']. "-->>&nbsp;" . $row['text']. "<br>";
    }
}

$sqr = "SELECT DISTINCT title, text FROM notifications WHERE No>50 AND No<=100";
$result = $conn->query($sqr);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo "  " . $row['title']. "-->>&nbsp;" . $row['text']. "<br>";
    }
}

$sqr = "SELECT DISTINCT title, text FROM notifications WHERE No>100 AND No<=150";
$result = $conn->query($sqr);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo "  " . $row['title']. "-->>&nbsp;" . $row['text']. "<br>";
    }
}

$conn->close();

?>

</font>