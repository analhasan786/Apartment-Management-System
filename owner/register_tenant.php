<?php
include '../db.php';
session_start();

$errors = [];
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $contact = trim($_POST['contact']);
    $email = trim($_POST['email']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $password = $_POST['password'];
    $floor_no = $_POST['floor_no'];
    $unit_no = $_POST['unit_no'];

    // Basic validation
    if (empty($name) || empty($contact) || empty($email) || empty($start_date) || empty($end_date) || empty($password) || empty($floor_no) || empty($unit_no)) {
        $errors[] = "All fields are required.";
    } else {
        // Check if unit exists
        $unitCheck = $conn->prepare("SELECT id FROM unit WHERE unit_no = ? AND floor_no = ?");
        $unitCheck->bind_param("si", $unit_no, $floor_no);
        $unitCheck->execute();
        $unitResult = $unitCheck->get_result();

        if ($unitResult->num_rows === 0) {
            $errors[] = "No such unit found on the specified floor.";
        } else {
            $unitData = $unitResult->fetch_assoc();
            $unit_id = $unitData['id'];

            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert tenant
            $stmt = $conn->prepare("INSERT INTO tenant (Name, Contact_Info, Email, Lease_Start_Date, Lease_End_Date, Login_Password, Floor_No, unit_no, unit_id) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssii", $name, $contact, $email, $start_date, $end_date, $hashed_password, $floor_no, $unit_no, $unit_id);

            if ($stmt->execute()) {
                $success = "Tenant registered successfully.";
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Tenant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #6dd5fa, #2980b9);
            min-height: 100vh;
        }
        .container {
            background: white;
            padding: 30px;
            margin-top: 60px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .form-group.required label:after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body>
<div class="container col-md-6">
    <h3 class="text-center mb-4">Register Tenant</h3>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $e) echo "<div>$e</div>"; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group required">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required />
        </div>

        <div class="form-group required">
            <label>Contact Info</label>
            <input type="text" name="contact" class="form-control" required />
        </div>

        <div class="form-group required">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required />
        </div>

        <div class="form-group required">
            <label>Lease Start Date</label>
            <input type="date" name="start_date" class="form-control" required />
        </div>

        <div class="form-group required">
            <label>Lease End Date</label>
            <input type="date" name="end_date" class="form-control" required />
        </div>

        <div class="form-group required">
            <label>Login Password</label>
            <input type="password" name="password" class="form-control" required />
        </div>

        <div class="form-group required">
            <label>Floor No</label>
            <input type="number" name="floor_no" class="form-control" required />
        </div>

        <div class="form-group required">
            <label>Unit No</label>
            <input type="text" name="unit_no" class="form-control" required />
        </div>

        <button type="submit" class="btn btn-primary btn-block">Register Tenant</button>
    </form>
</div>
</body>
</html>
