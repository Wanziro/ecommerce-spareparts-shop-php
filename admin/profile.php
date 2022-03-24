<?php
$msg = '';
$pwd_msg = '';
include "admin_protect.php";
include "fxs.php";
if (isset($_POST['save'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $sql = "UPDATE users SET fname='$fname',lname='$lname',email='$email' where username='$admin_username'";
  $statement = $conn->query($sql);
  header("location: profile.php");
}

if (isset($_POST['change_pwd'])) {
  $current_pwd = mysqli_real_escape_string($conn2, $_POST['current_pwd']);
  $new_pwd = mysqli_real_escape_string($conn2, $_POST['new_pwd']);
  $q = mysqli_query($conn2, "select * from users where username='$admin_username' and password='" . md5($current_pwd) . "' and type='ADMIN'");
  if (mysqli_num_rows($q) == 1) {
    mysqli_query($conn2, "update users set password='" . md5($new_pwd) . "' where username='$admin_username'");
    header("location: ../logout.php");
  } else {
    $pwd_msg = "<div class='alert alert-danger'>Wrong old password.</div>";
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
            <div class="col-md-6">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
                </div>
                <div class="card-body">
                  <table class="table">
                    <tr>
                      <td>First Name</td>
                      <td><?php echo $admin_fname; ?></td>
                    </tr>
                    <tr>
                      <td>Last Name</td>
                      <td><?php echo $admin_lname; ?></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td><?php echo $admin_email; ?></td>
                    </tr>
                  </table>
                </div>
              </div>

              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Update your password</h6>
                </div>
                <div class="card-body">
                  <?php echo $pwd_msg; ?>
                  <form method="post">
                    <div class="form-group">
                      <label>Current password *</label>
                      <input type="password" class="form-control" name="current_pwd" required>
                    </div>
                    <div class="form-group">
                      <label>New password *</label>
                      <input type="password" class="form-control" name="new_pwd" required>
                    </div>
                    <div>
                      <button class="btn btn-primary" type="submit" name="change_pwd">Update password</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Update your info</h6>
                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" required class="form-control" name="fname" value="<?php echo $admin_fname; ?>">
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" required class="form-control" name="lname" value="<?php echo $admin_lname; ?>">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" required class="form-control" name="email" value="<?php echo $admin_email; ?>">
                    </div>
                    <button class="btn btn-primary" name="save">Submit</button>
                  </form>
                </div>
              </div>
            </div>
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