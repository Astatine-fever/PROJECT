<?php
// Include the database connection file
require_once 'db_conn.php';
session_start();
$user_token = $_SESSION['token'];
$fnn = $_SESSION['fn'];
$lnn = $_SESSION['ln'];
$ema = $_SESSION['em'];
$pn = $_SESSION['phn'];
$db = $_SESSION['dob'];
$grd = $_SESSION['gd'];
$un = $_SESSION['uni'];

// Check if the connection was successful
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the form data from $_POST
$fn = $_POST['fname'] ?? $fnn; // Example: First Name
$ln = $_POST['lname'] ?? $lnn; // Example: Last Name
$email = $_POST['email'] ?? $ema; // Example: Email
$phone = $_POST['phone'] ?? $pn; // Example: Phone
$dd = date('Y-m-d', strtotime($_POST['dd'] ?? $db)); // Example: Date of Birth
$education = $_POST['education'] ?? $grd; // Example: Education
$eduId = $_POST['edu_id'] ?? $un; // Example: Educational Institute
 // Example: Password

// Save the data in the database table 'user_db'
// Replace 'user_db' with your actual table name and update the query accordingly
$query = "UPDATE user_db
          SET firstname = '$fn',
              lastname = '$ln',
              email = '$email',
              phone = '$phone',
              dob = '$dd',
              education = '$education',
              edu_institute = '$eduId'
          WHERE username = '$user_token'";

// Execute the query
$result = mysqli_query($conn, $query);

if ($result) {
 
  echo "Data saved successfully!";
} else {
  // Error occurred while saving data
  echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
