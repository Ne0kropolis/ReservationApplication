<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travelbuddydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	//echo "Connection Failed";
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>