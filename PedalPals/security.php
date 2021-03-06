<?php
//include auth.php file on all secure pages
include("auth.php");

$username =  $_SESSION['username'];
require_once 'forms/dbconnect.php';

$query="select * from user_ where username='$username'";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);

$query1="select number from mobilenumber where username='$username'";
$result1 = mysqli_query($con, $query1);
$numResults = mysqli_num_rows($result1);
$row1=mysqli_fetch_array($result1);
if($numResults==2) $row2=mysqli_fetch_array($result1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Security </title>
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
            width: 280px;
        }
        .login_btn2 {
            color: white;
            background-color: #6666FF;
            width: 150px;
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
          <li class="active"><a href="profile.html">Profile</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>

  </header><!-- End Header -->
  

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container bootstrap snippets">
        <div class="row">
            <div class="col-xs-12 col-sm-9">
                <form class="form-horizontal" action="forms/update_security_qa.php" method="post" role="form" class="php-email-form">
                    <p style="color: #000000" id="msg"></p>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Security Question and Answer</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Security Question</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="securityq" name="securityq" value=" <?php echo $row['securityq']; ?>" placeholder="Security Question" data-rule="required" data-msg="Please enter security question." />
                                    <div class="validate"></div>
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-sm-2 control-label">Security Answer</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="securityans" name="securityans" placeholder="Security Answer" data-rule="required" data-msg="Please enter security answer." />
                                     <div class="validate"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Current password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="current" name="current" placeholder="Password" data-rule="minlen:4" data-msg="Please enter at least 4 characters" />
                                    <div class="validate"></div>
                                </div>
                            </div>
                                                        
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <button type="submit" class="btn login_btn">Update Security Question and Answer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container bootstrap snippets">
        <div class="row">
            <div class="col-xs-12 col-sm-9">
                <form class="form-horizontal" action="forms/update_passw.php" method="post" role="form" class="php-email-form">
                    <p style="color: #000000" id="msg"></p>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Change Password</h4>
                        </div>
                        <div class="panel-body">

                             <div class="form-group">
                                <label class="col-sm-2 control-label">Current password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="current" name="current">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">New password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="new" name="new">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Retype New password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="renew" name="renew">
                                </div>
                            </div>
        

                                                       
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <button type="submit" class="btn login_btn2">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
    