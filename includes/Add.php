<?php 
include '../config/db.php';

$message = '';
$messageType = '';

if (!$conn) {
    $message = "Database connection failed: " . mysqli_connect_error();
    $messageType = "danger";
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['fname']);
    $email = mysqli_real_escape_string($conn, $_POST['mail']);
    $phone = mysqli_real_escape_string($conn, $_POST['contact']);


    $sql = "INSERT INTO users(fullname, email, phone) VALUES('$name', '$email', '$phone')";
    
    if (mysqli_query($conn, $sql)) {
        $message = "Student added successfully!";
        $messageType = "success";
        
        header("Refresh: 2; URL=ReadData.php");
    } else {
        $message = "Error: " . mysqli_error($conn);
        $messageType = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Add New Student</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="fname" class="form-control" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="mail" class="form-control" id="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="contact" class="form-control" id="phone" required>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="ReadData.php" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>