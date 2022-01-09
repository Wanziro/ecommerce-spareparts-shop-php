<?php
include"connect.php";
include"fxs.php";

function get_transaction_id(){
    include"connect.php";
    $sql = "SELECT * FROM invoices WHERE username='".$_SESSION['username']."' AND status='latest'";
    $statement = $conn->query($sql);
    $result = '';
    if($statement->rowCount() == 1){
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $result = $row['tx_id'];
        }
    }
    return $result;
}

function reduce_products($product_id,$item_number){
    include"connect.php";
    $sql = "SELECT * FROM spare_parts WHERE id='$product_id'";
    $statement = $conn->query($sql);
    if($statement->rowCount() == 1){
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $quantity = $row['quantity'];
            $res = $quantity - $item_number;
            $sql3 = "UPDATE spare_parts SET quantity='$res' WHERE id='$product_id'";
            $statement3 = $conn->query($sql3);           
        }
    }
}

if(!isset($_SESSION['username'])){
  header("Location: login_register.php");
}else{
$sql = "SELECT * FROM cart WHERE username='".$_SESSION['username']."'";
  $statement = $conn->query($sql);
  if($statement->rowCount() > 0){
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $id = $row['id'];
            $product_id = $row['product_id'];
            $item_number = $row['item_number'];
            $total = get_spare_part_price($product_id) * $item_number;
            
            //save in sold products
            if(get_transaction_id() != ''){
                $sqlx = "INSERT INTO sold_products(name,product_id,price,quantity,total,transaction_id,username)
                VALUES ('".get_spare_part_name($product_id)."','$product_id','".get_spare_part_price($product_id)."','$item_number','$total','".get_transaction_id()."','".$_SESSION['username']."')";
                $statementx = $conn->query($sqlx); 


                //delete item in cart
                $sqlx2 = "DELETE FROM cart WHERE id='$id'";
                $statementx2 = $conn->query($sqlx2); 

                //reduce product quantity
                reduce_products($product_id,$item_number);

                
            }//check if the transaction id exists


        }
        //update the latest to old invoice
        $sqlx2 = "UPDATE invoices SET status='Old' WHERE username='".$_SESSION['username']."'";
        $statementx2 = $conn->query($sqlx2);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="css/font-awesome.min.css" />
            <link rel="stylesheet" href="css/bootstrap.min.css" />
            <title>Payment completed!</title>
        </head>
        <body style="background-color: lightgreen">
            <div style="width:100%;height:100vh;display:flex;align-items:center;justify-content:center;">
                <div class="alert alert-success py-5">
                    <div class="text-center">
                        <i class="fa fa-check-circle" style="font-size:5rem"></i>
                    </div>
                    <div class="text-center">
                        <p>Thank you for shopping with us!!!</p>
                        <p>We have sent an invoice to your email address. <br> Also find the payment information and invoice on your profile page.</p>
                        <a href="profile.php">
                            <button class="btn btn-success">Go to my profile</button>
                        </a>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    }else{
        header("Location: index.php");
    }
}
?>
