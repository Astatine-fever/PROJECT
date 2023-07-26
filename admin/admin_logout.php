<?php
// end_session.php

// Start or resume the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page or any other appropriate page
header("Location:admin_login.html"); // Replace with the URL to your login page
exit;
?>
