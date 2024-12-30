<?php
include_once('../include/db.php');
$tbl_things_files = $pre_fix."tbl_things_files";
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
		$sql = mysqli_query($conn, "UPDATE ".$tbl_things_files." SET menu_order='".$n."',updated_img_date=now() WHERE image_id='".$zz[$k]."' AND admin_id=1") or die(mysqli_error($conn));
}
?>