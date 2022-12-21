<?php
//start session
session_start();


//config
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','Oussou-00');
define('DB_NAME','food-order');
define('SITEURL', 'http://localhost/food-order/');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD)or die(mysqli_connect_error());
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));