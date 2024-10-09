<?php
session_start();
include("connection.php");
$query = "select * from packages";
$exe = mysqli_query($cn, $query);
if (isset($_GET['idfrombuy'])) {
  $allpackdata = "select * from packages where pid=" . $_GET['idfrombuy'] ?? '';
  $exeapd = mysqli_query($cn, $allpackdata);
  $getpackdata = mysqli_fetch_assoc($exeapd);
}
if(isset($_GET['idfrombuy'])||isset($_GET['id']))
$id=isset($_GET['id'])?$_GET['id']:$_GET['idfrombuy'];
$image="select package_img from packages where pid='$id'";
$exeimg=mysqli_query($cn,$image);
$getimg=mysqli_fetch_assoc($exeimg);
// print_r($getimg);
// exit();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
  <script src="bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
  <!-- <script src="bootstrap/bootstrap.min.js"></script> -->
  <link rel="stylesheet" href="homede.css">
  <link rel="stylesheet" href="header.css">
  <link rel="stylesheet" href="footer.css">
  <title>package book</title>
</head>

<body>
  <!-- header -->
  <header class="container d-flex align-items-center ">
    <div class="logo d-flex align-items-center">
      <a href="home-1.php" style="text-decoration:none">
        <h5 class="h5">Wonder World</h5>
      </a>

    </div>
    <div class="user d-flex justify-content-end ">
      <ul class="unstyled list-inline clearfix left-nav">
        <li class="list-inline-item "><a href="home.php"><ion-icon class="icon" name="home-outline"></ion-icon></a></li>
        <li class="list-inline-item"><a href="#"><ion-icon class="icon" name="globe-outline"></ion-icon></a> </li>
      </ul>
      <div class="dropdown d-flex align-items-center justify-content-center">
        <button class="btn dropdown-toggle d-flex align-items-center " type="button" id="dropdownMenu"
          data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
          <div class="user-button" me-3>
            <span></span>
            <span></span>
            <span></span>
          </div>
          <ion-icon class="icon-user" name="person-outline"></ion-icon> </a>
        </button>
        <?php
        
        ?>

        <!-- dropdown menu -->
        <ul class="dropdown-menu" id="dropdown-menu">
          <?php if (!isset($_SESSION['username']) || $_SESSION['loggedin'] == false) {
            $un=$_SESSION['username'];
            echo '<li><h3><a class="dropdown-item" href="#">'.$un.'</a></h3></li>';
            echo '<li><a class="dropdown-item" href="login.php">Login</a></li';
            echo '<li><a class="dropdown-item" href="registration.php">Registrtion</a></li>';
          } ?>
          <li>
            <hr class="dropdown-divider">
          </li>
          <?php 
            $un=$_SESSION['username'];
            echo '<li><a class="dropdown-item" href="#">'.$un.'</a></li>';
          ?>
          <li><a class="dropdown-item" href="about.php">About Us</a></li>
          <li><a class="dropdown-item" href="co.php">Contect Us</a></li>
          <?php
          if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true) {
            echo '<li><a class="dropdown-item" href="status.php">My Bookings</a></li>';
            
            echo '<li><a class="dropdown-item" href="logout.php">Logout</a></li>';
          }
          ?>
        </ul>
      </div>

    </div>
  </header>
  <script>
    const userDropdown = document.getElementById('dropdownMenu');
    const userMenu = document.getElementById('dropdown-menu');

    userDropdown.addEventListener('click', () => {
      userMenu.classList.toggle('show');
    });
  </script>
  <div class="house-details container">
    <div class="house-title col-lg-12">
      <h2><?php echo isset($_GET['pname']) ? strtoupper($_GET['pname']) : strtoupper($getpackdata['package_name']); ?>
      </h2>
      <div class="row col-lg-11">
        <div class="review">
          <img src="i-con/star-solid.svg" width="18px">
          <img src="i-con/star-solid.svg" width="18px">
          <img src="i-con/star-solid.svg" width="18px">
          <img src="i-con/star-half-stroke-solid.svg" width="18px">
          <img src="i-con/star-regular.svg" width="18px">
          <span>245 Review's</span>
          <p>
            Location:<?php echo isset($_GET['ploc']) ? ucwords(strtolower($_GET['ploc'])) : ucwords(strtolower($getpackdata['package_loc'])); ?>
          </p>
          <!-- <p>Location:</?php echo ucwords(strtolower($ploc)); ?></p> -->
        </div>
      </div>
    </div>
    <div class="gallery  col-lg-12 col-sm-12">
      <div class="row">
      <?php if(isset($getimg["package_img"])): ?>
        <?php $images = json_decode($getimg["package_img"] ) ; ?>
        <!-- </?php foreach($images as $image): ?> -->
        
          <div class="col-lg-6 col-sm-12 col-12 image-one">
          
        
        <a href="" class="gallery-img">
        <?php if(count($images) > 0): ?>
        <img src="uploads/<?php echo $images[0]; ?>"  width="547px" height="auto" > <!-- First image -->
        <?php endif; ?>
        </a> 
        
        
          </div>
          <!-- <a href="" class="gallery-img">
            <img src="" width="547px">
          </a> -->
        
        <div class="col-lg-6 ">
          <div class="row">
              
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                
              <a href="" class="gallery-img">
              <?php if(count($images) > 1): ?>
                <!-- <img src="image/2.jpg" width="265px" height="auto"> -->
                <img src="uploads/<?php echo isset($image[1])?$images[1]:'image is loading..'; ?>"  width="265px" height="auto" > <!-- First image -->
                <?php endif; ?>
                </a>
                
              </div>
                
              
            <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-6">
              <a href="" class="gallery-img-2">
                <img src="image/3.jpg" width="265px" height="auto">
              </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
              <a href="" class="gallery-img">
                <img src="image/4.jpg" width="265px" height="auto">
              </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
              <a href="" class="gallery-img-4">
                <img src="image/5.jpeg" width="265px" height="auto">
              </a>
            </div> -->
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
            
              <a href="" class="gallery-img-2">
              <?php if(count($images) > 2): ?>
                <!-- <img src="image/2.jpg" width="265px" height="auto"> -->
                <img src="uploads/<?php echo $images[2]; ?>"  width="265px" height="auto" > <!-- First image -->
                <?php endif; ?>
                </a>
                
              </div>
                

                <?php if(count($images) > 3): ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
              <a href="" class="gallery-img">
                <!-- <img src="image/2.jpg" width="265px" height="auto"> -->
                <img src="uploads/<?php echo $images[3]; ?>" width="265px" height="auto" > <!-- First image -->
                </a></div>
                <?php endif; ?>

                <?php if(count($images) > 4): ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
              <a href="" class="gallery-img-4">
                <!-- <img src="image/2.jpg" width="265px" height="auto"> -->
                <img src="uploads/<?php echo $images[4]; ?>" width="265px" height="auto" > <!-- First image -->
                </a></div>
                <?php endif; ?>

          </div>
        </div>
        <!-- </?php endforeach; ?> -->
        <?php endif; ?>
      </div>
    </div>
    <div class="small-details col-md-12">
      <h3><?php echo isset($_GET['ploc']) ? ucwords($_GET['ploc']) : ucwords($getpackdata['package_loc']); ?></h3>
      <p>2 guest &nbsp;- 2 beds &nbsp;- 1 bathroom</p>
      <p style="white-space: pre-line;">
        <?php echo isset($_GET['pdetail']) ? nl2br($_GET['pdetail']) : nl2br($getpackdata['package_detail']); ?>
      </p>
      <form method="post" id="bookingForm">
        <?php
        $mainrid = $_SESSION['username'] ?? '';
        $packrnid = isset($_GET['id']) ? $_GET['id'] : $getpackdata['pid'];
        //  $packrnid=$packrnid2;
        if ($mainrid && $packrnid) {
          $query = "select rid from registration where name='$mainrid'";
          $query2 = "select * from packages where pid='$packrnid'";
          $exe = mysqli_query($cn, $query);
          $exe2 = mysqli_query($cn, $query2);
          $row1 = mysqli_fetch_assoc($exe);
          $row2 = mysqli_fetch_assoc($exe2);

          if ($row1 && $row2) {
            $redirectUrl = "buy.php?pacid=" . $row2['pid'] . "&" .
              "pname=" . urlencode($row2['package_name']) . "&" .
              "pcate=" . urlencode($row2['package_cate']) . "&" .
              "ploc=" . urlencode($row2['package_loc']) . "&" .
              "pprice=" . urlencode($row2['package_price']) . "&" .
              "pdetail=" . urlencode($row2['package_detail']) . "&" .
              "rid=" . $row1['rid'];
          }
        }
        ?>

        <!-- <a href="</?php echo $redirectUrl; ?>"> -->
        <h5><button type="submit" name="book"
            onclick="location.href='<?php echo $redirectUrl; ?>';">₹<?php echo isset($_GET['pprice']) ? number_format($_GET["pprice"], 2) : number_format($getpackdata["package_price"], 2); ?>/-</button>
        </h5>
        <!-- </a> -->

      </form>
      <!-- </?php }?> -->
      <script>
        document.getElementById('bookingForm').onsubmit = function (event) {
          var loggedin = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;
          if (!loggedin) {
            alert("First login after you book the package.");
            setTimeout(function () {
              window.location.href = "login.php";
            }, 0);
            event.preventDefault(); 
          } else {
            var confirmbooking = confirm("Are you sure you want to book?");
            if (confirmbooking) {
              event.preventDefault(); 
            }
           
          }
        };
      </script>
    </div>
    <hr class="line">
    <form class="check-form col-md-12">
      <div>
        <label>Check-In</label>
        <input type="text" placeholder="Add Date">
      </div>
      <div>
        <label>Check-Out</label>
        <input type="text" placeholder="Add Date">
      </div>
      <div class="guest-field">
        <label>Guest</label>
        <input type="text" placeholder="2 Guest">
      </div>
      <Button type="button">Check Availbility</Button>
    </form>
    <ul class="details-list col-md-12">
      <li><img src="i-con/house-solid.svg" width="20px">Entire Home</i>
        <span>You will have the Entire flat for you</span>
      </li>
      <li><img src="i-con/paintbrush-solid.svg" width="20px">Enhanced Clean
        <span>This Host has committed to Wonder World's cleaning process.</span>
      </li>
      <li><img src="i-con/map-location-dot-solid.svg" width="20px">Great Location
        <span>90% of recent guests gave the location a 4.5 star rating.</span>
      </li>
      <li><img src="i-con/heart-solid.svg" width="20px">Great Check-in Experience
        <span>100% of recent guests gave the check-in process a 5 star rating. </span>
      </li>
    </ul>
    <hr class="line">
    <p class="pacekege-desc col-md-12">Imagine a sanctuary of peace and serenity away from the hustle and bustle of
      everyday life,
      amidst lush greenery. Turn this vision into a reality at this lovely farm stay in Gujarat's picturesque village of
      Kutch.
      This enormous eco-stay is encircled by 65 acres of endless fields and fruit orchards!
    </p>
    <a href="#">See more</a>
    <hr class="line">
    <div class="map col-md-12">
      <h4>Location on map</h4>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d238242.28836383933!2d72.66775179604!3d21.091196363996804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be0f7904d597ba3%3A0x915102e9a8f9149e!2sChandan%20Van!5e0!3m2!1sen!2sin!4v1724677089648!5m2!1sen!2sin"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
      <b>Chandan Van, Navsari, India</b>
      <p>It's like a home away from home.</p>
    </div>
    <hr class="line">

    <div class="host col-md-12">
      <img src="i-con/user-solid.svg" width="20px" class="host-icon">
      <div>
        <h4>Hosted By Dhruv Patel</h4>
        <p><span>
            <img src="i-con/star-solid.svg" width="20px">
            <img src="i-con/star-solid.svg" width="20px">
            <img src="i-con/star-solid.svg" width="20px">
            <img src="i-con/star-solid.svg" width="20px">
            <img src="i-con/star-half-stroke-solid.svg" width="20px"></span>
          &nbsp;&nbsp;245 Review's&nbsp;&nbsp;Response rate 100%&nbsp;&nbsp;Response Time:&nbsp;90 min</p>
      </div>
    </div>
    <a href="#" class="contact-host">Contact host</a>
  </div>

  <footer class="footer">
    <div class="container-footer col-md-12">

      <div class="row">
        <div class="col-md-3 text-center">
          <h5>Support</h5>
          <br>
          <ul>
            <li><a href="customerservice.html" class="question">Help Centre</a></li>
            <li><a href="customerservice.html">Get help with a safety issue</a></li>
            <li><a href="customerservice.html"">AirCover</a></li>
              <li><a href=" customerservice.html">Anti-discrimination</a></li>
            <li><a href="customerservice.html">Disability support</a></li>
            <li><a href="customerservice.html">Cancellation options</a></li>
            <li><a href="customerservice.html">Report neighbourhood concern</a></li>
          </ul>
        </div>
        <div class="col-md-3 text-center">
          <h5>Hosting</h5>
          <br>
          <ul>
            <li><a href="#">Your home</a></li>
            <li><a href="#"> For Hosts</a></li>
            <li><a href="#">Hosting resources</a></li>
            <li><a href="#">Community forum</a></li>
            <li><a href="#">Hosting responsibly</a></li>
            <li><a href="#">Join a free Hosting class</a></li>
          </ul>
        </div>
        <div class="col-md-3 text-center">
          <h5>Wonder World</h5>
          <br>
          <ul>
            <li><a href="#">Newsroom</a></li>
            <li><a href="#">New features</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Investors</a></li>
            <li><a href="#"></a>ww.org emergency stays</a></li>
          </ul>
        </div>
        <div class="social-links col-md-3">
          <h5>Social Media</h5>
          <br>
          <img src="social/facebook.png" alt=""> <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
          <img src="social/instagram.png" alt=""> <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
          <img src="social/linkedin.png" alt=""> <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
          <img src="social/whatsapp.png" alt=""><a href="#" target="_blank"><i class="fab fa-whatsapp-g"></i></a>
        </div>
      </div>
    </div>

    <!-- only for icon -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>
<!-- </?php
if (isset($_POST['book'])) {
  if (!isset($_SESSION['username']) || $_SESSION['loggedin'] == false) {
    echo "<script>alert('First Login After You can Book the package!');window.location.href='login.php';</script>";
    exit();
  }
}
?> -->