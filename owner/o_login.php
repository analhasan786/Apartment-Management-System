<?php
session_start();
include '../db.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT * FROM owner WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $owner = $result->fetch_assoc();

        if (password_verify($password, $owner['password'])) {
            $_SESSION['id'] = $owner['id'];
            $_SESSION['name'] = $owner['name'];
            header("Location: o_dashboard.php");
            exit();
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Owner Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(99deg, #4CAF50, #2F80ED);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .error_message {
            color: red;
            text-align: center;
            font-weight: bold;
        }
        .links {
            margin-top: 15px;
            text-align: center;
        }
        .links a {
            font-size: 0.9rem;
            text-decoration: none;
            color: #007BFF;
            transition: 0.3s;
        }
        .links a:hover {
            color: #0056b3;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h3 class="text-center mb-4">Owner Login</h3>

                <?php if (!empty($error_message)) : ?>
                    <div class="error_message mb-3"><?= htmlspecialchars($error_message); ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <div class="links mt-3">
                    <a href="../index.php"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
