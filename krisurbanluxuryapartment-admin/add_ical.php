 <?php @include_once('session_destroy.php');?>
 <?php include_once('include/db.php') ;?>
<?php include_once('include/functions.php');?>
 <?php

$ical_links = $pre_fix."ical_links";
$property_details = $pre_fix."property_details";

if(isset($_POST['add_property_ical_submit']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$admin_id=test_input($_SESSION['admin_id']);
	$pro_id=test_input($_POST['pro_id']);
	$pro_heading=test_input($_POST['property_heading']);
	$pro_ical=test_input($_POST['ical_link']);
	$ip = getClientIP();
		
		$insert = mysqli_query($conn,"INSERT into ".$ical_links."(property_id,admin_id,property_heading,link,add_date,update_date,ical_add_ip) VALUES('".$pro_id."','".$admin_id."','".$pro_heading."', '".$pro_ical."', now() , now() ,'".$ip."')");
		
		if($insert)
		{
			echo "<script>alert('Add Successfully.');</script>";
			?>
			<script>
			window.location = 'property_ical_links.php';
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
<title>Add Ical</title>
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
<script>
$(document).ready(function(e) {
    $("#add_property_ical_submit").click(function(){
		var e = document.getElementById("pro_id");
	var strUser = e.options[e.selectedIndex].value;
	//if you need text to be compared then use
	var strUser1 = e.options[e.selectedIndex].text;
	if(strUser==="") //for text use if(strUser1=="Select")
	{
	$('#error_pro').html('* Please select a property for ical link');
		$('#pro_id').focus();
		return false;
	}
	else
	{
		$('#error_pro').html('');
	}
	});
})
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include_once('include/topbar.php'); ?>
<?php include_once('include/sidebar.php'); ?>
<?php @$admin_id = $_SESSION['admin_id'] ;?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
$sel = mysqli_query($conn, "SELECT property_id,property_heading FROM ".$property_details." WHERE admin_id='".$admin_id."'");
echo @$num = mysqli_num_rows($sel);
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
<section class="content-header">
<h1> Property Ical <small>Add your Property Ical Easily</small> </h1>
<hr>
<?php if($num>0)
{
?>
<form method="post" action="">
<div class="form-group">
          <label for="exampleInputEmail1">Select your property </label><br/>
          <select name='pro_id' id="pro_id">
          <option value="">-- Please select property for ical--</option>
          <?php while($row = mysqli_fetch_assoc($sel)){ ?>
          <option value="<?php echo $row['property_id'] ;?>"><?php echo $row['property_heading'] ;?></option>
          <?php } ?>
          </select>
        </div>
        <div id="error_pro" style="color:red;"></div>
		<div class="form-group">
          <label for="exampleInputEmail1">Heading</label>
          <input type="text" name="property_heading" class="form-control" id="property_heading" placeholder="Heading" required/>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Ical Link</label>
          <input type="text" name="ical_link" class="form-control" id="ical_link" placeholder="Ical Link" required/>
        </div>
       
        <p class="text-center">
          <button type="submit" name="add_property_ical_submit" id="add_property_ical_submit" class="btn btn-success btn-outline-rounded green"> Add Property Ical<span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
        </form>
<?php
}
else{
	echo "<p>No property is available now.</p>";
}
?>
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
