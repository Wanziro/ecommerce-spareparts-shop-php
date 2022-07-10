<?php
function get_all_vehicles()
{
    include "admin_protect.php";
    $sql = "SELECT * FROM vehicle_categories ORDER BY name ASC";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        echo '<option value="" selected disabled>Choose vehicle</option>';
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $name = $row['name'];
            echo "<option value='$name'>$name</option>";
        }
    }
}
function get_latest_products()
{
    include "admin_protect.php";
    $sql = "SELECT * FROM spare_parts ORDER BY id DESC Limit 10";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
?>
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div style="width:100%;display:flex;align-items:center;justify-content:space-between">
                        <h6 class="m-0 font-weight-bold text-primary">Latest Products</h6>
                        <a href="print_spare_parts.php" target="_blank">
                            <button class="btn btn-primary"><i class="fa fa-print"></i> Print data</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Vehicle</th>
                                <th>Mark</th>
                                <th>Model</th>
                                <th>Fuel</th>
                                <th>Part Number</th>
                            </tr>
                            <?php
                            while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $category = $row['spare_part_category'];
                                $vehicle = $row['vehicle_category'];
                                $mark = $row['vehicle_mark'];
                                $model = $row['vehicle_model'];
                                $fuel = $row['fuel'];
                                $part_number = $row['part_number'];
                                echo "
            <tr>
            <td>$id</td>
            <td>$name</td>
            <td>$category</td>
            <td>$vehicle</td>
            <td>$mark</td>
            <td>$model</td>
            <td>$fuel</td>
            <td>$part_number</td>
            ";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }
}

function get_invoices()
{
    include "admin_protect.php";
    $sql = "SELECT * FROM invoices ORDER BY id DESC";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
    ?>
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div style="width:100%;display:flex;align-items:center;justify-content:space-between">
                        <h6 class="m-0 font-weight-bold text-primary">Invoices</h6>
                        <a href="print_invoices.php" target="_blank">
                            <button class="btn btn-primary"><i class="fa fa-print"></i> Print data</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Client Username</th>
                                <th>Amount Paid</th>
                                <th>Transaction Id</th>
                                <th>Reference Id</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                                $id = $row['id'];
                                $us_name = $row['username'];
                                $amount = $row['amount'];
                                $tx_id = $row['tx_id'];
                                $tx_ref = $row['tx_ref'];
                                $date = $row['date'];
                                echo "
            <tr>
            <td>$us_name</td>
            <td>$amount RWF</td>
            <td>$tx_id</td>
            <td>$tx_ref</td>
            <td>$date</td>
            <td><a href='shipping.php?tx_id=" . $tx_id . "'><button class='btn btn-info'>Shipping info</button></td>
            ";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }
}

function get_part_name($id)
{
    include "admin_protect.php";
    $sql = "SELECT * FROM spare_parts WHERE id='$id'";
    $statement = $conn->query($sql);
    $result = '';
    if ($statement->rowCount() == 1) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $result = $row['name'];
        }
    }
    return $result;
}

function get_user_names($us_name)
{
    include "admin_protect.php";
    $sql = "SELECT * FROM users WHERE username='" . $us_name . "'";
    $statement = $conn->query($sql);
    if ($statement->rowCount() == 1) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $fname = $row['fname'];
            $lname = $row['lname'];

            echo "$fname $lname";
        }
    } else {
        echo "Info not found";
    }
}


function get_soldProducts()
{
    $total_amount = 0;
    include "admin_protect.php";
    $sql = "SELECT * FROM sold_products ORDER BY id DESC LIMIT 10";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
    ?>
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div style="width:100%;display:flex;align-items:center;justify-content:space-between">
                        <h6 class="m-0 font-weight-bold text-primary">Sold Products</h6>
                        <a href="print_sold_products.php" target="_blank">
                            <button class="btn btn-primary"><i class="fa fa-print"></i> Print data</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Product Name</th>
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
                                $total_amount += $total;
                                echo "
            <tr>
            <td>$name</td>
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
    }
}

