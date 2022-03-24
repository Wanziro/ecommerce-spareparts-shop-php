<?php
function get_start_here_spare_parts($vehicle, $vehicleMark, $vehicleModel, $vehicleFuel, $engine, $category, $filter)
{
    include "connect.php";
    if ($filter == 'name-az') {
        $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND vehicle_category='$vehicle' AND vehicle_mark='$vehicleMark' AND vehicle_model='$vehicleModel' AND fuel='$vehicleFuel' AND engine='$engine' ORDER BY name ASC";
    } else if ($filter == 'name-za') {
        $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND vehicle_category='$vehicle' AND vehicle_mark='$vehicleMark' AND vehicle_model='$vehicleModel' AND fuel='$vehicleFuel' AND engine='$engine' ORDER BY name DESC";
    } else if ($filter == 'price-lh') {
        $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND vehicle_category='$vehicle' AND vehicle_mark='$vehicleMark' AND vehicle_model='$vehicleModel' AND fuel='$vehicleFuel' AND engine='$engine' ORDER BY price ASC";
    } else if ($filter == 'price-hl') {
        $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND vehicle_category='$vehicle' AND vehicle_mark='$vehicleMark' AND vehicle_model='$vehicleModel' AND fuel='$vehicleFuel' AND engine='$engine' ORDER BY price DESC";
    } else if ($filter == 'ratings-l') {
        $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND vehicle_category='$vehicle' AND vehicle_mark='$vehicleMark' AND vehicle_model='$vehicleModel' AND fuel='$vehicleFuel' AND engine='$engine' ORDER BY ratings ASC";
    } else if ($filter == 'ratings-h') {
        $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND vehicle_category='$vehicle' AND vehicle_mark='$vehicleMark' AND vehicle_model='$vehicleModel' AND fuel='$vehicleFuel' AND engine='$engine' ORDER BY ratings DESC";
    } else {
        $sql = "SELECT DISTINCT * FROM spare_parts WHERE spare_part_category='$category' AND vehicle_category='$vehicle' AND vehicle_mark='$vehicleMark' AND vehicle_model='$vehicleModel' AND fuel='$vehicleFuel' AND engine='$engine' ORDER BY name DESC";
    }
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
?>
        <?php
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $id = $row['id'];
            $name = $row['name'];
            $img = $row['image'];
            $v_mark = $row['vehicle_mark'];
            $v_model = $row['vehicle_model'];
            $fuel = $row['fuel'];
            $engine = $row['engine'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $description = $row['description'];
            $description = str_replace(">,", ">", $description);
            increase_spare_part_views($id);
        ?>
            <div class="row mb-25 pb-25" style="border-bottom: 1px solid #CCC;">
                <div class="col-md-3">
                    <img src="./images/uploads/<?php echo "$img"; ?>" alt="<?php echo $name ?>" class="w-100">
                </div>
                <div class="col-md-6">
                    <div class="item-container">
                        <div class="item-title-container">
                            <p class="title"><?php echo $name; ?></p>
                            <p>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </p>
                        </div>
                        <p class="m-0">Basic Information for the spare part:</p>
                        <div class="product-info">
                            <p class="bold">Model</p>
                            <p><?php echo $v_model; ?></p>
                        </div>
                        <div class="product-info">
                            <p class="bold">Mark</p>
                            <p><?php echo $v_mark; ?></p>
                        </div>
                        <div class="product-info">
                            <p class="bold">Fuel</p>
                            <p><?php echo $fuel; ?></p>
                        </div>
                        <div class="product-info">
                            <p class="bold">Engine</p>
                            <p><?php echo $engine; ?></p>
                        </div>
                        <div class="product-info">
                            <p class="bold">Price</p>
                            <p>Rwf <?php echo $price; ?></p>
                        </div>
                        <p class="bg-dark p-2 text-white m-0">Product Description:</p>
                        <div class="item-description">
                            <?php echo $description; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="add-to-cart-container">
                        <h2 class="bg-dark text-white text-center">Add To Cart</h2>
                        <span>Sale</span>
                        <h2 class="dark-text"><?php echo numfmt_format_currency($fmt, $price, "RWF"); ?></h2>
                        <?php
                        if ($quantity > 0) {
                        ?>
                            <div class="in-stock">
                                <i class="fa fa-briefcase"></i>
                                <label>In Stock</label>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="in-stock">
                                <i class="fa fa-briefcase"></i>
                                <label>Out Of Stock</label>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="item-counter">
                            <div id="minusFor<?php echo $id; ?>" onclick="handleMinus(<?php echo $id; ?>)">-</div>
                            <div id="itemNumberFor<?php echo $id; ?>" style="width:100%">1</div>
                            <div id="plusFor<?php echo $id; ?>" onclick="handlePlus(<?php echo $id; ?>,<?php echo $quantity; ?>)">+</div>
                        </div>
                        <button onclick="addToCart(this,<?php echo $id; ?>)">Add to cart</button>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}
function get_all_vehicles()
{
    include "connect.php";
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

function get_spare_part_name($product_id)
{
    include "connect.php";
    $sql = "SELECT * FROM spare_parts where id='$product_id'";
    $statement = $conn->query($sql);
    $result = '';
    if ($statement->rowCount() > 0) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $result = $row['name'];
        }
    }
    return $result;
}

function get_spare_part_price($product_id)
{
    include "connect.php";
    $sql = "SELECT * FROM spare_parts where id='$product_id'";
    $statement = $conn->query($sql);
    $amount = 0;
    if ($statement->rowCount() > 0) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $amount = $row['price'];
        }
    }
    return $amount;
}

