<?php
include 'assets/backend/db_connection.php';

if(!isset($_SESSION['employee_logged_in']) || $_SESSION['employee_logged_in'] != true){
    header("location:http://localhost:8000/index.php");
    exit();
}

$employee_id = $_SESSION['employee_id'];

// Get tasks for this employee
$tasksQuery = "SELECT id, tasks, status, created_at FROM tasklist WHERE employee_id = '$employee_id' ORDER BY created_at DESC";
$tasksResult = executeQuery($tasksQuery);

$tasks = [];
if (!empty($tasksResult) && strpos($tasksResult, 'ERROR') === false) {
    $lines = explode("\n", trim($tasksResult));
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
                $tasks[] = array_combine($headers, $data);
            }
        }
    }
}

// Handle task completion
if(isset($_POST['meCompleted-btn'])){
    $task_id = $_GET['task_id'];
    $updateQuery = "UPDATE tasklist SET status = 1, updated_at = CURRENT_TIMESTAMP WHERE id = '$task_id'";
    $updateResult = executeQuery($updateQuery);
    
    if(strpos($updateResult, 'ERROR') === false){
        header("location:http://localhost:8000/home.php?employee_id=$employee_id");
        exit();
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unanda Bricks Co. - Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
        <!-- Modern Navbar -->
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user text-primary me-2 fs-4"></i>
                    <span class="navbar-brand-custom mb-0 h1">UNANDA BRICKS</span>
                    <span class="text-muted ms-2">Employee Portal</span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="text-muted me-3">Welcome, <strong><?php echo $_SESSION['employeeName']; ?></strong></span>
                    <div class="logout-btn">
                        <a href="assets/backend/employeeLogout.php" class="d-flex align-items-center">
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
                <h2 class="page-title">My Task Dashboard</h2>
                <p class="page-subtitle">Track and manage your assigned tasks</p>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-5">
                <div class="col-md-4 mb-3">
                    <div class="card text-center fade-in-up" style="animation-delay: 0.1s;">
                        <div class="card-body">
                            <i class="fas fa-clipboard-list text-primary fs-1 mb-3"></i>
                            <h3 class="fw-bold"><?php echo count($tasks); ?></h3>
                            <p class="text-muted mb-0">Total Tasks</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-center fade-in-up" style="animation-delay: 0.2s;">
                        <div class="card-body">
                            <i class="fas fa-check-circle text-success fs-1 mb-3"></i>
                            <h3 class="fw-bold"><?php echo count(array_filter($tasks, function($task) { return $task['status'] == 1; })); ?></h3>
                            <p class="text-muted mb-0">Completed</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-center fade-in-up" style="animation-delay: 0.3s;">
                        <div class="card-body">
                            <i class="fas fa-clock text-warning fs-1 mb-3"></i>
                            <h3 class="fw-bold"><?php echo count(array_filter($tasks, function($task) { return $task['status'] == 0; })); ?></h3>
                            <p class="text-muted mb-0">Pending</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tasks Table -->
            <div class="row">
                <div class="col-12">
                    <div class="employee_table fade-in-up" style="animation-delay: 0.4s;">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col"><i class="fas fa-hashtag me-2"></i>#</th>
                                        <th scope="col"><i class="fas fa-calendar me-2"></i>Assigned Date</th>
                                        <th scope="col"><i class="fas fa-clipboard-list me-2"></i>Task Description</th>
                                        <th scope="col"><i class="fas fa-info-circle me-2"></i>Status</th>
                                        <th scope="col"><i class="fas fa-cogs me-2"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($tasks)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-clipboard-list fs-1 mb-3 d-block"></i>
                                                <h5>No tasks assigned yet</h5>
                                                <p class="mb-0">Your tasks will appear here when assigned by your manager</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                    <?php $sno = 1; foreach($tasks as $task): ?>
                                    <tr>
                                        <th scope="row" class="fw-bold text-primary"><?php echo $sno++; ?></th>
                                        <td>
                                            <small class="text-muted">
                                                <?php echo date('M d, Y H:i', strtotime($task['created_at'])); ?>
                                            </small>
                                        </td>
                                        <td>
                                            <div class="task-description">
                                                <?php echo htmlspecialchars($task['tasks']); ?>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($task['status'] == 1): ?>
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check me-1"></i>Completed
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock me-1"></i>Pending
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($task['status'] == 0): ?>
                                            <form method="post" action="?employee_id=<?php echo $employee_id; ?>&task_id=<?php echo $task['id']; ?>" style="display: inline;">
                                                <button type="submit" name="meCompleted-btn" class="btn btn-success btn-sm" title="Mark as Completed">
                                                    <i class="fas fa-check me-1"></i>Mark Complete
                                                </button>
                                            </form>
                                            <?php else: ?>
                                            <span class="text-success">
                                                <i class="fas fa-check-circle me-1"></i>Task Completed
                                            </span>
                                            <?php endif; ?>
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