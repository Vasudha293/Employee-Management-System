<?php

include 'db_connection.php';
// ========== LOGIN Admin ==========
$admin_email = $_POST['adminEmail'];
$admin_password = $_POST['adminPassword'];

//ithe admin button click kel ka te check karto
if(isset($_POST['admin_login_btn'])){
    // Use our executeQuery function instead of mysqli
    $select = "SELECT id, name, email, password FROM admin WHERE email = '$admin_email'";
    $result = executeQuery($select);
    
    // Filter out the warning message and get clean result
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
                if($row['password'] === $admin_password){
                    $_SESSION['adminName'] = $row['name'];
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['adminEmail'] = $row['email'];
                    $_SESSION['admin_logged_in'] = true;

                    header("location:http://localhost:8000/admin/home.php?username=" . urlencode($row['name']));
                    exit();
                }else{
                    echo "<script>alert('Password does not match...try again!!'); window.location='http://localhost:8000/admin/index.php';</script>";
                }
            }else{
                echo "<script>alert('Admin does not exist - no password field found!'); window.location='http://localhost:8000/admin/index.php';</script>";
            }
        } else {
            echo "<script>alert('Admin does not exist - data mismatch!'); window.location='http://localhost:8000/admin/index.php';</script>";
        }
    }else{
        echo "<script>alert('Admin does not exist - no data found!'); window.location='http://localhost:8000/admin/index.php';</script>";
    }
}

?>