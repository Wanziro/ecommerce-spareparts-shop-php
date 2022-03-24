<?php
function get_latest_items($name)
{
    include "connect.php";
    $sql = "SELECT * FROM spare_parts WHERE spare_part_category='$name' ORDER BY id DESC LIMIT 3";
    $statement = $conn->query($sql);
    echo "<ul>";
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $name = $row['name'];
        echo '
        <li>
            <i class="fa fa-gear"></i>
            <span>' . $name . '</span>
        </li>
        ';
    }
    echo "</ul>";
}

$sql = 'SELECT * FROM spare_part_categories';
$statement = $conn->query($sql);
if ($statement->rowCount() > 0) {
?>
    <?php
    $i = 0;
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $name = $row['name'];
        $image = $row['image'];
        if (check_if_spare_part_category_has_values($name)) {
    ?>
            <div class="col-md-3 mb-3  wow fadeInUp delay-<?php echo $i; ?>">
                <div class="home-category-container" style="box-shadow: 0 0 10px 0 rgb(0 0 0 / 15%);padding-top:5px">
                    <a href="spare_part_from_category.php?category=<?php echo $name; ?>">
                        <div class="img-container">
                            <!-- <img
                        src="images/uploads/<?php echo $image; ?>"
                        class="ml-auto mr-auto d-block"
                        alt=""
                        style="max-width:100%; height: 100px"
                        /> -->
                            <div class="li-blog-gallery-slider slick-dot-style">
                                <div class="li-blog-banner">
                                    <img class="ml-auto mr-auto d-block index-sparepart-img" src="images/uploads/<?php echo $image; ?>" alt="<?php echo $name; ?>">
                                </div>
                                <?php
                                $q = mysqli_query($conn2, "select * from spare_parts where spare_part_category='$name' ORDER BY id DESC LIMIT 3");
                                if (mysqli_num_rows($q)) {
                                    while ($r = mysqli_fetch_assoc($q)) {
                                        $img = $r['image'];
                                        $sp_name = $r['name'];
                                ?>
                                        <div class="li-blog-banner">
                                            <img class="ml-auto mr-auto d-block index-sparepart-img" src="images/uploads/<?php echo $img; ?>" alt="<?php echo $sp_name; ?>">
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </a>
                    <div class="category-title"><?php echo $name; ?></div>
                    <div class="item-container">
                        <?php get_latest_items($name); ?>
                    </div>
                </div>
            </div>
<?php
            $i += 1000;
        }
    }
}
?>