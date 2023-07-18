<?php
$servername = "localhost";
$username = "asta_admin";
$password = "Ast@t!n3p63";
$database = "astaverse";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
