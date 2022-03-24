<?php
include "connect.php";
include "fxs.php";
$register_msg = '';
$login_msg = '';
$frm_fname = "";
$frm_lname = "";
$frm_email = "";
$frm_username = "";
function check_email($em)
{
    include "connect.php";
    $sql1 = "SELECT * FROM users where email='$em'";
    $statement1 = $conn->query($sql1);
    if ($statement1->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
function check_username($em)
{
    include "connect.php";
    $sql1 = "SELECT * FROM users where username='$em'";
    $statement1 = $conn->query($sql1);
    if ($statement1->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password1 = $_POST['password'];
    $password2 = $_POST['password2'];
    $username = $_POST['username'];

    $frm_fname = $fname;
    $frm_lname = $lname;
    $frm_username = $username;
    $frm_email = $email;

    if (
        $fname != '' &&
        $lname != '' &&
        $email != '' &&
        $password1 != '' &&
        $password2 != '' &&
        $username != ''
    ) {
        if (check_if_user_exists($username)) {
            $register_msg = '<div class="alert alert-danger">Username already exists. Try another one.</div>';
        } else if (strlen($password1) < 4) {
            $register_msg = '<div class="alert alert-warning">Password is too short. It must be greater or equal to 4 characters.</div>';
        } else if ($password2 != $password1) {
            $register_msg = '<div class="alert alert-danger">Passwords do not match.</div>';
        } else if (check_email($email)) {
            $register_msg = '<div class="alert alert-danger">Email already exists.</div>';
        } else if (check_username($username)) {
            $register_msg = '<div class="alert alert-danger">Username already exists. Try another one.</div>';
        } else {
            $password1 = md5($password1);
            //register new user
            $sql = "INSERT INTO users (fname, lname, email, username, password) 
            VALUES (?,?,?,?,?)";
            $statement = $conn->prepare($sql);
            $statement->execute(array($fname, $lname, $email, $username, $password1));
            //log the user in
            $_SESSION['username'] = $username;
            assign_products_to_user();
            header("Location: index.php");
        }
    }
}


if (isset($_POST['login'])) {
    $password = md5($_POST['password']);
    $username = $_POST['username'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $statement = $conn->query($sql);
    if ($statement->rowCount() > 0) {
        echo '<option value="" selected disabled>Choose fuel for the vehicle</option>';
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $type = $row['type'];
            $_SESSION['username'] = $username;
            if ($type == "CLIENT") {
                assign_products_to_user();
                header("Location: index.php");
            } else {
                header("Location: admin/dashboard.php");
            }
        }
    } else {
        $login_msg = "<div class='alert alert-danger'>Invalid username or password.</div>";
    }
}
?>
<!DOCTYPE html>
<html class="no-js">

<head>
    <?php include "main_header.php"; ?>
</head>

<body>
    <div class="body-wrapper">
        <?php include "./header.php"; ?>
        <div class="body-contents-wrapper">
            <div class="breadcrumb-area" style="margin-top: 0;">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li class="active">Login Register</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-section mb-60 mt-30">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">

                            <form method="post">
                                <div class="login-form">
                                    <h4 class="login-title">Login</h4>
                                    <?php echo $login_msg; ?>
                                    <div class="row">
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Username*</label>
                                            <input class="mb-0" required name="username" type="text" placeholder="Username">
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label>Password</label>
                                            <input class="mb-0" required name="password" type="password" placeholder="Password">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                                <input type="checkbox" id="remember_me">
                                                <label for="remember_me">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                            <a href="#"> Forgotten pasward?</a>
                                        </div>
                                        <div class="col-md-12">
                                            <button name="login" class="register-button mt-0">Login</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                            <form method="POST">
                                <div class="login-form">
                                    <h4 class="login-title">Register</h4>
                                    <?php echo $register_msg; ?>
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-20">
                                            <label>First Name</label>
                                            <input class="mb-0" type="text" value="<?php echo $frm_fname; ?>" name="fname" required placeholder="First Name">
                                        </div>
                                        <div class="col-md-6 col-12 mb-20">
                                            <label>Last Name</label>
                                            <input class="mb-0" type="text" value="<?php echo $frm_lname; ?>" name="lname" required placeholder="Last Name">
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <label>Email Address*</label>
                                            <input class="mb-0" type="email" value="<?php echo $frm_email; ?>" required name="email" placeholder="Email Address">
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <label>Username*</label>
                                            <input class="mb-0" type="text" value="<?php echo $frm_username; ?>" placeholder="Usename" required name="username">
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <label>Password</label>
                                            <input class="mb-0" type="password" name="password" required placeholder="Password">
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <label>Confirm Password</label>
                                            <input class="mb-0" type="password" name="password2" required placeholder="Confirm Password">
                                        </div>
                                        <div class="col-12">
                                            <button class="register-button mt-0" name="register">Register</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- body -->
        <?php include "footer.php"; ?>
    </div>
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
</body>

</html>