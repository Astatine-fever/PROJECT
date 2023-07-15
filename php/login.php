<?php
// Establish database connection (adjust these values according to your database configuration)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "astaverse";

// Create a new MySQLi instance
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare the query using a parameterized statement
    $query = "SELECT UserName, Pwd FROM user_db WHERE UserName = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row !== null) {
        // User exists, verify the password
        $storedPassword = $row['Pwd'];

        if (password_verify($password, $storedPassword)) {
            // Password is correct, redirect to the desired page
            echo "Login successful";
            // Redirect to the desired page here
            exit();
        }
    }

    $error = "Invalid username or password";
}
?>
