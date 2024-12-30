<?php 
	error_reporting(0);
	session_start();
	include("include/db.php");
	$gallery = $pre_fix."gallery";
?>
<?php
if(!empty($_FILES)){
	$admin_id = $_SESSION['admin_id'];
	$folder_path = '../uploads/gallery' ;
	if (!file_exists($folder_path)) {
    mkdir($folder_path, 0777, true);
	}
	include_once('include/db.php');
	$targetDir = '../uploads/gallery/' ;
	$fileName = $_FILES['file']['name'];
	$targetFile = $targetDir.$fileName;
	$fetch = mysqli_query($conn,"SELECT * FROM ".$gallery." WHERE admin_id='".$admin_id."'");
	$count = mysqli_num_rows($fetch);
	$menu_order = $count+1 ;
	if ($_FILES["file"]["error"] > 0) {
        			$error = $_FILES["file"]["error"];
    		} 
    		else if (($_FILES["file"]["type"] == "image/gif") || 
			($_FILES["file"]["type"] == "image/jpeg") || 
			($_FILES["file"]["type"] == "image/png") || 
			($_FILES["file"]["type"] == "image/pjpeg")) 
			
			{
				$name = ''; $type = ''; $size = ''; $error = '';
	function compress_image($source_url, $destination_url, $quality) {
		$info = getimagesize($source_url);
    		if ($info['mime'] == 'image/jpeg')
        			$image = imagecreatefromjpeg($source_url);
    		elseif ($info['mime'] == 'image/gif')
        			$image = imagecreatefromgif($source_url);
   		elseif ($info['mime'] == 'image/png')
        			$image = imagecreatefrompng($source_url);
    		imagejpeg($image, $destination_url, $quality);
		return $destination_url;
	}
				$targetFile =  $targetDir.$fileName;
				$filenames = compress_image($_FILES["file"]["tmp_name"], $targetFile, 80);
			
			$compress_size = filesize($targetFile);
		//insert file information into db table
		$insert = mysqli_query($conn,"INSERT INTO ".$gallery." (admin_id,file_name,file_size,menu_order,uploaded_img_date,updated_image_date) VALUES('".$admin_id."','".$fileName."','".$compress_size."','".$menu_order."', now(), now() )");
	}
}
?>