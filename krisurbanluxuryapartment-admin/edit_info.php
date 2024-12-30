<?php include_once('session_destroy.php'); ?>
<?php include_once('include/functions.php');?>
<?php 
	include("include/db.php"); 
	$area_info = $pre_fix."area_info";
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
	
	$ip = $_POST['ip'];
	$admin_id=$_POST['admin_id'];
	$id=test_input($_POST['r_id']);
	$location = $_POST['location'];
	$r_heading=base64_encode($_POST['c_heading']);
	$content = htmlentities($_POST['c_review']);
	$c_name = $_POST['c_name'];
	$c_place = $_POST['c_place'];

	$name=$_FILES['image']['name'];
	$type=$_FILES['image']['type'];
	$size=$_FILES['image']['size'];
	$tmp=$_FILES['image']['tmp_name'];
	$folder_path = '../uploads/areainfo';
	$targetDir = '../uploads/areainfo/';
	$dotcount = substr_count($name, '.');
	if (!file_exists($folder_path)) {
    mkdir($folder_path, 0777, true);
	}
	
	$insert = mysqli_query($conn,"SELECT * FROM ".$area_info." WHERE id='".$id."'");
	$row = mysqli_num_rows($insert);

	if($row>0)
	{
		if($dotcount>1){
			echo"<script>alert('File Not Supportable')</script>";
			?>
			<script>
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
	        </script>
	        <?php
		}else{
			if(($_FILES["image"]["type"] == "image/gif") || 
				($_FILES["image"]["type"] == "image/jpeg") || 
				($_FILES["image"]["type"] == "image/png") || 
				($_FILES["image"]["type"] == "image/pjpeg") ||
				($name == "")
				) 
				
				{
					while($loop = mysqli_fetch_assoc($insert))
					{
						$del_file = $loop['img'];
						if($name == "" )
						{
							$name = $loop['img'];
							
							$update = mysqli_query($conn,"UPDATE ".$area_info." SET img='".$name."', loc_id ='".$location."',heading='".$r_heading."', content='".$content."', sub_title='".$c_name."', icons='".$c_place."' WHERE id='".$loop['id']."'");
						}else{
							$upload_image = $_FILES["image"]["name"];
							$folder = $targetDir;
							move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
							$file = $targetDir.$_FILES["image"]["name"];
							$uploadimage = $folder.$_FILES["image"]["name"];
							$newname = $_FILES["image"]["name"];
							// Set the resize_image name
							$resize_image = $folder.$newname; 
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
							
							$update = mysqli_query($conn,"UPDATE ".$area_info." SET img='".$resize_image."', loc_id ='".$location."', heading='".$r_heading."', content='".$content."', sub_title='".$c_name."', icons='".$c_place."' WHERE id='".$loop['id']."'");
						}
						
						if($update)
						{
							$FileName = '../uploads/areainfo/'.$del_file;
							@chown($FileName,465); //Insert an Invalid UserId to set to Nobody Owner; for instance 465
							if($name != $del_file)
							{
							@unlink($FileName);
							}
							echo "<script>alert('Updated Successfully.');</script>";
							?>
							<script>
							window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
				            </script>
				            <?php
						}else{
							echo "<script>alert('Updatation Failed.');</script>";
						}
					}
				}
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
<?php include_once('include/topbar.php'); ?>
<div class="wrapper">


<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
if(isset($_POST['edit_review_button']))
{
	$admin_id = $_POST['admin_id'];
	$r_id = $_POST['edit_review_id'];
	$fetch = mysqli_query($conn,"SELECT * FROM ".$area_info." WHERE id='".$r_id."'");
	$num = @mysqli_num_rows($fetch);
	while($show = @mysqli_fetch_assoc($fetch))
	{
		$r_img=$show['img'];
		$loc_id=$show['loc_id'];
		$r_heading=base64_decode($show['heading']);
		$content = $show['content'];
		$c_name = $show['sub_title'];
		$c_place = $show['icons'];
	}
  
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Area Attractions <small>Update your area attraction Easily</small> </h1>
      <hr>
      <form method="post" action="" enctype="multipart/form-data">
		<div class="row">
		<div class="col-md-3 col-md-offset-4">
		<div class="image_holder">
		<?php if(@$r_img==""){ ?>
		<img src="../img/avatar.png">
		<?php }else{ ?>
		<img src="<?php  echo @$r_img; ?>">
		<?php } ?>
		<div class="form-group">
		<input type="file" name="image" id="profile_image">
		</div>
		</div>
		</div>
		</div> 
        
   		<div class="form-group">
          <label for="exampleInputEmail1">Title </label>
          <input type="text" name="c_heading" class="form-control" id="home_heading" placeholder="Title" value="<?php echo html_entity_decode($r_heading) ;?>"/>
        </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1">Link </label>
          <input type="text" name="c_name" class="form-control" id="home_heading" placeholder="Link" value="<?php echo html_entity_decode($c_name) ;?>"/>
        </div>
        
        <!--<div class="form-group">
						<label for="exampleInputEmail1">Category</label>
						<select  name="location" class="form-control">
							<option value="" style="display:none;">Select</option>
							<option value="1" <?php echo $loc_id==1?'Selected':''?>>Providenciales</option>
							<option value="2" <?php echo $loc_id==2?'Selected':''?>>Middle Caicos</option>
							<option value="3" <?php echo $loc_id==3?'Selected':''?>>North Caicos</option>
						</select>
					</div>-->

        <div class="editor">
			<label for="exampleInputEmail1">Content</label>
			<textarea class="ckeditor" name="c_review" id="noticeMessage" placeholder="Content"><?php echo $content; ?></textarea>
		</div>
       
		<input type="hidden" name="admin_id" value="<?php echo $admin_id;?>" />
		<input type="hidden" name="ip" value="<?php echo getClientIP();?>" />
		<input type="hidden" name="pro_id" value="<?php echo @$pro_id ;?>" >
		<input type="hidden" name="r_id" value="<?php echo @$r_id ;?>" >
         
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
$server = 'area_information.php';
?>
<script>
window.location ='<?php echo $server ;?>' ;
</script>
<?php
}
?>