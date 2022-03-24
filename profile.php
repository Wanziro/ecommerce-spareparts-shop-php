<?php
include "connect.php";
include "fxs.php";

if (!isset($_SESSION['username'])) {
  header("Location: login_register.php");
} else {
  if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];

    $sql = "UPDATE users set fname=?, lname=?, email=? where username='" . $_SESSION['username'] . "'";
    $statement = $conn->prepare($sql);
    $statement->execute(array($fname, $lname, $email));
  }
  $sql = "SELECT * FROM users WHERE username='" . $_SESSION['username'] . "'";
  $statement = $conn->query($sql);
  if ($statement->rowCount() == 1) {
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $fname = $row['fname'];
      $lname = $row['lname'];
      $email = $row['email'];
      $username = $row['username'];
    }
  } else {
    header("Location: login_register.php");
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title><?php echo $username ?> - KAS ONLINE LTD</title>
  <!-- Favicon-->
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"> -->

  <!-- Bootstrap Core Css -->
  <link href="profile/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Waves Effect Css -->
  <link href="profile/plugins/node-waves/waves.css" rel="stylesheet" />

  <!-- Animation Css -->
  <link href="profile/plugins/animate-css/animate.css" rel="stylesheet" />

  <!-- Morris Chart Css-->
  <link href="profile/plugins/morrisjs/morris.css" rel="stylesheet" />

  <!-- Custom Css -->
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link href="profile/css/style.css" rel="stylesheet">

  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <!-- <link href="profile/css/themes/all-themes.css" rel="stylesheet" /> -->
</head>

<body class="theme-red">
  <!-- Page Loader -->
  <div class="page-loader-wrapper">
    <div class="loader">
      <div class="preloader">
        <div class="spinner-layer pl-red">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
      <p>Please wait...</p>
    </div>
  </div>
  <!-- #END# Page Loader -->
  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>
  <!-- #END# Overlay For Sidebars -->
  <?php include "profile_header.php" ?>
  <section>
    <?php include "profile_side_bar.php"; ?>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>DASHBOARD</h2>
      </div>

      <!-- Widgets -->
      <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="content">
              <div class="text">CART ITEMS</div>
              <div class="number count-to" data-from="0" data-to="<?php echo user_items_in_cart(); ?>" data-speed="15" data-fresh-interval="20"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
              <i class="fa fa-shopping-basket"></i>
            </div>
            <div class="content">
              <div class="text">TOTAL ORDERS</div>
              <div class="number count-to" data-from="0" data-to="0" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
              <i class="fa fa-check"></i>
            </div>
            <div class="content">

              <div class="text">TRANSACTIONS</div>
              <div class="number count-to" data-from="0" data-to="
              <?php
              $sql = "SELECT * FROM invoices WHERE username='" . $_SESSION['username'] . "' ORDER BY id DESC";
              $statement = $conn->query($sql);
              echo $statement->rowCount();
              ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <div class="content">
              <div class="text">#######</div>
              <div class="number count-to" data-from="0" data-to="307" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- #END# Widgets -->
      <!-- CPU Usage -->
      <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="header">
              <h2>My Invoices</h2>
            </div>
            <div class="body">
              <?php
              $sql = "SELECT * FROM invoices WHERE username='" . $_SESSION['username'] . "' ORDER BY id DESC";
              $statement = $conn->query($sql);
              if ($statement->rowCount() > 0) {
              ?>
                <div class="table-responsive">
                  <table class="table table-hover dashboard-task-infos">
                    <tr>
                      <th>#</th>
                      <th>Transaction Id</th>
                      <th>Transaction Reference</th>
                      <th>Amount Paid</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>

                    <?php
                    $i = 1;
                    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                      $t_id = $row['tx_id'];
                      $t_ref = $row['tx_ref'];
                      $date = $row['date'];
                      $id = $row['id'];
                      $amount = $row['amount'];
                      echo "
                    <tr>
                      <td>$i</td>
                      <td>$t_id</td>
                      <td>$t_ref</td>
                      <td>$amount RWF</td>
                      <td>$date</td>
                      <td align='center'><i class='fa fa-check-circle'></i></td>
                      <td>
                       <a href='print_invoice.php?id=$id' target='_blank'>
                        <button class='btn btn-success'><i class='fa fa-print'></i> Print</button>
                       </a>
                      </td>
                      </tr>
                    ";
                      $i++;
                    }
                    ?>
                  </table>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <!-- #END# CPU Usage -->
      <!--  -->
      <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="header">
              <h2>Spare parts Bought</h2>
            </div>
            <div class="body">
              <?php
              $sql = "SELECT * FROM sold_products WHERE username='" . $_SESSION['username'] . "' ORDER BY id DESC";
              $statement = $conn->query($sql);
              if ($statement->rowCount() > 0) {
              ?>
                <div class="table-responsive">
                  <table class="table table-hover dashboard-task-infos">
                    <tr>
                      <th>#</th>
                      <th>Product Name</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Total Amount Paid</th>
                      <th>Transaction Id</th>
                      <th>Date</th>
                    </tr>

                    <?php
                    $i = 1;
                    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                      $t_id = $row['transaction_id'];
                      $name = $row['name'];
                      $date = $row['date'];
                      $id = $row['id'];
                      $total = $row['total'];
                      $price = $row['price'];
                      $quantity = $row['quantity'];

                      echo "
                    <tr>
                      <td>$i</td>
                      <td>$name</td>
                      <td>$price RWF</td>
                      <td>$quantity</td>
                      <td>$total RWF</td>
                      <td>$t_id</td>
                      <td>$date</td>
                      </tr>
                    ";
                      $i++;
                    }
                    ?>
                  </table>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <!--  -->

    </div>
  </section>

  <!-- Jquery Core Js -->
  <script src="profile/plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core Js -->
  <script src="profile/plugins/bootstrap/js/bootstrap.js"></script>

  <!-- Select Plugin Js -->
  <script src="profile/plugins/bootstrap-select/js/bootstrap-select.js"></script>

  <!-- Slimscroll Plugin Js -->
  <script src="profile/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

  <!-- Waves Effect Plugin Js -->
  <script src="profile/plugins/node-waves/waves.js"></script>

  <!-- Jquery CountTo Plugin Js -->
  <script src="profile/plugins/jquery-countto/jquery.countTo.js"></script>

  <!-- Morris Plugin Js -->
  <script src="profile/plugins/raphael/raphael.min.js"></script>
  <script src="profile/plugins/morrisjs/morris.js"></script>

  <!-- ChartJs -->
  <script src="profile/plugins/chartjs/Chart.bundle.js"></script>

  <!-- Flot Charts Plugin Js -->
  <script src="profile/plugins/flot-charts/jquery.flot.js"></script>
  <script src="profile/plugins/flot-charts/jquery.flot.resize.js"></script>
  <script src="profile/plugins/flot-charts/jquery.flot.pie.js"></script>
  <script src="profile/plugins/flot-charts/jquery.flot.categories.js"></script>
  <script src="profile/plugins/flot-charts/jquery.flot.time.js"></script>

  <!-- Sparkline Chart Plugin Js -->
  <script src="profile/plugins/jquery-sparkline/jquery.sparkline.js"></script>

  <!-- Custom Js -->
  <script src="profile/js/admin.js"></script>
  <script src="profile/js/pages/index.js"></script>

  <!-- Demo Js -->
  <script src="profile/js/demo.js"></script>
</body>

</html>