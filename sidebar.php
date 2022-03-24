<div class="shop-top-bar mb-3" style="flex-direction: column;">
    <div>
        <p>FILTER BY</p>
    </div>
    <div class="product-short w-100">
        <select class="nice-select" onchange="handleFiltering(this)">
            <option value="name-az" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'name-az') {
                                        echo 'selected';
                                    } ?>>
                Name (A - Z)
            </option>
            <option value="name-za" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'name-za') {
                                        echo 'selected';
                                    } ?>>Name (Z - A)</option>
            <option value="price-lh" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'price-lh') {
                                            echo 'selected';
                                        } ?>>
                Price (Low &gt; High)
            </option>
            <option value="price-hl" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'price-hl') {
                                            echo 'selected';
                                        } ?>>
                Price (High &gt; Low)
            </option>
            <option value="ratings-l" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'ratings-l') {
                                            echo 'selected';
                                        } ?>>
                Rating (Lowest)
            </option>
            <option value="ratings-h" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'ratings-h') {
                                            echo 'selected';
                                        } ?>>
                Rating (Highest)
            </option>
        </select>
    </div>
</div>
<div class="li-blog-sidebar-wrapper" style="border-right: 1px solid #e1e1e1;">
    <div class="p-2 w-100" style="background-color: #e1e1e1;">
        <h4 class="li-blog-sidebar-title m-0">PART CATEGORIES</h4>
    </div>
    <?php
    get_side_bar_car_categories();
    get_side_bar_truck_categories();
    get_side_bar_motocycles_categories(); ?>
</div>