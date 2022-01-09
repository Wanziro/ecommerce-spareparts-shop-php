<?php
include"../connect.php";
if(!isset($_SESSION['username'])){
    header("Location: ../login_register.php");
}else{
    $sql = "SELECT * FROM users where username='".$_SESSION['username']."'";
    $statement = $conn->query($sql);
    if($statement->rowCount() == 1){
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $type = $row['type'];
            if($type != 'ADMIN'){
                header("Location: ../index.php");
            }else{
                $admin_username = $row['username'];
                $admin_fname = $row['fname'];
                $admin_lname = $row['lname'];
                $admin_email = $row['email'];
            }
        }
    }
}
?>