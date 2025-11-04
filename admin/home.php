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

        <!-- Employee Details Section -->
        <div class="container">
            <div class="row ">
                <div class="col-md-12 mt-5 ">
                    <div class="add-btn d-flex justify-content-center">
                        <a class="btn btn-primary" href="addEmployee.php">Add Employee <i class="fa-solid fa-plus"></i></a>
                    </div>
                    <!-- Employee Details Table -->
                    <div class="employee_table d-flex justify-content-center border rounded mt-5">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Joining Date</th>
                                <th scope="col">Actions</th>
                                <th scope="col">Add Task</th>
                                </tr>
                            </thead>
                            <?php $id = 1; while($row = mysqli_fetch_assoc($s_query)){?>
                            
                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo $id++;?></th>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td>
                                    <a href=<?php echo "updateEmployee.php?employee_id=$row[id]" ?>  class="btn btn-success m-1" >Edit</a>

                                        <form action="<?php echo "../assets/backend/employee.php?employee_id=$row[id]" ?>" method="post">
                                            <button type="submit" class="btn btn-danger m-1" name="del-employee" id="del-employee" >Delete</button>
                                        </form>

                                    </td>
                                    <td>   
                                        <a class="btn btn-primary m-1" href=<?php echo "addTask.php?employee_id=$row[id]" ?>>Add Task</a>
                                    </td>
                                </tr>        
                            </tbody>
                            <?php }?>
                            
                        </table>
                    </div>
                    <!-- ./Employee Details Table -->
                </div>
            </div>
        </div>
        <!-- ./Employee Details Section -->

                    
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