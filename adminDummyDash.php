<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: adminLogin.php");
    exit();
}
$admin_name = "Admin"; // Optional: fetch from DB
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-card {
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            transition: 0.3s ease;
        }
        .dashboard-card:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand">Apartment Management - Admin</span>
        <div class="d-flex">
            <span class="navbar-text text-white me-3">Welcome, <?= htmlspecialchars($admin_name) ?></span>
            <a class="btn btn-light btn-sm" href="adminLogout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-4">Dashboard</h3>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card dashboard-card p-3 text-center bg-info text-white">
                <h4>Tenants</h4>
                <p class="fs-3">24</p>
                <a href="manage_tenants.php" class="btn btn-light btn-sm">Manage</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dashboard-card p-3 text-center bg-success text-white">
                <h4>Owners</h4>
                <p class="fs-3">12</p>
                <a href="manage_owners.php" class="btn btn-light btn-sm">Manage</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dashboard-card p-3 text-center bg-warning text-dark">
                <h4>Employees</h4>
                <p class="fs-3">6</p>
                <a href="manage_employees.php" class="btn btn-light btn-sm">Manage</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dashboard-card p-3 text-center bg-danger text-white">
                <h4>Available Rooms</h4>
                <p class="fs-3">10</p>
                <a href="available_rooms.php" class="btn btn-light btn-sm">Check</a>
            </div>
        </div>
    </div>

    <div class="row mt-5 g-4">
        <div class="col-md-4">
            <div class="card dashboard-card p-3">
                <h5 class="card-title">Complaints</h5>
                <p>View and assign unresolved tenant complaints.</p>
                <a href="manage_complaints.php" class="btn btn-outline-primary btn-sm">Go</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card dashboard-card p-3">
                <h5 class="card-title">Invoices</h5>
                <p>View rent & fund invoices. Mark as paid or due.</p>
                <a href="manage_invoices.php" class="btn btn-outline-primary btn-sm">Go</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card dashboard-card p-3">
                <h5 class="card-title">Notifications</h5>
                <p>Send email/SMS to tenants, owners & employees.</p>
                <a href="send_notifications.php" class="btn btn-outline-primary btn-sm">Go</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>
