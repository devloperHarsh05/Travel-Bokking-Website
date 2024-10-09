<?php
session_start();
    include("connection.php");
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
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Admin Dashboard</title>
    <style>
        /* Simple CSS for layout */
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
    <!-- Sidebar -->
    <div class="sidebar">
        <h4><?php echo $_SESSION['usernameadmin']; ?></h4>
        <small>admin</small>
        <a href="admin.php">Dashboard</a>
        <a href="manageuser.php">Manage Users</a>
        <a href="packages.php">Manage Packages</a>
        <a href="managebooking.php">Manage Bookings</a>
        <a href="logout.php" id="alog">Logout<span class="material-symbols-outlined">logout</span></a>
    </div>

    <?php
        //user records 
        $user='select * from registration';
        $uq=mysqli_query($cn,$user);
        $cu=mysqli_num_rows($uq);
        //package record
        $package="select * from packages";
        $pq=mysqli_query($cn,$package);
        $cp=mysqli_num_rows($pq);
        //booking record
        $booked="select * from bookings";
        $bq=mysqli_query($cn,$booked);
        $cb=mysqli_num_rows($bq);
         //booking status pending
         $bookedsp="select * from bookings where booking_status='pending'";
         $bqsp=mysqli_query($cn,$bookedsp);
         $sp=mysqli_num_rows($bqsp);
          //booking Confirm
        $bookedsc="select * from bookings where booking_status='confirmed'";
        $bqsc=mysqli_query($cn,$bookedsc);
        $sc=mysqli_num_rows($bqsc);
         //booking status canceled
         $bookedscan="select * from bookings where booking_status='canceled'";
         $bqscan=mysqli_query($cn,$bookedscan);
         $scan=mysqli_num_rows($bqscan);
    ?>
    <div class="content">
        <h2>Admin Dashboard</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-dark text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?php echo $cu;?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light text-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Packages</h5>
                        <p class="card-text"><?php echo $cp;?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Bookings</h5>
                        <p class="card-text"><?php echo $cb;?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pending Bookings</h5>
                        <p class="card-text"><?php echo $sp;?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Canceled Bookings</h5>
                        <p class="card-text"><?php echo $scan;?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Confirmed Bookings</h5>
                        <p class="card-text"><?php echo $sc;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>