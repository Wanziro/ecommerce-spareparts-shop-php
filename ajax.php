<?php
include "connect.php";
include "fxs.php";


function unmodify_all_products_in_cart()
{
    include "connect.php";
    if (isset($_SESSION['username'])) {
        $sql = "UPDATE cart set modified='NO' where username='" . $_SESSION['username'] . "'";
    } else {
        $sql = "UPDATE cart set modified='NO' where ip_address='" . getUserIpAddr() . "'";
    }
    $statement = $conn->query($sql);
}

function get_spare_part_category($product_id)
{
    include "connect.php";
    $sql = "SELECT * FROM spare_parts where id='$product_id'";
    $statement = $conn->query($sql);
    $result = '';
    if ($statement->rowCount() > 0) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $result = $row['spare_part_category'];
        }
    }
    return $result;
}

function get_spare_part_quantity($product_id)
{
    include "connect.php";
    $sql = "SELECT * FROM spare_parts where id='$product_id'";
    $statement = $conn->query($sql);
    $result = '';
    if ($statement->rowCount() > 0) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $result = $row['quantity'];
        }
    }
    return $result;
}
function get_spare_part_image($product_id)
{
    include "connect.php";
    $sql = "SELECT * FROM spare_parts where id='$product_id'";
    $statement = $conn->query($sql);
    $result = '';
    if ($statement->rowCount() > 0) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $result = $row['image'];
        }
    }
    return $result;
}
function check_if_item_exists($product_id)
{
    include "connect.php";
    if (isset($_SESSION['username'])) {
        $sql = "SELECT * FROM cart WHERE product_id='$product_id' AND username='" . $_SESSION['username'] . "'";
    } else {
        $sql = "SELECT * FROM cart WHERE product_id='$product_id' AND ip_address='" . getUserIpAddr() . "'";
    }
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['addToCart'])) {
    $product_id = $_POST['id'];
    $itemNumber = $_POST['itemNumber'];
    if (!empty($product_id) && !empty($itemNumber)) {
        if (!check_if_item_exists($product_id)) {
            if (isset($_SESSION['username'])) {
                $sql = "INSERT INTO cart ( product_id, item_number,username) 
                VALUES ('$product_id', '$itemNumber','" . $_SESSION['username'] . "')";
            } else {
                $sql = "INSERT INTO cart ( product_id, item_number,ip_address) 
                VALUES ('$product_id', '$itemNumber','" . getUserIpAddr() . "')";
            }
            $statement = $conn->query($sql);
            if ($statement->rowCount() > 0) {
                echo "<i class='fa fa-check-circle'></i>&nbsp;Item added to cart";
            } else {
                echo "<i class='fa fa-close'></i>&nbsp;Failed, try again later.";
            }
        } else {
            echo "<i class='fa fa-exclamation-triangle'></i>&nbsp;Item already exist in cart.";
        }
    }
}
if (isset($_POST['getMiniCart'])) {
    if (isset($_SESSION['username'])) {
        $sql = "SELECT * FROM cart where username='" . $_SESSION['username'] . "' ORDER BY id DESC LIMIT 4";
    } else {
        $sql = "SELECT * FROM cart where ip_address='" . getUserIpAddr() . "' ORDER BY id DESC LIMIT 4";
    }
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        echo '<ul class="minicart-product-list">';
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $product_id = $row['product_id'];
            $item_number = $row['item_number'];
            $id = $row['id'];
?>
            <li id="cartItem<?php echo "$id"; ?>">
                <a href="spare_part_from_category.php?category=<?php echo get_spare_part_category($product_id); ?>&item=<?php echo get_spare_part_name($product_id); ?>&s_id=<?php echo $product_id; ?>" class="minicart-product-image">
                    <img src="./images/uploads/<?php echo get_spare_part_image($product_id); ?>" alt="<?php echo get_spare_part_name($product_id); ?>" class="w-100" />
                </a>
                <div class="minicart-product-details">
                    <h6>
                        <a href="spare_part_from_category.php?category=<?php echo get_spare_part_category($product_id); ?>&item=<?php echo get_spare_part_name($product_id); ?>&s_id=<?php echo $product_id; ?>"><?php echo get_spare_part_name($product_id); ?></a>
                    </h6>
                    <span><?php echo get_spare_part_price($product_id); ?> x <?php echo $item_number; ?></span>
                </div>
                <button class="close" title="Remove" onclick="deleteFromCart(this,<?php echo $id; ?>)">
                    <i class="fa fa-close"></i>
                </button>
            </li>
        <?php
        }
        echo '</ul>';
    }
}

