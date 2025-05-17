<?php
  $active = 'why';
  include('head.php');
  include 'conn.php';
?>

<div class="container my-5">
  <div class="row align-items-center">
    <div class="col-lg-6 mb-4">
      <h1 class="mb-4">Why Should I Donate Blood?</h1>
      <p>
        <?php
          $sql = "SELECT * FROM pages WHERE page_type='donor'";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  echo $row['page_data'];
              }
          }
        ?>
      </p>
    </div>
    <div class="col-lg-6 mb-4 text-center">
      <img src="image/08f2fccc45d2564f74ead4a6d5086871.png" class="img-fluid rounded shadow" alt="Why Donate" style="max-height: 500px;">
    </div>
  </div>
</div>

<?php include('footer.php'); ?>