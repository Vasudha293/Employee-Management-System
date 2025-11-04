<?php
    include 'db_connection.php';

    $employee_id = $_GET['employee_id'];
    // =========== Fetch tasks list ==========
    $select = "SELECT * FROM `tasklist` WHERE employee_id = '$employee_id'";
    $st_query = mysqli_query($conn,$select);

    // =========== ADD TASKS =========
    $tasks = $_POST['add-task'];
    if(isset($_POST['add-task-btn'])){
        $insert = "INSERT INTO `tasklist`(`employee_id`, `tasks`,`created_at`, `updated_at`) VALUES ('$employee_id','$tasks',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        $it_query = mysqli_query($conn,$insert);
        if($it_query){
            header("location:http://localhost/employeeManagementPHP/admin/addTask.php?employee_id=$employee_id");
        }else{
            echo "<script>alert('Something Went wrong...try again!!'); window.location='../../admin/addTask.php?employee_id=$employee_id';</script>";
        }
    }

    // ============ Update Task through admin========
    $task_id = $_GET['task_id'];
    if(isset($_POST['mCompleted-btn'])){
        $update = "UPDATE `tasklist` SET `status`=1,`updated_at`= CURRENT_TIMESTAMP WHERE id = $task_id";
        $tu_query = mysqli_query($conn,$update);
        if($tu_query){
            header("location:http://localhost/employeeManagementPHP/admin/addTask.php?employee_id=$employee_id");
        }else{
            echo "<script>alert('Something Went wrong...try again!!'); window.location='../../admin/addTask.php?employee_id=$employee_id';</script>";
        }
    }

    // ============ Update Task through employee========
    $task_id = $_GET['task_id'];
    if(isset($_POST['meCompleted-btn'])){
        $update = "UPDATE `tasklist` SET `status`=1,`updated_at`= CURRENT_TIMESTAMP WHERE id = $task_id";
        $tu_query = mysqli_query($conn,$update);
        if($tu_query){
            header("location:http://localhost/employeeManagementPHP/home.php?employee_id=$employee_id&username=$_SESSION[employeeName]");
        }else{
            echo "<script>alert('Something Went wrong...try again!!'); window.location='../../admin/addTask.php?employee_id=$employee_id';</script>";
        }
    }

    // ===========delete task============
    if(isset($_POST['task-dlt-btn'])){
        $delete = "DELETE FROM `tasklist` WHERE id = '$task_id'";
        $td_query = mysqli_query($conn,$delete);
        if($td_query){
            header("location:http://localhost/employeeManagementPHP/admin/addTask.php?employee_id=$employee_id");
        }else{
            echo "<script>alert('Something Went wrong...try again!!'); window.location='../../admin/addTask.php?employee_id=$employee_id';</script>";
        }
    }
?>