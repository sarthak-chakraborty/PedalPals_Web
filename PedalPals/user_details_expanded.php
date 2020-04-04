<?php
//include auth.php file on all secure pages
include("auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>User Detailss</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

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
          color: white;
          background-color: #6666FF;
          width: 100px;
      }
  </style>


  <!-- =======================================================
  * Template Name: Mamba - v2.0.1
  * Template URL: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>



<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="icofont-envelope"></i><a href="mailto:contact@example.com">query@pedalpals.com</a>
        <i class="icofont-phone"></i> +91 8800875310
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">

      <div class="logo float-left">
        <h1 class="text-light"><a href="index.html"><span>PedalPals</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
         <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->
      </div>

      <nav class="nav-menu float-right d-none d-lg-block">
        <ul>
          <li><a href="admin_menu.php">Menu</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>

  </header><!-- End Header -->

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <div class="container bootstrap snippets">
  
  <?php
      require_once 'forms/dbconnect.php';

      $username = $_GET['username'];

      $query = "SELECT * FROM user_ WHERE username='$username';";
      $result = mysqli_query($con, $query);

      $row = mysqli_fetch_assoc($result);
      if(!$row['rating'])
        $rating = "NA";
      else
        $rating = $row['rating'];

      $query_new = "SELECT * from mobilenumber WHERE username='$username';";
      $result_new = mysqli_query($con, $query_new);
      $numResults = mysqli_num_rows($result_new);

      if($numResults > 0)
        $number1 = mysqli_fetch_assoc($result_new)["number"];
      else
        $number1 = "NA";

      if($numResults == 2)
        $number2 = mysqli_fetch_assoc($result_new)["number"];
      else
        $number2 = "NA";

      $query_cycle = "SELECT * FROM cycle WHERE username='$username';";
      $result_cycle = mysqli_query($con, $query_cycle);
      $numResults_cycle = mysqli_num_rows($result_cycle);

      echo '<div class="row">
          <div class="col-xs-12 col-sm-9">
            <form class="form-horizontal" action="user_details.php" role="form" class="php-email-form">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h4 class="panel-title">User info</h4>
                      </div>
                      <div class="panel-body">
                          <div class="form-group">
                              <label class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="first_name" name="first_name" value="'.$row["first_name"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="last_name" name="last_name" value="'.$row["last_name"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="username" name="username" value="'.$row["username"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Rating</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="ratingname" name="ratingname" value="'.$rating.'">
                                </div>
                          </div>
                      </div>
                  </div>

                  
                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">Contact info</h4>
                      </div>
                      <div class="panel-body">
                          <div class="form-group">
                              <label class="col-sm-2 control-label">E-mail address</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="email_id" name="email_id" value="'.$row["email_id"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Mobile Number</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="mobilenum1" name="mobilenum1" value="'.$number1.'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Alternate Mobile Number</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="mobilenum2" name="mobilenum2" value="'.$number2.'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Hall</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="hall" name="hall" value="'.$row["hall"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Room</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="room" name="room" value="'.$row["room"].'">
                                </div>
                          </div>
                      </div>
                    </div>

                    <div class="panel panel-default">
                      <div class="panel-heading">
                          <h4 class="panel-title">Cycle info</h4>
                      </div>
                      <div class="panel-body">
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Number of Cycles</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="numberCycle" name="numberCycle" value="'.$numResults_cycle.'">
                                </div>
                          </div>';

                        $id = 1;
                        while ($row_cycle = mysqli_fetch_assoc($result_cycle)){
                          if($row_cycle["reg_type"] == 'r')
                            $type = "Rental";
                          else
                            $type = "Selling";

                          echo '<div class="form-group">
                                  <label class="col-sm-2 control-label">Registration Number '.$id.'</label>
                                    <div class="col-sm-10">
                                        <input readonly type="text" class="form-control" id="reg_no'.$id.'" name="reg_no'.$id.'" value="'.$row_cycle["reg_no"].'">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Model '.$id.'</label>
                                    <div class="col-sm-10">
                                        <input readonly type="text" class="form-control" id="model'.$id.'" name="model'.$id.'" value="'.$row_cycle["model"].'">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Color '.$id.'</label>
                                    <div class="col-sm-10">
                                        <input readonly type="text" class="form-control" id="color'.$id.'" name="color'.$id.'" value="'.$row_cycle["color"].'">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Type '.$id.'</label>
                                    <div class="col-sm-10">
                                        <input readonly type="text" class="form-control" id="type'.$id.'" name="type'.$id.'" value="'.$type.'">
                                    </div>
                                </div>';
                                $id++;
                        }

                      echo '</div>
                  </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn login_btn">Back</button>
                        </div>
                    </div>
              </form>
          </div>
      </div>';
  ?>

  </div>


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
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