<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info dark-bg">
        <!-- <div class="image">
            <img src="profile/images/user.png" width="48" height="48" alt="User" />
        </div> -->
        <div class="user-logo">
            <?php echo $fname[0], $lname[0] ?>
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $fname, ' ', $lname ?>
            </div>
            <div class="email"><?php echo $email ?></div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li>
                <a href="index.php">
                    <i class="fa fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="active">
                <a href="profile.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-shopping-basket"></i>
                    <span>My orders</span>
                </a>
            </li>
            <li>
                <a href="cart.php">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Cart</span>
                </a>
            </li>
            <li>
                <a href="about_me.php">
                    <i class="fa fa-gear"></i>
                    <span>About me</span>
                </a>
            </li>
            <li>
                <a href="logout">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
</aside>