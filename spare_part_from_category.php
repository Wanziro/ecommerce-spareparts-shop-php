<?php include "connect.php";
include "fxs.php";

function get_spare_parts($category, $item, $filter, $s_id = 'xx')
{
  include "connect.php";
  if ($filter == 'name-az') {
    if ($s_id == 'xx') {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND name='$item' order by price asc";
    } else {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE id='$s_id' AND spare_part_category='$category' AND name='$item' order by price asc";
    }
  } else if ($filter == 'name-za') {
    if ($s_id == 'xx') {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND name='$item' order by name desc";
    } else {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE id='$s_id' AND spare_part_category='$category' AND name='$item' order by price desc";
    }
  } else if ($filter == 'price-lh') {
    if ($s_id == 'xx') {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND name='$item' order by price asc";
    } else {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE id='$s_id' AND spare_part_category='$category' AND name='$item' order by price asc";
    }
  } else if ($filter == 'price-hl') {
    if ($s_id == 'xx') {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND name='$item' order by price desc";
    } else {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE id='$s_id' AND spare_part_category='$category' AND name='$item' order by price desc";
    }
  } else if ($filter == 'ratings-l') {
    if ($s_id == 'xx') {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND name='$item' order by ratings asc";
    } else {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE id='$s_id' AND spare_part_category='$category' AND name='$item' order by ratings asc";
    }
  } else if ($filter == 'ratings-h') {
    if ($s_id == 'xx') {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND name='$item' order by ratings desc";
    } else {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE id='$s_id' AND spare_part_category='$category' AND name='$item' order by ratings desc";
    }
  } else {
    if ($s_id == 'xx') {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND name='$item' order by name asc";
    } else {
      $sql = "SELECT DISTINCT * FROM spare_parts WHERE id='$s_id' AND spare_part_category='$category' AND name='$item' order by name asc";
    }
  }
  $statement = $conn->query($sql);
  if ($statement->rowCount() > 0) {
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
      $description = str_replace(">,", ">", $description);
      increase_spare_part_views($id);
?>
      <div class="row mb-25 pb-25" style="border-bottom: 1px solid #CCC;">
        <div class="col-md-3">
          <img src="./images/uploads/<?php echo "$img"; ?>" alt="<?php echo $name ?>" class="w-100">
        </div>
        <div class="col-md-6">
          <div class="item-container">
            <div class="item-title-container">
              <p class="title"><?php echo $name; ?></p>
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
              <p><?php echo $v_model; ?></p>
            </div>
            <div class="product-info">
              <p class="bold">Mark</p>
              <p><?php echo $v_mark; ?></p>
            </div>
            <div class="product-info">
              <p class="bold">Fuel</p>
              <p><?php echo $fuel; ?></p>
            </div>
            <div class="product-info">
              <p class="bold">Engine</p>
              <p><?php echo $engine; ?></p>
            </div>
            <div class="product-info">
              <p class="bold">Price</p>
              <p>Rwf <?php echo $price; ?></p>
            </div>
            <p class="bg-dark p-2 text-white m-0">Product Description:</p>
            <div class="item-description">
              <?php echo $description; ?>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="add-to-cart-container">
            <h2 class="bg-dark text-white text-center">Add To Cart</h2>
            <span>Sale</span>
            <h2 class="dark-text"><?php echo numfmt_format_currency($fmt, $price, "RWF"); ?></h2>
            <?php
            if ($quantity > 0) {
            ?>
              <div class="in-stock">
                <i class="fa fa-briefcase"></i>
                <label>In Stock</label>
              </div>
            <?php
            } else {
            ?>
              <div class="in-stock">
                <i class="fa fa-briefcase"></i>
                <label>Out Of Stock</label>
              </div>
            <?php
            }
            ?>
            <div class="item-counter">
              <div id="minusFor<?php echo $id; ?>" onclick="handleMinus(<?php echo $id; ?>)">-</div>
              <div id="itemNumberFor<?php echo $id; ?>" style="width:100%">1</div>
              <div id="plusFor<?php echo $id; ?>" onclick="handlePlus(<?php echo $id; ?>,<?php echo $quantity; ?>)">+</div>
            </div>
            <button onclick="addToCart(this,<?php echo $id; ?>)">Add to cart</button>
          </div>
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
  <?php include "main_header.php"; ?>
  <style>
    .filters-disable .shop-top-bar {
      display: none !important;
    }
  </style>
</head>

<body>
  <div class="body-wrapper">
    <?php include "./header.php"; ?>
    <div class="body-contents-wrapper3">
      <?php if (isset($_GET['category']) && isset($_GET['item']) && !isset($_GET['s_id'])) {
        $category = $_GET['category'];
        $item = $_GET['item'];
        if (isset($_GET['filter'])) {
          $filter = $_GET['filter'];
        } else {
          $filter = 'name-az';
        }
      ?>
        <div class="product-area pt-10">
          <div class="container">
            <div class="row">
              <div class="col-lg-3 order-lg-1 order-2">
                <?php include "sidebar.php"; ?>
              </div>
              <div class="col-lg-9 order-lg-2 order-1">
                <div class="indicators-container">
                  <button class="indicator start">Spare Parts</button>
                  <button class="indicator middle"><?php echo $category ?></button>
                  <button class="indicator end"><?php echo $item ?></button>
                </div>
                <?php get_spare_parts($category, $item, $filter); ?>
                <!-- related parts from the same categories -->
                <?php
                if (isset($_GET['category']) && isset($_GET['item'])) {
                  $category = $_GET['category'];
                  if ($filter == 'name-az') {
                    $sql = "SELECT * FROM spare_parts WHERE spare_part_category='$category' and name != '" . $_GET['item'] . "' order by name asc";
                  } else if ($filter == 'name-za') {
                    $sql = "SELECT * FROM spare_parts WHERE spare_part_category='$category' and name != '" . $_GET['item'] . "' order by name desc";
                  } else if ($filter == 'price-lh') {
                    $sql = "SELECT * FROM spare_parts WHERE spare_part_category='$category' and name != '" . $_GET['item'] . "' order by price asc";
                  } else if ($filter == 'price-hl') {
                    $sql = "SELECT * FROM spare_parts WHERE spare_part_category='$category' and name != '" . $_GET['item'] . "' order by price desc";
                  } else if ($filter == 'ratings-l') {
                    $sql = "SELECT * FROM spare_parts WHERE spare_part_category='$category' and name != '" . $_GET['item'] . "' order by ratings asc";
                  } else if ($filter == 'ratings-h') {
                    $sql = "SELECT * FROM spare_parts WHERE spare_part_category='$category' and name != '" . $_GET['item'] . "' order by ratings desc";
                  } else {
                    $sql = "SELECT * FROM spare_parts WHERE spare_part_category='$category' and name != '" . $_GET['item'] . "' order by name asc";
                  }
                  $statement = $conn->query($sql);
                  if ($statement->rowCount() > 0) { ?>
                    <h2>Related parts</h2>
                    <div class="row">
                      <?php
                      while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $img = $row['image'];
                        $price = $row['price'];
                        $category = $row['spare_part_category'];
                      ?>
                        <div class="col-md-3">
                          <a href="spare_part_from_category.php?category=<?php echo $category ?>&item=<?php echo $name ?>">
                            <img src="images/uploads/<?php echo $img ?>" alt="<?php echo $name ?>" class="w-100">
                            <div class="text-center">
                              <p><?php echo $name ?></p>
                            </div>
                          </a>
                        </div>
                      <?php
                      }
                      ?>
                    </div>
                <?php
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      <?php } else if (isset($_GET['category']) && isset($_GET['item']) && isset($_GET['s_id'])) {
        $category = $_GET['category'];
        $item = $_GET['item'];
        $s_id = $_GET['s_id'];
        if (isset($_GET['filter'])) {
          $filter = $_GET['filter'];
        } else {
          $filter = 'name-az';
        }
      ?>
        <div class="product-area pt-10">
          <div class="container">
            <div class="indicators-container">
              <button class="indicator start">Spare Parts </button>
              <button class="indicator middle"><?php echo $category; ?></button>
              <a href="./spare_part_from_category.php?category=<?php echo "$category"; ?>&item=<?php echo "$item"; ?>">
                <button class="indicator middle" style="cursor:pointer"><?php echo $item; ?></button>
              </a>
              <button class="indicator end"><?php echo get_spare_part_name($s_id); ?></button>
            </div>
            <?php get_spare_parts($category, $item, $filter, $s_id); ?>
            <!-- get other part in the same category -->
            <?php
            $q = mysqli_query($conn2, "select * from spare_parts where spare_part_category='$category' and id !='$s_id' order by id desc limit 20");
            if (mysqli_num_rows($q) > 0) {
            ?>
              <div class="row pb-30">
                <div class="col-lg-3 order-lg-1 order-2">
                  <div class="filters-disable">
                    <?php include "sidebar.php"; ?>
                  </div>
                </div>
                <div class="col-lg-9 order-lg-2 order-1">
                  <h2 class="text-center p-1" style="background-color: #e1e1e1;">RELATED PRODUCTS</h2>
                  <div class="row py-4">
                    <?php
                    while ($row = mysqli_fetch_assoc($q)) {
                      $name = $row['name'];
                      $img = $row['image'];
                      $category = $row['spare_part_category'];
                      $part_number = $row['part_number'];
                      $product_id = $row['id'];
                      $price = $row['price'];
                    ?>
                      <div class="col-md-4">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap border">
                          <div class="product-image px-2">
                            <a href="spare_part_from_category.php?category=<?php echo $category ?>&item=<?php echo $name ?>&s_id=<?php echo $product_id ?>">
                              <img src="images/uploads/<?php echo $img ?>" alt="<?php echo $name ?>">
                            </a>
                          </div>
                          <div class="product_desc">
                            <div class="product_desc_info p-2">
                              <div class="product-review">
                                <h5 class="manufacturer">
                                  <a href="spare_part_from_category.php?category=<?php echo $category ?>&item=<?php echo $name ?>&s_id=<?php echo $product_id ?>"><?php echo $name ?></a>
                                </h5>
                                <div class="rating-box">
                                  <ul class="rating">
                                    <li><i><?php echo $part_number; ?></i>
                                  </ul>
                                </div>
                              </div>
                              <h4><a class="product_name" href="spare_part_from_category.php?category=<?php echo $category ?>"><?php echo $category ?></a></h4>
                              <div class="price-box">
                                <span class="new-price"><?php echo number_format($price) . ' RWF' ?></span>
                              </div>
                            </div>
                            <div class="add-actions">
                              <ul class="add-actions-link">
                                <li class="add-cart active w-100">
                                  <span style="cursor: pointer" onclick="addToCart(this, <?php echo $product_id; ?>)">Add to cart</span>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <!-- single-product-wrap end -->
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              <?php
            }
              ?>
              </div>
          </div>
        <?php } else if (isset($_GET['category'])) {
        $category = $_GET['category'];
        if (isset($_GET['filter'])) {
          $filter = $_GET['filter'];
        } else {
          $filter = 'name-az';
        }
        ?>
          <div class="container">
            <div class="row">
              <div class="col-lg-3 order-lg-1 order-2">
                <?php include "sidebar.php"; ?>
              </div>
              <div class="col-lg-9 order-lg-2 order-1">
                <div class="indicators-container">
                  <button class="indicator start">Spare Parts</button>
                  <button class="indicator middle"><?php echo $category ?></button>
                </div>
                <div class="mt-3">
                  <?php
                  // $sql = "SELECT DISTINCT name,image FROM spare_parts WHERE spare_part_category='$category'";
                  if ($filter == 'name-az') {
                    $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' order by name asc";
                  } else if ($filter == 'name-za') {
                    $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' order by name desc";
                  } else if ($filter == 'price-lh') {
                    $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' order by price asc";
                  } else if ($filter == 'price-hl') {
                    $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' order by price desc";
                  } else if ($filter == 'ratings-l') {
                    $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' order by ratings asc";
                  } else if ($filter == 'ratings-h') {
                    $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' order by ratings desc";
                  } else {
                    $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' order by name asc";
                  }
                  $statement = $conn->query($sql);
                  if ($statement->rowCount() > 0) {
                  ?>
                    <div class="row">
                      <?php
                      while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                        $name = $row['name'];
                        $price = $row['price'];
                        $img = $row['image'];
                      ?>
                        <div class="col-md-4 mb-3">
                          <div class="card bg-light">
                            <div class="card-body">
                              <a href="./spare_part_from_category.php?category=<?php echo "$category"; ?>&item=<?php echo "$name"; ?>">
                                <img src="./images/uploads/<?php echo "$img"; ?>" alt="<?php echo $name ?>" class="w-100">
                              </a>
                              <div class="mt-2">
                                <h4 style="font-size: 14px;"><?php echo $name; ?></h4 style="font-size: 14px;">
                                <h4 style="font-size: 14px;" class="text-danger"><?php echo number_format($price) . ' RWF'; ?></h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php
                      }
                      ?>
                    </div>
                  <?php
                  } else {
                    //no other products in the same category
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        <?php
      } ?>
        </div>
        <!-- body -->
        <?php include "footer.php"; ?>
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