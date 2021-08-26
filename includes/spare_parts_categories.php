<?php
function get_latest_items($name){
    include "connect.php";
    $sql = "SELECT * FROM spare_parts WHERE spare_part_category='$name' ORDER BY id DESC LIMIT 3";
    $statement = $conn->query($sql);
    echo"<ul>";
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $name = $row['name'];
        echo'
        <li>
            <i class="fa fa-gear"></i>
            <span>'.$name.'</span>
        </li>
        ';
    }
    echo"</ul>";
}

$sql = 'SELECT * FROM spare_part_categories';
$statement = $conn->query($sql);
if($statement->rowCount() > 0){
    ?>
    <?php
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $name = $row['name'];
        if(check_if_spare_part_category_has_values($name)){
        ?>
        <div class="col-md-3 mb-3">
              <div class="home-category-container">
                <a href="spare_parts_from_category.php?category=<?php echo $name;?>">
                    <div class="img-container">
                        <img
                        src="images/brake.jpg"
                        class="ml-auto mr-auto d-block"
                        alt=""
                        />
                    </div>
                </a>
                <div class="category-title"><?php echo $name;?></div>
                <div class="item-container">
                  <?php get_latest_items($name);?>
                </div>
              </div>
            </div>
        <?php
        }
    }
}
?>