if (isset($_POST['getCheckoutList'])) {
    if (isset($_SESSION['username'])) {
        $sqlx = "SELECT * FROM cart where username='" . $_SESSION['username'] . "' ORDER BY id DESC LIMIT 4";
    } else {
        $sqlx = "SELECT * FROM cart where ip_address='" . getUserIpAddr() . "' ORDER BY id DESC LIMIT 4";
    }
    $statementx = $conn->query($sqlx);
    $total = 0;
    if ($statementx->rowCount() > 0) {
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th class="cart-product-name">Product</th>
                    <th class="cart-product-total">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while (($row = $statementx->fetch(PDO::FETCH_ASSOC)) !== false) {
                    $product_id = $row['product_id'];
                    $item_number = $row['item_number'];
                    $id = $row['id'];
                    $total += $item_number * get_spare_part_price($product_id);
                ?>
                    <tr class="cart_item">
                        <td class="cart-product-name">
                            <?php echo get_spare_part_name($product_id); ?><strong class="product-quantity">
                                × <?php echo $item_number; ?></strong>
                        </td>
                        <td class="cart-product-total">
                            <span class="amount"><?php echo get_spare_part_price($product_id); ?></span>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="order-total">
                    <th>Total Price</th>
                    <td>
                        <strong><span class="amount"><?php echo numfmt_format_currency($fmt, $total, "RWF"); ?></span></strong>
                    </td>
                </tr>
                <tr class="order-total">
                    <th>Delivery Fee</th>
                    <td>
                        <strong><span class="amount" id="deliveryString"></span></strong>
                    </td>
                </tr>
                <tr class="order-total">
                    <th>Order Total</th>
                    <td>
                        <strong><span class="amount" id="amountString"><?php echo numfmt_format_currency($fmt, $total, "RWF"); ?></span></strong>
                        <input type="hidden" id="currentPrice" value="<?php echo $total; ?>">
                        <input type="hidden" id="totalAmountToPay" value="<?php echo $total; ?>">
                    </td>
                </tr>
            </tfoot>
        </table>
    <?php
    }
}

if (isset($_POST['deleteItem'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM cart where id='$id'";
    $statement = $conn->query($sql);
    echo "Done";
}

if (isset($_POST['miniCartNotifications'])) {
    if (isset($_SESSION['username'])) {
        $sql = "SELECT * FROM cart where username='" . $_SESSION['username'] . "'";
    } else {
        $sql = "SELECT * FROM cart where ip_address='" . getUserIpAddr() . "'";
    }
    $statement = $conn->query($sql);
    $totalItmes = $statement->rowCount();
    $total = '0.000 RWF';
    if ($totalItmes > 0) {
        $total = 0;
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $product_id = $row['product_id'];
            $item_number = $row['item_number'];
            $total += (get_spare_part_price($product_id) * $item_number);
        }
    }
    echo "$totalItmes&";
    if ($totalItmes > 0) {
        echo numfmt_format_currency($fmt, $total, "RWF");
    } else {
        echo $total;
    }
}


if (isset($_POST['cartOnPage'])) {
    unmodify_all_products_in_cart();
    if (isset($_SESSION['username'])) {
        $sql = "SELECT * FROM cart where username='" . $_SESSION['username'] . "' ORDER BY id DESC LIMIT 4";
    } else {
        $sql = "SELECT * FROM cart where ip_address='" . getUserIpAddr() . "' ORDER BY id DESC LIMIT 4";
    }
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        $total = 0;
    ?>
        <div class="table-content table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="li-product-remove">remove</th>
                        <th class="li-product-thumbnail">images</th>
                        <th class="cart-product-name">Spare Part</th>
                        <th class="li-product-price">Unit Price</th>
                        <th class="li-product-quantity">Quantity</th>
                        <th class="li-product-subtotal">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                        $product_id = $row['product_id'];
                        $item_number = $row['item_number'];
                        $id = $row['id'];
                        $total += (get_spare_part_price($product_id) * $item_number);
                        $current_total = get_spare_part_price($product_id) * $item_number;
                    ?>
                        <tr id="cartRowForItem<?php echo $id; ?>">
                            <td class="li-product-remove">
                                <span class="cart-remove-btn" onclick="deleteFromCart(this,<?php echo $id; ?>)"><i class="fa fa-times"></i></span>
                            </td>
                            <td class="li-product-thumbnail">
                                <a href="spare_part_from_category.php?category=<?php echo get_spare_part_category($product_id); ?>&item=<?php echo get_spare_part_name($product_id); ?>&s_id=<?php echo $product_id; ?>"><img src="./images/uploads/<?php echo get_spare_part_image($product_id); ?>" alt="<?php echo get_spare_part_name($product_id); ?>" /></a>
                            </td>
                            <td class="li-product-name">
                                <a href="spare_part_from_category.php?category=<?php echo get_spare_part_category($product_id); ?>&item=<?php echo get_spare_part_name($product_id); ?>&s_id=<?php echo $product_id; ?>">
                                    <?php echo get_spare_part_name($product_id); ?>
                                </a>
                            </td>
                            <td class="li-product-price">
                                <span class="amount"><?php echo numfmt_format_currency($fmt, get_spare_part_price($product_id), "RWF"); ?></span>
                            </td>
                            <td class="quantity">
                                <label>Quantity</label>
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" value="<?php echo $item_number; ?>" type="text" disabled="true" id="cartQuantityFor<?php echo $id; ?>" />
                                    <div class="dec qtybutton" onmouseleave="seeTheChanges(<?php echo $id; ?>)" onclick="handleCartMinus('<?php echo $id; ?>')">
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="inc qtybutton" onmouseleave="seeTheChanges(<?php echo $id; ?>)" onclick="handleCartPlus('<?php echo $id; ?>','<?php echo get_spare_part_quantity($product_id); ?>')">
                                        <i class="fa fa-angle-up"></i>
                                    </div>
                                </div>
                            </td>
                            <td class="product-subtotal">
                                <span class="amount"><?php echo numfmt_format_currency($fmt, $current_total, "RWF"); ?></span>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-5 ml-auto">
                <div class="cart-page-total">
                    <h2>Cart totals</h2>
                    <ul>
                        <li>Subtotal <span><?php echo numfmt_format_currency($fmt, $total, "RWF"); ?></span></li>
                        <li>Total <span><?php echo numfmt_format_currency($fmt, $total, "RWF"); ?></span></li>
                    </ul>
                    <a href="checkout.php">Proceed to checkout</a>
                </div>
            </div>
        </div>
    <?php
    } else {
        echo "<span>The cart is empty! Go and pick spare parts</span>";
    }
}

if (isset($_POST['updateCartDetails'])) {
    $id = $_POST['id'];
    $itemNumber = $_POST['itemNumber'];
    if (isset($_SESSION['username'])) {
        $sql = "UPDATE cart set item_number='$itemNumber', modified='YES' where id='$id' AND username='" . $_SESSION['username'] . "'";
    } else {
        $sql = "UPDATE cart set item_number='$itemNumber', modified='YES' where id='$id' AND ip_address='" . getUserIpAddr() . "'";
    }
    $statement = $conn->query($sql);
    echo "Done";
}

if (isset($_POST['seeTheChanges'])) {
    $id = $_POST['id'];
    if (isset($_SESSION['username'])) {
        $sql = "SELECT * FROM cart where username='" . $_SESSION['username'] . "' AND id='$id'";
    } else {
        $sql = "SELECT * FROM cart where ip_address='" . getUserIpAddr() . "' AND id='$id'";
    }
    $statement = $conn->query($sql);
    if ($statement->rowCount() == 1) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $modified = $row['modified'];
            if ($modified == "YES") {
                echo "yes";
            } else {
                echo "no";
            }
        }
    } else {
        echo "no";
    }
}

