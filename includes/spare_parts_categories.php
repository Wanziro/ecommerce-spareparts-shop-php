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
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $name = $row['name'];
        $image = $row['image'];
        if (check_if_spare_part_category_has_values($name)) {
    ?>
            <div class="col-md-3 mb-3">
                <div class="home-category-container">
                    <a href="spare_parts_from_category.php?category=<?php echo $name; ?>">
                        <div class="img-container">
                            <!-- <img
                        src="images/uploads/<?php echo $image; ?>"
                        class="ml-auto mr-auto d-block"
                        alt=""
                        style="max-width:100%; height: 100px"
                        /> -->
                            <div class="li-blog-gallery-slider slick-dot-style">
                                <div class="li-blog-banner">
                                    <img style="max-width:100%; height: 150px" class="ml-auto mr-auto d-block" src="images/uploads/<?php echo $image; ?>" alt="<?php echo $name; ?>">
                                </div>
                                <?php
                                $q = mysqli_query($conn2, "select * from spare_parts where spare_part_category='$name' ORDER BY id DESC LIMIT 3");
                                if (mysqli_num_rows($q)) {
                                    while ($r = mysqli_fetch_assoc($q)) {
                                        $img = $r['image'];
                                        $sp_name = $r['name'];
                                ?>
                                        <div class="li-blog-banner">
                                            <img style="max-width:100%; height: 100px" class="ml-auto mr-auto d-block" src="images/uploads/<?php echo $img; ?>" alt="<?php echo $sp_name; ?>">
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
        }
    }
}
?>