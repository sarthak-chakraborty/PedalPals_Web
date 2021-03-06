                
<?php
//include auth.php file on all secure pages
include("auth.php");

$username =  $_SESSION['username'];
require_once 'forms/dbconnect.php';

$reg_no = $_GET["reg_no"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Get Ride </title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

  <!-- Vendor CSS Files -->

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="css/inMain.css">

    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="lib/nivo-slider/css/nivo-slider.css" rel="stylesheet">

    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

    <link href="lib/owlcarousel/owl.carousel.css" rel="stylesheet">
    <link href="lib/owlcarousel/owl.transitions.css" rel="stylesheet">
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/venobox/venobox.css" rel="stylesheet">

    <link href="css/nivo-slider-theme.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/profile.css">
    <style type="text/css">
        .login_btn {
            color: black;
            background-color: #FFC312;
            width: 100px;
        }
    </style>
    <style>
      select {
      width: 140px;
      height: 35px;
      padding: 4px;
      border-radius:4px;
      box-shadow: 2px 2px 8px #999;
      background: #eee;
      border: none;
      outline: none;
      display: inline-block;
      -webkit-appearance:none;
      -moz-appearance: none;
      appearance: none;
      cursor: pointer;
      }
      label {
      position: relative;
      }
      label:after {
      content:'<>';
      font: 11px "Consolas", monospace;
      color: #666;
      -webkit-transform: rotate(90deg);
      -moz-transform: rotate(90deg);
      -ms-transform: rotate(90deg);
      transform: rotate(90deg);
      right: 8px; 
      top:2px;
      padding: 0 0 2px;
      border-bottom: 1px solid #ddd;
      position: absolute;
      pointer-events: none;
      }
      label:before {
      content: '';
      right: 6px; 
      top:0px;
      width: 20px; 
      height: 20px;
      background: #eee;
      position: absolute;
      pointer-events: none;
      display: block;
      }
    </style>
</head>

<body>
    <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="icofont-envelope"></i><a href="mailto:contact@example.com">query@pedalpals.com</a>
        <i class="icofont-phone"></i> +918800875310
      </div>
      <div class="social-links float-right">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">

      <div class="logo float-left">
        <h1 class="text-light"><a href="index.html"><span>PedalPals</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu float-right d-none d-lg-block">
        <ul>
          <li><a href="menu.php">Menu</a></li>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>

  </header><!-- End Header -->
  
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel" >
        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active" style="background-image: url('assets/img/slide/slide-5.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animated fadeInDown"> Get Ride </h2>
                <h5> <font color='white'> Go <a href = "get_ride.php"> Back </a> to choose other cycle. <br> Add other details.  </font></h5> <br><br>
                <?php echo '
                <form action="forms/get_ride_form.php?reg_no='.$reg_no.'" method="post" role="form">'; ?>
                  <div class="form-row">
                    <div class="col-lg-6 form-group">
                      <h4> <font color='white'> Cycle Registration Number: <?php echo $reg_no ?> </font></h4>
                    </div>
                     <div class="col-lg-3 form-group">
                      <input type="number" class="form-control" name="num_days" id="num_days" placeholder="Number of Days for Rental" data-rule="required" data-msg="Field Required." min="1" max="5" />
                      <div class="validate"></div>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col-lg-6 form-group">
                        <h4> <font color='white'> Start Date: <?php echo date('Y/m/d'); ?> </font></h4>
                    </div>  
                    <div class="col-lg-2 form-group">
                      <select id="coupon" name="coupon"> 
                      	<option value="">Select Coupon...</option>
                      	<?php

                          $query = "delete from User_Coupon where expiry_date < '".date('Y/m/d')."';";
                          mysqli_query($con,$query);

                      		$query = "select * from User_Coupon natural join Coupon where username = '".$username."';";
            							$result = mysqli_query($con, $query);
            							$numResults = mysqli_num_rows($result);

            							while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            								echo "<option value='$row[coupon_id]'> $row[coupon_id]: Get $row[discount] % off upto Rs. $row[max_amount] (Valid up to: $row[expiry_date])</option>";
            							}
            							?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <div class="loading"></div>
                    <div class="error-message"></div>
                    <div class="sent-message"></div>
                  </div>
                    <div class="text-left"><button type="submit" class="btn-get-started animated scrollto">Get Cycle</button></div>
                 </form>
                 
               </div>
             </div>
           </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
    <div class="footer-top">
      <div class="container">
        
      </div>
    </div>

    <div class="container">
        <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  </body>
</html>
