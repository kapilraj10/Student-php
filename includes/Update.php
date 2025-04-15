<?php 
include '../config/db.php';

$message = '';
$messageType = '';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid or missing student ID.");
}

$std_id = mysqli_real_escape_string($conn, $_GET['id']);

$sql_id = "SELECT * FROM users WHERE id = $std_id";
$result_id = mysqli_query($conn, $sql_id);

if (!$result_id || mysqli_num_rows($result_id) == 0) {
    die("Student not found.");
}

$data = mysqli_fetch_assoc($result_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['fname']);
    $email = mysqli_real_escape_string($conn, $_POST['mail']);
    $phone = mysqli_real_escape_string($conn, $_POST['contact']);

    $sql_update = "UPDATE users SET fullname='$name', email='$email', phone='$phone' WHERE id=$std_id";
    
    if (mysqli_query($conn, $sql_update)) {
        $message = "Student updated successfully!";
        $messageType = "success";
        header("Refresh: 2; URL=ReadData.php");
    } else {
        $message = "Error updating record: " . mysqli_error($conn);
        $messageType = "danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
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
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">Update Student</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name:</label>
                        <input type="text" name="fname" id="name" class="form-control" 
                               value="<?php echo htmlspecialchars($data['fullname'] ?? $data['name'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="mail" id="email" class="form-control" 
                               value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone:</label>
                        <input type="text" name="contact" id="phone" class="form-control" 
                               value="<?php echo htmlspecialchars($data['phone'] ?? ''); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update Student</button>
                    <a href="ReadData.php" class="btn btn-secondary"> Back</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>