<?php
include_once('../include/db.php');
$booking_details = $pre_fix."booking_details";
$transaction = $pre_fix."transaction";
if(isset($_POST['id']))
{
	$type = $_POST['dat'];
	$id = $_POST['id'];
	$admin_id = $_POST['admin'];
 	
	if($type=="#req")
	{
		 $fetch = mysqli_query($conn,"UPDATE ".$booking_details." SET book_status=1 WHERE bok_det_id='".$id."'") or die(mysqli_error($conn));
		 if($fetch)
		 {
		 	echo "1" ;
		 }
		 else
		 {
			echo "0" ; 
		 }
	}
	if($type=="#pay")
	{
		 $fetch = mysqli_query($conn,"UPDATE ".$transaction." SET trans_status=1 WHERE trans_id='".$id."' AND admin_id='".$admin_id."'") or die(mysqli_error($conn));
		 if($fetch)
		 {
		 	echo "1" ;
		 }
		 else
		 {
			echo "0" ; 
		 }
	}
}
?>