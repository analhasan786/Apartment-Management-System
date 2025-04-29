<?php
session_start();
include 'db.php';
// Simulate logged-in user
$_SESSION['user_id'] = 1;
$_SESSION['role'] = 'admin'; // Change as needed


// Insert complaint
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_complaint'])) {
    $user_id = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    $subject = $conn->real_escape_string($_POST['subject']);
    $description = $conn->real_escape_string($_POST['description']);

    $sql = "INSERT INTO complaints (user_id, role, subject, description)
            VALUES ('$user_id', '$role', '$subject', '$description')";
    if ($conn->query($sql)) $msg = "Complaint submitted successfully!";
    else $error = "Error: " . $conn->error;
}

// Update status
if (isset($_GET['action']) && $_SESSION['role'] == 'admin') {
    $id = (int) $_GET['id'];
    $status = $_GET['status'];
    $conn->query("UPDATE complaints SET status = '$status' WHERE id = $id");
    header("Location: complaint_form.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Complaint Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container">
    <h2 class="mb-4">Complaint Management</h2>

    <?php if (!empty($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <button class="btn btn-primary mb-3" onclick="toggleForm()">➕ Add Complaint</button>

    <div id="complaintForm" style="display: none;" class="card p-3 mb-4 shadow-sm">
        <form method="post">
            <input type="hidden" name="add_complaint" value="1">
            <div class="mb-3">
                <label class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit Complaint</button>
        </form>
    </div>

    <h4>Complaint List</h4>
    <table class="table table-bordered table-hover table-sm align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Role</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created</th>
                <?php if ($_SESSION['role'] == 'admin') echo "<th>Actions</th>"; ?>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM complaints ORDER BY created_at DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['user_id']}</td>
                    <td>{$row['role']}</td>
                    <td>{$row['subject']}</td>
                    <td>{$row['description']}</td>
                    <td><span class='badge bg-".getStatusColor($row['status'])."'>{$row['status']}</span></td>
                    <td>{$row['created_at']}</td>";
            if ($_SESSION['role'] == 'admin') {
                echo "<td>
                        <a href='?action=update&id={$row['id']}&status=In Progress' class='btn btn-sm btn-warning me-1'>In Progress</a>
                        <a href='?action=update&id={$row['id']}&status=Resolved' class='btn btn-sm btn-success'>Resolved</a>
                      </td>";
            }
            echo "</tr>";
        }

        function getStatusColor($status) {
            return match($status) {
                'Pending' => 'secondary',
                'In Progress' => 'warning',
                'Resolved' => 'success',
                default => 'light'
            };
        }
        ?>
        </tbody>
    </table>
</div>

<script>
function toggleForm() {
    const form = document.getElementById("complaintForm");
    form.style.display = form.style.display === "none" ? "block" : "none";
}
</script>

</body>
</html>
