<?php
    include("connection.php");
    $deleteBookings = "delete from bookings WHERE cid =".$_GET['id'];
    mysqli_query($cn, $deleteBookings);
    $query="delete from registration where rid=".$_GET['id'];
    if(mysqli_query($cn,$query)){
        header("location:manageuser.php");
        exit;
    }
    else{
        echo"error";
    }
?>