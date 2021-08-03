<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "database";

try {
  $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

  // set the PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

  echo "Connection failed: " . $e->getMessage();
}
?>
  