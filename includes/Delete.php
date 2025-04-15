<?php 
include '../config/db.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    die("Error: No student ID provided.");
}

$std_id = mysqli_real_escape_string($conn, $_GET['id']);

if (!is_numeric($std_id)) {
    die("Error: Invalid student ID format.");
}

$check_sql = "SELECT id FROM users WHERE id = $std_id";
$check_result = mysqli_query($conn, $check_sql);

if (!$check_result || mysqli_num_rows($check_result) == 0) {
    die("Error: Student with ID $std_id not found.");
}

$sql_del = "DELETE FROM users WHERE id = $std_id";
$result = mysqli_query($conn, $sql_del);

if ($result) {
    header('Location: ReadData.php?delete=success');
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
    echo "<br><br><a href='ReadData.php' class='btn btn-primary'>Back to List</a>";
}
?>