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
    $folder = "../images/uploads/";
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
    //image_upload
    $image_upload = $_FILES['image_upload']['name'];
    $image_upload_loc = $_FILES['image_upload']['tmp_name'];
    $image_upload_size = $_FILES['image_upload']['size'];
    $image_upload_type = $_FILES['image_upload']['type'];
    $temp1 = explode(".", $_FILES["image_upload"]["name"]);
    $newfn1 = round(microtime(true)) . end($temp1);

    //file size in KB
    $image_upload_file_size = $image_upload_size / 1024;

    // make file name in lower case
    $new_file_name1 = strtolower($newfn1);
    $new_file1 = strtolower($image_upload);
    // make file name in lower case
    $random_image_upload = str_replace(' ', '-', $new_file_name1);

    if ($name != '' && $category != "" && $mark != "") {
        if (check_if_vehicle_exists($name, $category, $mark, $model, $fuel, $engine, $s_category)) {
            $msg = "<div class='alert alert-danger'>Spare part '$name' already exists. Try to register other new products or update its values.</div>";
        } else if (!check_image_format($image_upload_type)) {
            $msg = "<div class='alert alert-danger'>Invalid file type. supported file types are .gif, .png and .jpg</div>";
        } else {
            if (move_uploaded_file($image_upload_loc, $folder . $random_image_upload)) {
                $sql = "INSERT INTO spare_parts(name,spare_part_category,vehicle_category,vehicle_mark,vehicle_model,fuel,engine,part_number,quantity,price,image,shop_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $statement = $conn->prepare($sql);
                $statement->execute(array($name, $s_category, $category, $mark, $model, $fuel, $engine, $part_number, $quantity, $price, $random_image_upload, $shop_id));
                $msg = '';
            } else {
                $msg = "<div class='alert alert-danger'>Failed to upload your image. try again later.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>All field are required!.</div>";
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
                        if (isset($_GET['shop_id'])) {
                            $shop_id = $_GET['shop_id'];
                            $sql = "SELECT * FROM spare_parts where shop_id='$shop_id' ORDER BY id DESC";
                            $statement = $conn->query($sql);
                            if ($statement->rowCount() > 0) {
                        ?>
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
                                    <div class="col-md-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary"><?php echo $name; ?></h6>
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <img src="../images/uploads/<?php echo $image; ?>" alt="" style="display:block;margin: 0px auto; max-height: 200px;">
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><b>Category</b></td>
                                                        <td><?php echo $s_category; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Vehicle</b></td>
                                                        <td><?php echo $category ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Mark</b></td>
                                                        <td><?php echo $mark; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Model</b></td>
                                                        <td><?php echo $model; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Engine</b></td>
                                                        <td><?php echo $engine; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Fuel</b></td>
                                                        <td><?php echo $fuel; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Number</b></td>
                                                        <td><?php echo $part_number; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Quantity</b></td>
                                                        <td><?php echo $quantity; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Price</b></td>
                                                        <td><?php echo $price; ?> RWF</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Shop ID</b></td>
                                                        <td><?php echo $shop_id; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Shop name</b></td>
                                                        <td><?php echo get_shop_name($shop_id); ?></td>
                                                    </tr>
                                                </table>
                                                <a href="edit_part.php?edit=<?php echo $id; ?>">
                                                    <button class='btn btn-primary mb-2 w-100'><i class='fa fa-edit'></i> Edit</button>
                                                </a>
                                                <a href="manage.php?product=<?php echo $id; ?>">
                                                    <button class='btn btn-success mb-2 w-100'><i class='fa fa-circle'></i> Manage desciption</button>
                                                </a>
                                                <a href="spare_parts.php?delete=<?php echo $id; ?>" onclick="return confirm('Do want to delete this spare part?')">
                                                    <button class='btn btn-danger w-100'><i class='fa fa-delete'></i> Delete</button>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                </table>


                        <?php
                            } else {
                                echo '<div class="col-xl-12 col-lg-12"><h2>No Spare parts Found</h2><br></div>';
                            }
                        }
                        ?>
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