<?php include_once('session_destroy.php') ;?>
<?php 
	include_once('include/db.php');
	$social_links = $pre_fix."social_links";
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

  <?php include ('include/functions.php'); ?>
  <?php include ('include/topbar.php'); ?>
  <div class="wrapper">
  <?php include ('include/sidebar.php'); ?>
  <?php
  $admin_id = $_SESSION['admin_id'];
  $fetch = mysqli_query($conn,"SELECT * FROM ".$social_links." WHERE admin_id='".$admin_id."'");
	$num = mysqli_num_rows($fetch);
  while($show = mysqli_fetch_assoc($fetch))
  {
	  $facebook = $show['facebook'];
	  $twitter = $show['twitter'];
	  $linkdin = $show['linkdin'];
	  $instragram = $show['instragram'];
	  $google_plus = $show['google_plus'];
  } 
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Social Links <small>Update your Social Links :</small> </h1>
      <hr>
      <form name="social" method="post" action="">
        
        <div class="form-group">
        <label for="exampleInputEmail1"><i class="fa fa-facebook-official"></i> Facebook</label>
        <input type="text" class="form-control" name="facebook_link" id="facebook_link" placeholder="Facebook" value="<?php echo @$facebook ;?>">
        </div>
        
        <div class="form-group">
        <label for="exampleInputEmail1"><i class="fa fa-twitter-square"></i> Twitter</label>
        <input type="text" class="form-control" name="twitter_link" id="twitter_link" placeholder="Twitter" value="<?php echo @$twitter ?>">
        </div>
        
        <!--<div class="form-group">
        <label for="exampleInputEmail1"><i class="fa fa-pinterest-p" aria-hidden="true"></i> Pinterest</label>
        <input type="text" class="form-control" name="linkdin" id="linkdin" placeholder="Pinterest" value="<?php echo @$linkdin ?>">
        </div> -->
        
       <div class="form-group">
        <label for="exampleInputEmail1"><i class="fa fa-instagram" aria-hidden="true"></i> Instragram</label>
        <input type="text" class="form-control" name="instragram" id="instragram" placeholder="Instragram" value="<?php echo @$instragram ?>">
        </div> 
        
        <div class="form-group">
        <label for="exampleInputEmail1"><i class="fa fa-google-plus-square" aria-hidden="true"></i>Google+</label>
        <input type="text" class="form-control" name="google_plus" id="google_plus" placeholder="You Tube" value="<?php echo @$google_plus ?>">
        </div>
        
        <div class="ui_button">
        <button type="submit" class="btn btn-default hi-icon hi-icon-images" name="social_submit"><i class="fa fa-paper-plane-o"></i> Submit</button>
        </div>
      </form>
      
    </section>
  </div>
</div>
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script>
<?php
if(isset($_POST['social_submit']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$facebook1 = test_input($_POST['facebook_link']);
	$twitter1 = test_input($_POST['twitter_link']);
	$linkdin1 = test_input($_POST['linkdin']);
	$instragram1 = test_input($_POST['instragram']);
	$google_plus1 = test_input($_POST['google_plus']);
	$admin_id = $_SESSION['admin_id'];
	$ip = getClientIP();
	
	$insert = mysqli_query($conn,"SELECT * FROM ".$social_links." WHERE admin_id='".$admin_id."'");
	$row = mysqli_num_rows($insert);
	
	if($row==0)
	{
		
		$insert1 = mysqli_query($conn,"INSERT into ".$social_links."(admin_id,facebook,twitter,linkdin,instragram,google_plus,social_status,social_insert_date,social_ip) VALUES('".$admin_id."','".$facebook1."','".$twitter1."','".$linkdin1."', '".$instragram1."', '".$google_plus1."', 1 , now() ,'".$ip."')") or (die(mysqli_error($conn)));
		
		if($insert1)
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
			$update = mysqli_query($conn,"UPDATE ".$social_links." SET facebook='".$facebook1."', twitter='".$twitter1."', linkdin='".$linkdin1."', instragram='".$instragram1."', google_plus='".$google_plus1."', social_update_date=now() , social_ip='".$ip."' WHERE social_id='".$loop['social_id']."' AND admin_id='".$admin_id."'") or (die(mysqli_error($conn))) ;
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
		
	}
}
?>
</body>
</html>
