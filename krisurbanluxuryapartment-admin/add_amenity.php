<?php
include_once('include/db.php');
include_once('include/functions.php');
$amenity = $pre_fix."amenity";
$amenity_details = $pre_fix."amenity_details";
$property_details = $pre_fix."property_details";
if((isset($_POST['amn_submit']))&&($_POST['add_amen']!="")){
	function test_input($data){
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$ss="";
	$pro_id = test_input($_POST['property_id']);
	$amen_name = mysqli_real_escape_string($conn, test_input($_POST['add_amen']));
	$admin_id= test_input($_POST['admin_id']);
	$ip = getClientIP();
	$insert122 = mysqli_query($conn,"SELECT * FROM ".$amenity." WHERE property_id='".$pro_id."' AND admin_id='".$admin_id."' AND amenity_name='".$amen_name."'");
	$sh = mysqli_num_rows($insert122);
	if($sh > 0){
		echo '<script>alert("This amenity name already exists,Try a new one.")</script>';
		echo '<script>window.location="amenities.php"</script>';
	}else{
			$insert123 = mysqli_query($conn,"INSERT into ".$amenity."(property_id,admin_id,amenity_name,amenity_add_date,amenity_update_date,amenity_ip) VALUES('".$pro_id."','".$admin_id."','".$amen_name."', now(), now(),'".$ip."')") or die(mysqli_error($conn));
			$lastid = mysqli_insert_id($conn);
			$queryda = mysqli_query($conn, "UPDATE ".$amenity." SET menu_order='$lastid' where amenity_id='$lastid'");
		
		if($insert123){
			echo'<script>alert("Amenity Created Successfully.")</script>';
			echo '<script>window.location="amenities.php"</script>';
			
		?>
        <?php
		}else{
			?>
			<script>alert("Insertion Failed.")</script>;
           <script>window.location="amenities.php"</script>;
			<?php
        }
	}
}
?>