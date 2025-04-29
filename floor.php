<?php  
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floor List</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container my-5">
       
        <div class="table-responsive">
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <!-- <th>Id</th> -->
                        <th>Floor No</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql = "SELECT * FROM floorList"; 
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            // $totalRows = mysqli_num_rows($result);
                            // echo "<p>Total Rows: $totalRows</p>";
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $row['id'];
                                $floor = $row['floorL'];
                                echo "<tr>
                                     <td>$floor</td>
                                    <td>
                                        <a class='btn btn-warning' href='floorEdit.php?id=$id' title='Edit'>
                                            <i class='fa fa-pencil'></i>
                                        </a>
                                        <a class='btn btn-danger' href='delete.php?deleteid=$id' title='Delete'>
                                            <i class='fa fa-trash' aria-hidden='true'></i>
                                        </a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No data available</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>