function check_if_user_exists($username)
{
    include "connect.php";
    $sql = "SELECT * FROM users where username='$username'";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function getUserIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function assign_products_to_user()
{
    include "connect.php";
    if (isset($_SESSION['username'])) {
        $sql = "SELECT * FROM cart where ip_address='" . getUserIpAddr() . "'";
        $statement = $conn->query($sql);
        if ($statement->rowCount() > 0) {
            while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                $id = $row['id'];
                $sql2 = "UPDATE cart SET username='" . $_SESSION['username'] . "', ip_address='0' WHERE id='$id'";
                $statement2 = $conn->query($sql2);
            }
        }
    }
}

function user_items_in_cart()
{
    include "connect.php";
    if (isset($_SESSION['username'])) {
        $sql = "SELECT * FROM cart where username='" . $_SESSION['username'] . "'";
        $statement = $conn->query($sql);
        return $statement->rowCount();
    } else {
        return '00';
    }
}

function get_all_fuels($vehicle, $mark, $model)
{
    include "connect.php";
    $sql = "SELECT * FROM fuel WHERE vehicle_category='$vehicle' AND vehicle_mark='$mark' AND vehicle_model='$model' ORDER BY name ASC";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        echo '<option value="" selected disabled>Choose fuel for the vehicle</option>';
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $name = $row['name'];
            echo "<option value='$name'>$name</option>";
        }
    } else {
        echo '<option value="" selected disabled>No Options Available</option>';
    }
}

function increase_spare_part_views($id)
{
    include "connect.php";
    $sql = "SELECT * FROM spare_parts WHERE id='$id'";
    $statement = $conn->query($sql);
    if ($statement->rowCount() == 1) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $views = $row['views'];
            $views += 1;
            $sql2 = "UPDATE spare_parts set views='$views' WHERE id='$id'";
            $conn->query($sql2);
        }
    }
}

function get_mark_logo($mark)
{
    include "connect.php";
    $sql = "SELECT * FROM vehicle_marks WHERE name='$mark'";
    $statement = $conn->query($sql);
    if ($statement->rowCount() == 1) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $logo = $row['logo'];
            echo "$logo";
        }
    }
}

function save_search_keyword($name)
{
    include "connect.php";
    $sql1 = "DELETE FROM search_list where name='$name'";
    $statement1 = $conn->query($sql1);
    $sql = "INSERT INTO search_list (name) VALUES ('$name')";
    $statement = $conn->query($sql);
}

function check_if_spare_part_category_has_values($name)
{
    include "connect.php";
    $sql = "SELECT * FROM spare_parts WHERE spare_part_category='$name'";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function get_all_search_categories()
{
    include "connect.php";
    $sql = "SELECT * FROM spare_part_categories ORDER BY name DESC LIMIT 100";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        echo '<option value="All" selected>All</option>';
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $name = $row['name'];
            echo "<option value='$name'>$name</option>";
        }
    }
}

function get_all_popular_search_keywords()
{
    include "connect.php";
    $sql = "SELECT * FROM search_list ORDER BY id DESC LIMIT 40";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            echo '<a href="search.php?category=All&q=' . $row['name'] . '">' . $row['name'] . "</a>";
        }
    } else {
        echo "<span>No searches</span>";
    }
}

function count_spare_parts_by_category($category)
{
    include "connect.php";
    $q = mysqli_query($conn2, "select * from spare_parts where spare_part_category='$category'");
    return mysqli_num_rows($q);
}

