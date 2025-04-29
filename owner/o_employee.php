<?php
session_start();
include '../db.php';




// Handle Add Employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_employee'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $salary = $_POST['salary'];
    $joining_date = $_POST['joining_date'];

    
    $stmt = $conn->prepare("INSERT INTO employees (name, email, password, phone, role, salary, joining_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssds", $name, $email, $password, $phone, $role, $salary, $joining_date);
    $stmt->execute();
    $stmt->close();
}

//update Salary
if($_SERVER["REQUEST_METHOD"] == "POST"  &&  isset($_POST['update_salary'])){
    $id = $_POST['id'];
    $salary = $_POST['salary'];
    $stmt = $conn->prepare("UPDATE employees SET salary = ? WHERE id = ?");
    $stmt->bind_param("di", $salary, $id);
    $stmt->execute();
    $stmt->close();
}

// Handle Delete Employee
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch employees
$result = $conn->query("SELECT * FROM employees ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="cssMinipro.css"> -->
</head>

<body>



    <?php
    // include '../layouts/a_header.php';
    ?>
    <div class="container py-5">
        <!-- Employee List Table -->
        <h3>Employee List</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>password</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Salary</th>
                    <th>Joining Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = 1;
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $id ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['password']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['role']) ?></td>
                        <td><?= htmlspecialchars($row['salary']) ?></td>
                        <td><?= htmlspecialchars($row['joining_date']) ?></td>
                        <td>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            <button class="btn btn-primary btn-sm mt-1" data-bs-toggle="modal" data-bs-target="#salaryModal<?= $row['id'] ?>">Update</button>

                            <!-- <a href="?edit=<?= $row['id'] ?>" class="btn btn-success btn-sm mt-3">Update</a> -->
                        </td>
                    </tr>

                    <div class="modal fade" id="salaryModal<?= $row['id'] ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="manage_employee.php">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Salary - <?= $row['name'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label>New Salary:</label>
                                        <input type="number" name="salary" class="form-control" value="<?= $row['salary'] ?>" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="update_salary" class="btn btn-success">Save</button>
                                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php $id++ ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>