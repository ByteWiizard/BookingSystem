<?php
include_once('../include/db.php');
$amenity_details = $pre_fix."married_amenity_details";
if($_POST['amenity_id']!="")
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$ss="";
	$amen_name = test_input($_POST['amenity_name']);
	$amen_id = test_input($_POST['amenity_id']);
	$amen_value= mysqli_real_escape_string($conn,test_input($_POST['amenities']));
	$ip =  test_input($_POST['ip']);
	$insert122 = mysqli_query($conn,"SELECT * FROM ".$amenity_details." WHERE amenity_id='".$amen_id."' AND amen_value='".$amen_value."'");
	$sh = mysqli_num_rows($insert122);
	if($sh > 0)
	{
		echo 'This amenity already exists,Try a new one.';
	}
	else
	{
			$insert123 = mysqli_query($conn,"INSERT into ".$amenity_details."(amenity_id,amen_value,amen_status,add_date,update_date,amen_ip) VALUES('".$amen_id."','".$amen_value."', '1',now(), now(),'".$ip."')") or die(mysqli_error($conn));
		
		if($insert123)
		{
				
				echo $amen_value;
				
		?>
        <?php
		}
		else
		{
			echo 'Insertion Failed.';
        }
	}
}
?>