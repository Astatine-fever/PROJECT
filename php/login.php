<?php
require_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare the query using a parameterized statement
    $query = "SELECT * FROM user_db WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row !== null) {
        // User exists, verify the password
        $storedPassword = $row['pwd'];

        if (password_verify($password, $storedPassword)) {
            // Password is correct, redirect to the desired page
            session_start();
            $_SESSION['fn'] = $row['firstname'];
            $_SESSION['ln'] = $row['lastname'];
            $_SESSION['em'] = $row['email'];
            $_SESSION['phn'] = $row['phone'];
            $_SESSION['dob'] = $row['dob'];
            $_SESSION['un'] = $row['username'];
            $_SESSION['gd'] = $row['education'];
            $_SESSION['uni'] = $row['edu_institute'];
            
            header("Location: homepage.php");
            exit();
        }
        else
        {
            $sa = "Invalid username or password";
            echo($sa);
        }
    }

    
    
}
?>
