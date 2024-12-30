<?php @include_once('session_destroy.php') ;?>
<?php 
	include("include/db.php"); 
	$logo = $pre_fix."logo";
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
<div class="wrapper">
<?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
$admin_id = $_SESSION['admin_id'];
  $fetch = mysqli_query($conn,"SELECT logo_img FROM ".$logo." WHERE admin_id='".$admin_id."'");
	$num = @mysqli_num_rows($fetch);
  while($show = @mysqli_fetch_assoc($fetch))
  {
	$logo_img = $show['logo_img'];
  }
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Logo <small>Update your Logo Easily</small> </h1>
      <hr>
	<!--<div class="logo-note"><strong>Note:</strong> Logo size will be 215px in width and 80px in height.</div> -->
      <form method="post" action="" enctype="multipart/form-data">
     <div class="row">
     <div class="col-md-3 col-md-offset-4">
     <div class="image_holder">
      <?php if(@$logo_img==""){ ?>
     <img src="framework/img/no-image.png">
     <?php }else{ ?>
      <img src="../uploads/logo/<?php echo @$logo_img ?>">
     <?php } ?>
     <div class="form-group">
    <input type="file" name="image" id="profile_image">
  </div>
     </div>
     </div>
       </div> 
        
        <div class="ui_button" style="padding-left:440px;">
        <button type="submit" name="logo_submit" class="btn btn-default"><i class="fa fa-paper-plane-o"></i> Submit</button>
        </div>
      </form>
      
    </section>
  </div>
</div>
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script>
</body>
</html>
<?php
if(isset($_POST['logo_submit']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$admin_id=test_input($_SESSION['admin_id']);
	$name=$_FILES['image']['name'];
	$type=$_FILES['image']['type'];
	$size=$_FILES['image']['size'];
	$tmp=$_FILES['image']['tmp_name'];
	$ip = getClientIP();
	$folder_path = '../uploads/logo';
	$targetDir = '../uploads/logo/';
	if (!file_exists($folder_path)) {
    mkdir($folder_path, 0777, true);
	}
	$inserte = mysqli_query($conn,"SELECT * FROM ".$logo." WHERE admin_id=$admin_id");
	$row = @mysqli_num_rows($inserte);
	
	if($row==0)
	{	
		
		if($name=="")
		{
			echo "<script>alert('Please select a valid logo first.');</script>";
			?>
			<script>
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
				
            </script>
            <?php
		}
		if(($_FILES["image"]["type"] == "image/gif") || 
			($_FILES["image"]["type"] == "image/jpeg") || 
			($_FILES["image"]["type"] == "image/png") || 
			($_FILES["image"]["type"] == "image/pjpeg")
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
    		imagejpeg($image, $destination_url, $quality);
		return $destination_url;
	}
}
	if(($size<=2097152)&&($name!="")) // 2 Mb
		{
		$insert = mysqli_query($conn,"INSERT into ".$logo."(admin_id,logo_img,logo_inst_date,logo_ip) VALUES('".$admin_id."','".$name."', now() ,'".$ip."')");
		}
		if(($size > 2097152)&&($size <= 4194304)) // 2-4 Mb
		{
			$targetFile =  $targetDir.$name;
			$filenames = compress_image($_FILES["image"]["tmp_name"], $targetFile, 80);
			$compress_size = filesize($folder_path);
			$insert1 = mysqli_query($conn,"INSERT into ".$logo."(admin_id,logo_img,logo_inst_date,logo_ip) VALUES('".$admin_id."','".$name."', now() ,'".$ip."')");
		}
		if($size>4194304)
		{
		 echo "<script>alert('Size of image is greater than 4MB, Please insert logo less than 4 Mb.');</script>";
			?>
			<script>
			window.location = 'logo.php';
            </script>
            <?php
		}
		if(($insert)||($insert1))
		{
			if($insert)
			{
			move_uploaded_file($tmp,"../uploads/logo/$name");
			}
			echo "<script>alert('Inserted Successfully.');</script>";
			?>
			<script>
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
            </script>
            <?php
		}
		else
		{
			echo "<script>alert('Insertion Failed.');</script>";
			?>
			<script>
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
            </script>
            <?php
		}
	}
	if($row==1)
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
		while($loop = mysqli_fetch_assoc($inserte))
		{
			$del_file = $loop['logo_img'];
			if($name == "" )
			{
				$name = $loop['logo_img'];
			}
			
			if($size<=2097152) // 2 Mb
			{
			$update = mysqli_query($conn,"UPDATE ".$logo." SET logo_img='".$name."', logo_update_date=now(), logo_ip='".$ip."' WHERE logo_id='".$loop['logo_id']."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
		}
		if(($size > 2097152)&&($size <= 4194304)) // 2-4 Mb
		{
			
				$targetFile =  $targetDir.$name;
			$filenames = compress_image($_FILES["image"]["tmp_name"], $targetFile, 80);
			$compress_size = filesize($folder_path);
			
						$update1 = mysqli_query($conn,"UPDATE ".$logo." SET logo_img='".$name."', logo_update_date=now(), logo_ip='".$ip."' WHERE logo_id='".$loop['logo_id']."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
		}
		if($size>4194304)
		{
		 echo "<script>alert('Size of image is greater than 4MB, Please insert logo than 4 Mb.');</script>";
			?>
			<script>
			window.location = 'logo.php';
            </script>
            <?php
		}
		}
		if(($update)||($update1))
		{
			if($update)
			{
			move_uploaded_file($tmp,"../uploads/logo/$name");
			}
			echo $FileName = '../uploads/logo/'.$del_file;
			@chown($FileName,465); //Insert an Invalid UserId to set to Nobody Owner; for instance 465
			if($name != $del_file)
			{
			unlink($FileName);
			}
			echo "<script>alert('Updated Successfully.');</script>";
			?>
			<script>
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
            </script>
            <?php
		}
		else
		{
			echo "<script>alert('Updatation Failed.');</script>";
			?>
			<script>
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
            </script>
            <?php
		}
		
	}
	
}
?>