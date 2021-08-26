<header>
        <!-- Begin Header Middle Area -->
        <div
          class="header-middle header-sticky pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0"
        >
          <div class="container">
            <div class="row">
              <!-- Begin Header Logo Area -->
              <div class="col-lg-3">
                <div class="logo pb-sm-30 pb-xs-30">
                  <a href="index.php">
                    <h1>ProjectName</h1>
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
                  <input
                    type="text"
                    name='q'
                    placeholder="Search by part name or by part number"
                    id="keyWord"
                    autocomplete="off"
                    value="<?php if(isset($_GET['q'])){echo $_GET['q'];}?>"
                    required
                  />
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
                          <a
                            href="cart.php"
                            class="li-button li-button-fullwidth li-button-dark"
                          >
                            <span>View Full Cart</span>
                          </a>
                          <a
                            href="checkout.html"
                            class="li-button li-button-fullwidth"
                          >
                            <span>Checkout</span>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li class="hm-wishlist">
                      <a href="#">
                        <i class="fa fa-user-o"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php include"./includes/nav_bar.php";?>
      </header>