<?php include_once('session_destroy.php') ;?>
<?php 
	include("include/db.php"); 
	$home_details = $pre_fix."home_details";
?>
<?php include_once('include/functions.php');?>
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
	$admin_id=test_input($_SESSION['admin_id']);
	$pro_heading=test_input($_POST['home_heading']);
	$pro_content=$_POST['home_content'];
	$other_content = $_POST['other_content'];
	$pro_video_url=test_input($_POST['home_video_url']);
	$pro_type=test_input($_POST['home_type']);
	$pro_no_of_bedrooms=test_input($_POST['home_no_of_bedrooms']);
	$pro_no_of_sleeps=test_input($_POST['home_no_of_sleeps']);
	$pro_no_of_baths=test_input($_POST['home_no_of_baths']);
	$ip = getClientIP();
	
	$insert = mysqli_query($conn,"SELECT * FROM ".$home_details." WHERE admin_id=$admin_id");
	$row = mysqli_num_rows($insert);
	
	if($row==0)
	{
		
		$insert = mysqli_query($conn,"INSERT into ".$home_details."(admin_id,home_heading,home_content,other_content,	home_video_url,home_type,home_no_of_bedrooms,home_no_of_sleeps,home_no_of_baths,home_det_insert_date,home_det_ip) VALUES('".$admin_id."','".$pro_heading."','".$pro_content."','".$other_content."','".$pro_video_url."','".$pro_type."','".$pro_no_of_bedrooms."','".$pro_no_of_sleeps."','".$pro_no_of_baths."', now() ,'".$ip."')");
		
		if($insert)
		{
			echo "<script>alert('Inserted Successfully.');</script>";
			?>
			<script>
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
            </script>
            <?php
		}
	}
	if($row>0)
	{
		while($loop = mysqli_fetch_assoc($insert))
		{
			$update = mysqli_query($conn,"UPDATE ".$home_details." SET home_heading='".$pro_heading."', home_content='".$pro_content."', other_content='".$other_content."',home_video_url='".$pro_video_url."', home_type='".$pro_type."', home_no_of_bedrooms='".$pro_no_of_bedrooms."', home_no_of_sleeps='".$pro_no_of_sleeps."', home_no_of_baths='".$pro_no_of_baths."', home_det_update_date=now() , home_det_ip='".$ip."' WHERE home_id='".$loop['home_id']."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
		}
		if($update)
		{
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
<div class="wrapper">
<?php include_once('include/topbar.php'); ?>
<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
$admin_id = $_SESSION['admin_id'];
  $fetch = mysqli_query($conn,"SELECT * FROM ".$home_details." WHERE admin_id='".$admin_id."'");
	$num = mysqli_num_rows($fetch);
  while($show = mysqli_fetch_assoc($fetch))
  {
	$pro_heading=$show['home_heading'];
	$pro_content=$show['home_content'];
	$pro_other = $show['other_content'];
	//$pro_video_url=$show['home_video_url'];
	$pro_type=$show['home_type'];
	$pro_no_of_bedrooms=$show['home_no_of_bedrooms'];
	$pro_no_of_sleeps=$show['home_no_of_sleeps'];
	$pro_no_of_baths=$show['home_no_of_baths'];
  }
?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Home <small>Update your Content Easily</small> </h1>
      <hr>
      <form method="post" action="">
  
  <!-- <div class="form-group">
          <label for="exampleInputEmail1">Heading</label>
          <input type="text" name="home_heading" class="form-control" id="home_heading" placeholder="Heading" value="<?php echo @$pro_heading ;?>" />
        </div> -->
        <div class="editor">
          <label for="exampleInputEmail1">Content</label>
          <textarea class="ckeditor" name="home_content" id="home_content"><?php echo htmlspecialchars(@$pro_content) ;?></textarea>
        </div>

        <!-- <div class="editor">
          <label for="exampleInputEmail1">Other Content</label>
          <textarea class="ckeditor" name="other_content" id="other_content"><?php echo htmlspecialchars(@$pro_other) ;?></textarea>
        </div> -->

        <!--<div class="form-group">
          <label for="exampleInputEmail1"><i class="fa fa-youtube" aria-hidden="true"></i> Video Url</label>
          <input type="text" name="home_video_url" class="form-control" id="home_video_url" placeholder="Video Url" value="<?php echo @$pro_video_url ;?>">
        </div>
        <div class="row">
          <div class="heading">
            <h3><i class="fa fa-home" aria-hidden="true"></i> Enter Your Property Details</h3>
          </div>
          <div class="col-md-4">
            <div class="prop_type">
              <section>
                <select name="home_type" class="cs-select cs-skin-underline">
				<?php
				$selected = @$pro_type ;
				$options  = array('Apartment', 'Cabin', 'Condo', 'Cottage', 'Guest House');
				if($selected==""){
              	echo "<option value='' disabled selected>Choose Property Type</option>";
				}
					echo "<option value=''>Choose Property Type</option>";
					foreach($options as $option){
						if($selected == $option){
							echo "<option selected='selected' value='$option'>$option</option>" ;
						}else{
							echo "<option value='$option'>$option</option>" ;
						}
					}
				?>
				</select>
              </section>
            </div>
          </div>
          
           <div class="col-md-4">
          <label for="exampleInputEmail1">No of Bedrooms</label>
          <input type="text" name="home_no_of_bedrooms" class="form-control" id="home_no_of_bedrooms" placeholder="No. of Bedrooms" value="<?php echo @$pro_no_of_bedrooms ;?>" />
        </div>
         
          <div class="col-md-4">
          <label for="exampleInputEmail1">No of Sleeps</label>
          <input type="text" name="home_no_of_sleeps" class="form-control" id="home_no_of_sleeps" placeholder="No. of Sleeps" value="<?php echo @$pro_no_of_sleeps ;?>" />
        </div>
        
        <div style="clear:both"></div>
        <div class="col-md-4">
          <label for="exampleInputEmail1">No of Bathrooms</label>
          <input type="text" name="home_no_of_baths" class="form-control" id="home_no_of_baths" placeholder="No. of Bathrooms" value="<?php echo @$pro_no_of_baths ;?>" />
        </div>-->
<div style="clear:both"></div>
         <p class="text-center">
          <button type="submit" name="home_details_submit" class="btn btn-success btn-outline-rounded green"> Submit <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
      </form>
      
    </section>
  </div>
</div>
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
</body>
</html>
