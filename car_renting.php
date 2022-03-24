<?php
include "connect.php";
include "fxs.php";
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = 'az';
}
?>
<!DOCTYPE html>
<html class="no-js">

<head>
    <?php include "main_header.php"; ?>
</head>

<body>
    <div class="body-wrapper">
        <?php include "header.php"; ?>
        <div class="body-contents-wrapper">
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li class="active">Car renting</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Begin Li's Content Wraper Area -->
            <div class="content-wraper pt-15 pb-60 pt-sm-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 order-1 order-lg-2">
                            <!-- shop-top-bar start -->
                            <div class="shop-top-bar">
                                <div class="shop-bar-inner">
                                    <div class="product-view-mode">
                                        <!-- shop-item-filter-list start -->
                                        <ul class="nav shop-item-filter-list" role="tablist">
                                            <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                            <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
                                        </ul>
                                        <!-- shop-item-filter-list end -->
                                    </div>
                                    <div class="toolbar-amount">
                                        <span>Ready for renting</span>
                                    </div>
                                </div>
                                <!-- product-select-box start -->
                                <div class="product-select-box">
                                    <div class="product-short">
                                        <p>Sort By:</p>
                                        <select class="nice-select" onchange="handleFiltering2(this)">
                                            <option value="az" <?php if ($sort == 'az') {
                                                                    echo 'selected';
                                                                } ?>>Name (A - Z)</option>
                                            <option value="za" <?php if ($sort == 'za') {
                                                                    echo 'selected';
                                                                } ?>>Name (Z - A)</option>
                                            <option value="lh" <?php if ($sort == 'lh') {
                                                                    echo 'selected';
                                                                } ?>>Price (Low &gt; High)</option>
                                            <option value="hl" <?php if ($sort == 'hl') {
                                                                    echo 'selected';
                                                                } ?>>Price (High &gt; Low)</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- product-select-box end -->
                            </div>
                            <!-- shop-top-bar end -->
                            <!-- shop-products-wrapper start -->
                            <div class="shop-products-wrapper">
                                <div class="tab-content">
                                    <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                                        <div class="product-area shop-product-area">
                                            <div class="row">
                                                <?php
                                                if ($sort == 'za') {
                                                    $q = mysqli_query($conn2, "select * from cars_for_renting where status='enabled' order by car_name desc");
                                                } else if ($sort == 'lh') {
                                                    $q = mysqli_query($conn2, "select * from cars_for_renting where status='enabled' order by price asc");
                                                } else if ($sort == 'hl') {
                                                    $q = mysqli_query($conn2, "select * from cars_for_renting where status='enabled' order by price desc");
                                                } else {
                                                    $q = mysqli_query($conn2, "select * from cars_for_renting where status='enabled' order by car_name asc");
                                                }
                                                $num  = mysqli_num_rows($q);
                                                if ($num > 0) {
                                                    while ($row = mysqli_fetch_assoc($q)) {
                                                        $car_name = $row['car_name'];
                                                        $image = $row['image1'];
                                                        $price = $row['price'];
                                                        $car_type = $row['type'];
                                                        $seats = $row['seats'];
                                                        $doors = $row['doors'];
                                                        $make = $row['make'];
                                                        $category = $row['category'];
                                                        $id = $row['id'];
                                                ?>
                                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40 cars-for-renting" data-processed="no" data-type="<?php echo $car_type ?>" data-make="<?php echo $make ?>" data-category="<?php echo $category ?>">
                                                            <div class="car-container">
                                                                <a href="car_details.php?id=<?php echo $id ?>">
                                                                    <img src="images/uploads/car_renting/<?php echo $image ?>" class="w-100" alt="<?php echo $car_name ?>">
                                                                </a>
                                                                <div class="car-descriptions">
                                                                    <div class="text-center">
                                                                        <p class="text-dark"><b><?php echo $car_name ?></b></p>
                                                                        <div class="icons-containter">
                                                                            <div>
                                                                                <img src="images/ic/door.png" alt="">
                                                                                <p class="m-0 text-center"><?php echo $doors ?></p>
                                                                            </div>
                                                                            <div>
                                                                                <img src="images/ic/seat.png" alt="">
                                                                                <p class="m-0 text-center"><?php echo $seats ?></p>
                                                                            </div>
                                                                            <div>
                                                                                <img src="images/ic/type.png" alt="">
                                                                                <p class="m-0 text-center"><?php echo $car_type ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="car-sub-desc">
                                                                        <p class="m-0"><i class="fa fa-check"></i> <?php echo $make ?></p>
                                                                        <p class="m-0"><i class="fa fa-check"></i> Pay at pickup</p>
                                                                    </div>
                                                                    <table class="w-100">
                                                                        <tr>
                                                                            <td><span class="dark-text2"><?php echo number_format($price) . ' RWF / Day' ?></span></td>
                                                                            <td>&nbsp;&nbsp;</td>
                                                                            <td>
                                                                                <a href="car_details.php?id=<?php echo $id ?>">
                                                                                    <button class="btn text-white">Book Now</button>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="list-view" class="tab-pane fade product-list-view" role="tabpanel">
                                        <div class="row">
                                            <div class="col">
                                                <?php
                                                if ($sort == 'za') {
                                                    $q = mysqli_query($conn2, "select * from cars_for_renting where status='enabled' order by car_name desc");
                                                } else if ($sort == 'lh') {
                                                    $q = mysqli_query($conn2, "select * from cars_for_renting where status='enabled' order by price asc");
                                                } else if ($sort == 'hl') {
                                                    $q = mysqli_query($conn2, "select * from cars_for_renting where status='enabled' order by price desc");
                                                } else {
                                                    $q = mysqli_query($conn2, "select * from cars_for_renting where status='enabled' order by car_name asc");
                                                }
                                                $num  = mysqli_num_rows($q);
                                                if ($num > 0) {
                                                    while ($row = mysqli_fetch_assoc($q)) {
                                                        $car_name = $row['car_name'];
                                                        $image = $row['image1'];
                                                        $price = $row['price'];
                                                        $car_type = $row['type'];
                                                        $seats = $row['seats'];
                                                        $doors = $row['doors'];
                                                        $make = $row['make'];
                                                        $category = $row['category'];
                                                        $id = $row['id'];
                                                ?>
                                                        <div class="row product-layout-list cars-for-renting" data-processed="no" data-type="<?php echo $car_type ?>" data-make="<?php echo $make ?>" data-category="<?php echo $category ?>">
                                                            <div class="col-lg-3 col-md-5 ">
                                                                <div class="product-image">
                                                                    <a href="car_details.php?id=<?php echo $id ?>">
                                                                        <img src="images/uploads/car_renting/<?php echo $image ?>" alt="<?php echo $car_name ?>" style="width: 100%;height:auto">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5 col-md-7">
                                                                <div class="product_desc">
                                                                    <div class="product_desc_info">
                                                                        <div class="product-review">
                                                                            <h5 class="manufacturer">
                                                                                <a href="car_details.php?id=<?php echo $id ?>">Category : <?php echo $category ?></a>
                                                                            </h5>
                                                                            <div class="rating-box">
                                                                                <ul class="rating">
                                                                                    <li style="color: #ff5722"><?php echo number_format($price) ?> RWF</li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <h4><a class="product_name" href="car_details.php?id=<?php echo $id ?>"><?php echo $car_name ?></a></h4>
                                                                        <div class="price-box">
                                                                            <p class="m-0"><i class="fa fa-check"></i> <?php echo $make ?></p>
                                                                            <p class="m-0"><i class="fa fa-check"></i> <?php echo $car_type ?></p>
                                                                            <p class="m-0"><i class="fa fa-check"></i> <?php echo $doors ?> doors</p>
                                                                            <p class="m-0"><i class="fa fa-check"></i> <?php echo $seats ?> seats</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="shop-add-action mb-xs-30">
                                                                    <ul class="add-actions-link">
                                                                        <li class="add-cart"><a href="car_details.php?id=<?php echo $id ?>">Book now</a></li>
                                                                        <li><a class="quick-view" href="car_details.php?id=<?php echo $id ?>"><i class="fa fa-eye"></i>Quick view</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- shop-products-wrapper end -->
                        </div>
                        <div class="col-lg-3 order-2 order-lg-1">
                            <div class="sidebar-categores-box">
                                <div class="sidebar-title">
                                    <h2>Filter By</h2>
                                </div>
                                <!-- btn-clear-all start -->
                                <button class="btn-clear-all mb-sm-30 mb-xs-30" onclick="clearAll()">Clear all</button>
                                <!-- btn-clear-all end -->
                                <!-- filter-sub-area start -->
                                <?php
                                $q = mysqli_query($conn2, "select distinct(make) from cars_for_renting where status='enabled' order by id desc");
                                $num  = mysqli_num_rows($q);
                                if ($num > 0) {
                                ?>
                                    <div class="filter-sub-area">
                                        <h5 class="filter-sub-titel">MAKE</h5>
                                        <div class="categori-checkbox">
                                            <form action="#" id="makeForm">
                                                <ul>
                                                    <?php
                                                    while ($row = mysqli_fetch_assoc($q)) {
                                                        $make = $row['make'];
                                                        echo '<li><input type="checkbox" onclick="handleMakes(this)" value="' . $make . '"> ' . $make . '</li>';
                                                    }
                                                    ?>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- filter-sub-area end -->
                                <!-- filter-sub-area start -->
                                <div class="filter-sub-area pt-sm-10 pt-xs-10">
                                    <h5 class="filter-sub-titel">Categories</h5>
                                    <div class="categori-checkbox">
                                        <form action="#" id="categoryForm">
                                            <ul>
                                                <li><input type="radio" name="product-categori" onclick="handleFilterCategory(this)" value="car"> Car</li>
                                                <li><input type="radio" name="product-categori" onclick="handleFilterCategory(this)" value="truck"> Truck</li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                                <!-- filter-sub-area end -->
                                <!-- filter-sub-area start -->
                                <div class="filter-sub-area pt-sm-10 pt-xs-10">
                                    <h5 class="filter-sub-titel">Type</h5>
                                    <div class="size-checkbox">
                                        <form action="#" id="typeForm">
                                            <ul>
                                                <li><input type="radio" name='type' onclick="handleFilterType(this)" value="manual"> Manual</li>
                                                <li><input type="radio" name='type' onclick="handleFilterType(this)" value="automatic"> Automatic</li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Wraper Area End Here -->

        <?php include "footer.php"; ?>
    </div>

    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/jquery.meanmenu.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.barrating.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/venobox.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/scrollUp.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        let filterTypes = '';
        let filterCategory = '';
        let filterMakes = [];

        const handleFilterType = box => {
            if (box.checked) {
                filterTypes = box.value
            }
            handleTypes();
        }
        const handleFilterCategory = box => {
            if (box.checked) {
                filterCategory = box.value;
            }
            handleCategories();
        }

        const handleTypes = () => {
            const cars = document.getElementsByClassName('cars-for-renting');
            if (filterTypes != '') {
                for (let x = 0; x < cars.length; x++) {
                    // data-type="" data-make="" data-category=""
                    const make = cars[x].getAttribute('data-make');
                    const category = cars[x].getAttribute('data-category');
                    if (filterCategory == '' && filterMakes.length == 0) {
                        if (cars[x].getAttribute('data-type') == filterTypes) {
                            cars[x].classList.remove('d-none');
                            cars[x].setAttribute('data-chosen', 'true');
                        } else {
                            cars[x].classList.add('d-none');
                        }
                    } else {
                        if (cars[x].getAttribute('data-type') == filterTypes && (category == filterCategory || filterMakes.indexOf(make) != -1)) {
                            cars[x].classList.remove('d-none');
                            cars[x].setAttribute('data-chosen', 'true');
                        } else {
                            cars[x].classList.add('d-none');
                        }
                    }
                }
            }
        }

        const handleCategories = () => {
            const cars = document.getElementsByClassName('cars-for-renting');
            if (filterCategory != '') {
                for (let x = 0; x < cars.length; x++) {
                    const make = cars[x].getAttribute('data-make');
                    const type = cars[x].getAttribute('data-type');
                    if (filterTypes == '' && filterMakes.length == 0) {
                        if (cars[x].getAttribute('data-category') == filterCategory) {
                            cars[x].classList.remove('d-none');
                            cars[x].setAttribute('data-chosen', 'true');
                        } else {
                            cars[x].classList.add('d-none');
                        }
                    } else {
                        if (cars[x].getAttribute('data-category') == filterCategory && (type == filterTypes || filterMakes.indexOf(make) != -1)) {
                            cars[x].classList.remove('d-none');
                            cars[x].setAttribute('data-chosen', 'true');
                        } else {
                            cars[x].classList.add('d-none');
                        }
                    }
                }
            }
        }

        const handleMakes = box => {
            if (box.checked) {
                if (filterMakes.indexOf(box.value) == -1) {
                    filterMakes.push(box.value);
                }
            } else {
                filterMakes.splice(filterMakes.indexOf(box.value), 1);
            }
            handleMakesDisplay();
        }

        const handleMakesDisplay = () => {
            const cars = document.getElementsByClassName('cars-for-renting');
            if (filterMakes.length > 0) {
                for (let x = 0; x < cars.length; x++) {
                    const category = cars[x].getAttribute('data-category');
                    const type = cars[x].getAttribute('data-type');
                    if (filterTypes == '' && filterCategory == '') {
                        if (filterMakes.indexOf(cars[x].getAttribute('data-make')) != -1) {
                            cars[x].classList.remove('d-none');
                            cars[x].setAttribute('data-chosen', 'true');
                        } else {
                            cars[x].classList.add('d-none');
                        }
                    } else {
                        if (filterMakes.indexOf(cars[x].getAttribute('data-make')) != -1 && (type == filterTypes || category == filterCategory)) {
                            cars[x].classList.remove('d-none');
                            cars[x].setAttribute('data-chosen', 'true');
                        } else {
                            cars[x].classList.add('d-none');
                        }
                    }
                }
            }
        }

        const clearAll = () => {
            filterMakes = [];
            filterCategory = '';
            filterTypes = '';
            document.getElementById('makeForm').reset();
            document.getElementById('categoryForm').reset();
            document.getElementById('typeForm').reset();
            const cars = document.getElementsByClassName('cars-for-renting');
            for (let x = 0; x < cars.length; x++) {
                cars[x].classList.remove('d-none');
            }
        }
    </script>
</body>

</html>