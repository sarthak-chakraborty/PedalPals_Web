<?php
//include auth.php file on all secure pages
include("auth.php");
$username =  $_SESSION['username'];
require_once 'forms/dbconnect.php';
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$query = "SELECT * FROM user_ WHERE username='$username';";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);

$numResults = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PedalPals: Forgot Password</title>
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

  <!-- =======================================================
  * Template Name: Mamba - v2.0.1
  * Template URL: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
                <form action="forms/forgot_passw_change.php" method="post" role="form" class="php-email-form">
        <div class="form-row">
                      <div class="col-lg-6 form-group">
                          <?php echo '<input type="text" class="form-control" name="securityq" id="securityq" placeholder="Security Question" value="'.$row['securityq'].'" readonly/>' ?>
                          <div class="validate"></div>
                      </div>
                      <div class="col-lg-6 form-group">
                          <input type="password" class="form-control" name="securityans" id="securityans" placeholder="Security Answer" data-rule="required" data-msg="Please enter security answer." />
                          <div class="validate"></div>
                      </div>
              </div>

              <div class="form-row">
                    <div class="col-lg-6 form-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="New Password" data-rule="minlen:4" data-msg="Please enter at least 4 characters" />
                      <div class="validate"></div>
                    </div>
                    <div class="col-lg-6 form-group">
                      <input type="password" class="form-control" name="re_password" id="re_password" placeholder="Re-enter new Password" data-rule="minlen:4" data-msg="Please enter at least 4 characters" />
                      <div class="validate"></div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <div class="loading"></div>
                    <div class="error-message"></div>
                    <div class="sent-message"></div>
                  </div>
                    <div class="text-left"><button type="submit" class="btn-get-started animated scrollto">Change Password</button></div>
              </form>
               
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