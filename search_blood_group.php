<?php
  $bg = $_POST['blood'];

  $conn = new mysqli("localhost", "root", "", "blood_donation");
  if ($conn->connect_error) {
      die("<div class='alert alert-danger'>Connection failed: " . $conn->connect_error . "</div>");
  }

  $sql = "SELECT donor_details.*, blood.blood_group 
          FROM donor_details 
          JOIN blood ON donor_details.donor_blood = blood.blood_id 
          WHERE donor_blood = ? 
          ORDER BY RAND() 
          LIMIT 5";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $bg);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0): ?>
      <div class="row">
          <?php while ($row = $result->fetch_assoc()): ?>
              <div class="col-lg-4 col-sm-6 mb-4">
                  <div class="card">
                      <img class="card-img-top" src="image/blood_drop_logo.jpg" alt="Donor Image" style="height:300px; object-fit:cover;">
                      <div class="card-body">
                          <h5 class="card-title"><?php echo $row['donor_name']; ?></h5>
                          <p class="card-text">
                              <b>Blood Group:</b> <?php echo $row['blood_group']; ?><br>
                              <b>Mobile No.:</b> <?php echo $row['donor_number']; ?><br>
                              <b>Gender:</b> <?php echo $row['donor_gender']; ?><br>
                              <b>Age:</b> <?php echo $row['donor_age']; ?><br>
                              <b>Address:</b> <?php echo $row['donor_address']; ?>
                          </p>
                      </div>
                  </div>
              </div>
          <?php endwhile; ?>
      </div>
  <?php else: ?>
      <div class="alert alert-danger">No Donor Found for your selected Blood Group.</div>
  <?php endif;

  $stmt->close();
  $conn->close();
?>
