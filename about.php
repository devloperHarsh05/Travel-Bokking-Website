<?php
  session_start();
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>News Room | Wonder World</title>
  <link rel="stylesheet" href="about.css">
</head>

<body>

  <div class="hedaer">
    <!-- header -->
    <header class="container-fluid d-flex align-items-center ">
      <div class="logo d-flex align-items-center">
        <a href="home.php">
          <h5 class="h5">W - News Page</h5>
        </a>
      </div>

      <div class="user d-flex justify-content-end ">
        <ul class="unstyled list-inline clearfix left-nav">
          <li class="list-inline-item "><a href="#"><ion-icon class="icon" name="home-outline"></ion-icon></a></li>
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
            <a href=""> <ion-icon class="icon-user" name="person-outline"></ion-icon></a>
          </button>
          <?php
          if (isset($_SESSION['username']) && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<h4>' . $_SESSION["username"] . '</h4>';
          }
        ?>
          <!-- dropdown menu -->
          <ul class="dropdown-menu" id="dropdown-menu">
            <?php if (!isset($_SESSION['username']) || $_SESSION['loggedin'] == false) {
              echo '<li><a class="dropdown-item" href="login.php">Login</a></li';
              echo '<li><a class="dropdown-item" href="registration.php">Registrtion</a></li>';
            } ?>
            <li>
              <hr class="dropdown-divider">
            </li>
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
  </div>
  <script>
    const userDropdown = document.getElementById('dropdownMenu');
    const userMenu = document.getElementById('dropdown-menu');

    userDropdown.addEventListener('click', () => {
      userMenu.classList.toggle('show');
    });
  </script>

  <div class="content-aboutas container">
    <div class="content-title">
      <h3>About Us</h3>
      <p>Wonder World was born in 2024 when two hosts welcomed three guests to their Surat, and has since grown to over
        5 hosts who have welcomed over 1.5 million guest arrivals in almost every country across the globe. Every day,
        hosts offer unique stays and experiences that make it possible for guests to connect with communities in a more
        authentic way.</p>
    </div>
    <div>
      <h2>Founders</h2>
    </div>
  </div>
  <div class="container">
    <div class="result">
      <div class="row">

        <!-- 1 -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
          <div class="property-icon">
            <div class="property-image">
              <img src="image2/own-2.jpg" alt="" class="im-fluid round" height="auto" width="360px">
            </div>
          </div>
          <a href="homede.html" class="property-details">
            <div class="property-location">
              <a href="#">
                <h5>Koshiya Shubham</h5>
              </a>
            </div>
            <div class="for-awy">
              <h6>Wonder World Co-founder and Chief Executive Officer</h6>
            </div>
          </a>
        </div>

        <!-- 2 -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
          <div class="property-icon">
            <div class="property-image">
              <img src="image2/own-3.jpg" alt="" class="im-fluid round" height="auto" width="360px">
            </div>
          </div>
          <a href="homede.html" class="property-details">
            <div class="property-location">
              <a href="#">
                <h5>Patel Dhruv</h5>
              </a>
            </div>
            <div class="for-awy">
              <h6>Wonder world Co-founder and Chief Executive Officer</h6>
            </div>
          </a>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
          <div class="property-icon">
            <div class="property-image">
              <img src="image2/own-1.jpg" alt="" class="im-fluid round" height="auto" width="360px">
            </div>
          </div>
          <a href="homede.html" class="property-details">
            <div class="property-location">
              <a href="#">
                <h5>Mori Vivek</h5>
              </a>
            </div>
            <div class="for-awy">
              <h6>wonder world Co-founder and Chairman of Wonder World</h6>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="container story">
    <div class="title">
      <h2>The Wonder World Story</h2>
    </div>
  </div>

  <div class="card-container">
    <div class="card">
      <img src="image2/story-1.jpg" alt="" width="400px">
      <div class="card-content">
        <h1>Audust 2024</h1>
        <h6>Radhe and Krishna host airbed & breakfast's Frist Guests</h6>
      </div>
    </div>


    <div class="card">
      <img src="image2/story-2.jpg" alt="" width="400px">
      <div class="card-content">
        <h1>September 2024</h1>
        <h6>Wonder World officially launches in India</h6>
      </div>
    </div>


    <div class="card">
      <img src="image2/story-4.jpg" alt="" width="400px">
      <div class="card-content">
        <h1>September 2024</h1>
        <h6>We Launch our Cleaning Protocol to help hosts <span>and guests book with confidencs during the ant
            time.</span></h6>
      </div>
    </div>
  </div>
  <footer class="container col-lg-12 d-flex justify-content-between">
    <p class="col-lg-6">© 2024 Wonder World, Inc. <a href="#">Privacy</a> <a href="#">Terms</a> <a href="#">Sitemap</a>
      <a href="#">Company details</a></p>
    <p class="col-lg-6">
      <a href="#" class="text-muted"><i class="fas fa-globe"></i> English (IN)</a>
      <a href="#" class="text-muted"><i class="fas fa-rupee-sign"></i> INR</a>
      <a href="#" class="text-muted"><img src="social/facebook.png" width="20px"></a>
      <a href="#" class="text-muted"><img src="social/instagram.png" width="20px"></a>
      <a href="#" class="text-muted"><img src="social/linkedin.png" width="20px"></a>
    </p>
  </footer>

  <!-- only for icon -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>