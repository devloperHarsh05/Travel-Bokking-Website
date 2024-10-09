<?php
session_start();
include("connection.php");
$cal_alldays = 0;
$membercounts = 1;
$gst = 0;
$total = 0;
$today = date('Y-m-d');

$fromd = $_POST['fromdate'] ?? '';

$tod = $_POST['todate'] ?? '';
$membercounts = $_POST['membercount'] ?? '1';
if(isset($_POST['fromdate'])&&!empty($_POST['fromdate'])){
    $todatemin = date('Y-m-d', strtotime($fromd . ' +1 day'));;
}
else {
    $toddatemin = date('Y-m-d', strtotime($today . ' +1 day'));
}
if(isset($_POST['fromdate'])&&isset($fromd)){
    $todatemin = date('Y-m-d', strtotime($fromd . ' +1 day'));;
}



if (isset($_POST['count'])) {
    if (!empty($fromd) && !empty($tod)) {
        $sd = new DateTime($fromd);
        $ed = new DateTime($tod);
        $daysbet = $sd->diff($ed);
        $diffdays = $daysbet->days;


        if ($diffdays < 1) {
            $diffdays = 5;
        }

        $packprice = $_GET['pprice'];
        $cal_alldays = ($packprice * $diffdays / 5) * $membercounts;
        $pack_price_eachday = $cal_alldays / $diffdays;
        $packprice = $cal_alldays;
        $gst = $cal_alldays * 18 / 100;
        $total = $gst + $cal_alldays;
    } else {
        echo "Please select valid dates.";
    }

}
$querygetid="select pid from packages where pid=".$_GET['pacid']??'';
$exe2=mysqli_query($cn,$querygetid);
$fetpid=mysqli_fetch_assoc($exe2);

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
    <script src="jquery.js"></script>
    <link rel="stylesheet" href="buy.css">
</head>

