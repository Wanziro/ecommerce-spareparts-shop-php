<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "ecommerce";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $fmt = numfmt_create('fr', NumberFormatter::CURRENCY);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>