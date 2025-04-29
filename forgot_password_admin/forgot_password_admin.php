<?php
include '../db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);

        $token = bin2hex(random_bytes(16));
        $otp = rand(100000, 999999);
        $expire = date("Y-m-d H:i:s", strtotime("+24 hours"));

        $update = "UPDATE admin SET reset_token='$token', reset_otp='$otp', reset_token_expire='$expire' WHERE email='$email'";
        mysqli_query($conn, $update);

        // Send Email using PHPMailer
        $resetLink = "http://localhost/Apartment-Management-System/forgot_password_admin/reset_password_admin.php?token=" . $token;
        // C:\xampp\htdocs\Apartment-Management-System\forgot_password_admin\update_password_admin.php

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'dabluhasi786@gmail.com';      // <-- change here
            $mail->Password   = 'uteiyjaxcrqvboaw';       // <-- change here
            $mail->SMTPSecure = 'tls';            
            $mail->Port       = 587;                                    

            $mail->setFrom('yourgmail@gmail.com', 'Apartment Management System'); // <-- change here
            $mail->addAddress($email);     

            $mail->isHTML(true);                                
            $mail->Subject = 'Admin Password Reset Link';
            $mail->Body    = "
                <p>Hello Admin,</p>
                <p>Click below link to reset your password:</p>
                <p><a href='$resetLink'>$resetLink</a></p>
                <p>Or use OTP: <b>$otp</b> (valid for 15 minutes).</p>
                <p>Thank you!</p>
            ";

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // Send SMS (dummy, commented for now)
        /*
        $phone = $admin['phone'];
        $sms_message = "Your OTP is $otp (valid 15 mins)";
        file_get_contents("https://sms-api.example.com/send?to=$phone&message=" . urlencode($sms_message));
        */

        echo "<h3>Reset link and OTP sent successfully! Check your email.</h3>";
    } else {
        echo "<h3>Email not found in Admin records.</h3>";
    }
}
?>

<!-- Bootstrap Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Admin Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-body">
            <h3 class="card-title text-center">Forgot Password</h3>
            <form method="POST">
                <div class="mb-3">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
            </form>
            <a href="../adminLogin.php"><button type="submit" class="btn btn-primary w-100 mt-1">Back</button></a>
        </div>
    </div>
</div>
</body>
</html>
