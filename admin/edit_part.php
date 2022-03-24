<?php
$msg = '';
include "admin_protect.php";
include "fxs.php";
function get_old_vehicle_name($id)
{
  include "admin_protect.php";
  $sql = "SELECT * FROM vehicle_categories WHERE id='$id'";
  $statement = $conn->query($sql);
  $result = '';
  if ($statement->rowCount() == 1) {
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $result = $row['name'];
    }
  }
  return $result;
}
function check_if_vehicle_exists($name)
{
  include "admin_protect.php";
  $sql = "SELECT * FROM vehicle_categories WHERE name='$name'";
  $statement = $conn->query($sql);
  $amount = 0;
  if ($statement->rowCount() == 1) {
    return true;
  } else {
    return false;
  }
}
if (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $name = $_POST['names'];
  $category = $_POST['v_category'];
  $s_category = $_POST['s_category'];
  $mark = $_POST['mark'];
  $model = $_POST['model'];
  $fuel = $_POST['fuel'];
  $engine = $_POST['engine'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $part_number = $_POST['part_number'];
  $shop_id = $_POST['shop_id'];

  $oldName = get_old_vehicle_name($id);
  if (check_if_vehicle_exists($name)) {
    $msg = "<div class='alert alert-danger'>The name already exists. try to edit with different vehicle name </div>";
  } else if ($name == '' || $id == '') {
    $msg = "<div class='alert alert-danger'>Please provide the vehicle name</div>";
  } else {
    //update the data
    $up = "UPDATE spare_parts SET name='$name',shop_id='$shop_id', spare_part_category='$s_category',vehicle_category='$category',vehicle_mark='$mark',vehicle_model='$model',fuel='$fuel',engine='$engine',part_number='$part_number',quantity='$quantity',price='$price' WHERE id = '$id'";
    $statement = $conn->query($up);

    header("Location: spare_parts.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Auto experts Rwanda</title>

  <!-- <link rel="stylesheet" href="../css/font-awesome.min.css" /> -->
  <link href="../css/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../css/admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include "sidebar.php"; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include "header.php"; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Content Row -->
          <div class="row">

            <?php if (isset($_GET['edit'])) {
              $s = "SELECT * FROM spare_parts WHERE id=" . $_GET['edit'] . "";
              $stm = $conn->query($s);
              if ($stm->rowCount() > 0) {
                while (($row = $stm->fetch(PDO::FETCH_ASSOC)) !== false) {
                  $name = $row['name'];
                  $model = $row['vehicle_model'];
                  $mark = $row['vehicle_mark'];
                  $vehicle = $row['vehicle_category'];
                  $engine = $row['engine'];
                  $fuel = $row['fuel'];
                  $part_number = $row['part_number'];
                  $quantity = $row['quantity'];
                  $price = $row['price'];
                  $id = $row['id'];
                  $shop_id = $row['shop_id'];
            ?>
                  <div class="col-lg-12">
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vehicles / Edit / <?php echo $_GET['edit']; ?></h6>
                      </div>
                      <div class="card-body">
                        <?php echo $msg; ?>
                        <form method="post" action="#" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="<?php echo $name; ?>" name="names" class="form-control" placeholder="Enter fuel name" required>
                          </div>
                          <div class="form-group">
                            <label>Vehicle Category</label>
                            <select name="v_category" class="form-control" id="vCategory" onchange="getMarks(this)" required>
                              <?php get_all_vehicles(); ?>
                              <option value="<?php echo $vehicle ?>" selected><?php echo $vehicle ?></option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Vehicle Mark</label>
                            <select name="mark" id="allMarks" class="form-control" required onchange="getModels(this)"></select>
                          </div>
                          <div class="form-group">
                            <label>Vehicle Model</label>
                            <select name="model" id="allModels" onchange="getFuels(this)" class="form-control" required></select>
                          </div>

                          <div class="form-group">
                            <label>Fuel</label>
                            <select name="fuel" id="allFuels" onchange="getEngines(this)" class="form-control" required></select>
                          </div>

                          <div class="form-group">
                            <label>Engine type</label>
                            <select name="engine" id="allEngines" onchange="getCats(this)" class="form-control" required></select>
                          </div>
                          <div class="form-group">
                            <label>Spare part category</label>
                            <select name="s_category" id="allCategories" class="form-control" required></select>
                          </div>
                          <div class="form-group">
                            <label>Part Number</label>
                            <input class="form-control" type="text" name="part_number" value="<?php echo $part_number; ?>">
                          </div>
                          <div class="form-group">
                            <label>Quantity</label>
                            <input class="form-control" type="text" name="quantity" value="<?php echo $quantity; ?>">
                          </div>
                          <div class="form-group">
                            <label>Price</label>
                            <input class="form-control" type="text" name="price" value="<?php echo $price; ?>">
                          </div>
                          <div class="form-group">
                            <label>Select Shop</label>
                            <select name="shop_id" class="form-control" required>
                              <option value="<?php echo $shop_id ?>"><?php echo get_shop_name($shop_id) ?></option>
                              <?php
                              $sql = mysqli_query($conn2, "SELECT * FROM shops order by name asc");
                              if (mysqli_num_rows($sql) > 0) {
                                while ($row = mysqli_fetch_assoc($sql)) {
                              ?>
                                  <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                          <button type="submit" name="edit" class="btn btn-primary">Submit changes</button>
                        </form>
                      </div>
                    </div>

                  </div>
                  <!--col-->

              <?php
                }
              } else {
                echo "Vehicle with id of " . $_GET['edit'] . " does not exist.";
              }
              ?>
            <?php
            } ?>
          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

      </div>

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <script src="../js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script src="../js/jquery.easing.min.js"></script>
    <script src="../js/admin.js"></script>
    <script>
      $(document).ready(() => {
        setTimeout(() => {
          getMarks(document.getElementById("vCategory"));
          setTimeout(() => {
            $.ajax({
              url: "../ajax.php",
              method: "POST",
              data: {
                getVehicleModels: 1,
                vehicleMark: $("#allMarks").val(),
                vehicle: $("#vCategory").val()
              },
              success: data => {
                $("#allModels").html(data)
              }
            });
          }, 500);
        }, 1000)
      })

      function getMarks(v) {
        $.ajax({
          url: "../ajax.php",
          method: "POST",
          data: {
            getVehicleMarks: 1,
            vehicle: v.value
          },
          success: data => {
            $("#allMarks").html(data)
          }
        })
      }

      function getModels(v) {
        $.ajax({
          url: "../ajax.php",
          method: "POST",
          data: {
            getVehicleModels: 1,
            vehicleMark: v.value,
            vehicle: $("#vCategory").val()
          },
          success: data => {
            $("#allModels").html(data)
          }
        })
      }

      function getFuels(v) {
        $.ajax({
          url: "../ajax.php",
          method: "POST",
          data: {
            getVehicleFuels: 1,
            vehicleModel: v.value,
            vehicleMark: $("#allMarks").val(),
            vehicle: $("#vCategory").val()
          },
          success: data => {
            $("#allFuels").html(data)
          }
        })
      }

      function getEngines(v) {
        $.ajax({
          url: "../ajax.php",
          method: "POST",
          data: {
            getVehicleEngineType: 1,
            vehicleFuel: v.value,
            vehicleModel: $("#allModels").val(),
            vehicleMark: $("#allMarks").val(),
            vehicle: $("#vCategory").val()
          },
          success: data => {
            $("#allEngines").html(data)
          }
        })
      }

      function getCats(v) {
        $.ajax({
          url: "../ajax.php",
          method: "POST",
          data: {
            getVehicleSpCat: 1,
            admin: 1,
            engine: v.value,
            vehicleFuel: $("#allFuels").val(),
            vehicleModel: $("#allModels").val(),
            vehicleMark: $("#allMarks").val(),
            vehicle: $("#vCategory").val()
          },
          success: data => {
            $("#allCategories").html(data)
          }
        })
      }
    </script>

</body>

</html>