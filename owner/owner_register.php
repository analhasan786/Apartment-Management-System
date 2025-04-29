<?php
include '../db.php'; // Adjust path if needed
$errors = [];
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $unit_no = trim($_POST['unit_no']);
    $floor_no = trim($_POST['floor_no']);
    $email = trim($_POST['email']);
    $contact_no = trim($_POST['contact_no']);
    $user_name = trim($_POST['user_name']);
    $password = trim($_POST['password']);

    if (!$name || !$unit_no || !$floor_no || !$email || !$contact_no || !$user_name || !$password) {
        $errors[] = "All fields are required.";
    } else {
        // Check if username or email exists
        $check = $conn->prepare("SELECT id FROM owner WHERE email = ? OR user_name = ?");
        $check->bind_param("ss", $email, $user_name);
        $check->execute();
        $result = $check->get_result();
        if ($result->num_rows > 0) {
            $errors[] = "Email or User_name already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO owner (name, unit_no, floor_no, email, contact_no, user_name, password) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssissss", $name, $unit_no, $floor_no, $email, $contact_no, $user_name, $hashed_password);
            if ($stmt->execute()) {
                $success = "Owner registered successfully!";
            } else {
                $errors[] = "Database error: " . $stmt->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Owner Registration</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(to right, #67b26f, #4ca2cd);
      min-height: 100vh;
    }
    .container {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.15);
      margin-top: 60px;
    }
    .form-group.required label:after {
      content: " *";
      color: red;
    }
  </style>
</head>
<body>
<div class="container col-md-6">
  <h3 class="text-center mb-4">Owner Registration</h3>

  <?php if ($errors): ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $err) echo "<div>$err</div>"; ?>
    </div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="alert alert-success"><?= $success ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="form-group required">
      <label>Full Name</label>
      <input type="text" name="name" class="form-control" required />
    </div>
    <div class="form-group required">
      <label>Unit No</label>
      <input type="text" name="unit_no" class="form-control" required />
    </div>
    <div class="form-group required">
      <label>Floor No</label>
      <input type="number" name="floor_no" class="form-control" required />
    </div>
    <div class="form-group required">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required />
    </div>
    <div class="form-group required">
      <label>Contact No</label>
      <input type="text" name="contact_no" class="form-control" required />
    </div>
    <div class="form-group required">
      <label>User_name</label>
      <input type="text" name="user_name" class="form-control" required />
    </div>
    <div class="form-group required">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required />
    </div>
    <button type="submit" class="btn btn-success btn-block">Register</button>
  </form>
</div>
</body>
</html>
