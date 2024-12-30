<?php
include_once('../include/db.php');
$amenity_details = $pre_fix."amenity_details";
if($_POST['amenId']!="")
{
$amenity_id = @$_POST['amenId'];
$amen_value1 = mysqli_real_escape_string($conn,$_POST['amenName']);
$amen_value = htmlspecialchars($amen_value1);
$msg="";
$fetch = mysqli_query($conn,"DELETE FROM ".$amenity_details." WHERE amenity_id='".$amenity_id."' AND amen_value='".$amen_value."'");
if($fetch)
{
	echo $amen_value1.' deleted successfully';
}
else
{
	echo $amen_value1."not deleted,some error occur...";
}
}
?>