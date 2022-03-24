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
                    <h2>Cars booking information</h2>
                    <div class="row">
                        <?php
                        $sql = "SELECT * FROM booking ORDER BY id DESC";
                        $statement = $conn->query($sql);
                        if ($statement->rowCount() > 0) {
                        ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#Vehicle</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Pickup date</th>
                                            <th>Return date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                                            $id = $row['id'];
                                            $fname = $row['fname'];
                                            $lname = $row['lname'];
                                            $email = $row['email'];
                                            $phone = $row['phone'];
                                            $pickup_date = $row['pickup_date'];
                                            $return_date = $row['return_date'];
                                            $vehicle_id = $row['vehicle_id'];
                                            $secs = strtotime($pickup_date) - strtotime($return_date);
                                            $days = $secs / 86400;
                                        ?>
                                            <tr>
                                                <td><?php echo $vehicle_id ?></td>
                                                <td><?php echo $fname ?></td>
                                                <td><?php echo $lname ?></td>
                                                <td><?php echo $email ?></td>
                                                <td><?php echo $phone ?></td>
                                                <td><?php echo $pickup_date ?></td>
                                                <td><?php echo $return_date ?></td>
                                                <td><?php echo $days + 3 ?> Days</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>


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