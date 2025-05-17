<?php 
$active = 'need';
include('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Need Blood</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .content-wrapper {
      flex: 1;
    }
  </style>
</head>
<body>

<?php include('head.php'); ?>

<div class="container my-5 content-wrapper">
  <h1 class="mb-4 text-center fw-bold">Need Blood</h1>

  <form name="needblood" method="post">
    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label class="form-label fw-semibold">Select Blood Group <span class="text-danger">*</span></label>
        <select name="blood" class="form-select" required>
          <option value="" disabled selected>Select</option>
          <?php
            $sql = "SELECT * FROM blood";
            $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");
            while($row = mysqli_fetch_assoc($result)){
              echo "<option value='{$row['blood_id']}'>{$row['blood_group']}</option>";
            }
          ?>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-semibold">Why do you need blood? <span class="text-danger">*</span></label>
        <textarea name="address" class="form-control" rows="3" required></textarea>
      </div>
    </div>

    <div class="text-start">
      <button type="submit" name="search" class="btn btn-primary px-4">Search</button>
    </div>
  </form>

  <div class="row mt-5">
    <?php
    if (isset($_POST['search'])) {
      $bg = mysqli_real_escape_string($conn, $_POST['blood']);
      $sql = "SELECT * FROM donor_details 
              JOIN blood ON donor_details.donor_blood = blood.blood_id 
              WHERE donor_blood = '$bg' 
              ORDER BY RAND() LIMIT 5";
      $result = mysqli_query($conn, $sql) or die("Query failed.");

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
          <img src="image/blood_drop_logo.jpg" class="card-img-top" style="height: 220px; object-fit: cover;" alt="Donor">
          <div class="card-body">
            <h5 class="card-title"><?php echo $row['donor_name']; ?></h5>
            <p class="card-text">
              <strong>Blood Group:</strong> <?php echo $row['blood_group']; ?><br>
              <strong>Mobile No.:</strong> <?php echo $row['donor_number']; ?><br>
              <strong>Gender:</strong> <?php echo $row['donor_gender']; ?><br>
              <strong>Age:</strong> <?php echo $row['donor_age']; ?><br>
              <strong>Address:</strong> <?php echo $row['donor_address']; ?>
            </p>
          </div>
        </div>
      </div>
    <?php
        }
      } else {
        echo '<div class="alert alert-danger mt-4">No Donor Found For Your Selected Blood Group.</div>';
      }
    }
    ?>
  </div>
</div>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>