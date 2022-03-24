<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "ecommerce";

//deployment
// $servername = "localhost";
// $username = "autoexpe_autoexpe";
// $password = "security@2022!0";
// $dbName = "autoexpe_main_db";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $fmt = numfmt_create('fr', NumberFormatter::CURRENCY);
  if(!isset($_SESSION)) {session_start();}
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$conn2 = mysqli_connect($servername,$username,$password,$dbName);
if(!$conn2){
  echo"Failed to connect to the server.";
  exit();
}
