<?php
session_start();
include("connection.php");

if (isset($_POST['apply'])) {
  $pricemulti = [];
  $countrymulti = [];

  //for price
  if (isset($_POST['price'])) {
    $pricefilter = $_POST['price'];
    foreach ($pricefilter as $pf) {
      switch ($pf) {
        case 'all':
          $pricemulti[]=" 1=1";
          break;
        case 'l50':
          $pricemulti[] = "package_price < 50000";
          break;
        case '50to1':
          $pricemulti[] = "package_price between 50000 and 100000";
          break;
        case '1to2':
          $pricemulti[] = "package_price between 100000 and 200000";
          break;
        case '2to4':
          $pricemulti[] = "package_price between 200000 and 400000";
          break;
        case '4to6':
          $pricemulti[] = "package_price between 400000 and 600000";
          break;
        case '6to7':
          $pricemulti[] = "package_price between 600000 and 700000";
          break;
        case 'g7':
          $pricemulti[] = "package_price > 700000";
          break;
        default:
          $pricemulti[] = "1=1";
          break;
      }
    }
  }

  //for country
  if (isset($_POST['country'])) {
    $countryfilter = $_POST['country'];
    foreach ($countryfilter as $cf) {
      switch ($cf) {
        case 'india':
          $countrymulti[] = "package_loc like '%india%'";
          break;
        case 'usa':
          $countrymulti[] = "package_loc like '%usa%'";
          break;
        case 'uk':
          $countrymulti[] = "package_loc like '%uk%'";
          break;
        case 'japan':
          $countrymulti[] = "package_loc like '%japan%'";
          break;
        case 'switzerland':
          $countrymulti[] = "package_loc like '%switzerland%'";
          break;
        default:
          $countrymulti[] = "1=1";
          break;
      }
    }
  }


  $allConditions = [];
  if (!empty($pricemulti)) {
    $allConditions[] = '(' . implode(' or ', $pricemulti) . ')';
  }

  if (!empty($countrymulti)) {
    $allConditions[] = '(' . implode(' or ', $countrymulti) . ')';
  }


  if (!empty($allConditions)) {
    $filter1 = "select * from packages where " . implode(' and ', $allConditions);
  } else {
    $filter1 = "select * from packages";
  }

  $exef1 = mysqli_query($cn, $filter1);

} else {
  $filter1 = "select * from packages";
  $exef1 = mysqli_query($cn, $filter1);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wonder world</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="bootstrap/bootstrap.min.js"></script> -->
  <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
  <script src="bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="header.css">
  <link rel="stylesheet" href="footer.css">
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="filter.css">

  <!-- Swiper CSS files -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <!-- Add Swiper CSS and JS files -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
  <script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
</head>

<body>
  <!-- header -->

  <header class="container-fluid d-flex align-items-center ">
    <div class="logo d-flex align-items-center">
      <a href="home.php" style="text-decoration:none">
        <!-- <img src="i-con\logo2.png" > -->
        <h4>Wonder World</h4>
      </a>
    </div>
    <div class="search align-items-center justify-content-center">
      <button class="btn">Any where</button>
      <span>|</span>
      <button class="btn">Any week</button>
      <span>|</span>
      <button class="btn search-guest">Add Guests
        <a href="#"><ion-icon name="search-outline"></ion-icon></a>
      </button>
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
          <ion-icon class="icon-user" name="person-outline"></ion-icon> </a>
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
  <!-- script for user dropdown -->
  <script>
    const userDropdown = document.getElementById('dropdownMenu');
    const userMenu = document.getElementById('dropdown-menu');

    userDropdown.addEventListener('click', () => {
      userMenu.classList.toggle('show');
    });
  </script>
  <!-- body -->
  <!-- filter menu menu -->
  <form method="post" id="formfilter">
    <div class="dropdown d-flex align-items-center justify-content-between">
      <button class="btn dropdown-toggle d-flex align-items-center " type="button" id="dropdown-2"
        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
        <div class="user-button">
          <a href="#"> <ion-icon class="icon-filter" name="options-outline"></ion-icon></ion-icon></a>
          <span class="span-1">Filter</span>
        </div>
      </button>

      <ol class="dropdown-menu" id="dropdown-1">
        <li><a class="dropdown-item">Price</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item"><input type="checkbox" name="price[]" value="all"> All</a></li>
        <li><a class="dropdown-item"><input type="checkbox" name="price[]" value="l50"> Less then ₹50,000</a></li>
        <li><a class="dropdown-item"><input type="checkbox" name="price[]" value="50to1"> ₹50,000-₹1,00,000</a></li>
        <li><a class="dropdown-item"><input type="checkbox" name="price[]" value="1to2"> ₹1,00,000-₹2,00,000</a></li>
        <li><a class="dropdown-item"><input type="checkbox" name="price[]" value="2to4"> ₹2,00,000-₹4,00,000</a></li>
        <li><a class="dropdown-item"><input type="checkbox" name="price[]" value="4to6"> ₹4,00,000-₹6,00,000</a></li>
        <li><a class="dropdown-item"><input type="checkbox" name="price[]" value="6to7"> ₹6,00,000-₹7,00,000</a></li>
        <li><a class="dropdown-item"><input type="checkbox" name="price[]" value="g7"> ₹7,00,000 - More.. </a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item">Country</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item"><input type="checkbox" name="country[]" value="india"> India</a></li>
        <li><a class="dropdown-item"><input type="checkbox" name="country[]" value="usa"> USA</a></li>
        <li><a class="dropdown-item"><input type="checkbox" name="country[]" value="uk"> UK</a></li>
        <li><a class="dropdown-item"><input type="checkbox" name="country[]" value="japan"> Japan</a></li>
        <li><a class="dropdown-item"><input type="checkbox" name="country[]" value="germany"> Germany</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li><a class="dropdown-item"><button type="submit" class="btn btn-primary" name="apply">Apply</button>
            <button type="reset" class="btn btn-warning">Reset</button></a></li>
      </ol>

    </div>
    <!-- <button type="submit" name="filter" value="all" id="all">All</button>
    <button type="submit" name="filter" value="2to4">₹200,000 to ₹400,000</button>
    <button type="submit" name="filter" value="4to5">₹400,000 to ₹500,000</button>
    <button type="submit" name="filter" value="5to6">₹500,000 to ₹600,000</button>
    <button type="submit" name="filter" value="6to7">₹600,000 to ₹700,000</button> -->
  </form>
  <!-- script for filter dropdown -->
  <script>
    const userDropdow = document.getElementById('dropdown-2');
    const userMen = document.getElementById('dropdown-1');

    userDropdow.addEventListener('click', () => {
      userMen.classList.toggle('show');
    });
  </script>
  <!-- script to reset checkbox -->
  <script>
    function resetcb() {
      var checkboxes = document.querySelectorAll('#formfilter input[type="checkbox"]');
      checkboxes.forEach(function (checkbox) {
        checkbox.checked = false;
      });
    }
  </script>
  <div class="main-content container">
    <div class="result">
      <div class="row g-4">
        <!-- 1 -->
        <?php if (mysqli_num_rows($exef1) > 0) { ?>
          <?php while ($row = mysqli_fetch_assoc($exef1)) { ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
              <div class="property-icon">

                <a href="" class="wishlist">
                  <ion-icon name="heart-outline"></ion-icon>
                </a>
                <div class="property-image swiper property-inside">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <img src="image/1.jpg" alt="" class="im-fluid round" height="auto" width="400px">
                    </div>
                    <div class="swiper-slide">
                      <img src="image/2.jpg" alt="" class="im-fluid round" height="auto" width="400px">
                    </div>
                    <div class="swiper-slide">
                      <img src="image/3.jpg" alt="" class="im-fluid round" height="auto" width="400px">
                    </div>
                    <div class="swiper-slide">
                      <img src="image/4.jpg" alt="" class="im-fluid round" height="auto" width="400px">
                    </div>
                  </div>
                  <div class="swiper-pagination"></div>
                  <div class="swiper-button swiper-button-next">
                    <ion-icon name="chevron-forward"></ion-icon>
                  </div>
                  <div class="swiper-button swiper-button-prev">
                    <ion-icon name="chevron-back"></ion-icon>
                  </div>
                </div>
                <a href="homede.php?id=<?php echo $row['pid']; ?>&pname=<?php echo $row['package_name']; ?>&pcate=<?php echo $row['package_cate'] ?>&ploc=<?php echo $row['package_loc']; ?>&pprice=<?php echo $row['package_price'] ?>&pdetail=<?php echo $row['package_detail']; ?>"
                  class="property-details">
                  <div class="property-location d-flex justify-content-between">
                    <h5 style="text-transform:uppercase"><b><?php echo $row["package_name"] ?></b></h5>
                  </div>
                  <div class="property-location d-flex justify-content-between">
                    <h5><?php echo ucwords($row["package_loc"]) ?></h5>
                    <h6><ion-icon name="star"></ion-icon><samp>5.0</samp></h6>
                  </div>
                  <!-- <div class="for-awy">
                        <h6>25 km near</h6>
                      </div> -->
                  <div class="category">
                    <h6 style="text-transform:uppercase"><?php echo $row["package_cate"]; ?></h6>
                  </div>
                  <div class="price">
                    <h6>₹<?php echo $row["package_price"]; ?></h6>
                  </div>
                </a>
              </div>
            </div>
          <?php } ?>
        <?php } else {
          if (mysqli_num_rows($exef1) == 0) {
            echo "<h3>No packages found matching your criteria :(</h3>";
          }
        } ?>

      </div>

    </div>
  </div>
  </div>

  <!-- footer-->

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
  </footer>

  <!-- only for icon -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!-- swiper js  -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".property-inside", {
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      }
    });
  </script>
</body>

</html>