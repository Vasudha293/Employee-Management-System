<?php
include 'db_connection.php';

$employee_id = isset($_GET['employee_id']) ? $_GET['employee_id'] : 0;
$task_id = isset($_GET['task_id']) ? $_GET['task_id'] : 0;

// =========== ADD TASKS =========
if(isset($_POST['add-task-btn'])){
    $tasks = $_POST['add-task'];
    if(!empty($tasks)){
        $insert = "INSERT INTO tasklist (employee_id, tasks, status, created_at, updated_at) VALUES ('$employee_id','$tasks', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $it_query = executeQuery($insert);
        
        if(strpos($it_query, 'ERROR') === false){
            header("location:http://localhost:8000/admin/addTask.php?employee_id=$employee_id");
            exit();
        } else {
            echo "<script>alert('Something went wrong...try again!!'); window.location='http://localhost:8000/admin/addTask.php?employee_id=$employee_id';</script>";
        }
    }
}

// ============ Update Task through admin ========
if(isset($_POST['mCompleted-btn'])){
    $update = "UPDATE tasklist SET status=1, updated_at=CURRENT_TIMESTAMP WHERE id = '$task_id'";
    $tu_query = executeQuery($update);
    
    if(strpos($tu_query, 'ERROR') === false){
        header("location:http://localhost:8000/admin/addTask.php?employee_id=$employee_id");
        exit();
    } else {
        echo "<script>alert('Something went wrong...try again!!'); window.location='http://localhost:8000/admin/addTask.php?employee_id=$employee_id';</script>";
    }
}

// ============ Update Task through employee ========
if(isset($_POST['meCompleted-btn'])){
    $update = "UPDATE tasklist SET status=1, updated_at=CURRENT_TIMESTAMP WHERE id = '$task_id'";
    $tu_query = executeQuery($update);
    
    if(strpos($tu_query, 'ERROR') === false){
        header("location:http://localhost:8000/home.php?employee_id=$employee_id");
        exit();
    } else {
        echo "<script>alert('Something went wrong...try again!!'); window.location='http://localhost:8000/home.php?employee_id=$employee_id';</script>";
    }
}

// =========== Delete task ============
if(isset($_POST['task-dlt-btn'])){
    $delete = "DELETE FROM tasklist WHERE id = '$task_id'";
    $td_query = executeQuery($delete);
    
    if(strpos($td_query, 'ERROR') === false){
        header("location:http://localhost:8000/admin/addTask.php?employee_id=$employee_id");
        exit();
    } else {
        echo "<script>alert('Something went wrong...try again!!'); window.location='http://localhost:8000/admin/addTask.php?employee_id=$employee_id';</script>";
    }
}
?>