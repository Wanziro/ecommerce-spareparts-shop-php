<?php include "connect.php";
include "fxs.php";
function get_spare_parts($category)
{
  include "connect.php";
  $sql = "SELECT DISTINCT name,image FROM spare_parts WHERE spare_part_category='$category'";
  $statement = $conn->query($sql);
  if ($statement->rowCount() > 0) {
?>
    <?php
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $name = $row['name'];
      $img = $row['image'];
    ?>
      <div class="col-md-2 mb-3">
        <div class="spare-part-container">
          <a href="./spare_part_from_category.php?category=<?php echo "$category"; ?>&item=<?php echo "$name"; ?>">
            <img src="./images/uploads/<?php echo "$img"; ?>" alt="<?php echo $name ?>">
          </a>
          <span><?php echo $name; ?></span>
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
</head>

<body>
  <div class="body-wrapper">
    <?php include "./header.php"; ?>
    <div class="body-contents-wrapper3">
      <!-- body -->
      <?php if (
        isset($_GET['vehicle']) &&
        isset($_GET['mark']) &&
        isset($_GET['model']) &&
        isset($_GET['fuel']) &&
        isset($_GET['engine']) &&
        isset($_GET['category'])
      ) {
        $vehicle = $_GET['vehicle'];
        $mark = $_GET['mark'];
        $model = $_GET['model'];
        $fuel = $_GET['fuel'];
        $engine = $_GET['engine'];
        $category = $_GET['category'];
        if (isset($_GET['filter'])) {
          $filter = $_GET['filter'];
        } else {
          $filter = 'name-az';
        }
      ?>
        <div class="container py-60">
          <div class="row">
            <div class="col-lg-3 order-lg-1 order-2">
              <?php include "sidebar.php"; ?>
            </div>
            <div class="col-lg-9 order-lg-2 order-1">
              <div class="indicators-container">
                <button class="indicator start"><?php echo $vehicle; ?></button>
                <button class="indicator middle"><?php echo $mark; ?></button>
                <button class="indicator middle"><?php echo $model; ?></button>
                <button class="indicator middle"><?php echo $fuel; ?></button>
                <button class="indicator middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $engine; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                <button class="indicator end"><?php echo $category; ?></button>
              </div>
              <?php get_start_here_spare_parts($vehicle, $mark, $model, $fuel, $engine, $category, $filter); ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <!-- body -->
    <?php include "footer.php"; ?>
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