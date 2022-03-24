<?php
include "connect.php";
include "fxs.php";
$update_msg = '';

if (!isset($_SESSION['username'])) {
    header("Location: login_register.php");
} else {
    if (isset($_POST['update'])) {
        $c_pwd = mysqli_real_escape_string($conn2, $_POST['c_pwd']);
        $n_pwd = mysqli_real_escape_string($conn2, $_POST['n_pwd']);
        $n_pwd2 = mysqli_real_escape_string($conn2, $_POST['n_pwd2']);
        $q = mysqli_query($conn2, "select * from users where username='" . $_SESSION['username'] . "' and password='" . md5($c_pwd) . "'");
        if (mysqli_num_rows($q) == 1) {
            if (strlen($n_pwd) > 3) {
                if ($n_pwd == $n_pwd2) {
                    $qq = mysqli_query($conn2, "update users set password='" . md5($n_pwd) . "' where username='" . $_SESSION['username'] . "'");
                    if ($qq) {
                        $update_msg = "<div class='alert alert-success'>Password updated successful</div>";
                    } else {
                        $update_msg = "<div class='alert alert-danger'>Something went wrong, try again later after sometime</div>";
                    }
                } else {
                    $update_msg = "<div class='alert alert-danger'>Passwords do not match</div>";
                }
            } else {
                $update_msg = "<div class='alert alert-danger'>Password must at least contain 4 characters</div>";
            }
        } else {
            $update_msg = "<div class='alert alert-danger'>Wrong old password</div>";
        }
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
                <h2>ABOUT ME</h2>
            </div>
            <!--  -->
            <div class="row clearfix">
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Firstname</h2>
                        </div>
                        <div class="body">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 100%;"><?php echo $fname ?></td>
                                    <td>
                                        <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Lastname</h2>
                        </div>
                        <div class="body">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 100%;"><?php echo $lname ?></td>
                                    <td>
                                        <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->

            <!--  -->
            <div class="row clearfix">
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Email</h2>
                        </div>
                        <div class="body">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 100%;"><?php echo $email ?></td>
                                    <td>
                                        <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Username</h2>
                        </div>
                        <div class="body">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 100%;"><?php echo $username ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->

            <!--  -->
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update your password</h2>
                        </div>
                        <div class="body">
                            <?php echo $update_msg ?>
                            <form method="POST">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="c_pwd" required />
                                        <label class="form-label">Current password</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="n_pwd" required />
                                        <label class="form-label">New password</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="n_pwd2" required />
                                        <label class="form-label">Confirm password</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" type="submit" name="update">Update</button>
                            </form>
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