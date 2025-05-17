<?php
include 'conn.php';
include 'session.php';
if (!isset($_SESSION['loggedin'])) {
    echo '<div class="alert alert-danger"><b>Please Login First To Access Admin Portal.</b></div>';
    echo '<a href="login.php" class="btn btn-primary">Go to Login Page</a>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }
    .sidebar {
      width: 220px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #2c3e50;
      padding-top: 70px;
    }
    .content {
      margin-left: 220px;
      padding: 30px;
    }
    .card {
      border-radius: 15px;
    }
    .dashboard-card {
      height: 200px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      font-weight: bold;
      font-size: 1.2rem;
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="sidebar">
  <?php $active = "dashboard"; include 'sidebar.php'; ?>
</div>

<div class="content">
  <h2 class="mb-4">Admin Dashboard</h2>
  <div class="row g-4">

    <!-- Blood Donors -->
    <div class="col-md-4">
      <div class="card bg-primary text-white dashboard-card shadow">
        <?php
          $sql = "SELECT * FROM donor_details";
          $result = mysqli_query($conn, $sql);
          $donorCount = mysqli_num_rows($result);
        ?>
        <h1><?php echo $donorCount; ?></h1>
        <p>Blood Donors Available</p>
        <a href="donor_list.php" class="btn btn-light btn-sm">Full Detail</a>
      </div>
    </div>

    <!-- All Queries -->
    <div class="col-md-4">
      <div class="card bg-success text-white dashboard-card shadow">
        <?php
          $sql1 = "SELECT * FROM contact_query";
          $result1 = mysqli_query($conn, $sql1);
          $queryCount = mysqli_num_rows($result1);
        ?>
        <h1><?php echo $queryCount; ?></h1>
        <p>All User Queries</p>
        <a href="query.php" class="btn btn-light btn-sm">Full Detail</a>
      </div>
    </div>

    <!-- Pending Queries -->
    <div class="col-md-4">
      <div class="card bg-warning text-dark dashboard-card shadow">
        <?php
          $sql2 = "SELECT * FROM contact_query WHERE query_status = 2";
          $result2 = mysqli_query($conn, $sql2);
          $pendingCount = mysqli_num_rows($result2);
        ?>
        <h1><?php echo $pendingCount; ?></h1>
        <p>Pending Queries</p>
        <a href="pending_query.php" class="btn btn-dark btn-sm">Full Detail</a>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>