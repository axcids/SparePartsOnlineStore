<?php
ob_start();
session_start();
require 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $title ?> | Sparepart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/custom_style.css">
  <link rel="stylesheet" href="css/about-us.css">
  <link rel="stylesheet" href="css/footer.css">
</head>
<body>
  <div class="py-2 bg-primary parent-header">
    <div class="container">
      <div class="row no-gutters d-flex align-items-start align-items-center px-3 px-md-0">
        <div class="col-lg-12 d-block">
          <div class="row d-flex">
            <div class="col-md-5 pr-4 d-flex topper align-items-center">
              <div class="icon bg-transparent mr-2 d-flex justify-content-center align-items-center"><span class="icon-map-marker"></span></div>
              <span> <a class="text" href="https://goo.gl/maps/FJB3Xy4MepLxdH4L8" target="_blank">Al Muruj Tower, Olaya St, Riyadh 12281 </a></span>
            </div>
            <div class="col-md pr-4 d-flex topper align-items-center">
              <span></span>
            </div>
            <div class="col-md pr-4 d-flex topper justify-content-end">
              <div class="icon bg-transparent mr-2 d-flex justify-content-center align-items-center"><span class="my-icon-phone icon icon-phone"></span></div>
              <span><a class="text" href="tel:+966530343821"> +966530343821 </a></span>
            </div>
            <?php if (isset($_SESSION['username']) && isset($_SESSION['user_type'])) : ?>
              <?php if ($_SESSION['user_type'] == 'customer') : ?>
                <div class="col-md-1 pr-4 d-flex topper justify-content-end">
                  <div class="btn-cart"><a href="cart.php">
                      <div class="icon mr-2 d-flex justify-content-center align-items-center icon-cart">
                        <span class='shopping_cart'>
                          <svg viewBox="0 0 32 32" class="sc-1k8rycc-0 hKMuPE">
                            <path d="M22.688 24.667c1.438 0 2.625 1.25 2.625 2.688s-1.188 2.625-2.625 2.625-2.688-1.188-2.688-2.625 1.25-2.688 2.688-2.688zM1.313 3.354h4.375l1.25 2.625h19.75c0.75 0 1.313 0.625 1.313 1.375 0 0.25-0.063 0.438-0.188 0.625l-4.75 8.625c-0.438 0.813-1.313 1.375-2.313 1.375h-9.938l-1.188 2.188-0.063 0.188c0 0.188 0.125 0.313 0.313 0.313h15.438v2.688h-16c-1.438 0-2.625-1.25-2.625-2.688 0-0.438 0.125-0.875 0.313-1.25l1.813-3.313-4.813-10.125h-2.688v-2.625zM9.313 24.667c1.438 0 2.688 1.25 2.688 2.688s-1.25 2.625-2.688 2.625-2.625-1.188-2.625-2.625 1.188-2.688 2.625-2.688z"></path>
                          </svg>
                        </span>

                        <?php
                        $result_user = mysqli_query($conn, "SELECT * FROM users WHERE username='{$_SESSION['username']}' LIMIT 0,1");
                        if (mysqli_num_rows($result_user) > 0) {
                          $row_user = mysqli_fetch_assoc($result_user);

                          $cart_count = 0;
                          $result = mysqli_query($conn, "SELECT * FROM cart");
                          if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                              if ($row_user['id'] == $row['user_id']) {
                                $cart_count++;
                              }
                            }
                          }
                          echo '<span class="cart-number"><p>' . $cart_count . '</p></span>';
                        }
                        ?>
                      </div>
                    </a>
                  </div>
                </div>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco_navbar ftco-navbar-light " id="ftco-navbar">
      <div class="container d-flex align-items-center">
        <a class="navbar-brand" href="home.php">
          <img src="images/logo/horiz-logo.png" alt="" >
        </a>
        <button class="navbar-toggler icon-menu" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <!-- <span class="oi oi-menu">Home</span> -->
        </button>
        <div class="collapse navbar-collapse py-10" id="ftco-nav">
          <ul class="navbar-nav ml-auto" style="color: #fda638;">
            <li class="nav-item px-2 py-3"><a href="home.php">Home</a></li>
            <li class="nav-item px-2 py-3"><a href="about_us.php">About</a></li>
            <li class="nav-item px-2 py-3"><a href="contact.php">Contact</a></li>
            <?php if (!isset($_SESSION['user_type'])) : ?>
              <li class="nav-item px-2 py-3"><a href="login.php">Login</a></li>
              <li class="nav-item px-2 py-3"><a href="register.php">Sign up</a></li>
            <?php elseif (in_array('admin', $_SESSION) || in_array('provider', $_SESSION)) : ?>
              <li class="nav-item px-2 py-3"><a href="admin/index.php">Control-Panel</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['username'])){ ?>
              <div class="dropdown">
                <li class="nav-item px-2 py-3 dropdown-toggle"><?php echo $_SESSION['username'] ?></li>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="inbox.php">Messages</a>
                  <a class="dropdown-item" href="edit_profile.php">Edit Profile</a>
                </div>
              </div>
              <li class="nav-item px-2 py-3"><a href="logout.php">Logout</a></li>

            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
</section>
