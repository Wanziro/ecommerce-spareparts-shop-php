<?php
$msg = '';
include "admin_protect.php";
include "fxs.php";
function check_if_vehicle_exists($name, $category, $mark, $model, $fuel, $engine, $cat)
{
  include "admin_protect.php";
  $sql = "SELECT * FROM spare_parts WHERE name='$name' AND vehicle_category='$category' AND vehicle_mark='$mark' AND vehicle_model='$model' AND fuel='$fuel' AND engine='$engine' AND spare_part_category='$cat'";
  $statement = $conn->query($sql);
  if ($statement->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sqlx = "DELETE FROM spare_parts where id='$id'";
  $statementx = $conn->query($sqlx);
}
if (isset($_POST['save'])) {
  $name = $_POST['names'];
  $category = $_POST['v_category'];
  $mark = $_POST['mark'];
  $model = $_POST['model'];
  $fuel = $_POST['fuel'];
  $engine = $_POST['engine'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $part_number = $_POST['part_number'];
  $shop_id = $_POST['shop_id'];
  $s_category = $_POST['s_category'];

  if ($name != '' && $category != "" && $mark != "") {
    if (check_if_vehicle_exists($name, $category, $mark, $model, $fuel, $engine, $s_category)) {
      $msg = "<div class='alert alert-danger'>Spare part '$name' already exists. Try to register other new products or update its values.</div>";
    } else {
      $sql = "INSERT INTO spare_parts(name,spare_part_category,vehicle_category,vehicle_mark,vehicle_model,fuel,engine,part_number,quantity,price,image,shop_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
      $statement = $conn->prepare($sql);
      $statement->execute(array($name, $s_category, $category, $mark, $model, $fuel, $engine, $part_number, $quantity, $price, '', $shop_id));
      $msg = '';
    }
  } else {
    $msg = "<div class='alert alert-danger'>All fields are required!.</div>";
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
            <?php
            $sql = "SELECT * FROM spare_parts ORDER BY id DESC";
            $statement = $conn->query($sql);
            if ($statement->rowCount() > 0) {
            ?>
              <h2 class="text-dark"> All spare parts (<?php echo $statement->rowCount(); ?>)</h2>
              <div class="table-responsive">
                <table class="table">
                  <?php
                  while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $category = $row['vehicle_category'];
                    $model = $row['vehicle_model'];
                    $mark = $row['vehicle_mark'];
                    $fuel = $row['fuel'];
                    $engine = $row['engine'];
                    $s_category = $row['spare_part_category'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $image = $row['image'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $part_number = $row['part_number'];
                    $shop_id = $row['shop_id'];
                  ?>
                    <tr style="background-color:#f2f2f2" class="text-dark">
                      <td></td>
                      <td><b>Product name</b></td>
                      <td><b>Part category</b></td>
                      <td><b>Category</b></td>
                      <td><b>Mark</b></td>
                      <td><b>Model</b></td>
                      <td><b>Engine</b></td>
                      <td><b>Fuel</b></td>
                      <td><b>Part number</b></td>
                      <td><b>Quantity</b></td>
                      <td><b>Price</b></td>
                      <td><b>Shop ID</b></td>
                      <td>Shop name</td>
                    </tr>
                    <tr>
                      <td>
                        <div>
                          <img src="../images/uploads/<?php echo $image; ?>" alt="" style="width:80px">
                        </div>
                      </td>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $s_category; ?></td>
                      <td><?php echo $category ?></td>
                      <td><?php echo $mark; ?></td>
                      <td><?php echo $model; ?></td>
                      <td><?php echo $engine; ?></td>
                      <td><?php echo $fuel; ?></td>
                      <td><?php echo $part_number; ?></td>
                      <td><?php echo $quantity; ?></td>
                      <td><?php echo $price; ?> RWF</td>
                      <td><?php echo $shop_id; ?></td>
                      <td><?php echo get_shop_name($shop_id); ?></td>
                    </tr>
                    <tr>
                      <td colspan="13" align="right">
                        <a href="part_image.php?edit=<?php echo $id; ?>">
                          <button class='btn btn-primary'><i class='fa fa-image'></i></button>
                        </a>

                        <a href="edit_part.php?edit=<?php echo $id; ?>">
                          <button class='btn btn-primary'><i class='fa fa-edit'></i> Edit</button>
                        </a>

                        <a href="manage.php?product=<?php echo $id; ?>">
                          <button class='btn btn-success'>Description</button>
                        </a>

                        <a href="spare_parts.php?delete=<?php echo $id; ?>" onclick="return confirm('Do want to delete this spare part?')">
                          <button class='btn btn-danger'><i class='fa fa-delete'></i> Delete</button>
                        </a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </table>
              </div>
            <?php
            } else {
              echo '<div class="col-xl-12 col-lg-12"><h2>No Spare parts Found</h2><br></div>';
            }
            ?>

            <div class="col-lg-12">
              <div class="card shadow my-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Register New spare part</h6>
                </div>
                <div class="card-body">
                  <?php echo $msg; ?>
                  <form method="post" action="#" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="names" class="form-control" placeholder="Enter spare part name" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Vehicle Category</label>
                          <select name="v_category" class="form-control" id="vCategory" onchange="getMarks(this)" required>
                            <?php get_all_vehicles(); ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Vehicle Mark</label>
                          <select name="mark" id="allMarks" class="form-control" required onchange="getModels(this)"></select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Vehicle Model</label>
                          <select name="model" id="allModels" onchange="getFuels(this)" class="form-control" required></select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Fuel</label>
                          <select name="fuel" id="allFuels" onchange="getEngines(this)" class="form-control" required></select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Engine type</label>
                          <select name="engine" id="allEngines" onchange="getCats(this)" class="form-control" required></select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Spare part category</label>
                          <select name="s_category" id="allCategories" class="form-control" required></select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Quantity</label>
                          <input type="number" name="quantity" class="form-control" required></select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Price</label>
                          <input type="number" name="price" class="form-control" placeholder="Ex: 20000">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Part Number</label>
                          <input type="text" name="part_number" class="form-control" placeholder="Ex: 20000">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Select Shop</label>
                      <select name="shop_id" class="form-control" required>
                        <option value="">Choose</option>
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
                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>

            </div>
            <!--col-->
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