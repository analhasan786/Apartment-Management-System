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
                <h3>Total Commplain</h3>
                <p><?php
                //  echo $payments_count; ?></p>
                <a href="../complaint_form.php">Add Complain</a>
            </div>

            <div class="dashboard-box">
                <h3>Total Maintenance Requests</h3>
                <p><?php 
                // echo $maintenance_count; ?></p>
                <a href="maintenance.php">Manage Maintenance</a>
            </div>
            <div class="dashboard-box">
                <h3>Visitor List</h3>
                <p><?php
                //  echo $emp_count; ?></p>
                <a href="../add_visitor.php">Add Visitor</a>
            </div>
        </div>
    </div>
    </div>
<?php include '../layouts/footer.php';?>

</body>
</html>



