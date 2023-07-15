<?php
// Establish database connection (adjust these values according to your database configuration)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "astaverse";

// Create a new MySQLi instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dd = $_POST['dd'];
    $uname = $_POST['uname'];
    $pword = password_hash($_POST['pword'],PASSWORD_DEFAULT);
    $cg = $_POST['cg'];
    $school = $_POST['school'];

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO user_db VALUES ('$fname', '$lname', '$email', '$phone', '$dd', '$uname', '$pword', '$cg', '$school')";

    if ($conn->query($sql) === true) {
        // Redirect to a success page or display a success message
        header('Location: success.php');
        exit();
    } else {
        // Display an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
