<?php

$servername = "127.0.0.1";
$username_db = "root";
$password_db= "";
$database = "policedb";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>