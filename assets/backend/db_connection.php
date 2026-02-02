<?php
// Database connection using system MySQL
$hostname = "localhost";
$username = "root";
$password = "root";
$db = "employee_management";

// Create a simple connection object
$conn = new stdClass();
$conn->connect_error = false;

// Test connection by trying to execute a simple query
$mysqlPath = '"C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql.exe"';
$testCommand = "$mysqlPath -h localhost -u root -p$password -e \"USE employee_management; SELECT 1;\" 2>&1";
$testResult = shell_exec($testCommand);

if (strpos($testResult, 'ERROR') !== false || empty($testResult)) {
    $conn->connect_error = "Database connection failed. Make sure MySQL is running and database 'employee_management' exists.";
}

// Simple query execution function
function executeQuery($query) {
    global $hostname, $username, $password, $db;
    
    // Use full path to MySQL
    $mysqlPath = '"C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql.exe"';
    
    // Don't escape quotes - let the command handle them
    $command = "$mysqlPath -h $hostname -u $username -p$password $db -e \"$query\" 2>&1";
    
    $result = shell_exec($command);
    return $result;
}

// Mock mysqli functions for basic compatibility
function mysqli_query($conn, $query) {
    if ($conn->connect_error) {
        return false;
    }
    
    $result = executeQuery($query);
    
    if (strpos($result, 'ERROR') !== false) {
        return false;
    }
    
    // Return a simple result object
    $resultObj = new stdClass();
    $resultObj->data = $result;
    return $resultObj;
}

function mysqli_fetch_assoc($result) {
    // Simplified - just return false for now
    return false;
}

function mysqli_num_rows($result) {
    if (!$result || strpos($result->data, 'ERROR') !== false) {
        return 0;
    }
    // Count lines in result (rough estimate)
    return substr_count($result->data, "\n") - 1;
}

// not error then start a session ........kish work

// Fix session path issue
ini_set('session.save_path', 'D:\F\Xampp\tmp');

// Start a new session
session_start();

// Turn on error reporting
error_reporting('1');
?>
