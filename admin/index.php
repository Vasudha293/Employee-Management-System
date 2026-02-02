<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UNANDA BRICKS Co. - Admin Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body>
    <div class="container">
      <div class="row min-vh-100 align-items-center">
        <div class="col-md-6 offset-md-3">
          <div class="text-center mb-4">
            <div class="brand-logo-container">
              <img src="../assets/logo.png" class="logo fade-in-up" alt="Unanda Bricks Co.">
            </div>
            <h1 class="company-name fade-in-up" style="animation-delay: 0.2s;">UNANDA BRICKS</h1>
            <p class="company-tagline fade-in-up" style="animation-delay: 0.3s;">Building and Material Suppliers</p>
            <h2 class="text-white mb-4 fade-in-up" style="animation-delay: 0.4s; font-size: 1.8rem; font-weight: 600;">Admin Portal</h2>
            <p class="text-white-50 fade-in-up" style="animation-delay: 0.5s;">Welcome back! Please sign in to your account.</p>
          </div>
          
          <div class="login-form fade-in-up" style="animation-delay: 0.6s;">
            <form method="post" action="../assets/backend/adminAuth.php">
              <div class="mb-4">
                <label for="adminEmail" class="form-label fw-semibold">Email Address</label>
                <input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="Enter your email" required>
              </div>
              
              <div class="mb-4">
                <label for="adminPassword" class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control" id="adminPassword" name="adminPassword" placeholder="Enter your password" required>
              </div>
              
              <button type="submit" id="admin_login_btn" name="admin_login_btn" class="btn btn-primary w-100 mb-4">
                Sign In to Dashboard
              </button>
            </form>
            
            <div class="text-center">
              <p class="text-muted mb-0">Employee? <a href="../index.php" class="fw-semibold">Login here</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>