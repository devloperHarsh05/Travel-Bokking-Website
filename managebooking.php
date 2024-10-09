<?php
include("connection.php");
include("header.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

    <title>Booking Management</title>
</head>

<body>
    <div class="content">
    <div class="container">
        <h2>Booking Management</h2>

        <h4>View Bookings</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Tour Name</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Booking Date</th>
                    <th>Booking Status</th>
                    <th>TOTAL PAYMENTS</th>
                    <th>MEMBERS</th>
                    <th colspan="2">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $query = "select b.bid,p.package_name,r.name,r.phone,b.booking_dateandtime,b.total_payment,b.members,b.booking_status from bookings b ,packages p ,registration r where b.pid=p.pid and b.cid=r.rid";
                $exe = mysqli_query($cn, $query);

                while ($row = mysqli_fetch_assoc($exe)) {
                    echo "<tr>
            <td>" . $row["bid"] . "</td>
            <td>" . $row["package_name"] . "</td>
            <td>" . $row["name"] . "</td>
            <td>" . $row["phone"] . "</td>
            <td>" . $row["booking_dateandtime"] . "</td>
            <td>" . $row["booking_status"] . "</td>
            <td>" . $row["total_payment"] . "</td>
            <td>" . $row["members"] . "</td>
             <td><a href='editbooking.php?id=$row[bid]&pname=$row[package_name]&cname=$row[name]&ccont=$row[phone]&bdate=$row[booking_dateandtime]&bstat=$row[booking_status]'><span class='material-symbols-outlined'>edit_square</span></a></td>
            <td><a href='#' onclick='confirmdelete(\"deletebooking.php?id=".$row["bid"] ."\")' ><span class='material-symbols-outlined'>delete</span></a></td>
                </tr>";
                }
                ?>
                
            
            </tbody>
        </table>
    </div>
    </div>         
</body>
<script>
        function confirmdelete(url){
            if(confirm("Are you sure you want to delete the record?")){
                window.location.href=url;
            }
        }
    </script>
</html>