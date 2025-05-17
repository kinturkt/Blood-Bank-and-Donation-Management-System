<?php
include 'conn.php';
$msg = '';

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "SELECT * FROM admin_info WHERE admin_email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // You can add an email feature here
        $msg = "<div class='alert alert-success text-center'>Password reset instructions have been sent to your email.</div>";
    } else {
        $msg = "<div class='alert alert-danger text-center'>Email not found in admin records.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Forgot Password - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('admin_image/blood-cells.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    .card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <div class="container" style="margin-top: 120px;">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="text-center text-white mb-4">
          <h1 class="fw-bold">Blood Bank & Management</h1>
          <h4>Forgot Password</h4>
        </div>
        <?php echo $msg; ?>
        <div class="card p-4 shadow">
          <form method="POST" action="">
            <div class="mb-3">
              <label class="form-label fw-semibold">Enter your registered email <span class="text-danger">*</span></label>
              <input type="email" name="email" class="form-control" placeholder="example@domain.com" required>
            </div>
            <div class="d-grid">
              <button type="submit" name="submit" class="btn btn-danger">Send Reset Instructions</button>
            </div>
            <div class="text-center mt-3">
              <a href="login.php" class="text-decoration-none">Back to Login</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
