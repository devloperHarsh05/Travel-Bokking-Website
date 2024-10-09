<?php
    include("connection.php");
    $deleteBookings = "delete from bookings WHERE pid =".$_GET['id'];
    mysqli_query($cn, $deleteBookings);
    $query="delete from packages where pid=".$_GET['id'];
    if(mysqli_query($cn,$query)){
        header("location:packages.php");
        exit;
    }
    else{
        echo"error";
    }
    
?>