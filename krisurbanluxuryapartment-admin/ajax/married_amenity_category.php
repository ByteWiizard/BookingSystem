<?php include_once('../session_destroy.php'); ?>
<?php
include_once('../include/db.php');
$amenity = $pre_fix."married_amenity";
if($_POST['catId']!="")
{
	$admin_id = $_SESSION['admin_id'];
	$amenity_id = @$_POST['catId'];
	$catname = @mysqli_real_escape_string($conn,$_POST['catName']);
$msg="";
$fetch = mysqli_query($conn,"SELECT * FROM ".$amenity." WHERE admin_id='".$admin_id."' AND amenity_name='".$catname."'");
 $num = mysqli_num_rows($fetch);
$row=mysqli_fetch_assoc($fetch);

	if($num>0)
	{
		$msg = "This name is already exists,try a new one.";
	}
	else
	{
		$upd = mysqli_query($conn, "UPDATE ".$amenity." SET amenity_name='".$catname."' WHERE admin_id='".$admin_id."' AND amenity_id='".$amenity_id."' ");
		if($upd)
		{
			$msg = "Amenity category name changed successfully.";
		}
		else
		{
			$msg = "Something went wrong.";
		}
		echo $msg;
	}
	
}