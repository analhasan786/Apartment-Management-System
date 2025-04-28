<?php
session_start();
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM owner WHERE email = '$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $owner = $result->fetch_assoc();
        if($password == $owner['password']){
            $_SESSION['id'] = $owner['id'];
            $_SESSION['name'] = $owner['name'];
            // header("Location: e_dashboard.php");
            header("Location: o_dashboard.php");

            exit();
        } else{

            $error_message = "Invalid Email and Password";
        }
    } else {
        $error_message = "Invalid Email And Password";
    }
    $conn->close();



    // if ($user && password_verify($password, $user['password'])) {
    //     $_SESSION['id'] = $user['id'];
    //     $_SESSION['name'] = $user['name']; // store name for dashboard greeting

    //     header("Location: e_dashboard.php");
    //     exit();
    // } else {
    //     $error = "Invalid email or password.";
    // }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Owner Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* background-color: #f2f2f2; */
            background: linear-gradient(99deg, #4CAF50, #2F80ED);

        }
        .login-container {
            margin-top: 80px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .error_message{
            color: red;
        }
        
        .links {
            margin-top: 20px;
            animation: fadeIn 1s ease;
            text-align: center;
        }

       
        
        .links a {
            font-size: 0.8rem;
            text-decoration: none;
            font-size: 0.9rem;
            color: #007BFF;
            /* margin: 0 10px; */
            transition: color 0.3s ease;
        }

       
        
        .links a:hover {
            color: #0056b3;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h3 class="text-center mb-4">Owner Login</h3>

                <?php if (isset($error_message)) { ?>
                    <div class="error_message "><?php echo $error_message; ?></div>
                <?php  } ?>

                <form method="POST" action="o_login.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" required placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <div class="links">
                        <a href="../index.php"><i class="fas fa-arrow-left"></i> Back</a>
                        <!-- <a href="register.php">Register <i class="fas fa-user-plus"></i></a> -->
                    </div>            </div>
        </div>
    </div>
</div>

</body>
</html>
