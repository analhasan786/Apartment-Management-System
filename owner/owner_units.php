<?php
include '../db.php';
session_start();

// Check login
if (!isset($_SESSION['id'])) {
    header("Location: o_login.php");
    exit();
}

$owner_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Units</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap + DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- Custom Gradient Background -->
  <style>
    body {
      background: linear-gradient(to right, #83a4d4, #b6fbff); /* Apartment-themed gradient */
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f2f2f2;
    }

    h3 {
      color: #333;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="card p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>My Units</h3>
        <a href="o_dashboard.php" class="btn btn-outline-dark">
          <i class="fa fa-home"></i> Dashboard
        </a>
      </div>

      <div class="table-responsive">
        <table id="unitTable" class="table table-bordered table-light">
          <thead>
            <tr>
              <th>Unit No</th>
              <th>Floor No</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT u.id, u.unit_no, u.floor_no, u.status
                    FROM unit u
                    INNER JOIN owner o ON u.owner_id = o.id
                    WHERE u.owner_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $owner_id);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['unit_no']) . "</td>
                        <td>" . htmlspecialchars($row['floor_no']) . "</td>
                        <td>" . htmlspecialchars($row['status']) . "</td>
                      </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- JS and DataTables -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#unitTable').DataTable();
    });
  </script>
</body>
</html>
