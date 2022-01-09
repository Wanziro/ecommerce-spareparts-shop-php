<?php
include"admin_protect.php";
$sql = "SELECT * FROM spare_parts";
$statement = $conn->query($sql);
if($statement->rowCount() > 0){
    ?>
    ?>
    <center>
        <h1>KIGALI AUTO SPARE PARTS LTD</h1>
        <p>List of spare parts</p>
    </center>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Category</th>
        <th>Vehicle</th>
        <th>Mark</th>
        <th>Model</th>
        <th>Fuel</th>
        <th>Part Number</th>
    </tr>
    <?php
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $id = $row['id'];
        $name = $row['name'];
        $category = $row['spare_part_category'];
        $vehicle = $row['vehicle_category'];
        $mark = $row['vehicle_mark'];
        $model = $row['vehicle_model'];
        $fuel = $row['fuel'];
        $part_number = $row['part_number'];
        echo"
        <tr>
        <td>$id</td>
        <td>$name</td>
        <td>$category</td>
        <td>$vehicle</td>
        <td>$mark</td>
        <td>$model</td>
        <td>$fuel</td>
        <td>$part_number</td>
        ";
    }
    ?>
    </table>

    <?php
}else{echo"<h2>No spare parts found</h2>";}

?>
<script>
    window.onload = () => {
        window.print()
    }
</script>