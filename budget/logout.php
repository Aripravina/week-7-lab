<?php
session_start(); // Start the session
// Destroy the session and clear session variables
$_SESSION = array();
session_destroy();
// Redirect to the register page
header("Location: register.php"); // Adjust the path to your register page
exit();
?>
