<?php
include '../db.php';

if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    $sql = "SELECT * FROM admin WHERE reset_token='$token' AND reset_token_expire >= NOW() LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-body">
            <h3 class="card-title text-center">Reset Password</h3>
            <form method="POST" action="update_password_admin.php">
                <input type="hidden" name="email" value="<?php echo $admin['email']; ?>">
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>OTP (from SMS)</label>
                    <input type="text" name="otp" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Reset Password</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
    } else {
        echo "<h3>Invalid or Expired Reset Link.</h3>";
    }
}
?>
