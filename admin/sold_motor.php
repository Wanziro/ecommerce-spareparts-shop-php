<?php
$msg = '';
include "admin_protect.php";
include "fxs.php";
function get_vehicle_category_of_product($id)
{
    include "admin_protect.php";
    $sql = "SELECT * FROM spare_parts WHERE id='" . $id . "'";
    $statement = $conn->query($sql);
    if ($statement->rowCount() == 1) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $cat = $row['vehicle_category'];

            return $cat;
        }
    } else {
        return "Info not found";
    }
}

function get_product_category_of_product($id)
{
    include "admin_protect.php";
    $sql = "SELECT * FROM spare_parts WHERE id='" . $id . "'";
    $statement = $conn->query($sql);
    if ($statement->rowCount() == 1) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $cat = $row['spare_part_category'];

            return $cat;
        }
    } else {
        return "Info not found";
    }
}

function get_product_mark_of_product($id)
{
    include "admin_protect.php";
    $sql = "SELECT * FROM spare_parts WHERE id='" . $id . "'";
    $statement = $conn->query($sql);
    if ($statement->rowCount() == 1) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $cat = $row['vehicle_mark'];

            return $cat;
        }
    } else {
        return "Info not found";
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
                        $total_amount = 0;
                        $sql = "SELECT * FROM sold_products ORDER BY id DESC LIMIT 10";
                        $statement = $conn->query($sql);
                        if ($statement->rowCount() > 0) {
                        ?>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <div style="width:100%;display:flex;align-items:center;justify-content:space-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Car Spare parts sold Products</h6>
                                            <a href="print_sold_motor.php" target="_blank">
                                                <button class="btn btn-primary"><i class="fa fa-print"></i> Print data</button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>Spare Part Name</th>
                                                    <th>Spare Part Category</th>
                                                    <th>Mark</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th>Transaction Id</th>
                                                    <th>Client Username</th>
                                                    <th>Client Names</th>
                                                    <th>Date</th>
                                                </tr>
                                                <?php
                                                while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                                                    $id = $row['id'];
                                                    $price = $row['price'];
                                                    $name = $row['name'];
                                                    $quantity = $row['quantity'];
                                                    $total = $row['total'];
                                                    $transactionId = $row['transaction_id'];
                                                    $us_name = $row['username'];
                                                    $date = $row['date'];
                                                    $product_id = $row['product_id'];
                                                    if (get_vehicle_category_of_product($product_id) == "Motocycles") {
                                                        $total_amount += $total;
                                                        echo "
                        <tr>
                        <td>$name</td>
                        <td>" . get_product_category_of_product($product_id) . "</td>
                        <td>" . get_product_mark_of_product($product_id) . "</td>
                        <td>$price RWF</td>
                        <td>$quantity</td>
                        <td>$total</td>
                        <td>$transactionId</td>
                        <td>$us_name</td>
                        <td>";
                                                        get_user_names($us_name);
                                                        echo "</td>
                        <td>$date</td>
                        ";
                                                    }
                                                }
                                                ?>
                                            </table>
                                            <div class="text-right">
                                                <h2>TOTAL : <?php echo $total_amount; ?> RWF</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                        } else {
                            echo "No Products found";
                        }
                        ?>
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