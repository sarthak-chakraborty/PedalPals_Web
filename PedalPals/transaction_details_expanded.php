<?php
//include auth.php file on all secure pages
include("auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Transaction Details</title>
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
          <li><a href="menu.php">Menu</a></li>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>

  </header><!-- End Header -->

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <div class="container bootstrap snippets">
  
  <?php
      require_once 'forms/dbconnect.php';

      $transaction_id = $_GET['transaction_id'];
      $username = $_SESSION['username'];

      $query = "SELECT * FROM transaction WHERE transaction_id='$transaction_id' and (username = '$username' || owner = '$username');";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_assoc($result);
      $numResults = mysqli_num_rows($result);
      if($numResults==0){
        echo "<h4> Invalid transaction entry </h4>";
        header("refresh:2;url=transaction_details_user.php");
      }

      $query_new = "SELECT * FROM user_ AS a, cycle AS b WHERE b.reg_no=".$row['reg_no']." AND a.username = b.username;";
      $result_new = mysqli_query($con, $query_new);
      $row_cycle = mysqli_fetch_assoc($result_new);
      $numResults = mysqli_num_rows($result);
      if($numResults==0){
        echo "<h4> Invalid entry </h4>";
        header("refresh:2;url=transaction_details_user.php");
      }
      $query_owner = "select * from user_ where username = '".$row['owner']."';";
      $result_owner = mysqli_query($con,$query_owner);
      $row_owner = mysqli_fetch_assoc($result_owner);

      $query_mob = "select number from mobilenumber where username = '".$row['owner']."';";
      $result_mob = mysqli_query($con,$query_mob);
      
      $numResults = mysqli_num_rows($result);
      if($numResults==0){
        echo "<h4> Invalid entry </h4>";
        header("refresh:2;url=transaction_details_user.php");
      }

      $row_mob = mysqli_fetch_assoc($result_mob);
      $mobilenumber = $row_mob['number'];

      while($row_mob = mysqli_fetch_assoc($result_mob))
        {
          $mobilenumber = $mobilenumber.", ".$row_mob['number'];
        }

      $query_user = "select * from user_ where username = '".$row['username']."';";
      $result_user = mysqli_query($con,$query_user);
      $row_user = mysqli_fetch_assoc($result_user);

      $query_mob_user = "select number from mobilenumber where username = '".$row['username']."';";
      $result_mob_user = mysqli_query($con,$query_mob_user);
      
      $numResults = mysqli_num_rows($result);
      if($numResults==0){
        echo "<h4> Invalid entry </h4>";
        header("refresh:2;url=transaction_details_user.php");
      }

      $row_mob_user = mysqli_fetch_assoc($result_mob_user);
      $mobilenumber_user = $row_mob_user['number'];

      while($row_mob_user = mysqli_fetch_assoc($result_mob_user))
        {
          $mobilenumber_user = $mobilenumber_user.", ".$row_mob['number'];
        }


        $start_date=date_create($row["start_date"]);
        $end_date=date_create($row["end_date"]);
        $num_days=date_diff($end_date,$start_date);
        $num_days=intval($num_days->format("%a"))+1;

        $total = (intval($row["price_per_day"])*$num_days);
        $coupon = $row['coupon_id'];

        if($coupon==null){
          $coupon="";
          $reward=0;
        }
        else{
          $query_coup = "select discount,max_amount from Coupon where coupon_id = '".$coupon."';";
          $result_coup = mysqli_query($con,$query_coup);
          $row_coup = mysqli_fetch_assoc($result_coup);
          $reward = $total * intval($row_coup['discount'])/100;
          if($reward>$row_coup['max_amount']){
            $reward = $row_coup['max_amount'];
          }
        }
      echo '<div class="row">
          <div class="col-xs-12 col-sm-9">
            <form class="form-horizontal" action="transaction_details_user.php" role="form" method="post" class="php-email-form">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h4 class="panel-title">Cycle info</h4>
                      </div>
                      <div class="panel-body">
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Transaction ID</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="transaction_id" name="transaction_id" value="'.$row["transaction_id"].'">
                                </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Cycle Registration Number</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="reg_no" name="reg_no" value="'.$row["reg_no"].'">
                                </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Model</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="model" name="model" value="'.$row_cycle["model"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="color" name="color" value="'.$row_cycle["color"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="location" name="location" value="'.$row_cycle["location_name"].'">
                                </div>
                          </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Start Date</label>
                              <div class="col-sm-10">
                                   <input readonly type="text" class="form-control" id="start_date" name="start_date" value="'.$row["start_date"].'">
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 control-label">End Date</label>
                              <div class="col-sm-10">
                                   <input readonly type="text" class="form-control" id="end_date" name="end_date" value="'.$row["end_date"].'">
                              </div>
                          </div>

                      </div>
                  </div>
                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">User Contact info</h4>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                              <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="name" name="name" value="'.$row_user["first_name"]." ".$row_user["last_name"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">E-mail address</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="email_id" name="email_id" value="'.$row_user["email_id"].'">
                                </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Mobile Number(s)</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="mobilenum" name="mobilenum" value="'.$mobilenumber_user.'">
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
                              <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="name" name="name" value="'.$row_owner["first_name"]." ".$row_owner["last_name"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">E-mail address</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="email_id" name="email_id" value="'.$row_owner["email_id"].'">
                                </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Mobile Number(s)</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="mobilenum" name="mobilenum" value="'.$mobilenumber.'">
                                </div>
                          </div>
                      </div>
                  </div>

                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">Billing Details</h4>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                              <label class="col-sm-2 control-label">Price Per Day</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="ppd" name="ppd" value="Rs. '.$row["price_per_day"].'">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Number of Days</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="num_days" name="num_days" value="'.$num_days.'">
                                </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Total Amount</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="total" name="total" value="Rs. '.$total.'">
                                </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Coupon Applied</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="total" name="total" value="'.$coupon.'">
                                </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Reward Points</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="reward" name="reward" value="Rs. '.$reward.'">
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