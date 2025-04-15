<?php 
    include '../config/db.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Student Details</h3>
                <a href="Add.php" class="btn btn-success btn-sm">➕ Add Student</a>
            </div>
            <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
            <div class="card-body">
            <?php 
    if (!$conn) {
        echo '<div class="alert alert-danger">Database connection failed: ' . mysqli_connect_error() . '</div>';
    } else {
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$data['id']}</td>
                            <td>{$data['fullname']}</td>
                            <td>{$data['email']}</td>
                            <td>{$data['phone']}</td>
                            <td>
                                <a href='Update.php?id={$data['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='Delete.php?id={$data['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Delete This Student?\")'>Delete</a>
                            </td>
                        </tr>";
                }
            } else {
                echo '<tr><td colspan="5"><div class="alert alert-info">No student records found.</div></td></tr>';
            }
        } else {
           
            echo '<tr><td colspan="5"><div class="alert alert-danger">Query failed: ' . mysqli_error($conn) . '</div></td></tr>';
        }
    }
?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
