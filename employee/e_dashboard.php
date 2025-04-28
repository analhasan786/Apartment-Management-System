<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id'])) {
    header("Location: e_login.php");
    exit();
}

$emp_id = $_SESSION['id'];
$emp_name = $_SESSION['name']; 
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .dashboard {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

<div class="dashboard">
    <h1>Employee Dashboard</h1>
    <h2>Welcome, <?= htmlspecialchars($emp_name); ?></h2>
    <ul>
        <li><a href="salary.php">💰 View Salary</a></li>
        <li><a href="complaints.php">🛠️💰🚪 Manage Complaints</a></li>
        <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en"> -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Apartment Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;
    0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1
    ,700;1,800;1,900&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../cssMinipro.css" />
</head>

<body>
<?php
 include '../layouts/e_header.php';
  ?> 
    
    <div class="main_box">
    <div class="content">
        <h2>Employee Dashboard</h2>
        <p>Welcome to the Employee Dashboard. Here you can see a quick overview of the Current data related to your Salaries and Maintenamnce sections.</p>

        <!-- Dashboard Boxes -->
        <div class="dashboard-boxes">
            <div class="dashboard-box">
                <h3>Your Salaries</h3>
                <p><?php
                //  echo $apartments_count; ?></p>
                <a href="apartments.php">See Salary</a>
            </div>

            <div class="dashboard-box">
                <h3>Total Tenants</h3>
                
                <a href="tenants.php">Manage Tenants</a>
            </div>

            <div class="dashboard-box">
                <h3>Mantenance</h3>
                <p><?php
                //  echo $payments_count; ?></p>
                <a href="payments.php">Manage Mantenance</a>
            </div>

            <div class="dashboard-box">
                <h3>Total Maintenance Requests</h3>
                <p><?php 
                // echo $maintenance_count; ?></p>
                <a href="maintenance.php">Manage Maintenance</a>
            </div>
            <div class="dashboard-box">
                <h3>Total Employees</h3>
                <p><?php
                //  echo $emp_count; ?></p>
                <a href="manage_employee.php">Add Employee</a>
            </div>
        </div>
    </div>
    </div>
<?php include '../layouts/footer.php';?>

</body>
</html>



