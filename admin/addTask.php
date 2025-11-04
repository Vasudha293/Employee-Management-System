<?php
    include '../assets/backend/db_connection.php';
    if($_SESSION['admin_logged_in'] == true){  
    include '../assets/backend/task.php';
    include '../assets/backend/employee.php';


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unanda Bricks Co.S</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body>
        <!-- Navbar -->
        <nav class="navbar bg-light">
            <div class="container">
                <span class="navbar-brand mb-0 h1"><?php echo $_SESSION['adminName'];?></span>
                <div class=" logout-btn"><a href="home.php?username=<?php echo $_SESSION['adminName'];?>">home</a></div>
                <div class=" logout-btn"><a href="../assets/backend/logout.php">Logout</a></div>
            </div>
        </nav>
        <!-- ./Navbar -->

        <!-- Todo section  -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <!-- add todo -->
                            <div id="add-btn" class=" d-flex justify-content-center mt-5">
                                    <span  class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Todo</span>    
                            </div>
                            <div id="add-todo-form" class="mt-5">
                                <form action=<?php echo "../assets/backend/task.php?employee_id=".$_GET['employee_id']?> method="post" >
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="add-task" name="add-task" placeholder="Enter your task here"  >
                                        <button class="btn btn-primary" name="add-task-btn" id="add-task-btn" type="submit">Add</button>
                                    </div>
                                </form>
                            </div>
                    <!-- ./add todo -->

                    <!-- todo table -->
                    <table class="table border rounded mt-5" >
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th class="text-center" scope="col">Creation Date</th>

                                                        <th class="text-center" scope="col">Task</th>
<th class="text-center" scope="col">
                                Actions
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sno = 1; while($task = mysqli_fetch_assoc($st_query)){?>
                                <tr>
                                <th scope="row" ><?php echo $sno++;?></th>
                                <td class="text-center">
                                    <div class="task-list">
                                        <?php echo $task['created_at'];?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="task-list">
                                        <?php echo $task['tasks'];?>
                                    </div>
                            </td>
                                <td class="text-center d-flex justify-content-center">
                                    <button class="btn btn-success m-1 <?php if($task['status']==1) {echo "d-inline";}else{echo "d-none";}?>" >Completed</button>

                                    <form class="" action="../assets/backend/task.php?employee_id=<?php echo $_GET['employee_id'];?>&task_id=<?php echo $task['id'];?>" method="post">
                                        <button class="btn btn-warning m-1 <?php if($task['status']==0) {echo "d-inline";}else{echo "d-none";}?>" name="mCompleted-btn" id="mCompleted-btn" type="submit">Mark as Completed</button>
                                        <button class="btn btn-danger m-1 d-inline" name="task-dlt-btn" id="task-dlt-btn" type="submit">Delete</button>

                                    </form>
                                    

                                </td>
                                </tr>
                            <?php }?>
                            
                        </tbody>
                    </table>
                    <!-- ./todo table -->
                </div>
            </div>
        </div>
        <!-- ./Todo section  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $( "#add-btn" ).click(function() {
                    $("#add-todo-form").toggle();   
            });
        });
    </script>
  </body>
</html>

<?php
    }else{
        header("location:http://localhost/employeeManagementPHP/admin/index.php?msg=login_first");
    }
?>