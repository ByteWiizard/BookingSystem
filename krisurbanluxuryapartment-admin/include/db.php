<?php
error_reporting(0);
$servername = "localhost"; 
$username = "surya150_kris_db";
$password = "krisurbanluxuryapartment#@!";
$db = "surya150_krisurbanluxuryapartment";
$pre_fix = "lhk_";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}
?>
<?php

define("SITE_URL", 'http://'.$_SERVER['SERVER_NAME'].'/');
?>