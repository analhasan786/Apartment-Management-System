<?php
include 'db.php'; // Your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $issue_date = $_POST['issue_date'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $floor_id = $_POST['floor_id'];
    $unit_id = $_POST['unit_id'];
    $intime = $_POST['intime'];
    $outtime = $_POST['outtime'];

    $sql = "INSERT INTO tbl_visitor (issue_date, name, mobile, address, floor_id, unit_id, intime, outtime)
            VALUES ('$issue_date', '$name', '$mobile', '$address', '$floor_id', '$unit_id', '$intime', '$outtime')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Visitor added successfully!'); window.location.href='add_visitor.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
