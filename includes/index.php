<?php 
    include '../config/db.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            display: inline-block;
        }
        a {
            text-decoration: none;
            color: #fff;
            background: #007BFF;
            padding: 10px 20px;
            margin: 10px;
            display: inline-block;
            border-radius: 4px;
        }
        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Student Management System</h1>
        <p>Use the links below to manage student records:</p>
        <a href="Add.php"> Add Student</a>
        <a href="ReadData.php"> View All Students</a>
    </div>
</body>
</html>
