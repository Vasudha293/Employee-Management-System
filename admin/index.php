<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- Set the viewport to make the website responsive on different devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unanda Bricks Co.</title>
    <!-- Import Bootstrap CSS file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Import custom CSS file -->
    <link rel="stylesheet" href="../assets/css/style.css">
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
        <!-- Add a heading to the form -->
        <img src="../assets/logo.png" style="
    border-radius: 50%; width: 40%;
">
        <h1 class="d-flex justify-content-center mt-5">ADMIN LOGIN</h1>
          <!-- Create the login form -->
          <form method="post" action="../assets/backend/adminAuth.php" class="border border-primary rounded p-4 br-3  login-form">
            <!-- Email input field -->
            <div class="mb-3">
              <label for="adminEmail" class="form-label">Email address</label>
              <input type="email" class="form-control" id="adminEmail" name="adminEmail" required>
            </div>
            <!-- Password input field -->
            <div class="mb-3">
              <label for="adminPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="adminPassword" name="adminPassword" required>
            </div>
            <!-- Login button -->
            <button type="submit" id="admin_login_btn" name="admin_login_btn" class="btn btn-primary">Login</button>
          </form>
          <div class="text-center">
            Login as <a style="color : blue; font-weight : bold;" href="../index.php">Èmp.</a>
          </div>
        </div>
      </div>
    </div>
    <!-- ./Login Form -->
    <!-- Import Popper.js library -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <!-- Import Bootstrap JS file -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>