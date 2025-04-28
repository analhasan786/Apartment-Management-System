<?php
?>
<?php 
$tenant_id = $_SESSION['tenant_id']; 
$tenant_name = $_SESSION['tenant_name']; 

$sql_apartments = "SELECT * FROM Apartment WHERE Availability_Status = 'Available'"; 
$apartments = $conn->query($sql_apartments); 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <link rel="stylesheet" type="text/css" href="../public/assets/css/t_header.css">
        <body>
<header>
<input type="checkbox" id="check" />
<div class="btn_one">
    <label for="check" style="color: white">
        <i class="fa-solid fa-bars"></i>
    </label>
</div>
<h1>Welcome  <?php echo $tenant_name;?></h1>


<div class="sidebar_menu">
    <div class="logo">
        <a href="#"><?php echo $tenant_name;?></a>
    </div>

    <div class="btn_two">
        <label for="check">
            <i class="fa-solid fa-xmark"></i>
        </label>
    </div>

    <div class="menu">
        <ul>
            <!-- <li>
                <a href="apartments.php">Manage Apartments</a>
            </li> -->
            <li>
            <a href="index.php">Home</a>         

            </li>
            <li>
            <a href="tenant_dashboard.php" class="active">Apartments</a>         
            </li>
            <li>
                 <a href="makePayment.php" class="btn">Make Payment</a>
            </li>
            <li>
            <a href="maintenanceRequest.php" class="btn">Submit Maintenance Request</a>
            </li>
            <li  id="logout">
                <a href="logout.php" class="btn">Logout</a>
            </li>
            
        </ul>
    </div>
</header>
</body>
</html>
