<?php include_once('session_destroy.php'); ?>
<?php include_once('include/functions.php');?>
<?php include("include/db.php"); ?>
<?php
	error_reporting(0);
	$about_property = $pre_fix."about_property";
?>
<?php

if(isset($_POST['about_submit'])){
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$about_id = test_input($_POST['about_id']);
	$title=test_input(htmlspecialchars($_POST['about_heading'],ENT_QUOTES));
	$content=test_input($_POST['about_content']);
	$content2=test_input($_POST['about_short_content']);
         $about_profile_img = test_input($_FILES['image']);

                        $name=$_FILES['image']['name'];
			$type=$_FILES['image']['type'];
			$size=$_FILES['image']['size'];
			$tmp=$_FILES['image']['tmp_name'];
			$ip = getClientIP();

			$folder_path = '../uploads/about';
			$targetDir = '../uploads/about/';
			$dotcount = substr_count($name, '.');
			if (!file_exists($folder_path)) {
				mkdir($folder_path, 0777, true);
			}

	if($about_id){
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
					){
						if($name==""){
							$img_name = $_POST['profile_image'];
						}else{

							$upload_image = $_FILES["image"]["name"];
							$folder = $targetDir;
							move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
							$file = $targetDir.$_FILES["image"]["name"];
							$uploadimage = $folder.$_FILES["image"]["name"];
							echo $newname = $_FILES["image"]["name"];
							// Set the resize_image name
							$resize_image = $folder.$newname; 
							$actual_image = $folder.$newname;
							// It gets the size of the image
							//list( $width,$height ) = getimagesize( $uploadimage );
							// It makes the new image width of 350
							$newwidth = 1800;
							//// It makes the new image height of 350
							//$newheight = 1238;
							// It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
							//$thumb = imagecreatetruecolor( $newwidth, $newheight );
							//$source = imagecreatefromjpeg( $resize_image );
							// Resize the $thumb image.
							//imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
							//imagejpeg( $thumb, $resize_image, 80 );

							//$img_name = $resize_image;
							$update = mysqli_query($conn,"UPDATE ".$about_property." SET about_img='".$newname."', title='".$title."', content='".$content."', content2='".$content2."', update_date=now() WHERE about_id='".$about_id."'") or (mysqli_error($conn));
		if($update){
			$_SESSION['wppa'] = "Updated Successfully.";
		?>
		<script>
		      window.location='<?php echo $_SERVER["REQUEST_URI"]?>';
		</script>
	    <?php } 
						}
						
		$update = mysqli_query($conn,"UPDATE ".$about_property." SET  title='".$title."', content='".$content."', content2='".$content2."', update_date=now() WHERE about_id='".$about_id."'") or (mysqli_error($conn));
		if($update){
			$_SESSION['wppa'] = "Updated Successfully.";
		?>
		<script>
		      window.location='<?php echo $_SERVER["REQUEST_URI"]?>';
		</script>
	    <?php } 
	    }
	    }
	}else{    
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
					){
						if($name==""){
							$img_name = $_POST['profile_image'];
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
							
							$img_name = $resize_image;
						}
		
		$insert = mysqli_query($conn,"INSERT into ".$about_property."(about_img,title,content,content2,create_date) VALUES('".$newname."','".$title."','".$content."','".$content2."', now())");
		if($insert){
			$_SESSION['wppa'] = "Inserted Successfully.";
			?>
			<script>
				window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
            </script>
            <?php
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
			$admin_id = $_SESSION['admin_id'];
		  	$fetch = mysqli_query($conn,"SELECT * FROM ".$about_property." limit 1");
			$num = mysqli_num_rows($fetch);
		  	while($show = mysqli_fetch_assoc($fetch))
		  	{
		  		$about_id = $show['about_id'];
				$title = html_entity_decode($show['title']);
				$content = $show['content'];
				$content2 = $show['content2'];
				$profile_image =$show['about_img'];
		  	}
		?>
		  <div class="content-wrapper">
		    <section class="content-header">
		      <h1> About Owner<small>Update your Content Easily</small> <?php if($_SESSION['wppa']){ ?><small id="msgata" style="color:#ff0000"><?php echo "--" .$_SESSION['wppa']; ?></small><?php } ?></h1>
		      <hr>
		      	<form method="post" action="" enctype="multipart/form-data">
		      	         <div class="row">
					<div class="col-md-3">
						<div class="image_holder">
							<?php if(@$profile_image==""){ ?>
								<img src="../img/default.jpg">
							<?php }else{ ?>
								<img src="../uploads/about/<?php echo @$profile_image ?>">
							<?php } ?>
							<div class="form-group">
								<input type="file" name="image" id="about_profile_img">
							</div>
						</div>
					</div>
				</div>
			        <div class="form-group">
				        <label for="exampleInputEmail1">Heading</label>
				        <input type="text" name="about_heading" class="form-control" id="about_heading" placeholder="Heading" value="<?php echo @$title; ?>">
			        </div>

			        <div class="form-group">
				        <label for="exampleInputEmail1">Content</label>
				         <div class="editor">
				        	<textarea class="ckeditor" name="about_content"><?php echo @$content; ?></textarea>
			        	</div>
			        </div>
		       
			        <!-- <div class="form-group">
			        	<label for="exampleInputEmail1">Youtube URL</label>
				        <input type="text" name="about_short_content" class="form-control" id="about_short_content" placeholder="Youtube URL" value="<?php echo @$content2; ?>">
			        </div> -->
		        <div class="ui_button">
		        <input type="hidden" name="about_id" value="<?php echo @$about_id; ?>">
		        <button type="submit" name="about_submit" class="btn btn-default"><i class="fa fa-paper-plane-o"></i> Submit</button>
		        </div>
		      </form>
		      
		    </section>
		  </div>
		</div>
    <script src="framework/js/bootstrap.min.js"></script> 
    <script src="framework/js/custom.js"></script> 
    <script src="framework/js/app.min.js"></script> 
    <script src="framework/ckeditor/ckeditor.js"></script>
    <script type="text/javascript"> 
      $(document).ready( function() {
        $('#msgata').delay(1000).fadeOut();
      });
    </script>
</body>
</html>
