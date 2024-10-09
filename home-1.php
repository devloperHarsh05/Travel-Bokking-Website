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
    <title>Wonder-World |Home page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet"  href="header-1.css">
  <link rel="stylesheet" href="footer.css">
  <link rel="stylesheet" href="home-1.css">   
  <link rel="stylesheet" href="filter.css">
   <link rel="stylesheet" href="search.css">
   <script src="search.js" defer></script>  

   <!-- Swiper CSS files -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
  <!-- Add Swiper CSS and JS files -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
    <script src="https://unpkg.com/swiper/js/swiper.min.js"></script>

     <!-- search icon -->
     <script src="https://unpkg.com/phosphor-icons"></script>

</head>
<body>

  
  <div class="hedaer">
  <!-- header -->
    <header class="container d-flex align-items-center ">
        <div class="logo d-flex align-items-center">
        <a href="home-1.php" style="text-decoration:none">
        
        <h4>Wonder World</h4>
      </a>
        </div>	
        <div class="search align-items-center justify-content-center">
            <button class="btn">Any where</button> 
            <span>|</span>  
            <button class="btn">Any week</button>   
            <span>|</span>  
            <button class="btn search-guest">Add Guests
                <!-- <a href="#"><ion-icon name="search-outline" ></ion-icon></a> -->
                <div class="item-search">
                  <input type="text" class="search-box-title container" placeholder="Search...">
                  <a class="search-icon-find"><ion-icon name="search-outline"></ion-icon></a>
                  <a class="close-icon-close"><ion-icon name="close-outline"></ion-icon></a>

                </div>
              </button>  
            </button>   
        </div>
        <div class="user d-flex justify-content-end ">
            <ul class="unstyled list-inline clearfix left-nav">
                <li class="list-inline-item "><a href="#"><ion-icon class="icon" name="home-outline"></ion-icon></a></li>
                <li class="list-inline-item"><a href="#"><ion-icon class="icon" name="globe-outline"></ion-icon></a> </li>
                </ul>
            <div class="dropdown d-flex align-items-center justify-content-center">
                <button class="btn dropdown-toggle d-flex align-items-center " type="button" id="dropdownMenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" >
                  <div class="user-button" me-3>
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                  <a href="#"> <ion-icon class="icon-user" name="person-outline"></ion-icon></a>
                </button>

        <!-- dropdown menu -->
        <ul class="dropdown-menu" id="dropdown-menu">
          <?php if (!isset($_SESSION['username']) || $_SESSION['loggedin'] == false) {
            echo '<li><a class="dropdown-item" href="login.php">Login</a></li';
            echo '<li><a class="dropdown-item" href="registration.php">Registrtion</a></li>';
            echo '<li><hr class="dropdown-divider"></li>';
          } ?>
         
          <li><a class="dropdown-item" href="about.php">About Us</a></li>
          <li><a class="dropdown-item" href="co.php">Contect Us</a></li>
          <?php
          if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true) {
            echo '<li><hr class="dropdown-divider"></li>';
            echo '<li><a class="dropdown-item" href="status.php">My Bookings</a></li>';
            echo '<li><a class="dropdown-item" href="logout.php">Logout</a></li>';
          }
          ?>
        </ul>  
              </div>
        </div>
    </header>  
    <div class="image-title">
        <!-- <h1>Find Your Next Stay</h1> -->
        <?php
        if (isset($_SESSION['username']) && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
          echo '<h1>Find Your Next Stay: ' . $_SESSION["username"] . '</h1>';
        }
        ?>
    </div>
  </div>
  </div>
    <script>
      const userDropdown = document.getElementById('dropdownMenu');
      const userMenu = document.getElementById('dropdown-menu');
    
      userDropdown.addEventListener('click', () => {
        userMenu.classList.toggle('show');
      });
    </script>
      <!-- body -->
      
      <div class="container-fluid">
        <h2 class="title-exclusives">Exclusives</h2>
        <div class="exclusives">
          <div>
            <img src="image/images/image-1.png">
              <span>
                <h4>London</h4>
                <p>Starts ₹1,11,000</p>
              </span>
          </div>
          <div>
            <img src="image/images/image-2.png">
            <span>
              <h4>Switzerland</h4>
              <p>Starts ₹1,21,000</p>
            </span>
          </div>
          <div>
            <img src="image/images/image-3.png">
            <span>
              <h4>Australia</h4>
              <p>Starts ₹1,11,000</p>
            </span>
          </div>
          <div>
            <img src="image/images/image-4.png">
            <span>
              <h4>France</h4>
              <p>Starts ₹1,00,000</p>
            </span>
          </div>
          <div>
            <img src="image/images/image-5.png">
            <span>
              <h4>Amsterdom</h4>
              <p>Starts ₹ 90,000</p>
            </span>
          </div>
        <div>
          <img src="image/images/image-6.png">
            <span>
              <h4>Netheriands</h4>
              <p>Starts ₹ 1,05,000</p>
            </span>
          </div>
          <div>
          <img src="image/images/image-7.png">
            <span>
              <h4>New York</h4>
              <p>Starts ₹ 2,00,000</p>
            </span>
          </div>
          <div>
          <img src="image/images/image-8.png">
            <span>
              <h4>Chicago</h4>
              <p>Starts ₹ 1,90,000</p>
            </span>
          </div>
          <div>
          <img src="image/images/image-9.png">
            <span>
              <h4>San Francisco</h4>
              <p>Starts ₹ 1,50,000</p>
            </span>
          </div>
          <div>
          <img src="image/images/image-10.png">
            <span>
              <h4>Shanghai</h4>
              <p>Starts ₹ 50,000</p>
            </span>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <h2 class="title-exclusives">Trending Places</h2>
        <div class="trending">
          <div>
            <img src="image/images/dubai.png">
            <h4>Dubai</h4>
          </div>
          <div>
            <img src="image/images/new-york.png">
            <h4>New York</h4>
          </div>
          <div>
            <img src="image/images/paris.png">
            <h4>Paris</h4>
          </div>
          <div>
            <img src="image/images/new-delhi.png">
            <h4>New Delhi</h4>
          </div>
        </div>
      </div>

      <div class="container-fluid">
      <div class="call-to-action">
        <h3>Sharing <br>Is Earning Now</h3>
        <p>Great opportunity to make money by <br> sharing your extra space.</p>
        <a href="#" class="call-to-action-btn">Know More</a>
      </div>
    </div>
    <div class="container-fluid">
    <h2 class="title-exclusives">Travellers Stories</h2>
    <div class="stories">
      <div>
        <img src="image/images/story-1.png">
        <p>Populer Aisan Countries with a budget of just ₹50,000</p>
      </div>
      <div>
        <img src="image/images/story-2.png">
        <p>Populer European Countries with a budget of just ₹1,50,000</p>
      </div>
      <div>
        <img src="image/images/story-3.png">
        <p>Populer European Countries with a budget of just ₹2,50,000</p>
      </div>
    </div>
  </div>
  <a href="#" class="start-btn">Explorer Stories</a>
  </div>
    <div class="main-content container-fluid">

        <div class=" d-flex  justify-content-between col-lg-12">
        <h2 class="title-package ">Trending Places</h2>
            <div class="dropdown d-flex align-items-center justify-content-center">
               <!-- filter menu menu -->
    <form method="post" id="formfilter">
         <div class="dropdown d-flex align-items-center justify-content-between">
          <button class="btn dropdown-toggle d-flex align-items-center " style="border: none;border: 1px solid #ff5361;border-radius: 12px;" type="button" id="dropdown-2"
          data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
          <div class="user-button">
          <ion-icon class="icon-filter" name="options-outline"></ion-icon></ion-icon>
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
  </form>
        </div>
      </div>
    </div> 
         <script>
          const userDropdow = document.getElementById('dropdown-2');
          const userMen = document.getElementById('dropdown-1');
        
          userDropdow.addEventListener('click', () => {
            userMen.classList.toggle('show');
          });
        </script>



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
             <a href="homede.php?id=<?php echo $row['pid']; ?>&pname=<?php echo $row['package_name']; ?>&pcate=<?php echo $row['package_cate'] ?>&ploc=<?php echo $row['package_loc']; ?>&pprice=<?php echo $row['package_price'] ?>&pdetail=<?php echo $row['package_detail'];?>&image=<?php echo $row['package_img']?>"
              class="property-details">
            <div class="property-image swiper property-inside">
              <div class="swiper-wrapper">
                
                  <!-- <img src="image/1.jpg" alt="" class="im-fluid round" height="auto" width="400px"> -->
        <?php if(isset($row["package_img"])): ?>
        <?php $images = json_decode($row["package_img"] ) ; ?>
        <?php foreach($images as $image): ?>
        <?php if(count($images) > 0): ?>
          <div class="swiper-slide">
            <img src="uploads/<?php echo $images[0]; ?>" class="im-fluid round" width="400px" height="auto"> <!-- First image -->
          </div>
        <?php endif; ?>
        
        <?php if(count($images) > 1): ?>
            <div class="swiper-slide">
                <img src="uploads/<?php echo $images[1]; ?>" class="im-fluid round" width="400px" height="auto"> <!-- Second image -->
            </div>
        <?php endif; ?>
        
        
                  <!-- <img src="image/3.jpg" alt="" class="im-fluid round" height="auto" width="400px"> -->
        <?php if(count($images) > 2): ?>
            <div class="swiper-slide">
            <img src="uploads/<?php echo $images[2]; ?>" class="im-fluid round" width="400px" height="auto"> <!-- Second image -->
            </div>
        <?php endif; ?>
        
        
                  <!-- <img src="image/4.jpg" alt="" class="im-fluid round" height="auto" width="400px"> -->
        <?php if(count($images) > 3): ?>
          <div class="swiper-slide">
            <img src="uploads/<?php echo $images[3]; ?>" class="im-fluid round" width="400px" height="auto"> <!-- Second image -->
          </div>
        <?php endif; ?>
        <?php if(count($images) > 4): ?>
          <div class="swiper-slide">
            <img src="uploads/<?php echo $images[4]; ?>" class="im-fluid round" width="400px" height="auto"> <!-- Second image -->
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
              </div>
              <div class="swiper-pagination"></div>
              <div class="swiper-button swiper-button-next">
                <ion-icon name="chevron-forward"></ion-icon>
              </div>
              <div class="swiper-button swiper-button-prev">
                <ion-icon name="chevron-back"></ion-icon>
              </div>
            </div>
            <a href="homede.php?id=<?php echo $row['pid']; ?>&pname=<?php echo $row['package_name']; ?>&pcate=<?php echo $row['package_cate'] ?>&ploc=<?php echo $row['package_loc']; ?>&pprice=<?php echo $row['package_price'] ?>&pdetail=<?php echo $row['package_detail'];?>&image=<?php echo $row['package_img']?>"
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
                <li><a href="customerservice.html">Anti-discrimination</a></li>
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
               <img src="social/facebook.png" alt=""> <a href="#"  target="_blank"><i class="fab fa-facebook-f"></i></a>
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
          pagination:{
            el: ".swiper-pagination",
            clickable: true,
             dynamicBullets:true,
          },
          navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
           }
         });
  </script>
  
</body>
</html>