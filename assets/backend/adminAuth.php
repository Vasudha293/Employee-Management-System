<?php

include 'db_connection.php';
// ========== LOGIN Admin ==========
$admin_email = $_POST['adminEmail'];
$admin_password = $_POST['adminPassword'];


//ithe admin button click kel ka te check karto
if(isset($_POST['admin_login_btn'])){
        $select = "SELECT * FROM `admin` WHERE email = '$admin_email'";
        $query = mysqli_query($conn, $select);
        $row = mysqli_fetch_assoc($query);
        if($row){
            if($row['password']===$admin_password){
                echo $row['name'];
                $_SESSION['adminName'] = $row['name'];
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['adminEmail'] = $row['email'];
                $_SESSION['admin_logged_in'] = true;

                header("location:http://localhost/employeeManagementPHP/admin/home.php?username=$row[name]");
            }else{
                echo "<script>alert('Password does not match...try again!!'); window.location='../../admin/index.php';</script>";

            }
                  
        }else{
            echo "<script>alert('Admin does not exist...try again!!'); window.location='../../admin/index.php';</script>";
        }
}

?>