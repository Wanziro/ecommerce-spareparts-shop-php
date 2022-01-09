<?php
include"connect.php";
include"fxs.php";
$id = $_GET['id'];

if(!isset($_SESSION['username'])){
    header("Location: login_register.php");
}
            $sql = "SELECT * FROM invoices WHERE id='$id' AND username='".$_SESSION['username']."' ORDER BY id DESC";
            $statement = $conn->query($sql);
            if($statement->rowCount() > 0){
              ?>
              <center>
                <h1>KIGALI AUTO SPARE PART PAYMENT INVOICE</h1>
              </center>
              <table border="1" cellspacing="0" cellpadding="5" width="100%">
                <tr>
                  <th align="center">Transaction Id</th>
                  <th align="center">Transaction Reference</th>
                  <th align="center">Amount Paid</th>
                  <th align="center">Date</th>
                  <th align="center">Status</th>
                </tr>

              <?php
                while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                    $t_id = $row['tx_id'];
                    $t_ref = $row['tx_ref'];
                    $date = $row['date'];
                    $amount = $row['amount'];
                    echo"
                    <tr>
                      <td align='center'>$t_id</td>
                      <td align='center'>$t_ref</td>
                      <td align='center'>$amount RWF</td>
                      <td align='center'>$date</td>
                      <td align='center'>Paid</td>
                      
                      </tr>
                    ";
                }
              ?>
              </table>
<?php }?>
<script>
    window.onload = () => {
        window.print()
    }
</script>