if (isset($_POST['getVehicleMarks'])) {
    $vehicle = $_POST['vehicle'];
    $sql = "SELECT * FROM vehicle_marks where vehicle_category='$vehicle' ORDER BY name ASC";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        echo '<option value="" selected disabled>Choose Mark</option>';
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $name = $row['name'];
            echo "<option value='$name'>$name</option>";
        }
    } else {
        echo '<option value="" selected disabled>No Data Found</option>';
    }
}

if (isset($_POST['getVehicleModels'])) {
    $vehicle = $_POST['vehicle'];
    $vehicleMark = $_POST['vehicleMark'];
    $sql = "SELECT * FROM vehicle_model where vehicle_category='$vehicle' AND vehicle_mark='$vehicleMark' ORDER BY name ASC";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        echo '<option value="" selected disabled>Choose Model</option>';
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $name = $row['name'];
            echo "<option value='$name'>$name</option>";
        }
    } else {
        echo '<option value="" selected disabled>No Data Found</option>';
    }
}

if (isset($_POST['getVehicleFuels'])) {
    $vehicle = $_POST['vehicle'];
    $vehicleMark = $_POST['vehicleMark'];
    $vehicleModel = $_POST['vehicleModel'];
    $sql = "SELECT * FROM fuel where vehicle_model='$vehicleModel' AND vehicle_category='$vehicle' AND vehicle_mark='$vehicleMark' ORDER BY name ASC";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        echo '<option value="" selected disabled>Choose Fuel</option>';
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $name = $row['name'];
            echo "<option value='$name'>$name</option>";
        }
    } else {
        echo '<option value="" selected disabled>No Data Found</option>';
    }
}

