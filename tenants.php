<?php
include './db.php';
session_start();

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
  <title>My Tenants</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap + DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    body {
      background: linear-gradient(to right, #83a4d4, #b6fbff);
      min-height: 100vh;
    }
    .card {
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .table thead {
      background-color:rgb(216, 218, 221);
      /* color: white; */
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="card p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>My Tenants</h3>
        <a href="./owner/o_dashboard.php" class="btn btn-outline-dark">
          <i class="fa fa-home"></i> Dashboard
        </a>
      </div>

      <div class="table-responsive">
        <table id="tenantTable" class="table table-bordered ">
          <thead>
            <tr>
              <th>Tenant Name</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Unit No</th>
              <th>Floor No</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT t.Name, t.Email, t.Contact_Info, u.unit_no, u.floor_no
                    FROM tenant t
                    INNER JOIN unit u ON t.unit_id = u.id
                    WHERE u.owner_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $owner_id);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['Name']) . "</td>
                        <td>" . htmlspecialchars($row['Email']) . "</td>
                        <td>" . htmlspecialchars($row['Contact_Info']) . "</td>
                        <td>" . htmlspecialchars($row['unit_no']) . "</td>
                        <td>" . htmlspecialchars($row['floor_no']) . "</td>
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
        $('#tenantTable').DataTable();
    });
  </script>
</body>
</html>
