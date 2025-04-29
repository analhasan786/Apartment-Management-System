<?php
session_start();
include '../db.php';

// Fetch all visitors
$result = $conn->query("SELECT * FROM tbl_visitor ORDER BY vid DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Visitor List for Owner</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
  <style>
    body { background: #f0f2f5; padding: 20px; }
    .container { background: white; padding: 20px; border-radius: 8px; }
  </style>
</head>
<body>
<div class="container">
  <h2 class="text-center">Visitor List</h2>
  <div class="d-flex justify-content-between mb-3">
    <a href="../owner/o_dashboard.php" class="btn btn-secondary">Home</a>
    <div>
      <button class="btn btn-warning" onclick="window.print()">Print</button>
    </div>
  </div>

  <div class="table-responsive">
    <table id="visitorTable" class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Issue Date</th>
          <th>Name</th>
          <th>Mobile</th>
          <th>Address</th>
          <th>Floor</th>
          <th>Unit</th>
          <th>In Time</th>
          <th>Out Time</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['issue_date']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['mobile']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            <td><?= htmlspecialchars($row['floor_id']) ?></td>
            <td><?= htmlspecialchars($row['unit_id']) ?></td>
            <td><?= htmlspecialchars($row['intime']) ?></td>
            <td><?= htmlspecialchars($row['outtime']) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
  $('#visitorTable').DataTable({
    dom: 'Bfrtip',
    buttons: ['excelHtml5']
  });
});
</script>
</body>
</html>