function get_latest_products2()
{
    include "admin_protect.php";
    $sql = "SELECT * FROM spare_parts ORDER BY id DESC Limit 10";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
    ?>
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Spare parts in the system</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Vehicle</th>
                                <th>Mark</th>
                                <th>Model</th>
                                <th>Fuel</th>
                                <th>Part Number</th>
                            </tr>
                            <?php
                            while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $category = $row['spare_part_category'];
                                $vehicle = $row['vehicle_category'];
                                $mark = $row['vehicle_mark'];
                                $model = $row['vehicle_model'];
                                $fuel = $row['fuel'];
                                $part_number = $row['part_number'];
                                echo "
            <tr>
            <td>$id</td>
            <td>$name</td>
            <td>$category</td>
            <td>$vehicle</td>
            <td>$mark</td>
            <td>$model</td>
            <td>$fuel</td>
            <td>$part_number</td>
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
        echo "<h2>No spare parts found</h2>";
    }
}
function get_number_of_spare_parts()
{
    include "admin_protect.php";
    $sql = "SELECT * FROM spare_parts WHERE quantity != '0'";
    $statement = $conn->query($sql);
    echo $statement->rowCount();
}
function get_total_stock()
{
    include "admin_protect.php";
    $sql = "SELECT * FROM spare_parts WHERE quantity != '0'";
    $statement = $conn->query($sql);
    $amount = 0;
    if ($statement->rowCount() > 0) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $amount += $row['quantity'] * $row['price'];
        }
    }
    echo number_format($amount) . " RWF";
}
function get_number_of_items_in_cart()
{
    include "admin_protect.php";
    $sql = "SELECT * FROM cart";
    $statement = $conn->query($sql);
    $total = 0;
    if ($statement->rowCount() > 0) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $total += $row['item_number'];
        }
    }
    echo $total;
}
function get_total_sold_amount()
{
    include "admin_protect.php";
    $sql = "SELECT * FROM invoices WHERE tx_id != '' AND amount !=''";
    $statement = $conn->query($sql);
    $amount = 0;
    if ($statement->rowCount() > 0) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $amount += $row['amount'];
        }
    }
    echo number_format($amount) . " RWF";
}
function check_image_format($img)
{
    if (
        $img != "image/jpg" && $img != "image/png" && $img != "image/jpeg"
        && $img != "image/gif"
    ) {
        return false;
    } else {
        return true;
    }
}
function get_users()
{
    include "admin_protect.php";
    $sql = "SELECT * FROM users WHERE type='CLIENT' ORDER BY id DESC Limit 50";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
    ?>
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Registered Users</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email address</th>
                                <th>Username</th>
                            </tr>
                            <?php
                            while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                                $id = $row['id'];
                                $fname = $row['fname'];
                                $lname = $row['lname'];
                                $email = $row['email'];
                                $username = $row['username'];
                                echo "
            <tr>
            <td>$id</td>
            <td>$fname</td>
            <td>$lname</td>
            <td>$email</td>
            <td>$username</td>
            ";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}

function check_if_shop_exists($name)
{
    include "admin_protect.php";
    $sql = "SELECT * FROM shops WHERE name='$name'";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function check_if_shop_exists2($name, $id)
{
    include "admin_protect.php";
    $sql = "SELECT * FROM shops WHERE name='$name' and id != '$id'";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function get_shop_name($id)
{
    include "admin_protect.php";
    $sql = "SELECT * FROM shops WHERE id='$id'";
    $statement = $conn->query($sql);
    if ($statement->rowCount() == 1) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $name = $row['name'];
            return $name;
        }
    } else {
        return 'Invalid';
    }
}

function count_shop_parts($shop_id)
{
    include "../connect.php";
    $q = mysqli_query($conn2, "select * from spare_parts where shop_id='$shop_id'");
    return mysqli_num_rows($q);
}

?>