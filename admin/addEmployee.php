<?php
include '../assets/backend/db_connection.php';

if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true){
    header("location:http://localhost:8000/admin/index.php");
    exit();
}

// Handle form submission
if(isset($_POST['add-employee-btn'])){
    $employeeName = $_POST['employeeName'];
    $employeeEmail = $_POST['employeeEmail'];
    $employeePhone = $_POST['employeePhone'];
    $employeeAddress = $_POST['employeeAddress'];
    $employeePassword = $_POST['employeePassword'];
    $employeeConfirmPassword = $_POST['employeeConfirmPassword'];
    
    // Check if passwords match
    if($employeePassword === $employeeConfirmPassword){
        
        // Check if employee already exists
        $checkQuery = "SELECT COUNT(*) FROM employee WHERE email = '$employeeEmail'";
        $checkResult = executeQuery($checkQuery);
        
        // Parse the count result
        $lines = explode("\n", trim($checkResult));
        $cleanLines = [];
        foreach ($lines as $line) {
            if (strpos($line, 'Warning') === false && strpos($line, 'mysql:') === false && !empty(trim($line))) {
                $cleanLines[] = trim($line);
            }
        }
        
        $employeeExists = false;
        if (count($cleanLines) >= 2) {
            $countValue = trim($cleanLines[1]);
            $employeeExists = ($countValue > 0);
        }
        
        if(!$employeeExists){
            // Insert new employee
            $insertQuery = "INSERT INTO employee (name, email, phone, address, password, created_at, updated_at) VALUES ('$employeeName','$employeeEmail','$employeePhone','$employeeAddress', '$employeePassword', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
            $insertResult = executeQuery($insertQuery);
            
            if(strpos($insertResult, 'ERROR') === false){
                echo "<script>alert('Employee added successfully!'); window.location='http://localhost:8000/admin/home.php';</script>";
                exit();
            }else{
                $errorMessage = "Something went wrong. Please try again.";
            }
        }else{
            $errorMessage = "Employee with this email already exists.";
        }
    }else{
        $errorMessage = "Password and Confirm Password do not match.";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unanda Bricks Co. - Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body>
        <!-- Modern Navbar -->
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-plus text-primary me-2 fs-4"></i>
                    <span class="navbar-brand mb-0 h1">Add Employee</span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="text-muted me-3">Welcome, <strong><?php echo $_SESSION['adminName'];?></strong></span>
                    <div class="logout-btn me-3">
                        <a href="home.php" class="d-flex align-items-center">
                            <i class="fas fa-home me-1"></i> Dashboard
                        </a>
                    </div>
                    <div class="logout-btn">
                        <a href="../assets/backend/logout.php" class="d-flex align-items-center">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <!-- Header -->
                    <div class="text-center text-white mb-5 fade-in-up">
                        <h1 class="display-6 fw-bold mb-3">Add New Employee</h1>
                        <p class="lead">Fill in the details to add a new team member</p>
                    </div>

                    <!-- Form Card -->
                    <div class="add-employee-form fade-in-up" style="animation-delay: 0.2s;">
                        <?php if(isset($errorMessage)): ?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?php echo $errorMessage; ?>
                        </div>
                        <?php endif; ?>
                        
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="employeeName" class="form-label fw-semibold">
                                        <i class="fas fa-user text-primary me-2"></i>Full Name
                                    </label>
                                    <input type="text" class="form-control" id="employeeName" name="employeeName" 
                                           placeholder="Enter employee's full name" required>
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="employeeEmail" class="form-label fw-semibold">
                                        <i class="fas fa-envelope text-primary me-2"></i>Email Address
                                    </label>
                                    <input type="email" class="form-control" id="employeeEmail" name="employeeEmail" 
                                           placeholder="employee@company.com" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="employeePhone" class="form-label fw-semibold">
                                        <i class="fas fa-phone text-primary me-2"></i>Phone Number
                                    </label>
                                    <input type="tel" class="form-control" id="employeePhone" name="employeePhone" 
                                           placeholder="+1 (555) 123-4567" required>
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="employeeAddress" class="form-label fw-semibold">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>Address
                                    </label>
                                    <input type="text" class="form-control" id="employeeAddress" name="employeeAddress" 
                                           placeholder="Enter full address" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="employeePassword" class="form-label fw-semibold">
                                        <i class="fas fa-lock text-primary me-2"></i>Password
                                    </label>
                                    <input type="password" class="form-control" id="employeePassword" name="employeePassword" 
                                           placeholder="Create a secure password" required>
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="employeeConfirmPassword" class="form-label fw-semibold">
                                        <i class="fas fa-lock text-primary me-2"></i>Confirm Password
                                    </label>
                                    <input type="password" class="form-control" id="employeeConfirmPassword" name="employeeConfirmPassword" 
                                           placeholder="Confirm the password" required>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                                <button type="submit" id="add-employee-btn" name="add-employee-btn" class="btn btn-primary btn-lg px-5 me-md-2">
                                    <i class="fas fa-user-plus me-2"></i>Add Employee
                                </button>
                                <a href="home.php" class="btn btn-secondary btn-lg px-5">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Password Validation Script -->
    <script>
        document.getElementById('employeeConfirmPassword').addEventListener('input', function() {
            const password = document.getElementById('employeePassword').value;
            const confirmPassword = this.value;
            
            if (password !== confirmPassword) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
  </body>
</html>