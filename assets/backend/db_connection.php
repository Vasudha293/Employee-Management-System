<?php
// database Connection
//connection to a MySQL database
$hostname = "localhost";
$username = "vasudha";
$password = "password";
$db =  "emp";
$conn = new mysqli($hostname,$username,$password,$db);

// Check for connection errors or not
if($conn->connect_error){
  die("connection error".$conn->connect_error);
}

// not error then start a session ........kish work

// Start a new session
session_start();

// Turn on error reporting
error_reporting('1');
?>
