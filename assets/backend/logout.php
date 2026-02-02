<?php

// Admin logout functionality

// Start a new session
session_start();

// Unset all admin session variables
unset($_SESSION['admin_logged_in']);
unset($_SESSION['adminName']);
unset($_SESSION['admin_id']);
unset($_SESSION['adminEmail']);

// Destroy the session completely
session_destroy();

// Redirect the user to the admin login page
header("location:http://localhost:8000/admin/index.php?msg=logout");
exit();
?>