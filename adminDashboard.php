<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: adminLogin.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];
$admin_name = "Admin User"; // Ideally, you fetch the admin name from the DB

// Count apartments
$sql_apartments = "SELECT COUNT(*) AS total_apartments FROM Apartment";
$result_apartments = $conn->query($sql_apartments);
$apartments_count = $result_apartments->fetch_assoc()['total_apartments'];

// Count tenants
$sql_tenants = "SELECT COUNT(*) AS total_tenants FROM Tenant";
$result_tenants = $conn->query($sql_tenants);
$tenants_count = $result_tenants->fetch_assoc()['total_tenants'];

// Count payments
$sql_payments = "SELECT COUNT(*) AS total_payments FROM Payment";
$result_payments = $conn->query($sql_payments);
$payments_count = $result_payments->fetch_assoc()['total_payments'];

// Count maintenance requests
$sql_maintenance = "SELECT COUNT(*) AS total_requests FROM Maintenance";
$result_maintenance = $conn->query($sql_maintenance);
$maintenance_count = $result_maintenance->fetch_assoc()['total_requests'];

//Count Employees
$sql_emp = "SELECT COUNT(*) AS total_employees FROM employees";
$result_emp = $conn->query($sql_emp);
$emp_count = $result_emp->fetch_assoc()['total_employees'];
?>

<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="cssMinipro.css" />
</head>

<body>
<?php
 include 'layouts/a_header.php';
  ?> 
    
    <div class="main_box">
    <div class="content">
        <h2>Admin Dashboard</h2>
        <p>Welcome to the Admin Dashboard. Here you can see a quick overview of the management sections.</p>

        <!-- Dashboard Boxes -->
        <div class="dashboard-boxes">
            <div class="dashboard-box">
                <h3>Total Apartments</h3>
                <p><?php echo $apartments_count; ?></p>
                <a href="apartments.php">Manage Apartments</a>
            </div>

            <div class="dashboard-box">
                <h3>Total Tenants</h3>
                <p><?php echo $tenants_count; ?></p>
                <a href="tenants.php">Manage Tenants</a>
            </div>

            <div class="dashboard-box">
                <h3>Total Payments</h3>
                <p><?php echo $payments_count; ?></p>
                <a href="payments.php">Manage Payments</a>
            </div>

            <div class="dashboard-box">
                <h3>Total Maintenance Requests</h3>
                <p><?php echo $maintenance_count; ?></p>
                <a href="maintenance.php">Manage Maintenance</a>
            </div>
            <div class="dashboard-box">
                <h3>Register Owner</h3>
                <p><?php echo $maintenance_count; ?></p>
                <a href="maintenance.php">Manage Owner Details</a>
            </div>
            <div class="dashboard-box">
                <h3>Total Employees</h3>
                <p><?php echo $emp_count; ?></p>
                <a href="manage_employee.php">Add Employee</a>
            </div>
            <div class="dashboard-box">
                <h3>Total Complain</h3>
                <p><?php echo $emp_count; ?></p>
                <a href="complain.php">Manage Complain</a>
            </div>
        </div>
    </div>
    </div>
    <!-- <footer> -->
        <!-- <div class="footer-container">
            <p>&copy; 2025 Apartment Management System | All Rights Reserved</p>
            <p>Contact us: <a href="mailto:anal.hasan007@gmail.com">anal.hasan007@gmail.com</a></p>
        </div> -->
    <!-- </footer> -->
<?php 
include './layouts/footer.php';?> 
</body>

</html>







