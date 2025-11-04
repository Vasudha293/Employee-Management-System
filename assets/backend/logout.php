<?php

// he page admin logout sathi ahe 

// Start a new session
session_start();

// Unset the 'admin_logged_in' session variable
unset($_SESSION['admin_logged_in']);

// Destroy the session
// session_destroy();

// Redirect the user to the login page
header("location:http://localhost/employeeManagementPHP/admin/index.php?msg=logout");
?>