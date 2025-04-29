<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['tenant_id'])) {
    header("Location: login.php");
    exit();
}

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
    <title>Tenant Dashboard - Apartment Management</title>
    <link rel="stylesheet" href="tenantDashboard.css">
    <link rel="stylesheet" href="cssMinipro.css">
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
    <style>
        /* General Page Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f0f0;
            margin: 0;
            padding: 0;
            /* display: flex;              */
            /* justify-content: flex-start; */
            /* align-items: flex-start; */
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Main Content Area */
        .main-content {
            /* margin-left: 260px;              */
            padding: 40px;
            /* margin-top: 30px; */
            flex-grow: 1;
            transition: margin-left 0.3s ease-in-out;
        }

        .main-content h1 {
            /* text-align: center; */
            color: #333;
            margin-bottom: 20px;
            font-size: 2.5em;
            letter-spacing: 1px;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        /* Apartment Card Styles */
        .apartment-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .apartment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .apartment-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .apartment-card .card-body {
            padding: 20px;
        }

        .apartment-card .card-title {
            font-size: 1.5em;
            color: #FF5733;
        }

        .apartment-card .card-footer {
            text-align: right;
        }

        .apartment-card .card-footer a {
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s, transform 0.3s ease-in-out;
        }

        .apartment-card .card-footer a:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Logout Button */
        .logout-btn {
            text-align: right;
            margin-bottom: 20px;
        }

        .logout-btn a {
            background-color: #FF5733;
            color: white;
            padding: 10px 20px;
            /* text-align: center; */
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s, transform 0.3s ease-in-out;
        }

        .logout-btn a:hover {
            background-color: #FF3B00;
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidenav {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .apartment-card {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <?php
    include 'layouts/t_header.php';
    ?>





    <!-- Main Content -->
    <div class="main-box">
        <div class="content">
            <h2>Tenant Dashboard</h2>
            <p>Welcome to the tenant Dashboard. Here you can see a quick overview of the Current data related to your tenant, unit, floor, complain .</p>
            <div class="dashboard-boxes">
                <div class="dashboard-box">
                    <h3>Unit Details</h3>
                    <p><?php
                        //  echo $apartments_count; 
                        ?></p>
                    <a href="unit.php">More Info</a>
                </div>
                <!-- <div class="dashboard-box">
                    <h3>Rented Statement</h3>
                    <p><?php
                        //  echo $apartments_count; 
                        ?></p>
                    <a href="apartments.php">More Info</a>
                </div> -->
                <div class="dashboard-box">
                    <h3>Total Complain </h3>
                    <p><?php
                        //  echo $apartments_count; 
                        ?></p>
                    <a href="complaint_form.php">More Info</a>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="main-content">
        <!-- <h1>Welcome, <?php echo $tenant_name; ?></h1>          -->
        <h2>Available Apartments</h2>
        <div class="apartment-container">
            <?php while ($apartment = $apartments->fetch_assoc()): ?>
                <div class="apartment-card">

                    <div class="card-body">
                        <h3 class="card-title"><?php echo $apartment['Apartment_No']; ?></h3>
                        <p>Floor: <?php echo $apartment['Floor_No']; ?></p>
                        <p>Rent: $<?php echo $apartment['Rent_Amount']; ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="bookApartment.php?apartment_no=<?php echo $apartment['Apartment_No']; ?>">Book Now</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>

</html>
    <?php
    include './layouts/footer.php';
    ?>