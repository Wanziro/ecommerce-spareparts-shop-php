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
    <!-- body -->
    <?php if (isset($_GET['vehicle']) && isset($_GET['model']) && isset($_GET['mark'])) {
      $vehicle = $_GET['vehicle'];
      $model = $_GET['model'];
      $mark = $_GET['mark'];
    ?>
      <div class="find-main-container body-contents-wrapper">
        <div class="find-container" style="background-image: url(images/uploads/<?php get_mark_logo($mark); ?>)">
        </div>
        <div class="find-contents">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <img src="images/uploads/<?php get_mark_logo($mark); ?>" class="w-100">
              </div>
              <div class="col-md-6">
                <div class="mt-20">
                  <h2 class="text-white transparent-bg px-2 mb-20">Complete The Search For <?php echo "$mark / $model " ?></h2>
                  <div class="option-container">
                    <select id="modelFuelType" onchange="getEngineTypes('<?php echo $vehicle; ?>','<?php echo $mark; ?>','<?php echo $model; ?>')">
                      <?php get_all_fuels($vehicle, $mark, $model); ?>
                    </select>
                    <div class="select-number">1</div>
                  </div>
                  <div class="option-container">
                    <select id="modelEngineType" onchange="getModels('<?php echo $vehicle; ?>','<?php echo $mark; ?>','<?php echo $model; ?>')">
                    </select>
                    <div class="select-number">2</div>
                  </div>
                  <div class="option-container">
                    <select id="modelCategory" onchange="enableSearchParts()">
                    </select>
                    <div class="select-number">3</div>
                  </div>
                  <button onclick="searchParts('<?php echo $vehicle; ?>','<?php echo $mark; ?>','<?php echo $model; ?>')" class='btn text-white dark-bg2 w-100' disabled id="searchParts">Search</button>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

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