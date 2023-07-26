<?php
session_start();

require_once('../php/db_conn.php');

// Step 1: Verify username and password in 'admin_db'
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM admin_db WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row !== null) {
        // Step 2: Connect to 'user_db' and retrieve data
        $user_data = array();
        $firstname_array = array();
        $lastname_array = array();

        $user_query = "SELECT firstname, lastname FROM user_db";
        $user_result = mysqli_query($conn, $user_query);

        while ($user_row = mysqli_fetch_assoc($user_result)) {
            $firstname_array[] = $user_row['firstname'];
            $lastname_array[] = $user_row['lastname'];
        }

        // Step 3: Connect to 'scores' and retrieve data
        $scores_data = array();
        $physics_array = array();
        $chemistry_array = array();
        $botany_array = array();
        $zoology_array = array();
        $technology_array = array();
        $engineering_array = array();

        $scores_query = "SELECT physics,chemistry, botany, zoology, technology, engineering FROM scores";
        $scores_result = mysqli_query($conn, $scores_query);

        while ($scores_row = mysqli_fetch_assoc($scores_result)) {
            $physics_array[] = $scores_row['physics'];
            $chemistry_array[] = $scores_row['chemistry'];
            $botany_array[] = $scores_row['botany'];
            $zoology_array[] = $scores_row['zoology'];
            $technology_array[] = $scores_row['technology'];
            $engineering_array[] = $scores_row['engineering'];
        }

        // Step 4: Store data in the session
        $_SESSION['firstname_array'] = $firstname_array;
        $_SESSION['lastname_array'] = $lastname_array;
        $_SESSION['physics_array'] = $physics_array;
        $_SESSION['chemistry_array'] = $chemistry_array;
        $_SESSION['botany_array'] = $botany_array;
        $_SESSION['zoology_array'] = $zoology_array;
        $_SESSION['technology_array'] = $technology_array;
        $_SESSION['engineering_array'] = $engineering_array;

        // Continue with your remaining code...
        header("Location:dashboard.php");
        exit();
    } else {
        echo "Invalid credentials.";
    }
}
?>
