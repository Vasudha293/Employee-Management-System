<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unanda Bricks Co.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</style>
  </head>
  <body>
    
    <!-- Login Form -->
    <div class="container">
      <div class="row ">
        <div class="col-md-6 offset-md-3">
          <img src="assets/logo.png" style="
    border-radius: 50%; width: 40%;
">
        <h1 class="d-flex justify-content-center mt-5 ">UNANDA EMPLOYEE LOGIN</h1>
          <form method="post" action="assets/backend/employeeAuth.php" class="border border-primary rounded p-4 br-3  login-form">
            <div class="mb-3">
              <label for="employeeEmail" class="form-label">Email address</label>
              <input type="email" class="form-control" id="employeeEmail" name="employeeEmail" placeholder="Employee Email" required>
            </div>
            <div class="mb-3">
              <label for="employeePassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="employeePassword" name="employeePassword" placeholder="Employee Password" required>
            </div>
            <button type="submit" id="employee_login_btn" name="employee_login_btn" class="btn btn-primary">Login</button>
          </form>
          <div class="text-center">
            Login as <a style="color : blue; font-weight : bold;" href="admin/index.php">Admin.</a>
          </div>
        </div>
      </div>
    </div>
    <!-- ./Login Form -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>