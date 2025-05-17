<?php
include 'conn.php';
include 'session.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>Invalid Donor ID</div>";
    exit;
}

$donor_id = intval($_GET['id']);

// Fetch donor details
$sql = "SELECT * FROM donor_details WHERE donor_id = $donor_id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-danger'>Donor not found</div>";
    exit;
}
$donor = mysqli_fetch_assoc($result);

// Update donor logic
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $number = mysqli_real_escape_string($conn, $_POST['mobileno']);
    $email = mysqli_real_escape_string($conn, $_POST['emailid']);
    $age = intval($_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $blood_group = intval($_POST['blood']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $update_sql = "UPDATE donor_details SET 
        donor_name = '$name', 
        donor_number = '$number', 
        donor_mail = '$email', 
        donor_age = '$age', 
        donor_gender = '$gender', 
        donor_blood = '$blood_group', 
        donor_address = '$address'
        WHERE donor_id = $donor_id";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: donor_list.php?status=updated");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Failed to update donor.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Donor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php $active = "donor"; include 'header.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Update Donor Details</h2>
    <form method="POST">
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($donor['donor_name']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Mobile Number</label>
                <input type="text" name="mobileno" class="form-control" value="<?php echo htmlspecialchars($donor['donor_number']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email ID</label>
                <input type="email" name="emailid" class="form-control" value="<?php echo htmlspecialchars($donor['donor_mail']); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Age</label>
                <input type="number" name="age" class="form-control" value="<?php echo htmlspecialchars($donor['donor_age']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select" required>
                    <option value="Male" <?php if($donor['donor_gender']=='Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if($donor['donor_gender']=='Female') echo 'selected'; ?>>Female</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Blood Group</label>
                <select name="blood" class="form-select" required>
                    <option disabled>Select</option>
                    <?php
                    $bg_sql = "SELECT * FROM blood";
                    $bg_result = mysqli_query($conn, $bg_sql);
                    while($bg = mysqli_fetch_assoc($bg_result)) {
                        $selected = ($bg['blood_id'] == $donor['donor_blood']) ? "selected" : "";
                        echo "<option value='{$bg['blood_id']}' $selected>{$bg['blood_group']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" required><?php echo htmlspecialchars($donor['donor_address']); ?></textarea>
            </div>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update Donor</button>
        <a href="donor_list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
