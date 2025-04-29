<?php
session_start();
include 'db.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM tenant WHERE Email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $tenant = $result->fetch_assoc();

        if (password_verify($password, $tenant['Login_Password'])) {
            $_SESSION['tenant_id'] = $tenant['Tenant_ID'];
            $_SESSION['tenant_name'] = $tenant['Name'];
            header("Location: tenantDashboard.php");
            exit();
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "Tenant not found!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenant Login - Apartment Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #4CAF50, #2F80ED);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #007BFF;
            margin-bottom: 20px;
        }

        label {
            font-size: 1rem;
            text-align: left;
            width: 100%;
            display: block;
            margin-bottom: 5px;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            background-color: #007BFF;
            color: white;
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
        }

        .links {
            margin-top: 15px;
        }

        .links a {
            font-size: 0.9rem;
            color: #007BFF;
            text-decoration: none;
            margin: 0 10px;
        }

        .links a:hover {
            color: #0056b3;
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }

            button {
                font-size: 0.9rem;
            }

            .links a {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Tenant Login</h2>

    <?php if ($error_message): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" required placeholder="Enter your email">

        <label for="password">Password:</label>
        <input type="password" name="password" required placeholder="Enter your password">

        <button type="submit">Login</button>
    </form>

    <div class="links">
        <a href="index.php"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>

</body>
</html>
