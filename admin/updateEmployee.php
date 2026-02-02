<?php
include '../assets/backend/db_connection.php';

if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true){
    header("location:http://localhost:8000/admin/index.php");
    exit();
}

$employee_id = isset($_GET['employee_id']) ? $_GET['employee_id'] : 0;

// Get employee details
$employeeQuery = "SELECT id, name, email, phone, address, password FROM employee WHERE id = '$employee_id'";
$employeeResult = executeQuery($employeeQuery);
$employee = null;

if (!empty($employeeResult) && strpos($employeeResult, 'ERROR') === false) {
    $lines = explode("\n", trim($employeeResult));
    $cleanLines = [];
    
    foreach ($lines as $line) {
        if (strpos($line, 'Warning') === false && strpos($line, 'mysql:') === false && !empty(trim($line))) {
            $cleanLines[] = trim($line);
        }
    }
    
    if (count($cleanLines) >= 2) {
        $headers = explode("\t", $cleanLines[0]);
        $data = explode("\t", $cleanLines[1]);
        if (count($headers) == count($data)) {
            $employee = array_combine($headers, $data);
        }
    }
}

// Handle form submission
if(isset($_POST['update-employee-btn'])){
    $editEmployeeName = $_POST['editEmployeeName'];
    $editEmployeeEmail = $_POST['editEmployeeEmail'];
    $editEmployeePhone = $_POST['editEmployeePhone'];
    $editEmployeeAddress = $_POST['editEmployeeAddress'];
    $editEmployeePassword = $_POST['editEmployeePassword'];
    $editEmployeeConfirmPassword = $_POST['editEmployeeConfirmPassword'];
    
    if($editEmployeePassword === $editEmployeeConfirmPassword){
        $updateQuery = "UPDATE employee SET name='$editEmployeeName', email='$editEmployeeEmail', phone='$editEmployeePhone', address='$editEmployeeAddress', password='$editEmployeePassword', updated_at=CURRENT_TIMESTAMP WHERE id = '$employee_id'";
        $updateResult = executeQuery($updateQuery);
        
        if(strpos($updateResult, 'ERROR') === false){
            echo "<script>alert('Employee updated successfully!'); window.location='http://localhost:8000/admin/home.php';</script>";
            exit();
        } else {
            $errorMessage = "Something went wrong. Please try again.";
        }
    } else {
        $errorMessage = "Password and Confirm Password do not match.";
    }
}

if (!$employee) {
    echo "<script>alert('Employee not found!'); window.location='http://localhost:8000/admin/home.php';</script>";
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unanda Bricks Co. - Update Employee</title>
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
                    <i class="fas fa-user-edit text-primary me-2 fs-4"></i>
                    <span class="navbar-brand mb-0 h1">Update Employee</span>
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
                        <h1 class="display-6 fw-bold mb-3">Update Employee</h1>
                        <p class="lead">Modify employee information</p>
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
                                    <label for="editEmployeeName" class="form-label fw-semibold">
                                        <i class="fas fa-user text-primary me-2"></i>Full Name
                                    </label>
                                    <input type="text" class="form-control" id="editEmployeeName" name="editEmployeeName" 
                                           value="<?php echo htmlspecialchars($employee['name']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="editEmployeeEmail" class="form-label fw-semibold">
                                        <i class="fas fa-envelope text-primary me-2"></i>Email Address
                                    </label>
                                    <input type="email" class="form-control" id="editEmployeeEmail" name="editEmployeeEmail" 
                                           value="<?php echo htmlspecialchars($employee['email']); ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="editEmployeePhone" class="form-label fw-semibold">
                                        <i class="fas fa-phone text-primary me-2"></i>Phone Number
                                    </label>
                                    <input type="tel" class="form-control" id="editEmployeePhone" name="editEmployeePhone" 
                                           value="<?php echo htmlspecialchars($employee['phone']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="editEmployeeAddress" class="form-label fw-semibold">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>Address
                                    </label>
                                    <input type="text" class="form-control" id="editEmployeeAddress" name="editEmployeeAddress" 
                                           value="<?php echo htmlspecialchars($employee['address']); ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="editEmployeePassword" class="form-label fw-semibold">
                                        <i class="fas fa-lock text-primary me-2"></i>Password
                                    </label>
                                    <input type="password" class="form-control" id="editEmployeePassword" name="editEmployeePassword" 
                                           value="<?php echo htmlspecialchars($employee['password']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="editEmployeeConfirmPassword" class="form-label fw-semibold">
                                        <i class="fas fa-lock text-primary me-2"></i>Confirm Password
                                    </label>
                                    <input type="password" class="form-control" id="editEmployeeConfirmPassword" name="editEmployeeConfirmPassword" 
                                           placeholder="Confirm the password" required>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                                <button type="submit" id="update-employee-btn" name="update-employee-btn" class="btn btn-primary btn-lg px-5 me-md-2">
                                    <i class="fas fa-save me-2"></i>Update Employee
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
        document.getElementById('editEmployeeConfirmPassword').addEventListener('input', function() {
            const password = document.getElementById('editEmployeePassword').value;
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