<?php
//visualizza errori
ini_set('display_errors', 1);
define("DB_SERVER", "localhost");
define("DB_USERNAME", "phpmyadmin");
define("DB_PASSWORD", "cioane11");
define("DB_NAME", "biblioteca2");

# Connection
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

# Check connection
if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}
