<?php
	include("include/db.php");
	$property_details = $pre_fix."property_details";
	$proid = $_POST['del_val'];
	$a = $_POST['a'];
	$QueryAll = mysqli_query($conn, "select * from ".$property_details." where featured='ture'");
	$Alldata = mysqli_num_rows($QueryAll);
	if($Alldata>'4'){
		echo "1";
	}else{
		$QueryU = mysqli_query($conn, "UPDATE ".$property_details." SET featured='$a' WHERE property_id='$proid'");
		if($QueryU){
			if($a=='true'){
				echo "2";
			}else{
				echo "3";
			}
		}
	}
?>