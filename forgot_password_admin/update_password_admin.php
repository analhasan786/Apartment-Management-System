<?php
include '../db.php';

if (isset($_POST['email']) && isset($_POST['new_password']) && isset($_POST['otp'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);

    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    $sql = "SELECT * FROM admin WHERE email='$email' AND reset_otp='$otp' AND reset_token_expire >= NOW() LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $update = "UPDATE admin SET password='$hashed_password', reset_token=NULL, reset_otp=NULL, reset_token_expire=NULL WHERE email='$email'";
        mysqli_query($conn, $update);

        echo "<h3>Password reset successful! You can now <a href='../adminLogin.php'>login</a>.</h3>";
    } else {
        echo "<h3>Invalid OTP or Link Expired!</h3>";
    }
}
?>
