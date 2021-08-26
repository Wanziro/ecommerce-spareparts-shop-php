<?php include"connect.php";
include"fxs.php";
function get_spare_parts($category){
    include"connect.php";
    $sql = "SELECT DISTINCT name,image FROM spare_parts WHERE spare_part_category='$category'";
    $statement = $conn->query($sql);
    if($statement->rowCount() > 0){
        ?>
        <?php
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $name = $row['name'];
            $img = $row['image'];
            ?>
            <div class="col-md-2 mb-3">
                <div class="spare-part-container">
                    <a href="./spare_part_from_category.php?category=<?php echo"$category";?>&item=<?php echo"$name";?>">
                        <img src="./images/uploads/<?php echo"$img";?>" alt="<?php echo $name?>">
                    </a>
                    <span><?php echo $name;?></span>
                </div>
            </div>
            <?php
        }
    }
}
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
      <?php include"./header.php";?>
      <!-- body -->
      <?php if(isset($_GET['category'])) {
        $category = $_GET['category'];
        ?>
      <div class="product-area pt-10 pb-50">
        <div class="container">
        <div class="indicators-container">
            <button class="indicator start">Spare Parts</button>
            <button class="indicator middle"><?php echo $category ?></button>
        </div>
          <div class="row">
            <?php get_spare_parts($category);?>
          </div>
        </div>
      </div>
      <?php }?>

      <!-- body -->
      <?php include"footer.php";?>
      </div>
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