if (isset($_POST['getVehicleEngineType'])) {
    $vehicle = $_POST['vehicle'];
    $vehicleMark = $_POST['vehicleMark'];
    $vehicleModel = $_POST['vehicleModel'];
    $vehicleFuel = $_POST['vehicleFuel'];
    $sql = "SELECT * FROM engine_type where fuel='$vehicleFuel' AND vehicle_model='$vehicleModel' AND vehicle_category='$vehicle' AND vehicle_mark='$vehicleMark' ORDER BY name ASC";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        echo '<option value="" selected disabled>Choose Engine</option>';
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $name = $row['name'];
            echo "<option value='$name'>$name</option>";
        }
    } else {
        echo '<option value="" selected disabled>No Data Found</option>';
    }
}

if (isset($_POST['getVehicleSpCat'])) {
    $vehicle = $_POST['vehicle'];
    $vehicleMark = $_POST['vehicleMark'];
    $vehicleModel = $_POST['vehicleModel'];
    $vehicleFuel = $_POST['vehicleFuel'];
    $engine = $_POST['engine'];
    $sql = "SELECT DISTINCT name FROM spare_part_categories where engine_type='$engine' AND fuel='$vehicleFuel' AND vehicle_model='$vehicleModel' AND vehicle_category='$vehicle' AND vehicle_mark='$vehicleMark' ORDER BY name ASC";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        echo '<option value="" selected disabled>Choose Part Category</option>';
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $name = $row['name'];
            if (isset($_POST['admin'])) {
                echo "<option value='$name'>$name</option>";
            } else {
                if (check_if_spare_part_category_has_values($name))
                    echo "<option value='$name'>$name</option>";
            }
        }
    } else {
        echo '<option value="" selected disabled>No Data Found</option>';
    }
}

