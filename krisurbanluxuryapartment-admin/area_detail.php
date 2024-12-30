<?php include_once('session_destroy.php'); ?>
<?php include_once('include/functions.php');?>
<?php include("include/db.php"); ?>
<?php
	error_reporting(0);
	$area_detail = $pre_fix."area_detail";
?>
<?php
if(isset($_POST['about_submit']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$area_id = test_input($_POST['area_id']);
	$title=mysqli_real_escape_string($conn, $_POST['about_heading']);
	$content=mysqli_real_escape_string($conn, $_POST['about_content']);

	if($area_id){
		$update = mysqli_query($conn,"UPDATE ".$area_detail." SET area_title='".$title."', area_content='".$content."', update_date=now() WHERE area_id='".$area_id."'") or (mysqli_error($conn));
		if($update){
			$_SESSION['wppa'] = "Updated Successfully.";
		?>
			<script>
				window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
		    </script>
	    <?php
		}
	}else{
		
		$insert = mysqli_query($conn,"INSERT into ".$area_detail."(area_title,area_content,create_date) VALUES('".$title."','".$content."', now())");
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
		  	$fetch = mysqli_query($conn,"SELECT * FROM ".$area_detail." limit 1");
			$num = mysqli_num_rows($fetch);
		  	while($show = mysqli_fetch_assoc($fetch))
		  	{
		  		$area_id = $show['area_id'];
				$title = $show['area_title'];
				$content = $show['area_content'];
		  	}
		?>
		  <div class="content-wrapper">
		    <section class="content-header">
		      <h1> Area Detail<small>Update Area Detail Easily</small> <?php if($_SESSION['wppa']){ ?><small id="msgata" style="color:#ff0000"><?php echo "--" .$_SESSION['wppa']; ?></small><?php } ?></h1>
		      <hr>
		      	<form method="post" action="" enctype="multipart/form-data">
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
		        <input type="hidden" name="area_id" value="<?php echo @$area_id; ?>">
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
