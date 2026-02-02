<?php

// Employee logout functionality

// Start the session
session_start();

// Unset all employee session variables
unset($_SESSION['employee_logged_in']);
unset($_SESSION['employeeName']);
unset($_SESSION['employee_id']);
unset($_SESSION['employeeEmail']);

// Destroy the session completely
session_destroy();

// Redirect to the employee login page
header("location:http://localhost:8000/index.php?msg=logout");
exit();
?>
