<?php
    session_start();
    if(!isset($_SESSION["usernameadmin"]) && $_SESSION["username"]==false){
        echo "<script>alert('First Login After You can visit the page!');window.location.href='login.php';</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            padding: 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .navbar {
            margin-left: 250px;
            padding: 15px;
        }
        .sidebar h4 {
            font-size: 18px;
            color: #333;
            margin: 0;
            padding: 10px;
            background-color: #e0e0e0;
            border-radius: 5px;
            text-align: center;
            text-transform: uppercase;
        }

        .sidebar small {
            display: block;
            font-size: 14px;
            color: lightgrey;
            text-align: center;
            margin: 0;
        }
    </style>
</head>
<body>
<div class="sidebar">
        <h4><?php echo $_SESSION['usernameadmin']; ?></h4>
        <small>admin</small>
        <a href="admin.php">Dashboard</a>
        <a href="manageuser.php">Manage Users</a>
        <a href="packages.php">Manage Packages</a>
        <a href="managebooking.php">Manage Bookings</a>
        <a href="logout.php">Logout<span class="material-symbols-outlined">logout</span></a>
    </div>
</body>
</html>