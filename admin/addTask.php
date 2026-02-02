<?php
include '../assets/backend/db_connection.php';

if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true){
    header("location:http://localhost:8000/admin/index.php");
    exit();
}

$employee_id = isset($_GET['employee_id']) ? $_GET['employee_id'] : 0;

// Get employee details
$employeeQuery = "SELECT name, email FROM employee WHERE id = '$employee_id'";
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

// Handle form submissions
if(isset($_POST['add-task-btn'])){
    $taskText = $_POST['add-task'];
    if(!empty($taskText)){
        $insertQuery = "INSERT INTO tasklist (employee_id, tasks, status, created_at, updated_at) VALUES ('$employee_id', '$taskText', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $insertResult = executeQuery($insertQuery);
        
        if(strpos($insertResult, 'ERROR') === false){
            $successMessage = "Task added successfully!";
        } else {
            $errorMessage = "Failed to add task. Please try again.";
        }
    } else {
        $errorMessage = "Please enter a task description.";
    }
}

// Handle task completion
if(isset($_POST['mCompleted-btn'])){
    $task_id = $_GET['task_id'];
    $updateQuery = "UPDATE tasklist SET status = 1, updated_at = CURRENT_TIMESTAMP WHERE id = '$task_id'";
    $updateResult = executeQuery($updateQuery);
    
    if(strpos($updateResult, 'ERROR') === false){
        $successMessage = "Task marked as completed!";
    }
}

// Handle task deletion
if(isset($_POST['task-dlt-btn'])){
    $task_id = $_GET['task_id'];
    $deleteQuery = "DELETE FROM tasklist WHERE id = '$task_id'";
    $deleteResult = executeQuery($deleteQuery);
    
    if(strpos($deleteResult, 'ERROR') === false){
        $successMessage = "Task deleted successfully!";
    }
}

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
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unanda Bricks Co. - Manage Tasks</title>
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
                    <i class="fas fa-tasks text-primary me-2 fs-4"></i>
                    <span class="navbar-brand mb-0 h1">Task Management</span>
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
            <!-- Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="text-center text-white fade-in-up">
                        <h1 class="display-6 fw-bold mb-3">Task Management</h1>
                        <?php if($employee): ?>
                        <p class="lead">Managing tasks for <strong><?php echo htmlspecialchars($employee['name']); ?></strong></p>
                        <p class="text-white-50"><?php echo htmlspecialchars($employee['email']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <?php if(isset($successMessage)): ?>
            <div class="alert alert-success d-flex align-items-center fade-in-up" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo $successMessage; ?>
            </div>
            <?php endif; ?>

            <?php if(isset($errorMessage)): ?>
            <div class="alert alert-danger d-flex align-items-center fade-in-up" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo $errorMessage; ?>
            </div>
            <?php endif; ?>

            <!-- Add Task Section -->
            <div class="row mb-5">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card fade-in-up" style="animation-delay: 0.2s;">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Add New Task</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-clipboard-list"></i></span>
                                    <input type="text" class="form-control" name="add-task" 
                                           placeholder="Enter task description..." required>
                                    <button class="btn btn-primary" name="add-task-btn" type="submit">
                                        <i class="fas fa-plus me-1"></i>Add Task
                                    </button>
                                </div>
                            </form>
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
                                        <th scope="col"><i class="fas fa-calendar me-2"></i>Created</th>
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
                                                <p class="mb-0">Add the first task using the form above</p>
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
                                            <div class="btn-group" role="group">
                                                <?php if($task['status'] == 0): ?>
                                                <form method="post" action="?employee_id=<?php echo $employee_id; ?>&task_id=<?php echo $task['id']; ?>" style="display: inline;">
                                                    <button type="submit" name="mCompleted-btn" class="btn btn-success btn-sm" title="Mark as Completed">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <?php endif; ?>
                                                
                                                <form method="post" action="?employee_id=<?php echo $employee_id; ?>&task_id=<?php echo $task['id']; ?>" 
                                                      style="display: inline;" 
                                                      onsubmit="return confirm('Are you sure you want to delete this task?')">
                                                    <button type="submit" name="task-dlt-btn" class="btn btn-danger btn-sm" title="Delete Task">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
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