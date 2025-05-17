<?php
$active = 'donate';
include('head.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Donate Blood</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">Blood Bank & Donation Website</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?php if($active=='about') echo 'active'; ?>" href="about_us.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($active=='why') echo 'active'; ?>" href="why_donate_blood.php">Why Donate Blood</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($active=='donate') echo 'active bg-danger rounded-pill px-3'; ?>" href="donate_blood.php">Become A Donor</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($active=='need') echo 'active'; ?>" href="need_blood.php">Need Blood</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($active=='contact') echo 'active'; ?>" href="contact_us.php">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5 pt-5">
    <h1 class="mb-4">Donate Blood</h1>
    <form name="donor" action="savedata.php" method="post">
      <div class="row g-4">
        <div class="col-md-4">
          <label class="form-label">Full Name <span class="text-danger">*</span></label>
          <input type="text" name="fullname" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
          <input type="text" name="mobileno" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Email Id</label>
          <input type="email" name="emailid" class="form-control">
        </div>
        <div class="col-md-4">
          <label class="form-label">Age <span class="text-danger">*</span></label>
          <input type="text" name="age" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Gender <span class="text-danger">*</span></label>
          <select name="gender" class="form-select" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Blood Group <span class="text-danger">*</span></label>
          <select name="blood" class="form-select" required>
            <option value="" selected disabled>Select</option>
            <?php
              include 'conn.php';
              $sql= "SELECT * FROM blood";
              $result=mysqli_query($conn,$sql);
              while($row=mysqli_fetch_assoc($result)){
                echo '<option value="'.$row['blood_id'].'">'.$row['blood_group'].'</option>';
              }
            ?>
          </select>
        </div>
        <div class="col-md-12">
          <label class="form-label">Address <span class="text-danger">*</span></label>
          <textarea class="form-control" name="address" rows="3" required></textarea>
        </div>
        <div class="col-12">
          <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
        </div>
      </div>
    </form>
  </div>

  <footer class="text-center text-white bg-dark py-3 mt-5">
    <strong>COPYRIGHT ©2021<br>Blood Bank & Donation Management<br>ALL RIGHTS RESERVED.</strong>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>