<?php include_once('session_destroy.php') ;?>
<?php include_once('include/functions.php');?>
<?php 
	error_reporting(0);
	include("include/db.php"); 
	$profile_details = $pre_fix."profile_details";
?>

<?php
if(isset($_POST['profile_submit'])){

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$admin_id=test_input($_SESSION['admin_id']);
	$profile_name=test_input($_POST['profile_name']);
	$website_name=test_input($_POST['website_name']);
	$name=$_FILES['image']['name'];
	$type=$_FILES['image']['type'];
	$size=$_FILES['image']['size'];
	$tmp=$_FILES['image']['tmp_name'];
	$dotcount = substr_count($name, '.');
	$ip = getClientIP();
	$folder_path = 'uploads/profile';

	if (!file_exists($folder_path)) {
    	mkdir($folder_path, 0777, true);
	}
	$targetDir = 'uploads/profile/';
	$insert = mysqli_query($conn,"SELECT * FROM ".$profile_details." WHERE admin_id=$admin_id");
	$row = mysqli_num_rows($insert);
	
	if($row==0){
		if($dotcount>1){
			echo"<script>alert('File Not Supportable')</script>";
			?>
			<script>
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
            </script>
            <?php
		}else{
			if(($type=="image/jpeg")||($type=="image/png")||($type=="image/gif")||($name=="")){
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
				///$newwidth = 640;
				// It makes the new image height of 350
				//$newheight = 1136;
				// It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
				//$thumb = imagecreatetruecolor( $newwidth, $newheight );
				//$source = imagecreatefromjpeg( $resize_image );
				// Resize the $thumb image.
				///imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				//imagejpeg( $thumb, $resize_image, 80 );

				$insert = mysqli_query($conn,"INSERT into ".$profile_details."(admin_id,profile_img,profile_name,website_name,profile_inst_date,profile_ip) VALUES('".$admin_id."','".$resize_image."','".$profile_name."','".$website_name."', now() ,'".$ip."')");
			}else{
				echo"<script>alert('$type is not a valid type of file')</script>";
			}
			
			if($insert)
			{
				move_uploaded_file($tmp,"../uploads/profile/$name");
				echo "<script>alert('Inserted Successfully.');</script>";
				?>
				<script>
				window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
	            </script>
	            <?php
			}
		}
	}
	if($row>0){
		while($loop = mysqli_fetch_assoc($insert)){
			$del_file = $loop['profile_img'];
			if($name == "" ){
				$name = $loop['profile_img'];
				$update = mysqli_query($conn,"UPDATE ".$profile_details." SET profile_img='".$name."' , profile_name='".$profile_name."', website_name='".$website_name."', profile_update_date=now(), profile_ip='".$ip."' WHERE profile_id='".$loop['profile_id']."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
				if($update){
					echo "<script>alert('Updated Successfully.');</script>";
				?>
					<script>
						window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
		            </script>
		        <?php
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
					
					if(($type=="image/jpeg")||($type=="image/png")||($type=="image/gif")||($type=="image/jpg")){

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
						//$newwidth = 640;
						// It makes the new image height of 350
						//$newheight = 1136;
						// It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
						//$thumb = imagecreatetruecolor( $newwidth, $newheight );
						//$source = imagecreatefromjpeg( $resize_image );
						// Resize the $thumb image.
						//imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
						//imagejpeg( $thumb, $resize_image, 80 );
							/**/
							$update = mysqli_query($conn,"UPDATE ".$profile_details." SET profile_img='".$resize_image."' , profile_name='".$profile_name."', website_name='".$website_name."', profile_update_date=now(), profile_ip='".$ip."' WHERE profile_id='".$loop['profile_id']."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
							if($update){
								echo $FileName = 'uploads/profile/'.$del_file;
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
							}else{
								echo "<script>alert('Updatation Failed.');</script>";
							}
						
					}else{
						echo "<script>alert('File Type Is Not Supportable.');</script>";
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
  $fetch = mysqli_query($conn,"SELECT * FROM ".$profile_details." WHERE admin_id='".$admin_id."'");
	$num = mysqli_num_rows($fetch);
  while($show = mysqli_fetch_assoc($fetch))
  {
	$profile_img = $show['profile_img'];
	$profile_name=$show['profile_name'];
	$website_name=$show['website_name'];
  }
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Profile <small>Update your Profile Easily</small> </h1>
      <hr>
      <form method="post" action="" enctype="multipart/form-data">
     <div class="row">
     <div class="col-md-3 col-md-offset-4">
     <div class="image_holder">
      <?php if(@$profile_img==""){ ?>
     <img src="../img/user2-160x160.jpg">
     <?php }else{ ?>
      <img src="<?php echo @$profile_img ?>">
     <?php } ?>
     <div class="form-group">
    <input type="file" name="image" id="profile_image">
  </div>
     </div>
     </div>
       </div> 
        
        <div class="col-md-6">
        <div class="form-group">
        <label for="exampleInputEmail1">Name </label>
        <input type="text" name="profile_name"  class="form-control" id="profile_name" placeholder="Name" value="<?php echo @$profile_name ?>">
        </div>
        </div>
        
        <div class="col-md-6">
        <div class="form-group">
        <label for="exampleInputEmail1">Website Name </label>
        <input type="text" name="website_name" class="form-control" id="website_name" placeholder="Website Name" value="<?php echo @$website_name ?>">
        </div>
        </div>
       
        
        <div class="ui_button">
        <button type="submit" name="profile_submit" class="btn btn-default"><i class="fa fa-paper-plane-o"></i> Submit</button>
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
