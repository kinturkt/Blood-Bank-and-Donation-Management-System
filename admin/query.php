<?php
include 'conn.php';
include 'session.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo '<div class="alert alert-danger"><b>Please Login First To Access Admin Portal.</b></div>';
    echo '<a href="login.php" class="btn btn-primary">Go to Login Page</a>';
    exit;
}

// Mark query as read if "id" is present in URL
if (isset($_GET['id'])) {
    $que_id = intval($_GET['id']);
    $sql1 = "UPDATE contact_query SET query_status='1' WHERE query_id={$que_id}";
    mysqli_query($conn, $sql1);
    header("Location: query.php?status=read");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Queries</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    #sidebar { position: relative; margin-top: -20px; }
    #content { position: relative; margin-left: 210px; }
    @media screen and (max-width: 600px) {
      #content { margin-left: auto; margin-right: auto; }
    }
    #he {
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      padding: 3px 7px;
      color: #fff;
      text-decoration: none;
      border-radius: 3px;
      text-align: center;
    }
  </style>
</head>
<body style="color:black;">

<div id="header">
  <?php include 'header.php'; ?>
</div>

<div id="sidebar">
  <?php $active = "query"; include 'sidebar.php'; ?>
</div>

<div id="content">
  <div class="container-fluid">
    <h1 class="page-title">User Query</h1>
    <hr>

    <?php
    $limit = 10;
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($page - 1) * $limit;
    $count = $offset + 1;

    $sql = "SELECT * FROM contact_query LIMIT {$offset},{$limit}";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0): ?>
      <div class="table-responsive">
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th>S.no</th>
              <th>Name</th>
              <th>Email Id</th>
              <th>Mobile Number</th>
              <th>Message</th>
              <th>Posting Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?= $count++ ?></td>
                <td><?= htmlspecialchars($row['query_name']) ?></td>
                <td><?= htmlspecialchars($row['query_mail']) ?></td>
                <td><?= htmlspecialchars($row['query_number']) ?></td>
                <td><?= htmlspecialchars($row['query_message']) ?></td>
                <td><?= htmlspecialchars($row['query_date']) ?></td>
                <td>
                  <?php if ($row['query_status'] == 1): ?>
                    <span class="label label-success">Read</span>
                  <?php else: ?>
                    <a href="query.php?id=<?= $row['query_id'] ?>" class="label label-warning">Pending</a>
                  <?php endif; ?>
                </td>
                <td id="he">
                  <a href="delete_query.php?id=<?= $row['query_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="text-center">
        <ul class="pagination">
          <?php
          $total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM contact_query");
          $total_row = mysqli_fetch_assoc($total_result);
          $total_pages = ceil($total_row['total'] / $limit);

          if ($page > 1) echo '<li><a href="query.php?page=' . ($page - 1) . '">Prev</a></li>';
          for ($i = 1; $i <= $total_pages; $i++) {
              $active = ($i == $page) ? 'active' : '';
              echo '<li class="' . $active . '"><a href="query.php?page=' . $i . '">' . $i . '</a></li>';
          }
          if ($page < $total_pages) echo '<li><a href="query.php?page=' . ($page + 1) . '">Next</a></li>';
          ?>
        </ul>
      </div>

    <?php else: ?>
      <div class="alert alert-info text-center">No user queries found.</div>
    <?php endif; ?>
  </div>
</div>

</body>
</html>