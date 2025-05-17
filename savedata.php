<?php
    // DB Connection
    $conn = new mysqli("localhost", "root", "", "blood_donation");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize & assign form values
    $name = trim($_POST['fullname']);
    $number = trim($_POST['mobileno']);
    $email = trim($_POST['emailid']);
    $age = intval($_POST['age']);
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood'];
    $address = trim($_POST['address']);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisis", $name, $number, $email, $age, $gender, $blood_group, $address);

    // Execute and check result
    if ($stmt->execute()) {
        // Redirect with success
        header("Location: home.php?status=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
?>