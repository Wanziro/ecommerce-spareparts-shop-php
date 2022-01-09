<?php
include "connect.php";
include "fxs.php";
?>
<!DOCTYPE html>
<html class="no-js">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>eCommerce Project</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="css/material-design-iconic-font.min.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/fontawesome-stars.css" />
  <link rel="stylesheet" href="css/meanmenu.css" />
  <link rel="stylesheet" href="css/owl.carousel.min.css" />
  <link rel="stylesheet" href="css/slick.css" />
  <link rel="stylesheet" href="css/animate.css" />
  <link rel="stylesheet" href="css/jquery-ui.min.css" />
  <link rel="stylesheet" href="css/venobox.css" />
  <link rel="stylesheet" href="css/nice-select.css" />
  <link rel="stylesheet" href="css/magnific-popup.css" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/helper.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
  <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
  <div class="body-wrapper">
    <?php include "./header.php"; ?>
    <?php include("top_video_banner.php"); ?>
    <div id="bodyContents">
      <div class="slider-with-banner">
        <div class="container">
          <div class="row">
            <!-- Begin Slider Area -->
            <div class="col-lg-8 col-md-8">
              <div class="slider-area">
                <div class="slider-active owl-carousel">
                  <!-- Begin Single Slide Area -->
                  <div class="
                      single-slide
                      align-center-left
                      animation-style-01
                      bg-1
                    ">
                    <div class="slider-progress"></div>
                    <div class="slider-content">
                      <h5 class="bg-transparent">
                        Quality <span>100%</span> Don't Miss!!
                      </h5>
                      <h2 class="bg-transparent">
                        Moto Bike Spare parts From Europe
                      </h2>
                      <h3 class="bg-transparent">
                        Starting at <span>Rwf 10,000</span>
                      </h3>
                      <div class="default-btn slide-btn">
                        <a class="links" href="#">Shop Now</a>
                      </div>
                    </div>
                  </div>
                  <!-- Single Slide Area End Here -->
                  <!-- Begin Single Slide Area -->
                  <div class="
                      single-slide
                      align-center-left
                      animation-style-02
                      bg-2
                    ">
                    <div class="slider-progress"></div>
                    <div class="slider-content">
                      <h5 class="bg-transparent">
                        Sale Offer <span>Original</span> This Week
                      </h5>
                      <h2 class="bg-transparent">
                        All Kinds and model of trucks
                      </h2>
                      <h3 class="bg-transparent">
                        Get your truck's spare parts <span>NOW!!!</span>
                      </h3>
                      <div class="default-btn slide-btn">
                        <a class="links" href="#">Shop Now</a>
                      </div>
                    </div>
                  </div>
                  <!-- Single Slide Area End Here -->
                  <!-- Begin Single Slide Area -->
                  <div class="
                      single-slide
                      align-center-left
                      animation-style-01
                      bg-3
                    ">
                    <div class="slider-progress"></div>
                    <div class="slider-content">
                      <h5 class="bg-transparent">
                        Gurantee of <span>1 Month</span> / item
                      </h5>
                      <h2 class="bg-transparent">All Season Tyre</h2>
                      <h3 class="bg-transparent">
                        Starting at <span>RWF 50,000</span>
                      </h3>
                      <div class="default-btn slide-btn">
                        <a class="links" href="#">Shop Now</a>
                      </div>
                    </div>
                  </div>
                  <!-- Single Slide Area End Here -->
                  <!-- Begin Single Slide Area -->
                  <div class="
                      single-slide
                      align-center-left
                      animation-style-01
                      bg-33
                    ">
                    <div class="slider-progress"></div>
                    <div class="slider-content">
                      <h5 class="bg-transparent">
                        Upgrade your tyres from a <span>trusted</span> Company
                      </h5>
                      <h2 class="bg-transparent">All Season + Winter</h2>
                      <h3 class="bg-transparent">
                        Starting at <span>RWF 40,0000</span>
                      </h3>
                      <div class="default-btn slide-btn">
                        <a class="links" href="#">Shop Now</a>
                      </div>
                    </div>
                  </div>
                  <!-- Single Slide Area End Here -->
                </div>
              </div>
            </div>
            <!-- Slider Area End Here -->
            <!-- Begin Li Banner Area -->
            <div class="col-lg-4 col-md-4 text-center pt-xs-30">
              <div class="li-banner">
                <div class="start-here py-3">
                  <h2>Start Here</h2>
                  <div class="row">
                    <div class="col">
                      <span>Vehicle</span>
                      <select id="startHereVehicle" class="form-control">
                        <?php get_all_vehicles(); ?>
                      </select>
                    </div>
                    <div class="col">
                      <span>Mark</span>
                      <select id="startHereMark" class="form-control">
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <span>Model</span>
                      <select id="startHereModel" class="form-control">
                      </select>
                    </div>
                    <div class="col">
                      <span>Fuel</span>
                      <select id="startHereFuel" class="form-control">
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <span>Engine Type</span>
                      <select id="startHereEngineType" class="form-control">
                      </select>
                    </div>
                    <div class="col">
                      <span>Spare Part Category</span>
                      <select id="startHereCategory" class="form-control">
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Li Banner Area End Here -->
          </div>
        </div>
      </div>
      <!-- Slider With Banner Area End Here -->
      <!-- body -->
      <div class="product-area pt-60 pb-50">
        <div class="container">
          <div class="text-center dark-bg text-white py-2 mb-50">
            <h2>Spare Parts Categories</h2>
          </div>
          <div class="row">
            <?php include "./includes/spare_parts_categories.php"; ?>
          </div>
          <!-- product lists -->
          <?php
          $sql = "SELECT * FROM vehicle_categories";
          $statement = $conn->query($sql);
          if ($statement->rowCount() > 0) {
            while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
              vehicle_trendings($row['name']);
            }
          }
          ?>
          <!-- product lists -->
        </div>
      </div>

    </div><!-- Body contents end here! -->

    <?php include "footer.php"; ?>
  </div>
  <div class="ldl-mdl d-none" id="ldlMdl">
    <div class="ldl-mdl-contents"><img src="images/loader-double.svg" alt=""></div>
  </div>
  <script src="js/vendor/jquery-1.12.4.min.js"></script>
  <script src="js/vendor/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/ajax-mail.js"></script>
  <script src="js/jquery.meanmenu.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/imagesloaded.pkgd.min.js"></script>
  <script src="js/jquery.mixitup.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/jquery.barrating.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/venobox.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/scrollUp.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>