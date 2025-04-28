<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';

// Redirect to login if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: adminLogin.php");
    exit();
}

$Name = isset($_SESSION['Name']) ? htmlspecialchars($_SESSION['Name']) : 'Admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <link rel="stylesheet" type="text/css" href="../public/assets/css/a_header.css">
</head>

<body>
    <header>
        <input type="checkbox" id="check" />
        <div class="btn_one">
            <label for="check" style="color: white">
                <i class="fa-solid fa-bars"></i>
            </label>
        </div>
        <?php
        //    $sql =  "select * from admin";
        // $result = $conn->query($sql);
        //  $Name = htmlspecialchars($row[$Name]);
        // $Name = $result->fetch_assoc()['Name'];

        ?>
        <h1 style="margin: 10px;">Welcome <?php echo $Name ?></h1>


        <div class="sidebar_menu">
            <div class="logo">
                <a href="adminDashboard.php">Admin Dashboard</a>
            </div>

            <div class="btn_two">
                <label for="check">
                    <i class="fa-solid fa-xmark"></i>
                </label>
            </div>

            <div class="menu">
                <ul style="list-style-type: none; margin: 0; padding: 0;">
                    <li>
                        <a href="./index.php">Home</a>
                    </li>
                    <li>
                        <a href="apartments.php">Manage Apartments</a>
                    </li>
                    <li>
                        <a href="tenants.php">Manage Tenants</a>

                    </li>
                    <li>
                        <a href="payments.php">Manage Payments</a>
                    </li>
                    <li>
                        <a href="maintenance.php">Manage Maintenance Requests</a>
                    </li>
                    <li>
                        <a href="manage_employee.php">Add Employees</a>
                    </li>
                    <li id="logout">
                        <a href="logout.php" class="btn">Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </header>
</body>

</html>