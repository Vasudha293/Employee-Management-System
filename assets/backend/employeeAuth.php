<?php

// include the database connection 
include 'db_connection.php';

// get the employee email and password from the form submission
$employee_email = $_POST['employeeEmail'];
$employee_password = $_POST['employeePassword'];

// check if the employee ch login button click kely ka nahi
if(isset($_POST['employee_login_btn'])){
        // emp chya table mndhun email varun details gheun check karne
        $select = "SELECT * FROM `employee` WHERE email = '$employee_email'";
        $query = mysqli_query($conn, $select);
        $row = mysqli_fetch_assoc($query);
        
        // if the employee exists in the database then khalil 
        if($row){
            // check if password jar mach zala tr
            if($row['password']===$employee_password){
                // jar password mach zala tr session enabled karun dene
                echo $row['name'];
                $_SESSION['employeeName'] = $row['name'];
                $_SESSION['employee_id'] = $row['id'];
                $_SESSION['employeeEmail'] = $row['email'];
                $_SESSION['employee_logged_in'] = true;

                header("location:http://localhost/employeeManagementPHP/home.php?employee_id=$row[id]&username=$row[name]");
            }else{
                // if the password does not match then part same page la redirect kara
                echo "<script>alert('Password does not match...try again!!'); window.location='../../index.php';</script>";

            }
                  
        }else{
            // if the employee does not exist : alred deun part same page la redirect kara
            echo "<script>alert('Employee does not exist...try again!!'); window.location='../../index.php';</script>";
        }
}

?>