<body>
    <header>
        <div class="logo container">
            <h3 class="h3"><a href="home.php" style="text-decoration:none; color:  #ff5361;">Wonder World</a></h3>
        </div>
    </header>
    <div class="buy-detail container mt-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="back d-flex">
                    <button><a href="homede.php?idfrombuy=<?php echo $fetpid['pid'];?>"><ion-icon class="icon-back"
                                name="chevron-back-outline"></ion-icon></a></button>
                    <div class="title">
                        <h2>Confirm and pay</h2>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h2 class="card-title">Your trip</h2>
                        <div class="form-group">
                            <form method="post">
                                <label for="dates">Dates</label>
                                <div class="d-flex justify-content-between">

                                    <span>From <input type="date" name="fromdate" id="fd" min="<?php echo $today; ?>"
                                            value="<?php echo htmlspecialchars($fromd); ?>">
                                        To <input type="date" name="todate" id="td"  min="<?php echo $todatemin; ?>"
                                            value="<?php echo htmlspecialchars($tod); ?>"></span>
                                    <!-- <button class="btn btn-link" id="editDates" name="editdates">Edit</button> -->

                                </div>
                        </div>
                        <div class="form-group">
                            <label for="guests">Memebers</label>
                            <div class="d-flex justify-content-between">

                                <span><input type="number" min="1" step="1" name="membercount" id="memberc"
                                        value="<?php echo htmlspecialchars($membercounts); ?>"></span>
                                <!-- <button class="btn btn-link" id="editGuests" name="editmember">Edit</button> -->

                            </div>

                            <button type="submit" value="count" name="count" class="btn-submit">Count</button>
                            </form>
                        </div>
                        <hr>
                        <!-- <h5 class="card-title mt-3">Log in or sign up to book</h5> -->

                        <div class="form-number">
                            <div class="form-floating">
                                <label for="countryRegion">Country/Region</label>
                                <select class="form-control" id="countryRegion">
                                    <option value="India (+91)">India (+91)</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <form method="post" id="bookingpack">
                                <div class="form-floating">
                                    <label for="number">Moblie number:</label>
                                    <input type="tel" id="number" class="form-control" placeholder="Enter number">
                                </div>
                                
                        </div>
                        <p class="text-muted">We'll call or text you to confirm your number. Standard message and data
                            rates apply. <a href="#">Privacy Policy</a></p>

                        <input type="hidden" name="fromdate" value="<?php echo htmlspecialchars($fromd); ?>">
                        <input type="hidden" name="todate" value="<?php echo htmlspecialchars($tod); ?>">
                        <input type="hidden" name="membercount" value="<?php echo htmlspecialchars($membercounts); ?>">
                        <input type="hidden" name="total" value="<?php echo htmlspecialchars($total); ?>">
                        <button class="btn-submit" id="continuebutton" value="submit" name="submit">Continue</button>
                        </form>
                        <script>
                                    $(document).ready(
                                        function () {
                                            $("#continuebutton").click(
                                                function (event) {

                                                    $(".text-danger").remove();
                                                    $("input, textarea").css({ "border-color": "", "border-width": "", "border-style": "" });

                                                    let isValid = true;
                                                    let phono=$("#number").val();
                                                    if ($("#number").val() === '') {
                                                        $("#number").css({ "border-color": "red", "border-width": "3px", "border-style": "double" });
                                                        $("#number").after("<small class='text text-danger'>Phone number is required.</small>");
                                                        isValid = false;
                                                    }
                                                    else if(phono.length!=10){
                                                        $("#number").css({ "border-color": "red", "border-width": "3px", "border-style": "double" });
                                                        $("#number").after("<small class='text text-danger'>Phone number's length should be 10.</small>");
                                                        isValid = false;
                                                    }
                                                    else {
                                                        $("#number").css({ "border-color": "", "border-width": "", "border-style": "" });
                                                    }
                                                    $("input, textarea, select").on('input change', function () {
                                                        $(this).css({ "border-color": "", "border-width": "", "border-style": "" });
                                                        $(this).siblings(".text-danger").remove();
                                                    });

                                                    if (!isValid) {
                                                        event.preventDefault();
                                                        console.log("Form submission prevented due to validation errors.");
                                                    } else {
                                                        console.log("Form is valid and will be submitted.");
                                                    }
                                                });
                                        });
                                </script>
                        <script>
                            document.getElementById('bookingpack').onsubmit = function () {
                                return confirm("Are you sure you want to book this package?");
                            };
                        </script>
                        <p class="text-center mt-3">or</p>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button class="btn btn-outline-secondary btn-block" id="googleButton"><img
                                        src="social/google.png" width="18px"></button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-outline-secondary btn-block" id="appleButton"><img
                                        src="social/social.png" width="18px"></button>
                            </div>
                        </div>
                        <button class="btn btn-outline-secondary btn-block mt-3" id="emailButton"><img
                                src="social/mail.png" width="18px"><span>Continue with email</span> </button>
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
                            <span class="span-1"><?php echo ucwords(strtolower($_GET['ploc'])); ?> </span>
                            <p class="card-text">Entire villa</p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card mt-3">
                    <div class="card-buy-price">
                        <h5 class="card-title">Price details</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">₹<?php echo number_format($_GET['pprice'], 2); ?> x
                                <?php echo !empty($diffdays) ? $diffdays : '5' ?> nights
                                <?php echo "(" . (!empty($membercounts) ? $membercounts : '1') . " member" . ")";
                                echo "<br>"; ?>
                                <?php echo "(" . $fromd . " To " . $tod . ")"; ?>
                                <span class="float-right">₹<?php echo number_format($cal_alldays, 2); ?>\-</span>

                            </li>
                            <li class="list-group-item">Taxes <span class="float-right">₹<?php
                            echo number_format($gst, 2) ?>\-</span>
                            </li>
                            <li class="list-group-item">Total <u>(INR)</u> <span class="float-right">₹<?php
                            echo number_format($total, 2, ) ?>\-</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="container col-lg-12 d-flex justify-content-between">
        <p>© 2024 Wonder World, Inc. <a href="#">Privacy</a> <a href="#">Terms</a> <a href="#">Sitemap</a> <a
                href="#">Company details</a></p>
        <p>
            <a href="#" class="text-muted"><i class="fas fa-globe"></i> English (IN)</a>
            <a href="#" class="text-muted"><i class="fas fa-rupee-sign"></i> INR</a>
            <a href="#" class="text-muted"><img src="social/facebook.png" width="18px"></a>
            <a href="#" class="text-muted"><img src="social/instagram.png" width="18px"></a>
            <a href="#" class="text-muted"><img src="social/linkedin.png" width="18px"></a>
        </p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- only for icon -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $pid = $_GET['pacid'];
    // $pname=$_GET['pname'];
    $curr_time = date('Y-m-d H:i:s');
    $un = $_SESSION["username"];
    $getcid = "select rid from registration where name='$un'";
    $result = mysqli_query($cn, $getcid);
    $row = mysqli_fetch_assoc($result);
    $cid = $row['rid'];
    $fromd = $_POST['fromdate'];
    $tod = $_POST['todate'];
    $membercounts = $_POST['membercount'];
    $total = $_POST['total'];
    var_dump($fromd);
    var_dump($tod);
    var_dump($membercounts);
    var_dump($total);
    if (!empty($fromd) && !empty($tod) && !empty($membercounts)) {
        $bookquery = "insert into bookings (pid, cid, booking_dateandtime, booking_status,tour_start,tour_end,members,total_payment) values ('$pid', '$cid', '$curr_time', default,'$fromd','$tod','$membercounts',$total)";
        $bqe = mysqli_query($cn, $bookquery);
        if (!$bqe) {
            echo "<script>alert('Something went wrong ,Try Again!');window.location.href='homede.php';</script>";
            exit();
        } else {
            echo "<script>alert('Your booking has been successfully completed! We will notify you about the status shortly.You can check you status in tour status page!')</script>";
        }
    } else {
        echo "<script>alert('please select date and member')</script>";
    }
}

?>