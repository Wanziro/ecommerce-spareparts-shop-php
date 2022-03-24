<?php
$msg = '';
include "admin_protect.php";
include "fxs.php";

if (isset($_POST['save'])) {
    $folder = "../images/uploads/car_renting/";
    $id = $_POST['id'];

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

    if ($image_upload != '') {
        if (!check_image_format($image_upload_type)) {
            $msg = "<div class='alert alert-danger'>Invalid file type. supported file types are .gif, .png and .jpg</div>";
        } else {
            $q = mysqli_query($conn2, "select * from cars_for_renting where id='$id'");
            if (mysqli_num_rows($q) == 1) {
                while ($row = mysqli_fetch_assoc($q)) {
                    $image2 = $row['image2'];
                    $image3 = $row['image3'];
                    $image4 = $row['image4'];
                    if ($image2 == '') {
                        if (move_uploaded_file($image_upload_loc, $folder . $random_image_upload)) {
                            $sql = "update cars_for_renting set image2='$random_image_upload' where id='$id'";
                            $conn->query($sql);
                            header("location: cars_for_renting.php");
                        } else {
                            $msg = "<div class='alert alert-danger'>Failed to upload your image. try again later.</div>";
                        }
                    } elseif ($image3 == "") {
                        if (move_uploaded_file($image_upload_loc, $folder . $random_image_upload)) {
                            $sql = "update cars_for_renting set image3='$random_image_upload' where id='$id'";
                            $conn->query($sql);
                            header("location: cars_for_renting.php");
                        } else {
                            $msg = "<div class='alert alert-danger'>Failed to upload your image. try again later.</div>";
                        }
                    } else {
                        if (file_exists($folder . '/' . $image4) && $image4 != '') {
                            if (unlink($folder . '/' . $image4)) {
                                if (move_uploaded_file($image_upload_loc, $folder . $random_image_upload)) {
                                    $sql = "update cars_for_renting set image4='$random_image_upload' where id='$id'";
                                    $conn->query($sql);
                                    header("location: cars_for_renting.php");
                                } else {
                                    $msg = "<div class='alert alert-danger'>Failed to upload your image. try again later.</div>";
                                }
                            } else {
                                $msg = "<div class='alert alert-danger'>Failed to delete old car image. Try again later after sometime.</div>";
                            }
                        } else {
                            if (move_uploaded_file($image_upload_loc, $folder . $random_image_upload)) {
                                $sql = "update cars_for_renting set image4='$random_image_upload' where id='$id'";
                                $conn->query($sql);
                                header("location: cars_for_renting.php");
                            } else {
                                $msg = "<div class='alert alert-danger'>Failed to upload your image. try again later.</div>";
                            }
                        }
                    }
                }
            } else {
                $msg = "<div class='alert alert-danger'>Invalid info. Try again later with valid inforamtion.</div>";
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
                        if (isset($_GET['id'])) {
                            $sql = "SELECT * FROM cars_for_renting where id='" . $_GET['id'] . "'";
                            $statement = $conn->query($sql);
                            if ($statement->rowCount() > 0) {
                        ?>
                                <?php
                                while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                                    $id = $row['id'];
                                    $name = $row['car_name'];
                                ?>
                                    <div class="col-lg-12">
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Cars for renting / Add image / #<?php echo $_GET['id'] . ' ' . $name; ?></h6>
                                            </div>
                                            <div class="card-body">
                                                <?php echo $msg; ?>
                                                <form method="post" action="#" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <input type="file" name="image_upload" class="form-control" required>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" name="save" class="btn btn-primary">Save image</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                        <?php
                                }
                            } else {
                                echo "Car with id of " . $_GET['id'] . " does not exist.";
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
</body>

</html>