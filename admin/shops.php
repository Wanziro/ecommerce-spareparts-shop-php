<?php
$msg = '';
include "admin_protect.php";
include "fxs.php";

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sqlx = "SELECT * FROM shops where id='$id'";
  $statementx = $conn->query($sqlx);
  if ($statementx->rowCount() == 1) {
    while (($rw = $statementx->fetch(PDO::FETCH_ASSOC)) !== false) {
      $img = $rw['image'];
      if (file_exists("../images/uploads/$img")) {
        if (unlink("../images/uploads/$img")) {
          $sql2 = "DELETE FROM shops WHERE id='$id'";
          $statement = $conn->query($sql2);
        } else {
          $sql2 = "DELETE FROM shops WHERE id='$id'";
          $statement = $conn->query($sql2);
        }
      } else {
        $sql2 = "DELETE FROM shops WHERE id='$id'";
        $statement = $conn->query($sql2);
      }
    }
  }
}


if (isset($_POST['save'])) {
  $folder = "../images/uploads/";
  $name = $_POST['name'];
  $owner = $_POST['owner'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
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

  if ($name != '' && $image_upload != "") {
    if (check_if_shop_exists($name)) {
      $msg = "<div class='alert alert-danger'>Shop name '$name' already exists. Try different name.</div>";
    } else if (!check_image_format($image_upload_type)) {
      $msg = "<div class='alert alert-danger'>Invalid file type. supported file types are .gif, .png and .jpg</div>";
    } else {
      if (move_uploaded_file($image_upload_loc, $folder . $random_image_upload)) {
        $sql = "INSERT INTO shops (name,owner,phone,address, image) VALUES (?,?,?,?,?)";
        $statement = $conn->prepare($sql);
        $statement->execute(array($name, $owner, $phone, $address, $random_image_upload));
        $msg = '';
      } else {
        $msg = "<div class='alert alert-danger'>Failed to upload shop image. try again later.</div>";
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
            $sql = "SELECT * FROM shops ORDER BY id DESC";
            $statement = $conn->query($sql);
            if ($statement->rowCount() > 0) {
            ?>
              <div class="col-xl-12 col-lg-12">
                <h2>Shops in the system</h2>
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th>Shop Image</th>
                          <th>Shop name</th>
                          <th>Shop owner</th>
                          <th>Phone number</th>
                          <th>Address</th>
                          <th>Action</th>
                        </tr>
                        <?php
                        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                          $id = $row['id'];
                          $name = $row['name'];
                          $owner = $row['owner'];
                          $phone = $row['phone'];
                          $address = $row['address'];
                          $image = $row['image'];
                          echo "
                    <tr>
                    <td><img src='../images/uploads/$image' class='vehicle-image2'></td>
                    <td>$name</td>
                    <td>$owner</td>
                    <td>$phone</td>
                    <td>$address</td>
                    <td>";
                        ?>
                          <a href="edit_shops.php?edit=<?php echo $id; ?>">
                            <button class='btn btn-primary'><i class='fa fa-edit'></i> Edit</button>
                          </a>
                          <a href="parts_from_shop.php?shop_id=<?php echo $id; ?>">
                            <button class='btn btn-primary'><i class='fa fa-eye'></i> <?php echo count_shop_parts($id) ?> Parts</button>
                          </a>
                          <a href="?delete=<?php echo $id; ?>" onclick="return confirm('Do want to delete this shop?\nAll spareparts related to this shop will also be deleted')">
                            <button class='btn btn-danger'><i class='fa fa-delete'></i> Delete</button>
                          </a>
                        <?php echo "</td>
                    ";
                        }
                        ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            <?php
            } else {
              echo '<div class="col-xl-12 col-lg-12"><h2>No shops found</h2><br></div>';
            }
            ?>

            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Register new shop</h6>
                </div>
                <div class="card-body">
                  <?php echo $msg; ?>
                  <form method="post" action="#" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Shop name</label>
                      <input type="text" name="name" class="form-control" placeholder="Enter shop name" required>
                    </div>
                    <div class="form-group">
                      <label>Owner name</label>
                      <input type="text" name="owner" class="form-control" placeholder="Enter shop owner's name" required>
                    </div>
                    <div class="form-group">
                      <label>Phone number</label>
                      <input type="text" name="phone" maxlength='10' class="form-control" placeholder="Enter phone number" required>
                    </div>
                    <div class="form-group">
                      <label>Shop address</label>
                      <input type="text" name="address" class="form-control" placeholder="Enter shop address" required>
                    </div>
                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" name="image_upload" class="form-control" required>
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

</body>

</html>