if (isset($_POST['startHereSpareParts'])) {
    $vehicle = $_POST['vehicle'];
    $vehicleMark = $_POST['vehicleMark'];
    $vehicleModel = $_POST['vehicleModel'];
    $vehicleFuel = $_POST['vehicleFuel'];
    $engine = $_POST['engine'];
    $category = $_POST['category'];
    $filter = $_POST['filter'];
    ?>
    <div class="container py-60">
        <div class="indicators-container">
            <button class="indicator start"><?php echo $vehicle; ?></button>
            <button class="indicator middle"><?php echo $vehicleMark; ?></button>
            <button class="indicator middle"><?php echo $vehicleModel; ?></button>
            <button class="indicator middle"><?php echo $vehicleFuel; ?></button>
            <button class="indicator middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $engine; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
            <button class="indicator end"><?php echo $category; ?></button>
        </div>
        <?php get_start_here_spare_parts($vehicle, $vehicleMark, $vehicleModel, $vehicleFuel, $engine, $category, $filter); ?>
    </div>
    <?php
}

if (isset($_POST['search'])) {
    $keyWord = $_POST['keyWord'];
    $searchCategory = $_POST['searchCategory'];
    if ($searchCategory != 'All') {
        $sql = "SELECT * FROM spare_parts where (name LIKE '%{$keyWord}%' OR part_number LIKE '%{$keyWord}%') AND spare_part_category='$searchCategory' LIMIT 10";
    } else {
        $sql = "SELECT * FROM spare_parts where name LIKE '%{$keyWord}%' OR part_number LIKE '%{$keyWord}%' LIMIT 10";
    }
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        echo '<ul>';
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $name = $row['name'];
            $part_number = $row['part_number'];
    ?>
            <li onclick="searchThis('<?php echo $part_number; ?>')">
    <?php
            echo "
            <span>$name</span>
            <span>$part_number</span>
            </li>";
        }
        echo "</ul>";
    } else {
        echo "";
    }
}


if (isset($_POST['saveInvoice'])) {
    $amount = $_POST['amount'];
    $transaction_id = $_POST['tx_id'];
    $transaction_ref = $_POST['tx_ref'];
    if (isset($_SESSION['username'])) {
        $sql1 = "UPDATE invoices SET status='Old' WHERE username='" . $_SESSION['username'] . "'";
        $statement1 = $conn->query($sql1);

        $sql = "INSERT INTO invoices(username,amount,tx_id,tx_ref)
        VALUES('" . $_SESSION['username'] . "','$amount','$transaction_id','$transaction_ref')";
        $statement = $conn->query($sql);
    }
}

if (isset($_POST['saveShippingInfo'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $tx_id = $_POST['tx_id'];
    $province = $_POST['province'];
    $phone = $_POST['phone'];

    if (isset($_SESSION['username'])) {
        $sql = "INSERT INTO shipping_info(fname,lname,email,address,phone,province,username,transaction_id)
        VALUES('$fname','$lname','$email','$address','$phone','$province','" . $_SESSION['username'] . "','$tx_id')";
        $statement = $conn->query($sql);
        echo "success";
    }
}

if (isset($_POST['updateDescription'])) {
    $id = $_POST['spare_part'];
    $description = $_POST['description'];
    mysqli_query($conn2, "update spare_parts set description='$description' where id='$id'");
}

if (isset($_POST['updateDescription2'])) {
    $id = $_POST['car_id'];
    $description = $_POST['description'];
    mysqli_query($conn2, "update cars_for_renting set description='$description' where id='$id'");
}

    ?>