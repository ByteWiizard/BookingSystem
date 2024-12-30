<?php
include_once('../include/db.php');
$amenity_details = $pre_fix."amenity_details";
if($_POST['amenId']!="")
{
	$amenity_id = @$_POST['amenId'];
$msg="";
$fetch = mysqli_query($conn,"SELECT amen_value,amen_status FROM ".$amenity_details." WHERE amenity_id='".$amenity_id."'");
while($row=@mysqli_fetch_assoc($fetch))
{
	$amenvalue = html_entity_decode($row['amen_value']);
	if($row['amen_status']==1)
	{
	$msg .=  "<span class='sin_amen'><input type='checkbox' class='subhi' name='".$amenvalue."' id='".$amenvalue."' checked/><label for='".$amenvalue."'>".$amenvalue."</label><a title='Delete this amenity' href='#' class='remove_field'><i class='fa fa-times-circle' aria-hidden='true'></i></a><p id='xc-".$amenvalue."'></p></span>";
	}
	else
	{
	$msg .=  "<span class='sin_amen'><input type='checkbox' name='".$amenvalue."' id='".$amenvalue."' /><label for='".$amenvalue."'>".$amenvalue."</label><a  title='Delete this amenity' href='#' class='remove_field'><i class='fa fa-times-circle' aria-hidden='true'></i></a><p id='xc-".$amenvalue."'></p></span>";
	}
}
echo $msg;
}
?>