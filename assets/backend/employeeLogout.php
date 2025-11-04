<?php
// start the session
session_start();

// unset the session variable for employee_logged_in to log out
unset($_SESSION['employee_logged_in']);

// redirect the main login page
header("location:http://localhost/employeeManagementPHP/index.php?msg=logout");
?>
