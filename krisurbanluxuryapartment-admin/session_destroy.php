<?php
session_start();
$sess = trim($_SESSION['admin_id']);
if($sess=="")
{
	header("location:login.php");
}
?>