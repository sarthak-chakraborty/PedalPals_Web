<?php
//include auth.php file on all secure pages
include("auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cycle Details</title>
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

      $reg_no = $_GET['reg_no'];

      $query = "SELECT * FROM cycle WHERE reg_no='$reg_no';";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_assoc($result);
      $numResults = mysqli_num_rows($result);
      if($numResults==0){
        echo "<h4> Invalid cycle entry </h4>";
        header("refresh:1;url=cycle_details.php");
      }
      if($row["hasCarrier"] == 'y')
        $carrier = "Yes";
      else
        $carrier = "No";

      if($row["reg_type"] == 'r'){ 
        $type = "Rental";
        $price = "Rs. ".$row['price']."/day";
      }
      else if($row["reg_type"]=='s'){
        $type = "Selling";
        $price = "Rs. ".$row['price'];
      }
      else{
      	$type = "Other";
      	$price = "Rs. ".$row["price"];
      }

      $query_new = "SELECT * FROM user_ AS a, cycle AS b WHERE b.reg_no='$reg_no' AND a.username = b.username;";
      $result_new = mysqli_query($con, $query_new);
      $row_new = mysqli_fetch_assoc($result_new);


      $numResults = mysqli_num_rows($result);
      if($numResults==0){
        echo "<h4> Invalid entry </h4>";
        header("refresh:1;url=cycle_details.php");
      }

      $query_mob = "select number from mobilenumber where username = '".$row['username']."';";
      $result_mob = mysqli_query($con,$query_mob);
      
      $numResults = mysqli_num_rows($result);
      if($numResults==0){
        echo "<h4> Invalid entry </h4>";
        header("refresh:1;url=cycle_details.php");
      }

      $row_mob = mysqli_fetch_assoc($result_mob);
      $mobilenumber = $row_mob['number'];

      while($row_mob = mysqli_fetch_assoc($result_mob))
        {
          $mobilenumber = $mobilenumber.", ".$row_mob['number'];
        }

        if($row['rating']==null){
                          $rating = "NA";
                        }
                        else{
                          $rating = $row['rating'];
                        }

      echo '<div class="row">
          <div class="col-xs-12 col-sm-9">
            <form class="form-horizontal" action="cycle_details.php" role="form" class="php-email-form">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h4 class="panel-title">Cycle info</h4>
                      </div>
                      <div class="panel-body">
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Registration Number</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="reg_no" name="reg_no" value="'.$row["reg_no"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Model</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="model" name="model" value="'.$row["model"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="color" name="color" value="'.$row["color"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="color" name="color" value="'.$rating.'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="location" name="location" value="'.$row["location_name"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Carrier</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="carrier" name="carrier" value="'.$carrier.'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="type" name="type" value="'.$type.'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Price for Rental/Selling</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="price" name="price" value="'.$price.'">
                                </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Condition</label>
                              <div class="col-sm-10">
                                  <textarea readonly class="form-control" name="description" id="description" rows="5" name="description">'.$row["cycle_condition"].'</textarea>
                                <div class="validate"></div>
                              </div
                          </div>
                      </div>
                  </div>

                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">Owner info</h4>
                      </div>
                      <div class="panel-body">
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="name" name="name" value="'.$row_new["first_name"]." ".$row_new["last_name"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="username" name="username" value="'.$row_new["username"].'">
                                </div>
                          </div>
                      </div>
                  </div>

                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">Owner Contact info</h4>
                      </div>
                      <div class="panel-body">
                          <div class="form-group">
                              <label class="col-sm-2 control-label">E-mail address</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="email_id" name="email_id" value="'.$row_new["email_id"].'">
                                </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Mobile Number(s)</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="email_id" name="email_id" value="'.$mobilenumber.'">
                                </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Hall and Room</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="hall" name="hall" value="'.$row_new["hall"]." ".$row_new["room"].'">
                                </div>
                          </div>
                      </div>
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