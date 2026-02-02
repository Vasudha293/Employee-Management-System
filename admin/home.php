<?php
include '../assets/backend/db_connection.php';

if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true){
    header("location:http://localhost:8000/admin/index.php");
    exit();
}

// Get employee list directly
$select = "SELECT id, name, email, phone, address, created_at FROM employee";
$result = executeQuery($select);

// Parse employees
$employees = [];
if (!empty($result) && strpos($result, 'ERROR') === false) {
    $lines = explode("\n", trim($result));
    $cleanLines = [];
    
    foreach ($lines as $line) {
        if (strpos($line, 'Warning') === false && strpos($line, 'mysql:') === false && !empty(trim($line))) {
            $cleanLines[] = trim($line);
        }
    }
    
    if (count($cleanLines) >= 1) {
        $headers = explode("\t", $cleanLines[0]);
        for ($i = 1; $i < count($cleanLines); $i++) {
            $data = explode("\t", $cleanLines[$i]);
            if (count($headers) == count($data)) {
                $employees[] = array_combine($headers, $data);
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unanda Bricks Co. - Admin Dashboard</title>
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
                    <i class="fas fa-user-shield text-primary me-2 fs-4"></i>
                    <span class="navbar-brand-custom mb-0 h1">UNANDA BRICKS</span>
                    <span class="text-muted ms-2">Admin Dashboard</span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="text-muted me-3">Welcome, <strong><?php echo $_SESSION['adminName'];?></strong></span>
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
            <!-- Header Section with Company Branding -->
            <div class="page-header fade-in-up">
                <h1 class="company-name">UNANDA BRICKS</h1>
                <p class="company-tagline">Building and Material Suppliers</p>
                <h2 class="page-title">Employee Management System</h2>
                <p class="page-subtitle">Manage your team efficiently and track their progress</p>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-5">
                <div class="col-md-4 mb-3">
                    <div class="card text-center fade-in-up" style="animation-delay: 0.1s;">
                        <div class="card-body">
                            <i class="fas fa-users text-primary fs-1 mb-3"></i>
                            <h3 class="fw-bold"><?php echo count($employees); ?></h3>
                            <p class="text-muted mb-0">Total Employees</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-center fade-in-up" style="animation-delay: 0.2s;">
                        <div class="card-body">
                            <i class="fas fa-tasks text-success fs-1 mb-3"></i>
                            <h3 class="fw-bold">0</h3>
                            <p class="text-muted mb-0">Active Tasks</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-center fade-in-up" style="animation-delay: 0.3s;">
                        <div class="card-body">
                            <i class="fas fa-chart-line text-warning fs-1 mb-3"></i>
                            <h3 class="fw-bold">100%</h3>
                            <p class="text-muted mb-0">System Health</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="text-center fade-in-up" style="animation-delay: 0.4s;">
                        <a class="btn btn-primary btn-lg px-5 py-3" href="addEmployee.php">
                            <i class="fas fa-user-plus me-2"></i>Add New Employee
                        </a>
                    </div>
                </div>
            </div>
                    
            <!-- Employee Table -->
            <div class="row">
                <div class="col-12">
                    <div class="employee_table fade-in-up" style="animation-delay: 0.5s;">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col"><i class="fas fa-hashtag me-2"></i>#</th>
                                        <th scope="col"><i class="fas fa-user me-2"></i>Name</th>
                                        <th scope="col"><i class="fas fa-envelope me-2"></i>Email</th>
                                        <th scope="col"><i class="fas fa-phone me-2"></i>Phone</th>
                                        <th scope="col"><i class="fas fa-map-marker-alt me-2"></i>Address</th>
                                        <th scope="col"><i class="fas fa-calendar me-2"></i>Joining Date</th>
                                        <th scope="col"><i class="fas fa-cogs me-2"></i>Actions</th>
                                        <th scope="col"><i class="fas fa-tasks me-2"></i>Tasks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($employees)): ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-users fs-1 mb-3 d-block"></i>
                                                <h5>No employees found</h5>
                                                <p class="mb-3">Get started by adding your first employee</p>
                                                <a href="addEmployee.php" class="btn btn-primary">
                                                    <i class="fas fa-plus me-2"></i>Add First Employee
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                    <?php $id = 1; foreach($employees as $row): ?>
                                    <tr>
                                        <th scope="row" class="fw-bold text-primary"><?php echo $id++;?></th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                    <span class="text-white fw-bold"><?php echo strtoupper(substr($row['name'], 0, 1)); ?></span>
                                                </div>
                                                <strong><?php echo htmlspecialchars($row['name']); ?></strong>
                                            </div>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                                        <td>
                                            <small class="text-muted">
                                                <?php echo date('M d, Y', strtotime($row['created_at'])); ?>
                                            </small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="updateEmployee.php?employee_id=<?php echo $row['id']; ?>" 
                                                   class="btn btn-success btn-sm" title="Edit Employee">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="../assets/backend/employee.php?employee_id=<?php echo $row['id']; ?>" 
                                                      method="post" style="display: inline;" 
                                                      onsubmit="return confirm('Are you sure you want to delete this employee?')">
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            name="del-employee" title="Delete Employee">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>   
                                            <a class="btn btn-primary btn-sm" 
                                               href="addTask.php?employee_id=<?php echo $row['id']; ?>" 
                                               title="Add Task">
                                                <i class="fas fa-plus me-1"></i>Add Task
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>