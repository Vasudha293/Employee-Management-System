<?php
include 'assets/backend/db_connection.php';
if ($_SESSION['employee_logged_in'] == true) {
    include 'assets/backend/task.php';
    include 'assets/backend/employee.php';


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unanda Bricks Co.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
        <!-- Navbar -->
        <nav class="navbar bg-light">
            <div class="container">
                <span class="navbar-brand mb-0 h1"><?php echo $_SESSION['employeeName']; ?></span>
                <div class=" logout-btn"><a href="assets/backend/employeeLogout.php">Logout</a></div>
            </div>
        </nav>
        <!-- ./Navbar -->

        <!-- Todo section  -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    

                    <!-- todo table -->
                    <table class="table border rounded mt-5" >
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th class="text-center" scope="col">Tasks</th>
                            <th class="text-center" scope="col">
                                Actions
                            </th>
                            </tr>
                        </thead>
                        <tbody>
    <!-- Start table row loop -->
    <?php $sno = 1;
    while ($task = mysqli_fetch_assoc($st_query)) { ?>
        <tr>
        <!-- Display serial number -->
        <th scope="row" ><?php echo $sno++; ?></th>
        <td class="text-center">
            <!-- Display task -->
            <div class="task-list">
                <?php echo $task['tasks']; ?>
            </div>
        </td>
        <td class="text-center d-flex justify-content-center">
            <!-- Display "Completed" button if task is completed -->
            <button class="btn btn-success m-1 <?php if ($task['status'] == 1) {
            echo "d-inline";
        } else {
            echo "d-none";
        } ?>" >Completed</button>

            <!-- Start form -->
            <form class="" action="assets/backend/task.php?employee_id=<?php echo $_GET['employee_id']; ?>&task_id=<?php echo $task['id']; ?>" method="post">
                <!-- Display "Mark as Completed" button if task is not completed -->
                <button class="btn btn-warning m-1 <?php if ($task['status'] == 0) {
            echo "d-inline";
        } else {
            echo "d-none";
        } ?>" name="meCompleted-btn" id="meCompleted-btn" type="submit">Mark as Completed</button>
            <!-- End form -->
            </form>
        </td>
        </tr>
    <?php } ?>
    <!-- End table row loop -->
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
    // Wait for document to be ready
    $(document).ready(function(){
        // Add click event listener to "Add" button
        $( "#add-btn" ).click(function() {
            // Toggle visibility of add to-do form
            $("#add-todo-form").toggle();   
        });
    });
</script>

  </body>
</html>

<?php
} else {
    header("location:http://localhost/employeeManagementPHP/admin/index.php?msg=login_first");
}
?>