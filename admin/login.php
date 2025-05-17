<?php
session_start();
include 'conn.php';

// Handle remember me (prefill from cookie if available)
$rememberedUsername = isset($_COOKIE['remembered_user']) ? $_COOKIE['remembered_user'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin Login - Blood Bank Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('admin_image/blood-cells.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    .login-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <?php $active = 'admin'; include('../head.php'); ?>

  <div class="container" style="margin-top: 120px;">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="text-center text-white mb-4">
          <h1 class="fw-bold">Blood Bank & Management</h1>
          <h4>Admin Login Portal</h4>
        </div>
        <div class="card login-card p-4 shadow">
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="mb-3">
              <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
              <input type="text" name="username" class="form-control" placeholder="Enter your username" required value="<?php echo htmlspecialchars($rememberedUsername); ?>">
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
              <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" name="remember" class="form-check-input" id="rememberMe" <?php if ($rememberedUsername) echo 'checked'; ?>>
              <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>
            <div class="d-grid mb-2">
              <button type="submit" name="login" class="btn btn-primary">LOGIN</button>
            </div>
            <div class="text-center">
              <a href="forgot_password.php" class="text-decoration-none">Forgot Password?</a>
            </div>
          </form>
        </div>

        <?php
        if (isset($_POST["login"])) {
          $username = mysqli_real_escape_string($conn, $_POST["username"]);
          $password = mysqli_real_escape_string($conn, $_POST["password"]);

          $sql = "SELECT * FROM admin_info WHERE admin_username='$username' AND admin_password='$password'";
          $result = mysqli_query($conn, $sql) or die("Query failed.");

          if (mysqli_num_rows($result) > 0) {
            $_SESSION['loggedin'] = true;
            $_SESSION["username"] = $username;

            // Handle remember me cookie
            if (isset($_POST['remember'])) {
              setcookie('remembered_user', $username, time() + (30 * 24 * 60 * 60)); // 30 days
            } else {
              setcookie('remembered_user', '', time() - 3600); // Delete cookie
            }

            header("Location: dashboard.php");
            exit();
          } else {
            echo '<div class="alert alert-danger mt-3 fw-semibold text-center">Username and Password are not matched!</div>';
          }
        }
        ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>