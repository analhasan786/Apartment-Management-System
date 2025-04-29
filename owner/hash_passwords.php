<?php
include '../db.php'; // adjust path if needed

$sql = "SELECT Tenant_ID, Login_Password FROM tenant";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $id = $row['Tenant_ID'];
    $plain_password = $row['Login_Password'];

    // Skip if already hashed (starts with $2y$)
    if (strpos($plain_password, '$2y$') !== 0) {
        $hashed = password_hash($plain_password, PASSWORD_DEFAULT);

        $update = $conn->prepare("UPDATE tenant SET Login_Password = ? WHERE Tenant_ID = ?");
        $update->bind_param("si", $hashed, $id);
        $update->execute();

        echo "Updated password for Tenant ID: $id<br>";
    }
}

echo "Password hashing completed for tenants.<br>";
?>
