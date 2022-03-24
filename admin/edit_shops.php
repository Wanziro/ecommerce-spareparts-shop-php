<?php
$msg = '';
include "admin_protect.php";
include "fxs.php";

if (isset($_POST['edit'])) {
  $folder = "../images/uploads/";
  $id = $_POST['id'];
  $name = $_POST['name'];
  $owner = $_POST['owner'];
  $phone = $_POST['phone'];
  //image_upload
  $image_upload = $_FILES['image_upload']['name'];
  if ($image_upload == '') {
    if (check_if_shop_exists2($name, $id)) {
      $msg = "<div class='alert alert-danger'>Shop name already exists. try to edit with different name </div>";
    } else if (trim($name) == '' || trim($id) == '') {
      $msg = "<div class='alert alert-danger'>Please provide the shop name</div>";
    } else {
      //update the data
      $up = "UPDATE shops SET name='$name', owner='$owner', phone='$phone' WHERE id = '$id'";
      $statement = $conn->query($up);
      header("Location: shops.php");
    }
  } else {
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

    if ($name != '' && $image_upload != "" && $id != "") {
      $name_exists = false;
      if (check_if_shop_exists2($name, $id)) {
        $msg = "<div class='alert alert-danger'>Shop name already exists. try to edit with different name </div>";
      } else if (!check_image_format($image_upload_type)) {
        $msg = "<div class='alert alert-danger'>Invalid file type. supported file types are .gif, .png and .jpg</div>";
      } else {
        if (move_uploaded_file($image_upload_loc, $folder . $random_image_upload)) {
          //update the data
          $up = "UPDATE shops SET name='$name', owner='$owner', phone='$phone',image='$random_image_upload' WHERE id = '$id'";
          $statement = $conn->query($up);
          header("Location: shops.php");
        } else {
          $msg = "<div class='alert alert-danger'>Failed to upload your image. Try again later.</div>";
        }
      }
    } else {
      $msg = "<div class='alert alert-danger'>All field are required!.</div>";
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
          <div class="row">

            <?php if (isset($_GET['edit'])) {
              $s = "SELECT * FROM shops WHERE id=" . $_GET['edit'] . "";
              $stm = $conn->query($s);
              if ($stm->rowCount() > 0) {
                while (($row = $stm->fetch(PDO::FETCH_ASSOC)) !== false) {
                  $name = $row['name'];
                  $owner = $row['owner'];
                  $phone = $row['phone'];
                  $address = $row['address'];
                  $image = $row['image'];
            ?>
                  <div class="col-lg-12">
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Shops / Edit / <?php echo $_GET['edit']; ?></h6>
                      </div>
                      <div class="card-body">
                        <?php echo $msg; ?>
                        <form method="post" action="#" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>">
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter vehicle name" required>
                          </div>
                          <div class="form-group">
                            <label>Owner's name</label>
                            <input type="text" name="owner" class="form-control" value="<?php echo $owner; ?>" placeholder="Enter vehicle name" required>
                          </div>
                          <div class="form-group">
                            <label>Phone number</label>
                            <input type="text" name="phone" maxlength='10' class="form-control" value="<?php echo $phone; ?>" placeholder="Enter vehicle name" required>
                          </div>
                          <div class="form-group">
                            <label>Image <font color="red">(Leave this as empty if you dont want to change current vehicle image)</font></label>
                            <input type="file" name="image_upload" class="form-control">
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
                echo "Shop with id of " . $_GET['edit'] . " does not exist.";
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

</body>

</html>