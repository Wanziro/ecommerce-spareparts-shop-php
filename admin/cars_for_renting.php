<?php
$msg = '';
include "admin_protect.php";
include "fxs.php";

if (isset($_GET['disable'])) {
    $id = $_GET['disable'];
    $sqlx = mysqli_query($conn2, "select * from cars_for_renting where id='$id'");
    if (mysqli_num_rows($sqlx)  == 1) {
        while ($r = mysqli_fetch_assoc($sqlx)) {
            $status = $r['status'];
            if ($status == 'enabled') {
                mysqli_query($conn2, "update cars_for_renting set status='disabled' where id='$id'");
            } else {
                mysqli_query($conn2, "update cars_for_renting set status='enabled' where id='$id'");
            }
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sqlx = mysqli_query($conn2, "select * from cars_for_renting where id='$id'");
    if (mysqli_num_rows($sqlx)  == 1) {
        while ($r = mysqli_fetch_assoc($sqlx)) {
            $image1 = $r['image1'];
            $image2 = $r['image2'];
            $image3 = $r['image3'];
            $image4 = $r['image4'];
            $folder = "../images/uploads/car_renting/";

            if (file_exists($folder . '/' . $image1) && $image1 != '') {
                unlink($folder . '/' . $image1);
            }

            if (file_exists($folder . '/' . $image2) && $image2 != '') {
                unlink($folder . '/' . $image2);
            }

            if (file_exists($folder . '/' . $image3) && $image3 != '') {
                unlink($folder . '/' . $image3);
            }

            if (file_exists($folder . '/' . $image4) && $image4 != '') {
                unlink($folder . '/' . $image4);
            }
        }
        mysqli_query($conn2, "delete from cars_for_renting where id = '$id'");
    }
}

if (isset($_GET['removeFor']) && isset($_GET['position'])) {
    $id = $_GET['removeFor'];
    $position = $_GET['position'];
    $sqlx = mysqli_query($conn2, "select * from cars_for_renting where id='$id'");
    if (mysqli_num_rows($sqlx)  == 1) {
        while ($r = mysqli_fetch_assoc($sqlx)) {
            $image2 = $r['image2'];
            $image3 = $r['image3'];
            $image4 = $r['image4'];
            $folder = "../images/uploads/car_renting/";
            if ($position == 2) {
                if (file_exists($folder . '/' . $image2) && $image2 != '') {
                    if (unlink($folder . '/' . $image2)) {
                        mysqli_query($conn2, "update cars_for_renting set image2='' where id='$id'");
                    }
                }
            }
            if ($position == 3) {
                if (file_exists($folder . '/' . $image3) && $image3 != '') {
                    if (unlink($folder . '/' . $image3)) {
                        mysqli_query($conn2, "update cars_for_renting set image3='' where id='$id'");
                    }
                }
            }
            if ($position == 4) {
                if (file_exists($folder . '/' . $image4) && $image4 != '') {
                    if (unlink($folder . '/' . $image4)) {
                        mysqli_query($conn2, "update cars_for_renting set image4='' where id='$id'");
                    }
                }
            }
        }
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
                    <h2>Cars for renting</h2>
                    <div class="row">
                        <?php
                        $sql = "SELECT * FROM cars_for_renting ORDER BY id DESC";
                        $statement = $conn->query($sql);
                        if ($statement->rowCount() > 0) {
                        ?>
                            <?php
                            while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                                $id = $row['id'];
                                $name = $row['car_name'];
                                $doors = $row['doors'];
                                $seats = $row['seats'];
                                $type = $row['type'];
                                $price = $row['price'];
                                $image1 = $row['image1'];
                                $image2 = $row['image2'];
                                $image3 = $row['image3'];
                                $image4 = $row['image4'];
                                $status = $row['status'];
                                $is_booked = $row['is_booked'];
                            ?>
                                <div class="col-md-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $name; ?></h6>
                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <div id="vehicle<?php echo $id ?>" class="carousel slide">
                                                    <!-- Indicators -->
                                                    <!-- <ul class="carousel-indicators">
                                                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                                                        <li data-target="#demo" data-slide-to="1"></li>
                                                        <li data-target="#demo" data-slide-to="2"></li>
                                                    </ul> -->

                                                    <!-- The slideshow -->
                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <img src="../images/uploads/car_renting/<?php echo $image1; ?>" alt="<?php echo $name ?>" class="admin_image">
                                                        </div>
                                                        <?php
                                                        if ($image2 != '') {
                                                        ?>
                                                            <div class="carousel-item" style="position: relative;">
                                                                <img src="../images/uploads/car_renting/<?php echo $image2; ?>" alt="<?php echo $name ?>" class="admin_image">
                                                                <div class="remove-image-container" onclick="handleRemoveImage('<?php echo $id ?>',2)">
                                                                    <span>Remove image</span>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        if ($image3 != '') {
                                                        ?>
                                                            <div class="carousel-item" style="position: relative;">
                                                                <img src="../images/uploads/car_renting/<?php echo $image3; ?>" alt="<?php echo $name ?>" class="admin_image">
                                                                <div class="remove-image-container" onclick="handleRemoveImage('<?php echo $id ?>',3)">
                                                                    <span>Remove image</span>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        if ($image4 != '') {
                                                        ?>
                                                            <div class="carousel-item" style="position: relative;">
                                                                <img src="../images/uploads/car_renting/<?php echo $image4; ?>" alt="<?php echo $name ?>" class="admin_image">
                                                                <div class="remove-image-container" onclick="handleRemoveImage('<?php echo $id ?>',4)">
                                                                    <span>Remove image</span>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }

                                                        if ($image2 == '' || $image3 == '' || $image4 == '') {
                                                        ?>
                                                            <div class="carousel-item">
                                                                <div class="add-image-container">
                                                                    <a href="add_new_car_renting_image.php?id=<?php echo $id ?>">
                                                                        <button class="btn btn-primary">Add image</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    <!-- Left and right controls -->
                                                    <a class="carousel-control-prev " href="#vehicle<?php echo $id ?>" data-slide="prev">
                                                        <span class="carousel-control-prev-icon bg-dark rounded p-2"></span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#vehicle<?php echo $id ?>" data-slide="next">
                                                        <span class="carousel-control-next-icon bg-dark rounded p-2"></span>
                                                    </a>

                                                </div>
                                            </div>
                                            <table class="table">
                                                <tr>
                                                    <td><b>Number of doors</b></td>
                                                    <td><?php echo $doors; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Number of seats</b></td>
                                                    <td><?php echo $seats ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Car type</b></td>
                                                    <td><?php echo $type; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Price</b></td>
                                                    <td><?php echo number_format($price) . 'RWF / Day'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Booked</b></td>
                                                    <td><?php echo $is_booked; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Status</b></td>
                                                    <td><?php echo $status; ?></td>
                                                </tr>
                                            </table>
                                            <a href="edit_car_for_renting.php?edit=<?php echo $id; ?>">
                                                <button class='btn btn-primary mb-2 w-100'><i class='fa fa-edit'></i> Edit</button>
                                            </a>
                                            <a href="manage2.php?product=<?php echo $id; ?>">
                                                <button class='btn btn-success mb-2 w-100'><i class='fa fa-circle'></i> Manage desciption</button>
                                            </a>
                                            <a href="cars_for_renting.php?disable=<?php echo $id; ?>" onclick="return confirm('Do want to disable this car?')">
                                                <button class='btn btn-danger w-100 mb-2'><i class='fa fa-delete'></i> Desable/enable</button>
                                            </a>
                                            <a href="cars_for_renting.php?delete=<?php echo $id; ?>" onclick="return confirm('Do want to delete this car?')">
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
                            echo '<div class="col-xl-12 col-lg-12"><small>No cars for renting found.</small><br></div>';
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
            const handleRemoveImage = (id, position) => {
                if (confirm("Do you want to delete this image?")) {
                    window.location = `cars_for_renting.php?removeFor=${id}&position=${position}`;
                }
            }
        </script>

</body>

</html>