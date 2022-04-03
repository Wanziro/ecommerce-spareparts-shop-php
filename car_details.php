<?php
include "connect.php";
include "fxs.php";
$msg = '';
$submitSuccess = '';
$min = date('Y-m-d');
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = 'az';
}

if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $fname = mysqli_real_escape_string($conn2, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn2, $_POST['lname']);
    $phone = mysqli_real_escape_string($conn2, $_POST['phone']);
    $email = mysqli_real_escape_string($conn2, $_POST['email']);
    $pickup_date = mysqli_real_escape_string($conn2, $_POST['pickup_date']);
    $return_date = mysqli_real_escape_string($conn2, $_POST['return_date']);

    if (
        trim($fname) == '' ||
        trim($lname) == '' ||
        trim($phone) == '' ||
        trim($email) == '' ||
        trim($pickup_date) == '' ||
        trim($return_date) == ''

    ) {
        $msg = "<div class='alert alert-danger'>All fields are required.</div>";
    } else {
        if (strlen($phone) != 10) {
            $msg = "<div class='alert alert-danger'>Phone number must be 10 numbers</div>";
        } else if (!preg_match('/^07[2,3,8]{1}[0-9]{7}$/', $phone)) {
            $msg = "<div class='alert alert-danger'>Invalid phone number</div>";
        } else {
            //check if the car is already booked for specific date
            $q = mysqli_query($conn2, "select * from booking where pickup_date='$pickup_date' and return_date='$return_date' and confirmed='1'");
            if (mysqli_num_rows($q) > 0) {
                $msg = "<div class='alert alert-warning'>Sorry! the vehicle you are trying to book is not available at the selected date. Please select different date and try again later.</div>";
            } else {
                $q2 = mysqli_query($conn2, "select * from booking where email='$email' and phone='$phone'");
                if (mysqli_num_rows($q2) > 0) {
                    while ($row = mysqli_fetch_assoc($q2)) {
                        $confirmed = $row['confirmed'];
                        if ($confirmed == '1') {
                            $msg = "<div class='alert alert-warning'>You have already booked this car between $pickup_date - $return_date.</div>";
                        } else {
                            $msg = "<div class='alert alert-warning'>You have already booked this car. Your request is waiting to be approved by admin.</div>";
                        }
                    }
                } else {
                    $q = mysqli_query($conn2, "insert into booking(vehicle_id,fname,lname,email,phone,pickup_date,	return_date) 
                    values('$id','$fname','$lname','$email','$phone','$pickup_date','$return_date')");
                    if ($q) {
                        $submitSuccess = true;
                    } else {
                        $submitSuccess = false;
                    }
                }
            }
            //check if the car is already booked for specific date
        }
    }
}
?>
<!DOCTYPE html>
<html class="no-js">

