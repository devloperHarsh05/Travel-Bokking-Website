<?php
    include("connection.php");
    $query="delete from bookings where bid=".$_GET['id'];
    if(mysqli_query($cn,$query)){
        header("location:managebooking.php");
        exit;
    }
    else{
        echo"error";
    }
?>