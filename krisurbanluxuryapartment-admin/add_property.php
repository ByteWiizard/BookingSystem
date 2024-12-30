<?php include_once('session_destroy.php') ;?>
<?php include("include/db.php"); ?>
<?php include_once('include/functions.php');?>
<?php
error_reporting(0);
$property_listing = $pre_fix."property_listing";
$property_details = $pre_fix."property_details";

if(isset($_POST['add_property_submit'])){
	$admin_id=$_SESSION['admin_id'];
	$pro_heading=mysqli_real_escape_string($conn, $_POST['property_heading']);
	$location = $_POST['location'];
	$pro_status=$_POST['property_status'];
	$ip = getClientIP();
		
		$insert = mysqli_query($conn,"INSERT into ".$property_listing."(admin_id,property_heading,property_status,pro_add_insert_date,pro_add_ip) VALUES('".$admin_id."','".$pro_heading."','".$pro_status."', now() ,'".$ip."')");
		$last_id = mysqli_insert_id($conn);
		
		$insert = mysqli_query($conn,"INSERT into ".$property_details."(admin_id,property_id,property_heading,property_status,pro_det_insert_date,pro_det_ip) VALUES('".$admin_id."','".$last_id."','".$pro_heading."','".$pro_status."', now() ,'".$ip."')");
		if($insert)
		{
			echo "<script>alert('Add Successfully.');</script>";
			?>
			<script>
			window.location = 'property_listing.php';
            </script>
            <?php
		}
		else
		{
			echo "<script>alert('Something Went Wrong.');</script>";		
		}
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="framework/js/ajax.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add Property</title>
<link href="framework/css/import.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include_once('include/topbar.php'); ?>
<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
<section class="content-header">
<h1> Property Details <small>Add your Property Easily</small> </h1>
<hr>
	<form method="post" action="">
		
		<div class="form-group">
			<label for="exampleInputEmail1">Heading</label>
			<input type="text" name="property_heading" class="form-control" id="property_heading" placeholder="Heading" required/>
		</div>

		<div class="form-group">
			<div class="prop_type">
				
				<select name="property_status" class="cs-select cs-skin-underline">
				<?php
					$selected = "";
					$options  = array('for sale', 'for rent');
					echo "<option value=''>Property Status</option>";
				foreach($options as $option){
					echo "<option value='$option'>$option</option>" ;
				}
				?>
				</select>
				
			</div>
		</div>
		<p class="text-center">
		<button type="submit" name="add_property_submit" class="btn btn-success btn-outline-rounded green"> Add Property <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
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
