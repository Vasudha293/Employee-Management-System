<?php
    include '../assets/backend/db_connection.php';
    if($_SESSION['admin_logged_in'] == true){  
    include '../assets/backend/employee.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unanda Bricks Co.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body>
        <!-- Navbar -->
        <nav class="navbar bg-light">
            <div class="container">
                <span class="navbar-brand mb-0 h1"><?php echo $_SESSION['adminName'];?></span>
                <div class="d-flex justify-content-end logout-btn"><a href="../assets/backend/logout.php">Logout</a></div>
            </div>
        </nav>
        <!-- ./Navbar -->

        <!-- Add Employee Form -->
        <div class="container">
    <!-- Start row -->
    <div class="row mt-5">
        <!-- Display heading -->
        <h1 class="col-md-6 offset-md-3 text-center">Update Employee</h1>
        <!-- Start form container -->
        <div class="col-md-6 offset-md-3 mt-2 border rounded p-4">
            <!-- Start form -->
            <form method="post" action=<?php echo '../assets/backend/employee.php?employee_id='.$sid_row['id']?>>
                <!-- Name input -->
                <div class="mb-3">
                    <label for="editEmployeeName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="editEmployeeName" name="editEmployeeName" value="<?php echo $sid_row['name'];?>" placeholder="Employee Name" required>
                </div>
                <!-- Email input -->
                <div class="mb-3">
                    <label for="editEmployeeEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="editEmployeeEmail" name="editEmployeeEmail" value="<?php echo $sid_row['email'];?>" placeholder="Employee Email" required>
                </div>
                <!-- Phone input -->
                <div class="mb-3">
                    <label for="editEmployeePhone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="editEmployeePhone" name="editEmployeePhone" value="<?php echo $sid_row['phone'];?>" placeholder="Employee Phone number" required>
                </div>
                <!-- Address input -->
                <div class="mb-3">
                    <label for="editEmployeeAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" id="editEmployeeAddress" name="editEmployeeAddress" value="<?php echo $sid_row['address'];?>" placeholder="Employee Address" required>
                </div>
                <!-- Password input -->
                <div class="mb-3">
                    <label for="editEmployeePassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="editEmployeePassword" name="editEmployeePassword" value="<?php echo $sid_row['password'];?>" placeholder="Password" required>
                </div>
                <!-- Confirm password input -->
                <div class="mb-3">
                    <label for="editEmployeeConfirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="editEmployeeConfirmPassword" name="editEmployeeConfirmPassword" placeholder="Confirm Password" required>
                </div>
                <!-- Submit button -->
                <button type="submit" id="update-employee-btn" name="update-employee-btn" class="btn btn-primary">Update Employee</button>
            <!-- End form -->
            </form>
        <!-- End form container -->
        </div>
        </div>
        </div>
       

        <!-- ./Add Employee Form -->

                    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  </body>
</html>

<?php
    }else{
        header("location:http://localhost/employeeManagementPHP/admin/index.php?msg=login_first");
    }
?>