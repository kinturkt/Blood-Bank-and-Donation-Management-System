<?php
include 'conn.php';
include 'session.php';
if (!isset($_SESSION['loggedin'])) {
    echo '<div class="alert alert-danger"><b>Please Login First To Access Admin Portal.</b></div>';
    echo '<a href="login.php" class="btn btn-primary">Go to Login Page</a>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Pages</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .table td {
      vertical-align: middle;
    }
    .page-data-box {
      max-height: 120px;
      overflow-y: auto;
    }
  </style>
</head>
<body>

<?php $active = "pages"; include 'header.php'; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 p-0">
      <?php include 'sidebar.php'; ?>
    </div>

    <div class="col-md-10 p-4">
      <h3 class="mb-4">Manage Page Content</h3>

      <?php
      $limit = 3;
      $page = isset($_GET['page']) ? $_GET['page'] : 1;
      $offset = ($page - 1) * $limit;
      $count = $offset + 1;

      $sql = "SELECT * FROM pages LIMIT $offset, $limit";
      $result = mysqli_query($conn, $sql);
      ?>

      <?php if (mysqli_num_rows($result) > 0): ?>
      <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
          <thead class="table-dark">
            <tr>
              <th>S.No</th>
              <th>Page Name</th>
              <th>Page Type</th>
              <th>Page Data</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?= $count++; ?></td>
                <td><?= htmlspecialchars($row['page_name']) ?></td>
                <td><?= htmlspecialchars($row['page_type']) ?></td>
                <td class="text-start">
                  <div class="page-data-box"><?= nl2br(htmlspecialchars($row['page_data'])) ?></div>
                </td>
                <td>
                  <a class="btn btn-info btn-sm" href="update_page_details.php?type=<?= urlencode($row['page_type']) ?>">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <?php else: ?>
        <div class="alert alert-warning">No pages found.</div>
      <?php endif; ?>

      <!-- Pagination -->
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
        <?php
        $sql1 = "SELECT COUNT(*) AS total FROM pages";
        $res1 = mysqli_query($conn, $sql1);
        $total_records = mysqli_fetch_assoc($res1)['total'];
        $total_page = ceil($total_records / $limit);

        if ($page > 1) {
            echo '<li class="page-item"><a class="page-link" href="pages.php?page='.($page-1).'">Prev</a></li>';
        }

        for ($i = 1; $i <= $total_page; $i++) {
            $active_class = ($i == $page) ? 'active' : '';
            echo '<li class="page-item '.$active_class.'"><a class="page-link" href="pages.php?page='.$i.'">'.$i.'</a></li>';
        }

        if ($total_page > $page) {
            echo '<li class="page-item"><a class="page-link" href="pages.php?page='.($page+1).'">Next</a></li>';
        }
        ?>
        </ul>
      </nav>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>