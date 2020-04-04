<?php
//include auth.php file on all secure pages
include("auth.php");
$username =  $_SESSION['username'];
require_once 'forms/dbconnect.php';
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>View Completed Buy Requests</title>
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

  <style type="text/css">
    .container-table100 {
        width: 100%;
        min-height: 100vh;

        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        padding: 33px 30px;
      }

      .wrap-table100 {
        width: 1170px;
      }

      table {
        border-spacing: 1;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        width: 100%;
        margin: 0 auto;
        position: relative;
      }
      table * {
        position: relative;
      }
      table td, table th {
        padding-left: 8px;
      }
      table thead tr {
        height: 60px;
        background: #5c768d;
        color: #FFF;
      }
      table tbody tr {
        height: 50px;
      }
      table tbody tr:last-child {
        border: 0;
      }
      table td, table th {
        text-align: center;
      }
      table td.l, table th.l {
        text-align: center;
      }
      table td.c, table th.c {
        text-align: center;
      }
      table td.r, table th.r {
        text-align: center;
      }


      .table100-head th{
        color: #fff;
        line-height: 1.2;
        font-weight: unset;
      }

      tbody tr:nth-child(even) {
        background-color: #f5f5f5;
      }

      tbody tr {
        color: #808080;
        line-height: 1.2;
        font-weight: unset;
      }

      tbody tr:hover {
        color: #555555;
        background-color: #f5f5f5;
        cursor: pointer;
      }

      .column1 {
        width: 50px;
        padding-left: 15px;
      }

      .column2 {
        padding-left: 15px;
        width: 50px;
      }

      .column3 {
        padding-left: 15px;

        width: 50px;
      }

      .column4 {
        padding-left: 15px;
        width: 50px;
      }

      .column5 {
        padding-left: 15px;
        width: 150px;
      }

      .column6 {
        padding-left: 5px;
        width: 100px;
      }

      .column7 {
        padding-left: 15px;
        width: 100px;
      }

      .column8 {
        padding-left: 15px;
        width: 100px;
      }

      .column9 {
        width: 100px;
        padding-left: 15px;
      }
      .column10 {
        width: 100px;
        padding-left: 15px;
      }
      .column11 {
        padding-left: 15px;
        width: 30px;
      }
      .column12{
        width: 15px;
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

          <div class="carousel-item active" style="background-image: url('assets/img/slide/slide-1.jpg');">
            
            <div class="carousel-container">
              <div class="carousel-content container">

                <p>
                   <?php

                      $query = "SELECT A.reg_no,model,color,A.price,first_name,last_name,email_id,A.buyer,A.seller,request_date,completion_date,status from completed_buy_cycle_requests A, user_ B, cycle C where A.reg_no = C.reg_no and A.buyer = '$username' and A.seller = B.username;";
                      $result = mysqli_query($con, $query);
                      $numResults = mysqli_num_rows($result);
                      if($numResults==0){
                        echo "<h2> Completed Buy Requests</h2> ";
                        echo "<h5><font color='white'> No records available </font></h5>";
                        echo "<h5> <font color='white'> View Pending Requests <a href = 'view_buy_requests.php'> Here</a> </font></h5>";
                        echo "<h5> <font color='white'> Go to <a href = 'buy_cycle.php'> Buy Cycle </a> </font></h5>";
                        exit();
                      }
                      echo "<div class='container-table100'>\n";
                      echo "<div class='wrap-table100'>\n";
                      echo "<div class='table100'>";
   
                      echo "<h2> Completed Buy Requests</h2> ";
                      echo "<h5> <font color='white'> View Pending Requests <a href = 'view_buy_requests.php'> Here</a> </font></h5>";
                      echo "<h5> <font color='white'> Go to <a href = 'buy_cycle.php'> Buy Cycle </a> </font></h5>";
                      echo "<table>\n";
                      echo "<thead> <tr class='table100-head'>
                            <td class='column1'>Reg. Number</td>
                            <td class='column2'>Model</td>
                            <td class='column3'>Colour</td>
                            <td class='column4'>Price</td>
                            <td class='column5'>Seller </td>
                            <td class='column6'>Seller Mobile Number(s)</td>
                            <td class='column7'>Seller Email ID </td>
                            <td class='column8'>Request Date </td>
                            <td class='column9'>Status</td>
                            <td class='column10'>Completion Date</td>
                            </tr> </thead> \n";

                      echo "<tbody>\n";
                      $id = 1;
                      while ($row = mysqli_fetch_assoc($result)){
                        
                        if(strcmp($row["status"],"a")==0){
                          $status="Accepted";
                        }
                        else if(strcmp($row["status"],"r")==0){
                          $status="Rejected";
                        }
                        
                        $query2 = "select * from mobilenumber where username='".$row["seller"]."';";
                        $result2 = mysqli_query($con,$query2);
                        $numResults2 = mysqli_num_rows($result2);
                        $mobilenumber = "";
                        if($numResults2==1){
                          $row1=mysqli_fetch_assoc($result2);
                          $mobilenumber = $row1['number'];
                        }
                        else if($numResults2==2){
                          $row1=mysqli_fetch_assoc($result2);
                          $mobilenumber = $row1['number'];
                          $row2=mysqli_fetch_assoc($result2);
                          $mobilenumber = $mobilenumber." ".$row2['number'];
                        }

                        echo "<tr>
                            <td class='column1'>".$row['reg_no']."</td>
                            <td class='column2'>".$row["model"]."</td>
                            <td class='column3'>".$row["color"]."</td>
                            <td class='column4'>".$row["price"]."</td>
                            <td class='column5'>".$row["first_name"]." ".$row["last_name"]."</td>
                            <td class='column6'>".$mobilenumber."</td>
                            <td class='column7'>".$row["email_id"]."</td>
                            <td class='column8'>".$row["request_date"]."</td>
                            <td class='column9'>".$status."</td>
                            <td class='column10'>".$row["completion_date"]."</td>
                            </tr>\n";

                        $id++;
                      }
                      echo "</tbody>\n";
                      echo "</table>\n";
                      echo "</div>\n </div>\n </div>";

                      mysqli_close($con);
                    ?>
                  </p>
              </div>
             </div>
           </div>
          </div>
        </div>
      </div>
    </section>


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