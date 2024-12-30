<?php
include_once('../include/db.php');
$positions = $_POST['choices'];
$files = $pre_fix."files";
$pos = explode("&", $positions);

foreach($pos as $key=>$value){
  $array[$key]=str_replace("[]=",",",$value);
}
$aa = implode(",", $array);
$bb = explode(",", $aa);
$ab = "";
$zz = "";
for ($i=0; array_key_exists($i, $bb); $i+=2) {
    $ab[] = $bb[$i];
}
for ($j=1; array_key_exists($j, $bb); $j+=2) {
   $zz[] = $bb[$j];
}

$p = count($ab);
for($k=0; $k<$p ;$k++)
{
	$n = $k+1;
		$sql = mysqli_query($conn, "UPDATE ".$files." SET menu_order='".$n."',updated_img_date=now() WHERE image_id='".$zz[$k]."' AND admin_id=1") or die(mysqli_error($conn));
}

$idArray = explode(",",$_REQUEST['h']);

//update images order
$db->updateOrder($idArray);
$count = count($idArray);
  for($i=0;$i<=$count-1;$i++){
  	$qry ="UPDATE ".$files." SET menu_order='".$i."',updated_img_date=now() WHERE image_id='".$idArray[$i]."' AND admin_id=1";
 		$update = mysqli_query($conn,$qry);
 		
  }
?>