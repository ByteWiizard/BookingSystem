<?php
include_once('../include/db.php');
$files = $pre_fix."files";
$idArray = explode(",",$_REQUEST['ids']);

$count = count($idArray);
  for($i=0;$i<=$count-1;$i++){
  	 $qry ="UPDATE ".$files." SET menu_order='".$i."',updated_img_date=now() WHERE image_id='".$idArray[$i]."' AND admin_id=1";
 		$update = mysqli_query($conn,$qry);
 		
  }

?>