<head>
    <?php include "main_header.php"; ?>
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <style>
        .header-bottom {
            margin-bottom: 0px;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper {
            width: 100%;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .mySwiper2 {
            height: 80%;
            width: 100%;
        }

        .mySwiper {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .mySwiper .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .mySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="body-wrapper">
        <?php include "header.php"; ?>
        <div class="body-contents-wrapper">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $q = mysqli_query($conn2, "select * from cars_for_renting where id='$id'");
                if (mysqli_num_rows($q) == 1) {
                    while ($row = mysqli_fetch_assoc($q)) {
                        $car_name = $row['car_name'];
                        $image1 = $row['image1'];
                        $image2 = $row['image2'];
                        $image3 = $row['image3'];
                        $image4 = $row['image4'];
                        $price = $row['price'];
                        $car_type = $row['type'];
                        $seats = $row['seats'];
                        $doors = $row['doors'];
                        $make = $row['make'];
                        $category = $row['category'];
                        $description = $row['description'];
            ?>
                        <div class="breadcrumb-area" style="margin-top: 0px;">
                            <div class="container">
                                <div class="breadcrumb-content">
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li class="active"><a href="car_renting.php">Car renting</a></li>
                                        <li class="active"><?php echo $car_name ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Begin Li's Content Wraper Area -->
                        <div class="content-wraper pt-20 pb-60 pt-sm-30">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div>
                                            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <img src="images/uploads/car_renting/<?php echo $image1 ?>" />
                                                    </div>
                                                    <?php
                                                    if (trim($image2) != '' || !is_null($image2)) {
                                                    ?>
                                                        <div class="swiper-slide">
                                                            <img src="images/uploads/car_renting/<?php echo $image2 ?>" />
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if (trim($image3) != '' || !is_null($image3)) {
                                                    ?>
                                                        <div class="swiper-slide">
                                                            <img src="images/uploads/car_renting/<?php echo $image3 ?>" />
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if (trim($image4) != '' || !is_null($image4)) {
                                                    ?>
                                                        <div class="swiper-slide">
                                                            <img src="images/uploads/car_renting/<?php echo $image4 ?>" />
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="swiper-button-next" style="background-color: rgba(0,0,0,0.3);border-radius: 100%;height: 50px;width: 50px;"></div>
                                                <div class="swiper-button-prev" style="background-color: rgba(0,0,0,0.3);border-radius: 100%;height: 50px;width: 50px;"></div>
                                            </div>
                                            <div thumbsSlider="" class="swiper mySwiper">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <img src="images/uploads/car_renting/<?php echo $image1 ?>" />
                                                    </div>
                                                    <?php
                                                    if (trim($image2) != '' || !is_null($image2)) {
                                                    ?>
                                                        <div class="swiper-slide">
                                                            <img src="images/uploads/car_renting/<?php echo $image2 ?>" />
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if (trim($image3) != '' || !is_null($image3)) {
                                                    ?>
                                                        <div class="swiper-slide">
                                                            <img src="images/uploads/car_renting/<?php echo $image3 ?>" />
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if (trim($image4) != '' || !is_null($image4)) {
                                                    ?>
                                                        <div class="swiper-slide">
                                                            <img src="images/uploads/car_renting/<?php echo $image4 ?>" />
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="booking-container">
                                            <table class="w-100">
                                                <tr>
                                                    <td>
                                                        <h2><?php echo $car_name ?></h2>
                                                    </td>
                                                    <td align="right">
                                                        <p style="color:#da1c36;font-size:20px"><?php echo number_format($price) ?> Rwf / Day</p>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="car-details-container">
                                                        <p class="m-0"><i class="fa fa-check"></i> <?php echo $make ?></p>
                                                        <p class="m-0"><i class="fa fa-check"></i> <?php echo $car_type ?></p>
                                                        <p class="m-0"><i class="fa fa-check"></i> <?php echo $doors ?> doors</p>
                                                        <p class="m-0"><i class="fa fa-check"></i> <?php echo $seats ?> seats</p>
                                                        <p class="m-0"><i class="fa fa-check"></i> Pay at pickup</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                    if (trim($description) != '' && !is_null($description)) {
                                                        $description =  str_replace(">,", ">", $description)
                                                    ?>
                                                        <div class="car-description-container">
                                                            <?php echo $description ?>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="booking-container">
                                            <div class="booking-header">
                                                <span>BOOK THIS <?php echo strtoupper($category) ?></span>
                                            </div>
                                            <?php echo $msg ?>
                                            <form method="post">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" name="fname" class="form-control" placeholder="Enter your firstname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" name="lname" class="form-control" placeholder="Enter your lastname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="phone" name="phone" class="form-control" placeholder="Enter your phone ex: 07..." pattern="07[2,3,8]{1}[0-9]{7}" title="Invalid Phone Number (use MTN or AIRTEL-TIGO mobile number). start with 07..." maxlength="10" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pickup Date</label>
                                                    <input type="date" name="pickup_date" min="<?php echo $min ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Return Date</label>
                                                    <input type="date" name="return_date" min="<?php echo $min ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <table>
                                                        <tr>
                                                            <td valign="top">
                                                                <input type="checkbox" style="height: auto;width:25px;margin:0px;padding:0px" required>
                                                            </td>
                                                            <td valign="top">
                                                                <span>By submitting this application I agree to terms and condition</span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class=" form-group">
                                                    <button class="btn w-100" name="submit" type="submit">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Content Wraper Area End Here -->
                    <?php
                    }
                } else {
                    ?>
                    <div class="content-wraper pt-60 pb-60 pt-sm-30">
                        <div class="container">
                            Invalid details.
                        </div>
                    </div>
            <?php
                }
            }
            ?>

        </div>
        <?php include "footer.php"; ?>
    </div>


    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <?php
                    if ($submitSuccess == true) { ?>
                        <div class="mt-2" style="display: flex;align-items:center;justify-content:center;flex-direction:column;">
                            <div style="border-radius: 100%;padding:10px;" class="bg-success">
                                <i class="fa fa-check text-white" style="font-size: 2rem;"></i>
                            </div>
                            <h2 class="text-success">Congratulations!!</h2>
                            <p class="text-center text-dark m-0">Your request for booking this <?php echo $category ?> was completed successful!. </p>
                            <p class="text-center text-dark">We will notify you through the address that you gave us when the request is approved. <a href="index.php" class="text-success" style="text-decoration: underline;">Continue</a></p>
                        </div>
                    <?php } else {
                    ?>
                        <div class="mt-2" style="display: flex;align-items:center;justify-content:center;flex-direction:column;">
                            <i class="fa fa-exclamation-triangle text-danger" style="font-size: 2rem;"></i>
                            <h2 class="text-danger">Error</h2>
                            <p class="text-center text-dark m-0">Something went wrong while submitting your request. </p>
                            <p class="text-center text-dark">Try again later after sometime.</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- whatsap chatt container -->
    <div class="whatsap-main-container">
        <a href="https://wa.me/250780848761" target="_blank">
            <img src="images/w_logo_2.png" alt="contact us on whatsapp">
        </a>
    </div>
    <!-- whatsap chatt container -->

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
    <script src="js/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>

    <?php
    if ($submitSuccess != '') {
    ?>
        <script>
            $("#successModal").modal('show')
        </script>
    <?php
    }
    ?>
</body>

</html>