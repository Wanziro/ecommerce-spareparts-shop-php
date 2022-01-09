<?php
require_once('connect.php');
if (isset($_SESSION['username'])) {
    $qq = mysqli_query($conn2, "select * from users where username='" . $_SESSION['username'] . "'");
    while ($r = mysqli_fetch_assoc($qq)) {
        $fname = $r['fname'];
        $lname = $r['lname'];
        $email = $r['email'];
        $username = $r['username'];
    }
}
