<?php 
    include("connection.php");
    include("header.php");
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <title>Edit Booking</title>
</head>
<body>
    <div class="content">
    <div class="container-fluid">
        <h3>Booking Update</h3>
        <a href="managebooking.php" title="Return To The Booking"><span class="material-symbols-outlined">arrow_back</span></a>

        <form method="post">
            <div class="row">
                <!-- <div class="col-md-6">
                <label for="pn" class="control-label">Package Name:</label>
                <input type="text"  class="form-control" id="pn" name="packname" value="</?php echo $_GET['pname']?>">
                </div> -->
                <div class="col-md-6">
                <label for="pc" class="control-label">Booking Status:</label>
                <select name="bookingstatus" id="pc" class="form-select" >
                    <option value="confirmed" <?php echo (isset($_GET['bstat']) && $_GET['bstat'] == 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                    <option value="pending" <?php echo (isset($_GET['bstat']) && $_GET['bstat'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="canceled"  <?php echo (isset($_GET['bstat']) && $_GET['bstat'] == 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                </select>
                
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                <label for="pl" class="control-label">Booking Date:</label>
                <input type="date"  class="form-control" id="bd" name="bookingdate"  value="<?php echo isset($_GET['bdate']) ? date('Y-m-d', strtotime($_GET['bdate'])) : ''; ?>">
                </div>
            
<!--             
                <div class="col-md-6">
                <label for="pp" class="control-label">Customer Contact:</label>
                <input type="number"  class="form-control" id="pp" name="ccont" value="</?php echo $_GET['ccont']?>">
                </div> -->
            </div>
            
            <button type="submit" value="submit" name="submit" id="btnedit"class="btn btn-primary ">UPDATE</button>
            <button type="reset" value="reset" name="reset"class="btn btn-secondary ">RESET</button>
        </form>
    </div>
    </div>
</body>
</html>
<?php 

    
    if(isset($_POST['submit'])){
        // $pn=$_POST['packname'];
        $bs=$_POST['bookingstatus'];
        $bd=$_POST['bookingdate']??'';
        // $cc=$_POST['ccont'];
        // $pd=$_POST['packdetail'];
        $iq="update bookings set booking_dateandtime='$bd',booking_status='$bs' where bid=".$_GET['id'];
        $up=mysqli_query($cn,$iq);
        if(!$up){
            echo '<script> alert("Update unsuccessfull")</script>';
            exit;
        }
        else{
            echo '<script> alert("Update successfull")</script>';
        }
    }
?>
