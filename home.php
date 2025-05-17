<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank & Donation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            padding-top: 70px;
        }

        .navbar-brand {
            font-weight: bold;
            color: #c0392b;
        }

        .hero-section {
            background: url('image/_107317099_blooddonor976.jpg') no-repeat center center/cover;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 1px 1px 5px black;
        }

        .section-title {
            color: #c0392b;
            margin-bottom: 1rem;
        }

        .card h4 {
            background-color: #c0392b;
            color: white;
            padding: 10px;
            margin-bottom: 0;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>

<?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
<div class="alert alert-success text-center">Thank you! Donor details submitted successfully.</div>
<?php endif; ?>

<body>
    <!-- <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Blood Bank & Donation</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#donors">Donors</a></li>
                    <li class="nav-item"><a class="nav-link" href="#groups">Blood Groups</a></li>
                    <li class="nav-item"><a class="nav-link" href="donate_blood.php">Donate</a></li>
                </ul>
            </div>
        </div>
    </nav> -->

    <?php $active = 'home'; include('head.php'); ?>

    <header class="hero-section">
        <div class="text-center">
            <h1 class="display-4">Welcome to Blood Bank & Donor Management System</h1>
        </div>
    </header>

    <main class="container">
        <section class="my-5">
            <h2 class="section-title text-center">The Need for Blood</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <h4>The need for blood</h4>
                        <div class="card-body">
                            <?php include 'conn.php';
                            $res = mysqli_query($conn, "SELECT page_data FROM pages WHERE page_type='needforblood'");
                            if ($res && mysqli_num_rows($res) > 0) {
                                echo mysqli_fetch_assoc($res)['page_data'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h4>Blood Donation Tips</h4>
                        <div class="card-body">
                            <?php $res = mysqli_query($conn, "SELECT page_data FROM pages WHERE page_type='bloodtips'");
                            if ($res && mysqli_num_rows($res) > 0) {
                                echo mysqli_fetch_assoc($res)['page_data'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h4>Who You Could Help? </h4>
                        <div class="card-body">
                            <?php $res = mysqli_query($conn, "SELECT page_data FROM pages WHERE page_type='whoyouhelp'");
                            if ($res && mysqli_num_rows($res) > 0) {
                                echo mysqli_fetch_assoc($res)['page_data'];
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="donors" class="my-5">
            <h2 class="section-title text-center">Our Donors</h2>
            <div class="row">
                <?php $res = mysqli_query($conn, "SELECT * FROM donor_details JOIN blood ON donor_blood = blood_id ORDER BY RAND() LIMIT 6");
                while ($row = mysqli_fetch_assoc($res)) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="image/blood_drop_logo.jpg" class="card-img-top" style="height:300px; object-fit:cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['donor_name']; ?></h5>
                                <p class="card-text">
                                    <strong>Blood Group:</strong> <?php echo $row['blood_group']; ?><br>
                                    <strong>Mobile:</strong> <?php echo $row['donor_number']; ?><br>
                                    <strong>Gender:</strong> <?php echo $row['donor_gender']; ?><br>
                                    <strong>Age:</strong> <?php echo $row['donor_age']; ?><br>
                                    <strong>Address:</strong> <?php echo $row['donor_address']; ?><br>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>

        <section id="groups" class="my-5">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="section-title">Blood Groups</h2>
                    <p><?php $res = mysqli_query($conn, "SELECT page_data FROM pages WHERE page_type='bloodgroups'");
                        if ($res && mysqli_num_rows($res) > 0) {
                            echo mysqli_fetch_assoc($res)['page_data'];
                        } ?></p>
                </div>
                <div class="col-md-6">
                    <img src="image/blood_donationcover.jpeg" alt="Blood Cover" class="img-fluid rounded">
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div>
            <strong>COPYRIGHT © 2021</strong><br>
            Blood Bank & Donation Management<br>
            ALL RIGHTS RESERVED.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>