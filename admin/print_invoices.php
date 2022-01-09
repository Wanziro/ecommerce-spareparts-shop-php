<?php
include"admin_protect.php";
$sql = "SELECT * FROM invoices";
$statement = $conn->query($sql);
if($statement->rowCount() > 0){
    ?>
    <center>
        <h1>KIGALI AUTO SPARE PARTS LTD</h1>
        <p>List of Invoices</p>
    </center>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
    <tr>
            <th>Client Username</th>
            <th>Amount Paid</th>
            <th>Transaction Id</th>
            <th>Reference Id</th>
            <th>Date</th>
        </tr>
        <?php
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $id = $row['id'];
            $us_name = $row['username'];
            $amount = $row['amount'];
            $tx_id = $row['tx_id'];
            $tx_ref = $row['tx_ref'];
            $date = $row['date'];
            echo"
            <tr>
            <td>$us_name</td>
            <td>$amount</td>
            <td>$tx_id</td>
            <td>$tx_ref</td>
            <td>$date</td>
            ";
        }
        ?>
        </table>

    <?php
}else{echo"<h2>No invoices found</h2>";}

?>
<script>
    window.onload = () => {
        window.print()
    }
</script>