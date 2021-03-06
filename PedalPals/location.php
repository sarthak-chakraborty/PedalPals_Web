<?php
// include auth.php file on all secure pages
include("auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PedalPals: Add Location</title>
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
        /*min-height: 100vh;*/

        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        padding-right: 30px;
        height: 100%;
      }

      .wrap-table100 {
        width: 1000px;
      }

      table {
        border-spacing: 1;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        width: 100%;
        margin: 0 auto;
        position: relative;
        font-size: 15px;
        overflow: auto;
        height: 100px;
      }
      table td, table th {
        padding-left: 6px;
      }
      table thead tr {
        height: 50px;
        background: #5c768d;
        color: #FFF;
        position: relative;
      }
      table tbody tr {
        height: 40px;
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
        padding-left: 25px;
      }

      .column2 {
        width: 80px;
      }
      .column3 {
        width: 2px;
        padding-right: 5px;
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
        <i class="icofont-envelope"></i><a href="mailto:query@pedalpals.com">query@pedalpals.com</a>
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

  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel" >
        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active" style="background-image: url('assets/img/slide/slide-4.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <div>
                  <div style="float: left; width: 40%">
                    <div class="col-lg-12" align="center">
                    <h2 class="animated fadeInDown">Locations</h2>
                    <h6 style='color: white'>Note: Deleting a location will de-register all the cycles operating from that location.</h6>
                     <?php
                        require_once 'forms/dbconnect.php';

                        $query = "SELECT * FROM location ;";
                        $result = mysqli_query($con, $query);
                        $numResults = mysqli_num_rows($result);

                        echo "<div class='container-table100'>\n";
                        echo "<div class='wrap-table100'>\n";
                        echo "<div class='table100 table-wrapper'>";
                        echo "<table>\n";
                        echo "<thead> <tr class='table100-head'> 
                              <th class='column1'>Sl. No.</th>
                              <th class='column2'>Location Name</th>
                              <th class='column3'></th>
                              </tr> </thead> \n";

                        echo "<tbody>\n";
                        $id = 1;
                        while ($row = mysqli_fetch_assoc($result)){
                          echo "<tr>
                              <td class='column1'>".$id."</td>
                              <td class='column2'>".$row["name"]."</td>
                              <td class='column3'><a title='Remove' href='forms/remove_location.php?name=".$row['name']."'><i class='icofont-ui-delete' style='color: rgb(255,0,0)'></i></a></td>
                              </tr>\n";

                          $id++;
                        }
                        echo "</tbody>\n";
                        echo "</table>\n";
                        echo "</div>\n </div>\n </div>";

                        mysqli_close($con);
                      ?>
                    </div>
                  </div>
                  <div style="float: right; width: 60%; padding-left: 15px; padding-right: 15px;">
                    <div align="center">
                    <h2 class="animated fadeInDown"> Add Location </h2>
                     <h6 style='color: white'> Refresh page to view updated table </h6>
                      <form action="forms/location.php" method="post" role="form" class="php-email-form">
                        <div class="form-row" style="width: 50%">
                          <div class="col-lg-12 form-group">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" />
                            <div class="validate"></div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <div class="loading"></div>
                          <div class="error-message"></div>
                          <div class="sent-message"></div>
                        </div>
                          <div class="text-center" style="width: 50%"><button type="submit" class="btn-get-started animated scrollto">Add</button></div>
                       </form>
                     </div>
                  </div>
                </div>             
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