<?php
$msg = '';
include "admin_protect.php";
include "fxs.php";

if (isset($_POST['save'])) {
    $folder = "../images/uploads/car_renting/";
    $name = $_POST['car_name'];
    $seats_number = $_POST['seats_number'];
    $doors = $_POST['doors'];
    $type = $_POST['type'];
    $price = $_POST['price'];

    //image_upload
    $image_upload = $_FILES['image_upload']['name'];
    $image_upload_loc = $_FILES['image_upload']['tmp_name'];
    $image_upload_size = $_FILES['image_upload']['size'];
    $image_upload_type = $_FILES['image_upload']['type'];
    $temp1 = explode(".", $_FILES["image_upload"]["name"]);
    $newfn1 = round(microtime(true)) . '.' . end($temp1);

    //file size in KB
    $image_upload_file_size = $image_upload_size / 1024;

    // make file name in lower case
    $new_file_name1 = strtolower($newfn1);
    $new_file1 = strtolower($image_upload);
    // make file name in lower case
    $random_image_upload = str_replace(' ', '-', $new_file_name1);

    if ($name != '' && $price != "" && $type != "") {
        if (!check_image_format($image_upload_type)) {
            $msg = "<div class='alert alert-danger'>Invalid file type. supported file types are .gif, .png and .jpg</div>";
        } else {
            if (move_uploaded_file($image_upload_loc, $folder . $random_image_upload)) {
                $sql = "INSERT INTO cars_for_renting(car_name,doors,seats,type,price,image1) 
                VALUES (?,?,?,?,?,?)";
                $statement = $conn->prepare($sql);
                $statement->execute(array($name, $doors, $seats_number, $type, $price, $random_image_upload));
                $msg = '';
                header("location: cars_for_renting.php");
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
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Register new car for renting</h6>
                                </div>
                                <div class="card-body">
                                    <?php echo $msg; ?>
                                    <form method="post" action="#" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Car name</label>
                                            <input type="text" placeholder="Enter car name" name="car_name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Number of seats</label>
                                            <input type="number" placeholder="Enter number of seats" name="seats_number" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Doors</label>
                                            <input type="number" placeholder="Enter number of doors" name="doors" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="type" required class="form-control">
                                                <option value="">Select type</option>
                                                <option value="automatic">Automatic</option>
                                                <option value="manual">Manual</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Price per day</label>
                                            <input type="number" name="price" placeholder="Enter price in RWF" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image_upload" class="form-control" required>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="save" class="btn btn-primary">Save car</button>
                                        </div>
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