function get_side_bar_car_categories()
{
    include "connect.php";
    $q = mysqli_query($conn2, "select * from spare_part_categories where vehicle_category='Cars'");
    if (mysqli_num_rows($q) > 0) { ?>
        <div class="li-blog-sidebar pt-25">
            <h4 class="li-blog-sidebar-title">CAR PART CATEGORIES</h4>
            <ul class="li-blog-archive">
                <?php
                while ($r = mysqli_fetch_assoc($q)) {
                    $name = $r['name'];
                    $img = $r['image'];
                ?><li><a href="spare_part_from_category.php?category=<?php echo $name; ?>">
                            <table>
                                <tr>
                                    <td><img src="images/uploads/<?php echo $img ?>" alt="<?php echo $name ?>" width="40" height="40"></td>
                                    <td>&nbsp;</td>
                                    <td><?php echo $name ?> (<?php echo count_spare_parts_by_category($name); ?>)</td>
                                </tr>
                            </table>
                        </a>
                    <?php
                }
                    ?>
            </ul>
        </div>
    <?php
    }
}

function get_side_bar_truck_categories()
{
    include "connect.php";
    $q = mysqli_query($conn2, "select * from spare_part_categories where vehicle_category='Trucks'");
    if (mysqli_num_rows($q) > 0) { ?>
        <div class="li-blog-sidebar pt-25">
            <h4 class="li-blog-sidebar-title">TRUCK PART CATEGORIES</h4>
            <ul class="li-blog-archive">
                <?php
                while ($r = mysqli_fetch_assoc($q)) {
                    $name = $r['name'];
                    $img = $r['image'];
                ?><li><a href="spare_part_from_category.php?category=<?php echo $name; ?>">
                            <table>
                                <tr>
                                    <td><img src="images/uploads/<?php echo $img ?>" alt="<?php echo $name ?>" width="40" height="40"></td>
                                    <td>&nbsp;</td>
                                    <td><?php echo $name ?> (<?php echo count_spare_parts_by_category($name); ?>)</td>
                                </tr>
                            </table>
                        </a>
                    <?php
                }
                    ?>
            </ul>
        </div>
    <?php
    }
}

function get_side_bar_motocycles_categories()
{
    include "connect.php";
    $q = mysqli_query($conn2, "select * from spare_part_categories where vehicle_category='Motocycles'");
    if (mysqli_num_rows($q) > 0) { ?>
        <div class="li-blog-sidebar pt-25">
            <h4 class="li-blog-sidebar-title">Motocycle PART CATEGORIES</h4>
            <ul class="li-blog-archive">
                <?php
                while ($r = mysqli_fetch_assoc($q)) {
                    $name = $r['name'];
                    $img = $r['image'];
                ?><li><a href="spare_part_from_category.php?category=<?php echo $name; ?>">
                            <table>
                                <tr>
                                    <td><img src="images/uploads/<?php echo $img ?>" alt="<?php echo $name ?>" width="40" height="40"></td>
                                    <td>&nbsp;</td>
                                    <td><?php echo $name ?> (<?php echo count_spare_parts_by_category($name); ?>)</td>
                                </tr>
                            </table>
                        </a>
                    <?php
                }
                    ?>
            </ul>
        </div>
    <?php
    }
}



function vehicle_trendings($vehicle)
{
    include "connect.php";
    $sql = "SELECT * FROM spare_parts WHERE vehicle_category='$vehicle' ORDER BY id DESC LIMIT 40";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
    ?>
        <section class="
          product-area
          li-laptop-product li-trendding-products
          best-sellers
          pb-45
        ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span><?php echo $vehicle ?> trending parts</span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            <?php
                            while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                                $name = $row['name'];
                                $img = $row['image'];
                                $category = $row['spare_part_category'];
                                $part_number = $row['part_number'];
                                $product_id = $row['id'];
                                $price = $row['price'];
                            ?>

                                <div class="col-lg-12">
                                    <div class="single-product-wrap" style="box-shadow: 0 0 10px 0 rgb(0 0 0 / 15%);padding:15px 10px">
                                        <div class="product-image">
                                            <a href="./spare_part_from_category.php?category=<?php echo "$category"; ?>&item=<?php echo "$name"; ?>&s_id=<?php echo $product_id; ?>">
                                                <img src="./images/uploads/<?php echo "$img"; ?>" alt="<?php echo $name ?>" class="trending-img">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="spare_parts_from_category.php?category=<?php echo $category; ?>"><?php echo $category; ?></a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li><i><?php echo $part_number; ?></i>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4>
                                                    <a class="product_name" href="spare_parts_from_category.php?category=<?php echo $category; ?>">
                                                        <?php echo $name; ?>
                                                    </a>
                                                </h4>
                                                <div class="price-box">
                                                    <span>PRICE</span>
                                                    <span class="new-price new-price-2"> <?php echo numfmt_format_currency($fmt, $price, "RWF"); ?></span>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active w-100">
                                                        <span style="cursor: pointer" onclick="addToCart(this, <?php echo $product_id; ?>)">Add to cart</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                            echo "</div></div></section>";
                        }
                    }
                    ?>