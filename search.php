<?php include"connect.php";
include"fxs.php";
function get_spare_part_name($id){
  include"connect.php";
  $result = "INVALID";
  $sql = "SELECT DISTINCT * FROM spare_parts WHERE id='$id'";
  $statement = $conn->query($sql);
  if($statement->rowCount() > 0){
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $result = $row['name'];
    }
  }
  return $result;
}

function get_spare_parts($category,$word){
    include"connect.php";
    if($category != 'All'){
      $sql = "SELECT * FROM spare_parts where (name LIKE '%{$word}%' OR part_number LIKE '%{$word}%') AND spare_part_category='$category'";
    }else{
        $sql = "SELECT * FROM spare_parts where name LIKE '%{$word}%' OR part_number LIKE '%{$word}%'";
    }
    $statement = $conn->query($sql);
    $count = $statement->rowCount();
    if($count > 0){
      echo"<p style='color:#CCC'>Found $count result(s) for the search query</p>";
        ?>
        <?php
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $id = $row['id'];
            $name = $row['name'];
            $img = $row['image'];
            $v_mark = $row['vehicle_mark'];
            $v_model = $row['vehicle_model'];
            $fuel = $row['fuel'];
            $engine = $row['engine'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $description = $row['description'];
            $description = str_replace(">,",">",$description);
            save_search_keyword($name);
            ?>
            <div class="row mb-25 pb-25" style="border-bottom: 1px solid #CCC;">
                <div class="col-md-3">
                    <img src="./images/uploads/<?php echo"$img";?>" alt="<?php echo $name?>" class="w-100">
                </div>
                <div class="col-md-6">
                    <div class="item-container">
                        <div class="item-title-container">
                            <p class="title"><?php echo $name;?></p>
                            <p>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </p>
                        </div>
                        <p class="m-0">Basic Information for the spare part:</p>
                        <div class="product-info">
                            <p class="bold">Model</p>
                            <p><?php echo $v_model;?></p>
                        </div>
                        <div class="product-info">
                            <p class="bold">Mark</p>
                            <p><?php echo $v_mark;?></p>
                        </div>
                        <div class="product-info">
                            <p class="bold">Fuel</p>
                            <p><?php echo $fuel;?></p>
                        </div>
                        <div class="product-info">
                            <p class="bold">Engine</p>
                            <p><?php echo $engine;?></p>
                        </div>
                        <div class="product-info">
                            <p class="bold">Price</p>
                            <p>Rwf <?php echo $price;?></p>
                        </div>
                        <p class="bg-dark p-2 text-white m-0">Product Description:</p>
                        <div class="item-description">
                            <?php echo $description;?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="add-to-cart-container">
                      <h2 class="bg-dark text-white text-center">Add To Cart</h2>
                      <span>Sale</span>
                      <h2 class="dark-text"><?php echo numfmt_format_currency($fmt, $price, "RWF");?></h2>
                      <?php
                      if($quantity > 0){
                        ?>
                        <div class="in-stock">
                          <i class="fa fa-briefcase"></i>
                          <label>In Stock</label>
                        </div>
                        <?php
                      }else{
                        ?>
                        <div class="in-stock">
                          <i class="fa fa-briefcase"></i>
                          <label>Out Of Stock</label>
                        </div>
                        <?php
                      }
                      ?>
                      <div class="item-counter">
                        <div id="minusFor<?php echo $id;?>" onclick="handleMinus(<?php echo $id;?>)">-</div>
                        <div  id="itemNumberFor<?php echo $id;?>" style="width:100%">1</div>
                        <div  id="plusFor<?php echo $id;?>" onclick="handlePlus(<?php echo $id;?>,<?php echo $quantity;?>)">+</div>
                      </div>
                      <button onclick="addToCart(this,<?php echo $id;?>)">Add to cart</button>
                    </div>
                </div>
            </div>
            <?php
        }
    }else{
      echo"<h2>No Search Result Found</h2>";
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
      <?php if(isset($_GET['category']) && isset($_GET['q'])) {
        $category = $_GET['category'];
        $word = $_GET['q'];
        ?>
      <div class="product-area pt-10 pb-50">
        <div class="container">
        <div class="text-center dark-bg text-white py-2 mb-50">
            <h2> Search results for <?php echo $word;?></h2>
        </div>
            <?php get_spare_parts($category,$word);?>
        </div>
      </div>
      <?php } ?>

      <!-- body -->
      <?php include"footer.php";?>
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
