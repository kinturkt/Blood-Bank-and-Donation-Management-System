<?php
$active = 'about';
include('head.php');
include 'conn.php';
?>
<div class="container my-5">
  <div class="row align-items-center">
    <div class="col-lg-6">
      <h1 class="mb-4">About Us</h1>
      <p>
        <?php
          $sql = "SELECT * FROM pages WHERE page_type='aboutus'";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  echo $row['page_data'];
              }
          }
        ?>
      </p>
    </div>
    <div class="col-lg-6">
      <img src="image/banner_590x300.jpg" alt="About Us Image" class="img-fluid rounded shadow" style="max-height: 400px;">
    </div>
  </div>
</div>
<?php include('footer.php'); ?>