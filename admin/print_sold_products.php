<?php
function get_user_names($us_name){
    include"admin_protect.php";
    $sql = "SELECT * FROM users WHERE username='".$us_name."'";
    $statement = $conn->query($sql);
    if($statement->rowCount() == 1){
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $fname = $row['fname'];
            $lname = $row['lname'];  

            echo "$fname $lname";
        }
    }else{
        echo"Info not found";
    }
}

$total_amount = 0;
include"admin_protect.php";
$sql = "SELECT * FROM sold_products ORDER BY id DESC";
$statement = $conn->query($sql);
if($statement->rowCount() > 0){
    ?>
    <center>
        <h1>KIGALI AUTO SPARE PARTS LTD</h1>
        <p>List of sold products</p>
    </center>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
    <tr>
        <th align="center">#</th>
        <th align="center">Product Name</th>
        <th align="center">Price</th>
        <th align="center">Quantity</th>
        <th align="center">Total</th>
        <th align="center">Transaction Id</th>
        <th align="center">Client Username</th>
        <th align="center">Client Names</th>
        <th align="center">Date</th>
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
        $total_amount += $total;
        echo"
        <tr>
        <td align='center'>$id</td>
        <td align='center'>$name</td>
        <td align='center'>$price</td>
        <td align='center'>$quantity</td>
        <td align='center'>$total</td>
        <td align='center'>$transactionId</td>
        <td align='center'>$us_name</td>
        <td align='center'>";get_user_names($us_name); echo"</td>
        <td align='center'>$date</td>
        ";
    }
    ?>
    </table>
    <div class="text-right"><h2>TOTAL : <?php echo $total_amount;?> RWF</h2></div>

    <?php
}
?>
<script>
    window.onload = () => {
        window.print()
    }
</script>