<?php
include "admin_protect.php";
include "fxs.php";

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
            if (isset($_GET['tx_id'])) {
              $transaction = $_GET['tx_id'];
              $sql = "SELECT * FROM shipping_info where transaction_id=$transaction";
              $statement = $conn->query($sql);
              if ($statement->rowCount() > 0) {
            ?>
                <div class="col-xl-12 col-lg-12">
                  <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Shipping info for transaction <?php echo $transaction; ?></h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Province</th>
                          </tr>
                          <?php
                          while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                            $id = $row['id'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $email = $row['email'];
                            $phone = $row['phone'];
                            $address = $row['address'];
                            $province = $row['province'];
                            echo "
                        <tr>
                        <td>$fname</td>
                        <td>$lname</td>
                        <td>$email</td>
                        <td>$phone</td>
                        <td>$address</td>
                        <td>$province</td>
                        
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
                echo '<div class="col-xl-12 col-lg-12"><h2>No info Found</h2><br></div>';
              }
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