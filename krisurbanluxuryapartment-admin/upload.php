<?php 
	include("include/db.php");
	session_start();
	$files = $pre_fix."files";
	
?>
<?php
if(!empty($_FILES)){
	$property_id = $_POST['property_id'];
	$admin_id = $_SESSION['admin_id'];
	$folder_path = '../uploads/'.$property_id ;
	
	if (!file_exists($folder_path)) {
    mkdir($folder_path, 0777, true);
	}
	
	$targetDir = '../uploads/'.$property_id.'/' ;
	$fileName = $_FILES['file']['name'];
	$fileSize = $_FILES['file']['size'];
	$dotcount = substr_count($name, '.');
	$fetch = mysqli_query($conn,"SELECT * FROM ".$files." WHERE property_id='".$property_id."' AND admin_id='".$admin_id."'");
	$count = mysqli_num_rows($fetch);
	$menu_order = $count+1 ;
	if($dotcount>1){
		echo"<script>alert('File Not Supportable')</script>";
		?>
		<script>
		window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
        </script>
        <?php
	}else{
		if ($_FILES["file"]["error"] > 0) {
    			$error = $_FILES["file"]["error"];
		} 
		else if (($_FILES["file"]["type"] == "image/gif") || 
		($_FILES["file"]["type"] == "image/jpeg") || 
		($_FILES["file"]["type"] == "image/png") || 
		($_FILES["file"]["type"] == "image/pjpeg")){
			$upload_image = $_FILES["file"]["name"];
			$folder = $targetDir;
			move_uploaded_file($_FILES["file"]["tmp_name"],$targetDir.$_FILES["file"]["name"]);
			//$file = $targetDir.$_FILES["file"]["name"];
			$uploadimage = $folder.$_FILES["file"]["name"];
			$newname = $_FILES["file"]["name"];
			// Set the resize_image name
			$resize_image = $newname; 
			$actual_image = $folder.$newname;
			// It gets the size of the image
			//list( $width,$height ) = getimagesize( $uploadimage );
			// It makes the new image width of 350
			//$newwidth = 1800;
			// It makes the new image height of 350
			//$newheight = 1238;
			// It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
			//$thumb = imagecreatetruecolor( $newwidth, $newheight );
			//$source = imagecreatefromjpeg( $resize_image );
			// Resize the $thumb image.
			//imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			//imagejpeg( $thumb, $resize_image, 80 );
			//insert file information into db table
			$insert = mysqli_query($conn,"INSERT INTO ".$files." (property_id,admin_id,file_name,file_size,menu_order,uploaded_img_date,updated_img_date) VALUES('".$property_id."','".$admin_id."','".$resize_image."','".$compress_size."','".$menu_order."',now(),now() )") or die(mysqli_error($conn));
		}
	}	
}
?>