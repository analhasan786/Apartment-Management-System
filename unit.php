<?php
include 'db.php';
// Fetch units with tenant names
$sql = "
SELECT 
    u.uid,
    u.floor,
    u.unit,
    t.Tenant_ID,
    t.Name
FROM 
    tbl_add_unit u
INNER JOIN 
    tenant t ON u.tenant_id = t.Tenant_ID
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unit and Tenant List</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #4CAF50, #2F80ED);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007BFF;
            font-weight: 700;
        }

        table {
            margin-top: 20px;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>

</head>
<body>

<div class="container">
    <h2>Unit and Tenant Details</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>Unit ID</th>
                    <th>Floor</th>
                    <th>Unit Name</th>
                    <th>Tenant ID</th>
                    <th>Tenant Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['uid']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['floor']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['unit']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Tenant_ID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap Bundle JS (for future use like modals, if needed) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
