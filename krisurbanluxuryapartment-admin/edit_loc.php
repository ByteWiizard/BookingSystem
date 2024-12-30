<?php include_once('session_destroy.php'); ?>
<?php 
	include("include/db.php"); 
	$tpl_location = $pre_fix."tpl_location";
?>
<?php
error_reporting(0);
if(isset($_POST['home_details_submit']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	$admin_id=$_POST['admin_id'];
	$loc_id=test_input($_POST['loc_id']);
	$loc_title=base64_encode($_POST['loc_title']);
	$loc_content=$_POST['loc_content'];
	/*$loc_address = $_POST['loc_address'];
	$meta_title = $_POST['meta_title'];
	$meta_key= $_POST['meta_key'];
	$meta_desc = $_POST['meta_desc'];
	$canonical_url = $_POST['canonical_url'];*/

	$name=$_FILES['image']['name'];
	$type=$_FILES['image']['type'];
	$size=$_FILES['image']['size'];
	$tmp=$_FILES['image']['tmp_name'];
	$folder_path = '../uploads/location';
	$targetDir = '../uploads/location/';
	if (!file_exists($folder_path)) {
    mkdir($folder_path, 0777, true);
	}
	
	$insert = mysqli_query($conn,"SELECT * FROM ".$tpl_location." WHERE loc_id='".$loc_id."' AND admin_id='".$admin_id."'");
	$row = mysqli_num_rows($insert);
	if($row>0)
	{
		if(($_FILES["image"]["type"] == "image/gif") || 
			($_FILES["image"]["type"] == "image/jpeg") || 
			($_FILES["image"]["type"] == "image/png") || 
			($_FILES["image"]["type"] == "image/pjpeg") ||
			($name == "")
			) 
			
			{
				function compress_image($source_url, $destination_url, $quality) {
				$info = @getimagesize($source_url);
					if ($info['mime'] == 'image/jpeg')
							$image = imagecreatefromjpeg($source_url);
					elseif ($info['mime'] == 'image/gif')
							$image = imagecreatefromgif($source_url);
					elseif ($info['mime'] == 'image/png')
							$image = imagecreatefrompng($source_url);
					@imagejpeg($image, $destination_url, $quality);
				return $destination_url;
				}
			}
		while($loop = mysqli_fetch_assoc($insert))
		{
			$del_file = $loop['loc_img'];
			if($name == "" )
			{
				$name = $loop['loc_img'];
			}
			
			if($size<=4194304) // 4 Mb
			{
				$targetFile =  $targetDir.$name;
				$filenames = compress_image($_FILES["image"]["tmp_name"], $targetFile, 80);
				$compress_size = filesize($folder_path);
				
				$update = mysqli_query($conn,"UPDATE ".$tpl_location." SET loc_img='".$name."', loc_title='".$loc_title."', loc_content='".$loc_content."', update_date=now() WHERE loc_id='".$loop['loc_id']."'");
		}
		else
		{
			 echo "<script>alert('Size of image is greater than 4MB, Please insert image than 4 Mb.');</script>";
				?>
				<script>
				window.location = 'location.php';
	            </script>
	            <?php
			}
		}
		if($update)
		{
			move_uploaded_file($tmp,"../uploads/location/$name");
			$FileName = '../uploads/location/'.$del_file;
			@chown($FileName,465); //Insert an Invalid UserId to set to Nobody Owner; for instance 465
			if($name != $del_file)
			{
			@unlink($FileName);
			}
			echo "<script>alert('Updated Successfully.');</script>";
			?>
			<script>
			window.location = 'location.php';
            </script>
            <?php
		}
		else
		{
			echo "<script>alert('Updatation Failed.');</script>";
		}
		
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>
<link href="framework/css/import.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="framework/js/ajax.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<div class="wrapper">

<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
if(isset($_POST['edit_review_button']))
{
	$admin_id = $_POST['admin_id'];
	$r_id = $_POST['edit_loc_id'];
	$fetch = mysqli_query($conn,"SELECT * FROM ".$tpl_location." WHERE admin_id='".$admin_id."' AND loc_id='".$r_id."'");
	$num = @mysqli_num_rows($fetch);
	while($show = @mysqli_fetch_assoc($fetch))
	{
		$loc_id=$show['loc_id'];
		$r_img=$show['loc_img'];
		$loc_title=base64_decode($show['loc_title']);
		$loc_content=$show['loc_content'];
		$loc_address=$show['loc_address'];
		/*$meta_title=$show['meta_title'];
		$meta_key=$show['meta_key'];
		$meta_desc=$show['meta_desc'];
		$canonical_url=$show['meta_Canonical_Link'];*/
	}
  
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Activity Detail <small>Update Activity Detail Easily</small> </h1>
      <hr>
      <form method="post" action="" enctype="multipart/form-data">
		
        
   		<div class="form-group">
          <label for="exampleInputEmail1">Activity Title </label>
          <input type="text" name="loc_title" class="form-control" id="loc_title" placeholder="Activity Title" value="<?php echo html_entity_decode($loc_title); ?>"/>
        </div>
        <div class="editor">
          <label for="exampleInputEmail1">Activity Content </label>
          <textarea class="ckeditor" name="loc_content" id="loc_content" ><?php echo html_entity_decode($loc_content) ;?></textarea>
        </div>
		

		<!-- meta html -->
		<!-- <div class="form-group">
			<label for="exampleInputEmail1">Meta Title </label>
			<input type="text" name="meta_title" class="form-control" id="meta_title" value="<?php echo $meta_title; ?>" placeholder="Meta Title"/>
		</div> -->

		<!-- <div class="form-group">
			<label for="exampleInputEmail1">Meta Key </label>
			<input type="text" name="meta_key" class="form-control" id="meta_key" value="<?php echo $meta_key; ?>" placeholder="Meta Key"/>
		</div> -->

		<!-- <div class="editor">
			<label for="exampleInputEmail1">Meta Description</label>
			<textarea class="ckeditor" name="meta_desc" placeholder="Meta Description" id="meta_desc" ><?php echo $meta_desc; ?></textarea>
		</div> -->

		<!-- <div class="form-group">
			<label for="exampleInputEmail1">Canonical Url </label>
			<input type="text" name="canonical_url" class="form-control" id="canonical_url" value="<?php echo $canonical_url; ?>" placeholder="Canonical Url"/>
		</div> -->
		<!-- end meta html -->
		 
		<input type="hidden" name="admin_id" value="<?php echo $admin_id;?>" />
		<input type="hidden" name="loc_id" value="<?php echo @$loc_id ;?>" >
         
		<div style="clear:both"></div>
         <p class="text-center">
          <button type="submit" name="home_details_submit" class="btn btn-success btn-outline-rounded green"> Submit <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
      </form>
      
    </section>
  </div>
  <?php } ?>
</div>
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script>
</body>
</html>
<?php
if(!isset($_POST['edit_review_button']))
{
$server = 'location.php';
?>
<script>
window.location ='<?php echo $server ;?>' ;
</script>
<?php
}
?>