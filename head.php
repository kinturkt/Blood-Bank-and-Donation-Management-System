<?php
if (!isset($active)) $active = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blood Bank & Donation Website</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 70px;
    }
    .navbar-brand {
      font-weight: bold;
      color: #c0392b !important;
    }
  </style>
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
          <li class="nav-item"><a class="nav-link <?php if($active=='about') echo 'active'; ?>" href="about_us.php">About Us</a></li>
          <li class="nav-item"><a class="nav-link <?php if($active=='why') echo 'active'; ?>" href="why_donate_blood.php">Why Donate Blood</a></li>
          <li class="nav-item"><a class="nav-link <?php if($active=='donate') echo 'active bg-danger text-white rounded-pill px-3'; ?>" href="donate_blood.php">Become A Donor</a></li>
          <li class="nav-item"><a class="nav-link <?php if($active=='need') echo 'active'; ?>" href="need_blood.php">Need Blood</a></li>
          <li class="nav-item"><a class="nav-link <?php if($active=='contact') echo 'active'; ?>" href="contact_us.php">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link <?php if($active=='admin') echo 'active'; ?>" href="admin/login.php">Admin Login</a></li>
        </ul>
      </div>
    </div>
  </nav>
</body>