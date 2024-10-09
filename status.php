<?php
session_start();
include("connection.php");
//get userid
$uname = $_SESSION['username'];
$getun = "select rid from registration where name='$uname'";
$getcid = mysqli_query($cn, $getun);
$fetchid = mysqli_fetch_assoc($getcid);
$cid = $fetchid['rid'];
//get all booking data according to the user that loggedin
//get package names according to bookes
$querygetpbdetali = "select b.bid,b.booking_status,b.tour_start,b.tour_end,b.members,b.total_payment,p.package_name,p.package_detail,p.package_loc,p.package_price from packages p,bookings b where b.pid=p.pid and b.cid='$cid'";
$getpackandbook = mysqli_query($cn, $querygetpbdetali);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm and Pay</title>
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <script src="bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqk1w20JHDn/a4M.." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="status.css">
</head>

<body>
    <?php if(mysqli_num_rows($getpackandbook)>0) {?>
    <?php while($rowbp=mysqli_fetch_assoc($getpackandbook)) {?>
    <div class="buy-detail container mt-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="back d-flex">
                    <button><a href="home-1.php"><ion-icon class="icon-back" name="chevron-back-outline"></ion-icon></a></button>
                <div class="title">
                <h2>Booking Checking</h2>
                </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        
                            <h2 class="card-title" style="text-transform:uppercase;"><?php echo $rowbp['package_name'] ?></h2>
                        
                        <div class="form-group">
                            <label for="dates">Dates</label>
                            <div class="d-flex justify-content-between">
                                <span><?php echo $rowbp['tour_start'].' To '.$rowbp['tour_end'];
                                 $sd = new DateTime($rowbp['tour_start']);
                                 $ed = new DateTime($rowbp['tour_end']);
                                 $daysbet = $sd->diff($ed);
                                 $diffdays = $daysbet->days;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="guests">Memebers</label>
                            <div class="d-flex justify-content-between">
                                <span><?php echo $rowbp['members'];?> Members</span>
                            </div>
                        </div>
                        <hr>
                        <h5 class="card-title mt-3">Booking Status</h5>
                        <div class="form-number">
                            <div class="form-floating">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Bookind Id:<span
                                            class="float-right"><?php echo $rowbp['bid'];?></span></li>
                                    <li class="list-group-item">Payment Type:<a href="#">(INR)</a> <span
                                            class="float-right">Gpay</span></li>
                                    <li class="list-group-item">Status:<span
                                            class="float-right"><?php echo $rowbp['booking_status'];?></span></li>
                                </ul>
                            </div>
                        </div>
                        <p class="text-muted">We'll call or text you to confirm your number. Standard message and data
                            rates apply. <a href="#">Privacy Policy</a></p>
                        <button class="btn-submit" id="continueButton" onclick="return back()">Back</button>
                        <!-- <form method="post">
                        <button class="btn-submit" id="continueButton" name="cancel" type="button">cancel</button>
                        </form> -->
                        <script>
                            function back(){
                                return window.location.href="home-1.php";
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="card-buy col-lg-6">
                <div class="card">
                    <div class="card-buy-title d-flex justify-content-between">
                        <div class="col-lg-5">
                            <img src="image/1.jpg" class="img-fluid" alt="Property Image">
                        </div>
                         
                        
                            <div class="col-lg-7">
                                <h2 style="text-transform:uppercase;"><span><?php echo $rowbp['package_loc'];?></span></h2>
                                
                            </div>
                        <?php ?>
                    </div>
                </div>
                <hr>
                <div class="card mt-3">
                    <div class="card-buy-price">
                        <h5 class="card-title">Price details</h5>
                        <ul class="list-group list-group-flush">
                            <?php //calculating the price for different members and nights 
                            $packprice = $rowbp['package_price'];
                            $cal_alldays = ($packprice * $diffdays / 5) * $rowbp['members'];
                            $pack_price_eachday = $cal_alldays / $diffdays;
                            $packprice = $cal_alldays;
                            $gst = $cal_alldays * 5 / 100;
                            $total = $gst + $cal_alldays;?>
                            <li class="list-group-item">₹<?php echo number_format($rowbp['package_price'],2);?> x <?php echo $diffdays;?> nights <a href="buy.php">Edit</a> <span
                                    class="float-right">₹<?php echo number_format($cal_alldays,2);?>\-</span></li>
                            <li class="list-group-item">Taxes <span class="float-right">₹<?php echo number_format($gst,2);?>\-</span></li>
                            <li class="list-group-item">Total <a href="#">(INR)</a> <span
                                    class="float-right">₹<?php echo number_format($rowbp['total_payment'],2);?>\-</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <?php } }else{
        echo "<h3>You have't book anything yet, please book the tour package now.<h3>";
    }?>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- only for icon -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>
