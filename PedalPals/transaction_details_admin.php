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
        width: 2px;
        padding-left: 15px;
      }
      .column2 {
        width: 50px;
      }
      .column3 {
        width: 75px;
      }
      .column4 {
        width: 150px;
      }
      .column5 {
        width: 75px;
      }
      .column6 {
        width: 75px;
      }
  
     .column7 {
        width: 75px;
      }

      .column8 {
        width: 50px;
      }
      .column9 {
        width: 2px;
        padding-right: 15px;
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
        <i class="icofont-phone"></i> +918800875310
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
          <li><a href="admin_menu.php">Menu</a></li>
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
          <div class="carousel-item active" style="background-image: url('assets/img/slide/slide-4.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <p>
                   <?php
                      require_once "forms/dbconnect.php";

                      $username = $_SESSION['username'];
                      $query = "SELECT * FROM transaction;";
                      $result = mysqli_query($con, $query);
                      $numResults = mysqli_num_rows($result);
                      if($numResults==0){
                        echo "<h4><font color='white'>No transactions available</font></h4>";
                        exit();
                      }

                      echo "<div class='container-table100'>\n";
                      echo "<div class='wrap-table100'>\n";
                      echo "<div class='table100'>";
                      echo "<h2> Transaction Details </h2>\n";
                      echo "<table>\n";
                      echo "<thead> <tr class='table100-head'>
                            <td class='column2'>Transaction ID</td>
                            <td class='column2'>Username </td>
                            <td class='column2'>Name </td>
                            <td class='column3'>Cycle Reg. No.</td>
                            <td class='column2'>Owner Username </td>
                            <td class='column4'>Start Date</td>
                            <td class='column5'>End Date</td>
                            <td class='column6'>Amount</td>
                            <td class='column7'>Reward</td>
                            <td class='column8'>Cycle Rating</td>
                            <td class='column8'>User Rating</td>
                            </tr> </thead> \n";

                      echo "<tbody>\n";
                      $id = 1;
                      while ($row = mysqli_fetch_assoc($result)){

                        $query2 = "select * from user_ where username = '".$row['username']."';";
                        $result2 = mysqli_query($con,$query2);
                        $row2 = mysqli_fetch_assoc($result2);

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

                        $c_rating = $row['cycle_rating'];
                        if($c_rating == null){
                          $c_rating = "NA";
                        }

                        $u_rating = $row['user_rating'];
                        if($u_rating == null){
                          $u_rating = "NA";
                        }

                        echo "<tr>
                            <td class='column2'>".$row["transaction_id"]."</td>
                            <td class='column2'>".$row["username"]."</td>
                            <td class='column2'>".$row2["first_name"]." ".$row2["last_name"]."</td>
                            <td class='column3'>".$row["reg_no"]."</td>
                            <td class='column3'>".$row["owner"]."</td>
                            <td class='column4'>".$row["start_date"]."</td>
                            <td class='column5'>".$row["end_date"]."</td>
                            <td class='column6'>".$total."</td>
                            <td class='column7'>".$reward."</td>
                            <td class='column8'>".$c_rating."</td>
                            <td class='column8'>".$u_rating."</td>

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