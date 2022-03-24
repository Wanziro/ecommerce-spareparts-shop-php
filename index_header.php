<header>
    <div class="header-main-container2">
        <!-- Begin Header Middle Area -->
        <div class="header-dynamic header-middle2  pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
            <div class="container py-0">
                <div class="row">
                    <!-- Begin Header Logo Area -->
                    <div class="col-lg-3">
                        <div class="logo pb-sm-30 pb-xs-30">
                            <a href="index.php">
                                <table>
                                    <tr>
                                        <td> <img src="logo/v2/log.png" style="width: 50px;" alt=""></td>
                                        <td>
                                            <h2 class="m-0 text-white" style="font-size: 18px;">Auto Expert Rwanda</h2>
                                        </td>
                                    </tr>
                                </table>
                            </a>
                        </div>
                    </div>
                    <!-- Header Logo Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                        <!-- Begin Header Middle Searchbox Area -->
                        <form action="search.php" class="hm-searchbox">
                            <select name='category' id="searchCategory" class="nice-select select-search-category">
                                <?php get_all_search_categories(); ?>
                            </select>
                            <div class="search-container">
                                <input type="text" name='q' placeholder="Search by part name or by part number" id="keyWord" autocomplete="off" value="<?php if (isset($_GET['q'])) {
                                                                                                                                                            echo $_GET['q'];
                                                                                                                                                        } ?>" required />
                                <div class="search-result-menu d-none" id="searchResult">
                                </div>
                            </div>
                            <button class="li-btn" style="z-index: 200;" id="searchBtn" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>

                        <div class="header-middle-right">
                            <ul class="hm-menu">
                                <li class="hm-minicart">
                                    <div class="hm-minicart-trigger">
                                        <span class="item-icon"></span>
                                        <span class="item-text" id="miniCartNotifications">0.000 RWF
                                            <span class="cart-item-count" id="cartTotalItemsNotification">0</span>
                                        </span>
                                    </div>
                                    <span></span>
                                    <div class="minicart">
                                        <div id="miniCart"></div>
                                        <p class="minicart-total">
                                            SUBTOTAL: <span id="miniCartTotal">0.000 RWF</span>
                                        </p>
                                        <div class="minicart-button">
                                            <a href="cart.php" class="li-button li-button-fullwidth li-button-dark">
                                                <span>View Full Cart</span>
                                            </a>
                                            <?php if (isset($_SESSION['username'])) { ?>
                                                <a href="checkout.php" class="li-button li-button-fullwidth">
                                                    <span>Checkout</span>
                                                </a>
                                            <?php } else { ?>
                                                <a href="login_register.php" class="li-button li-button-fullwidth" onclick="return confirm('You must Login first inorder to go to the checkout!')">
                                                    <span>Checkout</span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </li>

                                <?php if (isset($_SESSION['username'])) {
                                    include "get_user_details.php";
                                ?>
                                    <li class="hm-wishlist">
                                        <div class="header-user-dropdown">
                                            <!-- <i class="fa fa-user-circle"></i> -->
                                            <div class="user-logo">
                                                <?php echo $fname[0] ?>
                                                <?php echo $lname[0] ?>
                                            </div>
                                            <div class="header-user-dropdown-content">
                                                <p class="m-0"><?php echo $fname, ' ', $lname; ?></p>
                                                <small><?php echo $email ?></small>
                                                <a href="profile.php"><i class="fa fa-user-o" style="font-size: 14px;"></i> My profile</a>
                                                <a href="logout.php"><i class="fa fa-sign-out" style="font-size: 14px;"></i> Logout</a>
                                            </div>
                                        </div>
                                    </li>
                                <?php
                                } else { ?>
                                    <li class="hm-wishlist">
                                        <a href="login_register.php">
                                            <i class="fa fa-user-o"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "./includes/nav_bar.php"; ?>
    </div>
</header>