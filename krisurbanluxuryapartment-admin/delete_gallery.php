<?php session_start() ;?>
<?php
include_once('include/db.php');
$files = $pre_fix."files";
$gallery = $pre_fix."gallery";
$admin_id = $_SESSION['admin_id'];
$url = $_SERVER['HTTP_REFERER'];
?>
<?php
if(isset($_POST['dele']))
{
$d = $_POST['dele'];
$dd = explode(',', $d);
$i = $dd[1];
$folder_path = '../uploads/'.$i;

$fet = mysqli_query($conn,"SELECT file_name FROM ".$files." WHERE property_id='".$dd[1]."' AND image_id='".$dd[0]."' AND admin_id='".$admin_id."'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($fet);
$row['file_name'];
$del1 = mysqli_query($conn,"DELETE FROM ".$files." WHERE property_id='".$dd[1]."' AND image_id='".$dd[0]."' AND admin_id='".$admin_id."'");
	if($del1)
	{
		unlink($row['file_name']);
	echo "Deleted successfully.";
	}
}

if(isset($_POST['dele_gallery']))
{
$d = $_POST['dele_gallery'];
$folder_path = '../uploads/gallery';
include_once('include/db.php');
$fet = mysqli_query($conn,"SELECT file_name FROM ".$gallery." WHERE image_id='".$d."' AND admin_id='".$admin_id."'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($fet);
$del1 = mysqli_query($conn,"DELETE FROM ".$gallery." WHERE image_id='".$d."' AND admin_id='".$admin_id."'");
	if($del1)
	{
		unlink($row['file_name']);
	echo "Deleted successfully.";
	}
}

if(isset($_POST['dele_id']))
{
	include_once('include/db.php');
	$ii = $_POST['dele_id'];
	foreach($ii as $kk)
{
	$iii = explode(',', $kk);
	$count = count($ii);
	$del_id = $iii[0];
	$pro_id = $iii[1];
	$admin_id = $iii[2];
	$folder_path = '../uploads/'.$pro_id;
	$fet = mysqli_query($conn,"SELECT file_name FROM ".$files." WHERE property_id='".$pro_id."' AND image_id='".$del_id."' AND admin_id='".$admin_id."'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($fet);
$row['file_name'];
$del1 = mysqli_query($conn,"DELETE FROM ".$files." WHERE property_id='".$pro_id."' AND image_id='".$del_id."' AND admin_id='".$admin_id."'");
	if($del1)
	{
		unlink($row['file_name']);
	}

}
if($del1)
{
	echo $count.' images deleted successfully.';
}
}
?>