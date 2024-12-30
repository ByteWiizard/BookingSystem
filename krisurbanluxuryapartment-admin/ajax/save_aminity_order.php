<?php
include_once('../include/db.php');
$amenity_details = $pre_fix."amenity_details";
$positions = $_POST['choices'];

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
		$sql = mysqli_query($conn, "UPDATE ".$amenity_details." SET menu_order='".$n."',update_date=now() WHERE amen_id='".$zz[$k]."'") or die(mysqli_error($conn));
}
?>