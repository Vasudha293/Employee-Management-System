<?php

// include the database connection 
include 'db_connection.php';

// get the employee email and password from the form submission
$employee_email = $_POST['employeeEmail'];
$employee_password = $_POST['employeePassword'];

// check if the employee login button was clicked
if(isset($_POST['employee_login_btn'])){
    // Get employee details from database
    $select = "SELECT id, name, email, password FROM employee WHERE email = '$employee_email'";
    $result = executeQuery($select);
    
    // Parse the result (command line MySQL returns tab-separated values)
    $lines = explode("\n", trim($result));
    $cleanLines = [];
    
    foreach ($lines as $line) {
        // Skip warning messages
        if (strpos($line, 'Warning') === false && strpos($line, 'mysql:') === false && !empty(trim($line))) {
            $cleanLines[] = trim($line);
        }
    }
    
    if (count($cleanLines) >= 2) { // First line is headers, second line is data
        $headers = explode("\t", $cleanLines[0]);
        $data = explode("\t", $cleanLines[1]);
        
        // Create associative array
        if (count($headers) == count($data)) {
            $row = array_combine($headers, $data);
            
            if($row && isset($row['password'])){
                if($row['password'] === $employee_password){
                    $_SESSION['employeeName'] = $row['name'];
                    $_SESSION['employee_id'] = $row['id'];
                    $_SESSION['employeeEmail'] = $row['email'];
                    $_SESSION['employee_logged_in'] = true;

                    header("location:http://localhost:8000/home.php?employee_id=" . urlencode($row['id']) . "&username=" . urlencode($row['name']));
                    exit();
                }else{
                    echo "<script>alert('Password does not match...try again!!'); window.location='http://localhost:8000/index.php';</script>";
                }
            }else{
                echo "<script>alert('Employee does not exist...try again!!'); window.location='http://localhost:8000/index.php';</script>";
            }
        } else {
            echo "<script>alert('Employee does not exist - data mismatch!'); window.location='http://localhost:8000/index.php';</script>";
        }
    }else{
        echo "<script>alert('Employee does not exist...try again!!'); window.location='http://localhost:8000/index.php';</script>";
    }
}

?>