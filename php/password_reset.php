<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the submitted first name and educational institute
    $first_name = $_POST["first_name"];
    $edu_institute = $_POST["edu_institute"];
    $new_password = $_POST["pwd"];
    // Database connection parameters
 require_once "db_conn.php";

    // Connect to the database (you may want to use mysqli or PDO for added security)

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch the user record based on first name and educational institute
    $query = "SELECT * FROM user_db WHERE firstname='$first_name' AND edu_institute='$edu_institute'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // User exists, now update the password
         // Replace this with the new password provided by the user

        // Hash the new password using PHP's password_hash function
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $update_query = "UPDATE user_db SET pwd='$hashed_password' WHERE firstname='$first_name' AND edu_institute='$edu_institute'";
        if (mysqli_query($conn, $update_query)) {
            echo "Password reset successful!";
        } else {
            echo "Error updating password: " . mysqli_error($conn);
        }
    } else {
        echo "User not found. Please check your first name and educational institute.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
