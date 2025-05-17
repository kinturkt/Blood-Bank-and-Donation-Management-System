<?php
// Establish DB connection
$conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");

// Sanitize & fetch POST data
$name        = trim($_POST['fullname']);
$number      = trim($_POST['mobileno']);
$email       = trim($_POST['emailid']);
$age         = trim($_POST['age']);
$gender      = trim($_POST['gender']);
$blood_group = trim($_POST['blood']);
$address     = trim($_POST['address']);

// Use prepared statement to avoid SQL injection
$sql = "INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssssis", $name, $number, $email, $age, $gender, $blood_group, $address);
    $execResult = mysqli_stmt_execute($stmt);

    // Redirect with status
    if ($execResult) {
        header("Location: add_donor.php?status=success");
    } else {
        header("Location: add_donor.php?status=error");
    }

    mysqli_stmt_close($stmt);
} else {
    die("Prepared Statement Error: " . mysqli_error($conn));
}

mysqli_close($conn);
?>
