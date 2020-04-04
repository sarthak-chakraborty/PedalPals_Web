                
<?php
//include auth.php file on all secure pages
include("auth.php");

$username =  $_SESSION['username'];
require_once 'forms/dbconnect.php';

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$reg_no = $_GET["reg_no"];

$query = "select * from cycle where reg_no = $reg_no and username='$username';";
$result = mysqli_query($con,$query);
$numResults = mysqli_num_rows($result);
if($numResults==0){
  echo "<br><h5><font color='white'>Cannot Edit Entry. Unauthorised. </font></h5>";
  header("Location: ../manage_cycles.php");
} 
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Cycle Details </title>
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
      background: #ccccff;
      border: none;
      outline: none;
      display: inline-block;
      -webkit-appearance:none;
      -moz-appearance: none;
      appearance: none;
      cursor: pointer;
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
          <li><a href="profile.html">Profile</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>

  </header><!-- End Header -->
  

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container bootstrap snippets">
        <div class="row">
            <div class="col-xs-12 col-sm-9">
              <?php
                echo "<form class='form-horizontal' action='forms/update_cycle.php?reg_no=".$reg_no."'  method='post' role='form' class='php-email-form'>";
                ?>
                    <p style="color: #000000" id="msg"></p>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Cycle Details</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Registration ID </label>
                                <div class="col-sm-10">
                                  <br> <?php echo strval($reg_no); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Model</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="model" name="model" value=" <?php echo $row['model']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Colour</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="color" name="color" value=" <?php echo $row['color']; ?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Has Carrier?</label>
                                <div class="col-sm-10">
                                    <div class="sel sel--black-panther">

                                    <select id="hascarrier" name="hascarrier"> 
                                      <option value="">Has Carrier?</option>
                                      <?php if(strcmp($row['hasCarrier'],"y")==0) 
                                      echo " <option value='y' selected> Yes </option>
                                      <option value='n'> No </option> ";
                                      else
                                        echo "<option value='y' > Yes </option>
                                      <option value='n' selected> No </option> ";
                                      ?>                  
                                    </select>
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-10">
                                    <div class="sel sel--black-panther">

                                    <select id="location" name="location"> 
                                      <option value="">Select Location...</option>
                                      <?php $query = "select * from location;";
                                        $result = mysqli_query($con, $query);
                                        $numResults = mysqli_num_rows($result);

                                        while($locrow = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                          if(strcmp($locrow['name'],$row['location_name'])==0)
                                            echo "<option value='$locrow[name]' selected> $locrow[name]</option>";
                                          else 
                                            echo "<option value='$locrow[name]'> $locrow[name]</option>";
                                           }
                                      ?>                  
                                    </select>
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Cycle Condition and Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" id="description" rows="5" data-rule="required" data-msg="Mention cycle condition" maxlength=50> <?php echo $row['cycle_condition']; ?> </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Registration Type?</label>
                                <div class="col-sm-10">
                                    <div class="sel sel--black-panther">

                                    <select id="reg_type" name="reg_type"> 
                                      <option value="">Select Reg. Type...</option>
                                      <?php if(strcmp($row['reg_type'],"r")==0) 
                                      echo " <option value='r' selected> Rental </option>
                                      <option value='s'> Selling </option> 
                                      <option value='o'> Other </option>";
                                      else if(strcmp($row['reg_type'],"s")==0)
                                        echo "<option value='r' > Rental </option>
                                      <option value='s' selected> Selling </option> 
                                      <option value='o'> Other </option>";
                                      else 
                                      	echo "<option value='r' > Rental </option>
                                      <option value='s'> Selling </option> 
                                      <option value='o' selected> Other </option>";
                                      ?>                  
                                    </select>
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Price of cycle (for selling) or per day (for rental) in Rs.</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="price" name="price" value=" <?php echo $row['price']; ?>">
                                </div>
                            </div>
                             <div class="mb-3">
                            <div class="loading"></div>
                            <div class="error-message"></div>
                            <div class="sent-message"></div>
                          </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <button type="submit" class="btn login_btn">Update</button>
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