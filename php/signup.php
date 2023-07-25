<?php
// Establish database connection (adjust these values according to your database configuration)
require_once 'db_conn.php';

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
    $dob = date('Y-m-d', strtotime($_POST['dd'])); // Convert date to MySQL format
    $uname = $_POST['uname'];
    $pword = password_hash($_POST['pword'], PASSWORD_DEFAULT);
    $cg = $_POST['cg'];
    $school = $_POST['school'];

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO user_db (
        firstname, lastname, email, phone, dob, username, 
        pwd, education, edu_institute,created_at) 
        VALUES 
        (
            '$fname', '$lname', '$email', '$phone', '$dob', '$uname', 
            '$pword', '$cg', '$school',NOW()
        )";

    if ($conn->query($sql) === true) {
        // Redirect to a success page or display a success message
        $sql_1 = "INSERT INTO scores (
            fname, botany, zoology, chemistry, physics, maths, technology,engineering) 
            VALUES ('$fname', 0, 0, 0, 0, 0, 0,0)";
        
        $conn->query($sql_1);

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
