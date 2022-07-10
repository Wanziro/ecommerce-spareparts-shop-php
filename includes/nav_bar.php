<?php
function get_models($name, $vehicle_category)
{
  include "connect.php";
  if ($vehicle_category == 'cars') {
    $sql = "SELECT * FROM vehicle_model where vehicle_category='cars' AND vehicle_mark='$name'";
  } else if ($vehicle_category == 'Motocycles') {
    $sql = "SELECT * FROM vehicle_model where vehicle_category='Motocycles' AND vehicle_mark='$name'";
  } else {
    $sql = "SELECT * FROM vehicle_model where vehicle_category='trucks' AND vehicle_mark='$name'";
  }
  $statement = $conn->query($sql);
  if ($statement->rowCount() > 0) {
    echo '<ul class="hb-dropdown hb-sub-dropdown">';
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $name = $row['name'];
      $vehicle = $row['vehicle_category'];
      $vehicle_mark = $row['vehicle_mark'];
      echo '<li><a href="find.php?vehicle=' . $vehicle . '&mark=' . $vehicle_mark . '&model=' . $name . '">' . $name . '</a></li>';
    }
    echo '</ul>';
  }
}
?>
<div class="header-dynamic-bottom header-bottom d-none d-lg-block d-xl-block">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="hb-menu">
          <nav>
            <ul>
              <li class="no-content">
                <a href="index.php"><i class="fa fa-home"></i>&nbsp; Home</a>
              </li>
              <li class="dropdown-holder">
                <a href="#"><i class="fa fa-car"></i>&nbsp;Car Parts</a>

                <?php
                //get car marks and model
                $sql = 'SELECT * FROM vehicle_marks where vehicle_category="cars"';
                $statement = $conn->query($sql);

                if ($statement->rowCount() > 0) {
                ?>
                  <ul class="hb-dropdown">
                    <?php
                    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                      $name = $row['name'];
                    ?>
                      <li class="sub-dropdown-holder">
                        <a href="#"><?php echo "$name"; ?></a>
                      <?php
                      //get models
                      get_models($name, 'cars');
                      echo "</li>";
                    }
                      ?>
                  </ul>
                <?php
                }
                ?>
              </li>
              <li class="dropdown-holder">
                <a href="#"><i class="fa fa-truck"></i>&nbsp;Truck Parts</a>
                <?php
                //get car marks and model
                $sql = 'SELECT * FROM vehicle_marks where vehicle_category="trucks"';
                $statement = $conn->query($sql);

                if ($statement->rowCount() > 0) {
                ?>
                  <ul class="hb-dropdown">
                    <?php
                    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                      $name = $row['name'];
                    ?>
                      <li class="sub-dropdown-holder">
                        <a href="#"><?php echo "$name"; ?></a>
                      <?php
                      //get models
                      get_models($name, 'trucks');
                      echo "</li>";
                    }
                      ?>
                  </ul>
                <?php
                }
                ?>
              </li>
              <li class="no-content pl-30">
                <a href="car_renting.php">CAR renting</a>
              </li>
              <li class="no-content">
                <a href="about_us.php">About us</a>
              </li>
              <li class="no-content">
                <a href="contact_us.php">Contact us</a>
              </li>
              <li class="no-content">
                <a href="program/">
                  <div>program</div>
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <!-- Header Bottom Menu Area End Here -->
      </div>
    </div>
  </div>
</div>
<!-- Header Bottom Area End Here -->
<!-- Begin Mobile Menu Area -->
<div class="mobile-menu-area d-lg-none d-xl-none col-12">
  <div class="container">
    <div class="row">
      <div class="mobile-menu"></div>
    </div>
  </div>
</div>
<!-- Mobile Menu Area End Here -->