<?php
include"connect.php";
include"fxs.php";

if(!isset($_SESSION['username'])){
    header("Location: login_register.php");
}else{
  if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    
    $sql = "UPDATE users set fname=?, lname=?, email=? where username='".$_SESSION['username']."'";
    $statement = $conn->prepare($sql);
    $statement->execute(array($fname,$lname,$email));
  }
  $sql = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
    $statement = $conn->query($sql);
    if($statement->rowCount() == 1){
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
          $fname = $row['fname'];
          $lname = $row['lname'];
          $email = $row['email'];
          $username = $row['username'];            
        }
    }else{
      header("Location: login_register.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>eCommerce Project</title>
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/profile.css" />

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="user-sidebar" id="sidebar-wrapper">
      <div class="sidebar-heading">eCommerce Project</div>
      <div class="list-group list-group-flush">
        <a href="profile.php" class="list-group-item list-group-item-action active"><i class="fa fa-user-circle"></i> User Profile</a>
        <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-file-o"></i> Invoices</a>
        <a href="cart.php" class="list-group-item list-group-item-action"><i class="fa fa-shopping-cart"></i> My cart</a>
        <a href="index.php" class="list-group-item list-group-item-action"><i class="fa fa-home"></i> Home</a>
        <a href="logout.php" class="list-group-item list-group-item-action"><i class="fa fa-sign-out"></i> Logout</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg nav-header border-bottom">
        <button class="btn btn-primary px-4 btn-toggle" id="menu-toggle"><i class="fa fa-bars"></i></button>
        <h2 class="ml-3">Welcome <?php echo $_SESSION['username'];?></h2>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i> Logout<span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <div class="contents">
        <div class="row">
            <div class="col-md-6">
                <div class="card"> 
                    <h2>Profile information</h2>
                    <form method="post">
                        <span>First Name</span>
                        <input type="text" name="fname" value="<?php echo $fname;?>" required>
                        <span>Last Name</span>
                        <input type="text" name="lname" value="<?php echo $lname;?>" value="name" required>
                        <span>Email Address</span>
                        <input type="text" name="email" value="<?php echo $email;?>" required>
                        <span class="pt-3 d-block">Username</span>
                        <div class="disabled"><?php echo $username;?></div>
                        <button type="submit" name="submit">Update info</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
              
              <a style="text-decoration:none" href="cart.php">
                <div class="card p-3">
                  <span class="card-span"><i class="fa  fa-shopping-cart"></i> Items in cart</span>
                  <div class="centered"><h2><?php echo user_items_in_cart();?></h2></div>
                </div>
              </a>
            </div>
        </div>
        <div class="mt-3">
            <?php
            $sql = "SELECT * FROM invoices WHERE username='".$_SESSION['username']."' ORDER BY id DESC";
            $statement = $conn->query($sql);
            if($statement->rowCount() > 0){
              ?>
              <h1>My Invoices</h1>
              <table class="table">
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
              $i=1;
                while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                    $t_id = $row['tx_id'];
                    $t_ref = $row['tx_ref'];
                    $date = $row['date'];
                    $id = $row['id'];
                    $amount = $row['amount'];
                    echo"
                    <tr>
                      <td>$i</td>
                      <td>$t_id</td>
                      <td>$t_ref</td>
                      <td>$amount RWF</td>
                      <td>$date</td>
                      <td align='center'><i class='fa fa-check-circle alert-success'></i></td>
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
              <?php
            }
            ?>
        </div>

        <div class="mt-3">
            <?php
            $sql = "SELECT * FROM sold_products WHERE username='".$_SESSION['username']."' ORDER BY id DESC";
            $statement = $conn->query($sql);
            if($statement->rowCount() > 0){
              ?>
              <h1>Spare parts Bought</h1>
              <hr>
              <table class="table">
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
              $i=1;
                while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                    $t_id = $row['transaction_id'];
                    $name = $row['name'];
                    $date = $row['date'];
                    $id = $row['id'];
                    $total = $row['total'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];

                    echo"
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
              <?php
            }
            ?>
        </div>
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
