<?php
$msg= '';
include"admin_protect.php";
include"fxs.php";
function get_vehicle_category_of_product($id){
    include"admin_protect.php";
    $sql = "SELECT * FROM spare_parts WHERE id='".$id."'";
    $statement = $conn->query($sql);
    if($statement->rowCount() == 1){
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $cat = $row['vehicle_category'];  

            return $cat;
        }
    }else{
        return "Info not found";
    }
}

function get_product_category_of_product($id){
    include"admin_protect.php";
    $sql = "SELECT * FROM spare_parts WHERE id='".$id."'";
    $statement = $conn->query($sql);
    if($statement->rowCount() == 1){
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $cat = $row['spare_part_category'];  

            return $cat;
        }
    }else{
        return "Info not found";
    }
}

function get_product_mark_of_product($id){
    include"admin_protect.php";
    $sql = "SELECT * FROM spare_parts WHERE id='".$id."'";
    $statement = $conn->query($sql);
    if($statement->rowCount() == 1){
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $cat = $row['vehicle_mark'];  

            return $cat;
        }
    }else{
        return "Info not found";
    }
}
?>
<?php
$total_amount = 0;
$sql = "SELECT * FROM sold_products ORDER BY id DESC LIMIT 10";
$statement = $conn->query($sql);
if($statement->rowCount() > 0){ ?>
<center>
    <h1>Car Spare Parts Sold</h1>
</center>
<table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th>Spare Part Name</th>
                    <th>Spare Part Category</th>
                    <th>Mark</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Transaction Id</th>
                    <th>Client Username</th>
                    <th>Client Names</th>
                    <th>Date</th>
                </tr>
                <?php
                while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                    $id = $row['id'];
                    $price = $row['price'];
                    $name = $row['name'];
                    $quantity = $row['quantity'];
                    $total = $row['total'];
                    $transactionId = $row['transaction_id'];
                    $us_name = $row['username'];
                    $date = $row['date'];
                    $product_id = $row['product_id'];
                    if(get_vehicle_category_of_product($product_id) == "Cars"){
                        $total_amount += $total;
                        echo"
                        <tr>
                        <td>$name</td>
                        <td>".get_product_category_of_product($product_id)."</td>
                        <td>".get_product_mark_of_product($product_id)."</td>
                        <td>$price RWF</td>
                        <td>$quantity</td>
                        <td>$total</td>
                        <td>$transactionId</td>
                        <td>$us_name</td>
                        <td>";get_user_names($us_name); echo"</td>
                        <td>$date</td>
                        ";
                    }
                }
                ?>
                </table>
                <div class="text-right"><h2>TOTAL : <?php echo $total_amount;?> RWF</h2></div>
                </div>
                </div>
                </div>
                </div>
        
                <?php
            }else{
                echo"No Products found";
            }
            ?> 
            <script>
                window.onload = () => {
                    window.print();
                }
            </script>