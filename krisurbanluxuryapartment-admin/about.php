<?php include_once('session_destroy.php') ;
error_reporting(0);
?>
<?php 
	include_once('include/db.php');
	$about_details = $pre_fix."about_details";
?>
<?php include_once('include/functions.php');?>
<?php
	if(isset($_POST['about_submit']))
	{
		
		
	 
	    	function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			$about = $_POST['about'];
			$admin_id=test_input($_SESSION['admin_id']);
			$about_heading=mysqli_real_escape_string($conn, $_POST['about_heading']);
			$about_content=mysqli_real_escape_string($conn, $_POST['about_content']);
			$about_heading2=test_input($_POST['about_heading2']);
			$about_short_content=test_input($_POST['about_short_content']);
			$about_profile_img = $_POST['about_profile_img'];

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


			if($about){
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
							list( $width,$height ) = getimagesize( $uploadimage );
							// It makes the new image width of 350
							$newwidth = 1800;
							// It makes the new image height of 350
							$newheight = 1238;
							// It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
							$thumb = imagecreatetruecolor( $newwidth, $newheight );
							$source = imagecreatefromjpeg( $resize_image );
							// Resize the $thumb image.
							imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
							imagejpeg( $thumb, $resize_image, 80 );

							$img_name = $resize_image;
							$update = mysqli_query($conn,"UPDATE ".$about_details." SET about_heading='".$about_heading."', about_content='".$about_content."',about_profile_img='".$newname."', about_heading2='".$about_heading2."', about_short_content='".$about_short_content."', about_update_date=now(), about_ip='".$ip."' WHERE about_id='".$about."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
						if($update==true){
							$_SESSION['wppa'] = "Updated Successfully.";
						?>
							<script>
								window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
							</script>
						<?php
						}
						}
						$update = mysqli_query($conn,"UPDATE ".$about_details." SET about_heading='".$about_heading."', about_content='".$about_content."',about_heading2='".$about_heading2."', about_short_content='".$about_short_content."', about_update_date=now(), about_ip='".$ip."' WHERE about_id='".$about."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
						if($update==true){
							$_SESSION['wppa'] = "Updated Successfully.";
						?>
							<script>
								window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
							</script>
						<?php
						}
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
							list( $width,$height ) = getimagesize( $uploadimage );
							// It makes the new image width of 350
							$newwidth = 1800;
							// It makes the new image height of 350
							$newheight = 1238;
							// It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
							$thumb = imagecreatetruecolor( $newwidth, $newheight );
							$source = imagecreatefromjpeg( $resize_image );
							// Resize the $thumb image.
							imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
							imagejpeg( $thumb, $resize_image, 80 );
							
							$img_name = $resize_image;
						}
						$insert = mysqli_query($conn,"INSERT into ".$about_details."(admin_id,about_heading,about_content,about_profile_img,about_heading2,about_short_content,about_inst_date,about_ip) VALUES('".$admin_id."','".$about_heading."','".$about_content."', '".$newname."', '".$about_heading2."','".$about_short_content."', now() ,'".$ip."')");
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

<?php
if(isset($_POST['edit_review_button']))
{
	$admin_id = $_POST['admin_id'];
	$r_id = $_POST['edit_about_id'];
	$fetch = mysqli_query($conn,"SELECT * FROM ".$about_details." WHERE admin_id='".$admin_id."' AND about_id='".$r_id."'");
	$num = @mysqli_num_rows($fetch);
	while($show = @mysqli_fetch_assoc($fetch))
	{
		$about_id = $show['about_id'];
		$profile_image = $show['about_profile_img'];
		$about_heading = $show['about_heading'];
		$about_content = $show['about_content'];
		$about_heading2 = $show['about_heading2'];
		$about_short_content = $show['about_short_content'];
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
	<script>
	function check(){
		var retVal= confirm(" Do you want to delete? ");
		if(retVal==true){
			return true ;
		}else{
			return false ;
		}
	}
	</script>
	<script>
	$(document).ready(function(e) {
		var a = "<?php echo $about_id; ?>";
		if(a!=""){
			$('#add_rev').show();
		}else{
			$('#add_rev').hide();
		}
	    $('#add_areview').click(function(){
			var but = $('#add_areview').val();
				$('#add_rev').toggle(function(){
				if(but== 'Add About Other Details' ){
					$('#add_areview').val('Close X');
				}else{
					$('#add_areview').val('Add About Other Details');
					$('#add_rev').hide();
				}
			});
			return false;
		});
	});
	</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php include_once('include/topbar.php'); ?>
	<div class="wrapper">
		
		<?php include_once('include/sidebar.php'); ?>
		<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
		<?php
			$admin_id = $_SESSION['admin_id'];
		?>
  
  	<div class="content-wrapper">
		<section class="content-header">
			<h1>About Owner Details <small>Add About Owner Details From Here</small> <?php if($_SESSION['wppa']){ ?><small id="msgata" style="color:#ff0000"><?php echo "--" .$_SESSION['wppa']; ?></small><?php } ?></h1>
			<hr>
			<?php if($about_id){ ?>
				<h1>Update About Welcome Content</h1>
			<?php }else{ ?>
				<input type="button" class="btn btn-success green" id="add_areview" value="Add About Other Details" style="margin:10px;"/>
			<?php } ?>
			<div id="add_rev">
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
							<input type="text" name="about_heading" class="form-control" id="about_heading" placeholder="Heading" value="<?php echo @$about_heading ?>">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Content</label>
							<div class="editor">
								<textarea class="ckeditor" name="about_content"><?php echo @$about_content ?></textarea>
							</div>
						</div>

 

						<div class="ui_button">
							<input type="hidden" name="about" value="<?php echo $about_id; ?>">
							<input type="hidden" name="profile_image" value="<?php echo $profile_image; ?>">
							<button type="submit" name="about_submit" class="btn btn-default"><i class="fa fa-paper-plane-o"></i> Submit</button>
						</div>
					</form>
			</div>
		</section>
 
<?php
$admin_id = $_SESSION['admin_id'];
$per_page= 5; // number of user to show
$page_query=mysqli_query($conn,"SELECT about_id FROM ".$about_details." WHERE admin_id='".$admin_id."'");
$pages=ceil(mysqli_num_rows($page_query) / $per_page); //total number of pages to show
$page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1; // current page list
$start= ($page - 1) * $per_page; //start list of user from zero becoz php starts from zero
  $fetch11 = mysqli_query($conn,"SELECT * FROM ".$about_details." WHERE admin_id='".$admin_id."'  ORDER BY about_id DESC LIMIT $start, $per_page");
	   $num11 = mysqli_num_rows($fetch11);
	   if($num11>0)
	   {
	?>
        <h3 class="head text-center">About Other Content</h3>
        <table class="responsive-table">
          <thead>
            <tr>
              <th scope="col">S.No.  </th>
              <th scope="col"> Title </th>
              <th scope="col"> Content </th>
			 <th scope="col">Edit</th>
             <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $i = 1 ;
			while($show11 = mysqli_fetch_assoc($fetch11))
			{
				$c_head=$show11['about_heading'];
				$c_review=html_entity_decode($show11['about_content']);
				$c_rev=substr($c_review,0,150);
	?>
			<tr>
				<td scope="row"><?php echo ++$start ;?></td>
				<td data-title="Start Date"><?php echo $c_head; ?></td>
				<td data-title="Start Date"><?php echo $c_rev?html_entity_decode($c_rev)."...":''; ?></td>
				
				<form method="post" action="about.php">
				<td data-title="Edit" >
				<input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id'] ;?>" >
				<input type="hidden" name="edit_about_id" value="<?php echo $show11['about_id']; ?>">
				<button type="submit" name="edit_review_button"><i class="fa fa-pencil"></i></button>
				</td>
				</form>
				
				<form method="post" action="about.php">
				<td data-title="Delete" >
				<input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id'] ;?>" >
				<input type="hidden" name="delete_rate" value="<?php echo $show11['about_id']; ?>">
				<button type="submit" name="delete_rate_button"><i class="fa fa-trash"></i></button>
				</td>
				</form>
				
			</tr>
          <?php
             }
	   
          ?>
            </tbody>
          
        </table>

<?php
}
?>
 </div>
</div>
<?php 
   if(isset($_POST['delete_rate_button']))
{
	$delete_id = $_POST['delete_rate'];
	
	$dt = mysqli_query($conn, "SELECT img FROM ".$about_details." WHERE about_id='".$delete_id."'");
	$dell = mysqli_fetch_assoc($dt);
	$del_file = $dell['img'];
	echo $qry="DELETE FROM ".$about_details." WHERE about_id=$delete_id";
	$delete = mysqli_query($conn,$qry);
	if($delete)
		{
			$FileName = '../uploads/location/'.$del_file;
			@chown($FileName,465); //Insert an Invalid UserId to set to Nobody Owner; for instance 465
			@unlink($FileName);
			echo "<script>alert('Deleted Successfully.');</script>";
			echo "<script>window.location = 'location.php'</script>";
		}
}
?>  
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script>
<script src="framework/js/dropdown.js"></script>
<script src="framework/js/select.js"></script>
<script>
	(function() {
		[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
			new SelectFx(el);
		} );
	})();
</script>
<script type="text/javascript"> 
	$(document).ready( function() {
		$('#msgata').delay(1000).fadeOut();
	});
</script>
</body>
</html>
