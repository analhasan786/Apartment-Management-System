<?php
session_start();
include 'db.php';

// Add new visitor if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_visitor'])) {
    $issue_date = $_POST['issue_date'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $floor_id = $_POST['floor_id'];
    $unit_id = $_POST['unit_id'];
    $intime = $_POST['intime'];

    $stmt = $conn->prepare("INSERT INTO tbl_visitor (issue_date, name, mobile, address, floor_id, unit_id, intime) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $issue_date, $name, $mobile, $address, $floor_id, $unit_id, $intime);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Update outtime via AJAX
if (isset($_POST['update_outtime'])) {
    $vid = $_POST['vid'];
    $outtime = $_POST['outtime'];
    $stmt = $conn->prepare("UPDATE tbl_visitor SET outtime = ? WHERE vid = ?");
    $stmt->bind_param("si", $outtime, $vid);
    $stmt->execute();
    echo $outtime;
    exit();
}

// Fetch all visitors
$result = $conn->query("SELECT * FROM tbl_visitor ORDER BY vid DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Visitor Management</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
  <style>
    body { background: #f0f2f5; padding: 20px; }
    .container { background: white; padding: 20px; border-radius: 8px; }
    .btn-time { white-space: nowrap; }
  </style>
</head>
<body>
<div class="container">
  <h2 class="text-center">Visitor List</h2>
  <div class="d-flex justify-content-between mb-3">
    <a href="./employee/e_dashboard.php" class="btn btn-secondary">Home</a>
    <div>
      <button class="btn btn-warning" onclick="window.print()">Print</button>
    </div>
  </div>

  <form method="POST" action="">
    <input type="hidden" name="add_visitor" value="1">
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
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr data-id="<?= $row['vid'] ?>">
              <td><?= htmlspecialchars($row['issue_date']) ?></td>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['mobile']) ?></td>
              <td><?= htmlspecialchars($row['address']) ?></td>
              <td><?= htmlspecialchars($row['floor_id']) ?></td>
              <td><?= htmlspecialchars($row['unit_id']) ?></td>
              <td><?= htmlspecialchars($row['intime']) ?></td>
              <td class="outtime-cell">
                <?= htmlspecialchars($row['outtime']) ?: '<button class="btn btn-outline-danger btn-sm set-outtime">Set OutTime</button>' ?>
              </td>
              <td>-</td>
            </tr>
          <?php endwhile; ?>

          <!-- Form Row to Add Visitor -->
          <tr>
            <td><input type="date" name="issue_date" class="form-control" required></td>
            <td><input type="text" name="name" class="form-control" required></td>
            <td><input type="text" name="mobile" class="form-control" required></td>
            <td><input type="text" name="address" class="form-control" required></td>
            <td><input type="number" name="floor_id" class="form-control" required></td>
            <td><input type="text" name="unit_id" class="form-control" required></td>
            <td>
              <input type="hidden" name="intime" id="intime">
              <button type="button" class="btn btn-outline-success btn-time" onclick="setTime('intime', this)">Set InTime</button>
            </td>
            <td>-</td>
            <td><button type="submit" class="btn btn-primary">Add</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </form>
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
function setTime(inputId, btn) {
  const now = new Date().toLocaleTimeString('en-GB', { hour12: false });
  document.getElementById(inputId).value = now;
  btn.textContent = now;
}

$(document).ready(function() {
  const table = $('#visitorTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'excelHtml5'
    ]
  });

  // AJAX update outtime on click
  $(document).on('click', '.set-outtime', function() {
    const row = $(this).closest('tr');
    const vid = row.data('id');
    const now = new Date().toLocaleTimeString('en-GB', { hour12: false });
    $.post('', { update_outtime: 1, vid, outtime: now }, function(response) {
      row.find('.outtime-cell').text(response);
    });
  });
});
</script>
</body>
</html>
