<?php
// Initialize the session
//session_start();

// Destroy the session
session_destroy();
session_unset();

// Redirect to the login page after logout
header("Location:../login.php");
exit();
?>