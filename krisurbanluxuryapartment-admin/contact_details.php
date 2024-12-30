<?php include_once('session_destroy.php'); ?>
<?php 
  include("include/db.php"); 
  $contact_details = $pre_fix."contact_details";
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

<style>
  #mapCanvas {
    width: 500px;
    height: 400px;
    float: left;
  }
  #infoPanel {
    float: left;
    margin-left: 10px;
  }
  #infoPanel div {
    margin-bottom: 5px;
  }
  </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
 

<?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<div class="wrapper">
<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
$admin_id = $_SESSION['admin_id'];
  $fetch = mysqli_query($conn,"SELECT * FROM ".$contact_details." WHERE admin_id='".$admin_id."'");
	$num = mysqli_num_rows($fetch);
  while($show = mysqli_fetch_assoc($fetch))
  {
	$contact_name=$show['contact_name'];
	$contact_email=$show['contact_email'];
	$contact_email1=$show['contact_email1'];
	$contact_phone=$show['contact_phone'];
  /*$contact_phone1=$show['contact_phone1'];
  $contact_phone2=$show['contact_phone2'];*/
	$contact_addr=$show['contact_addr'];
	$contact_content=$show['contact_content'];
	$map_longitude=$show['map_longitude'];
	$map_latitude=$show['map_latitude'];
  }
?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Contact Details<small>Update your Contact Details</small> </h1>
      <hr>
      <form method="post" action="">
        
      <div class="form-group">
        <label for="exampleInputEmail1"><i class="fa fa-user" aria-hidden="true"></i> Name</label>
        <input type="text" name="contact_name" class="form-control" id="contact_name" placeholder="Name" value="<?php echo @$contact_name ?>">
        </div>
          <div class="form-group">
        <label for="exampleInputEmail1"><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</label>
        <input type="email" name="contact_email" class="form-control" id="contact_email" placeholder="Email" value="<?php echo @ $contact_email?>">
        </div>
      <!--<div class="form-group">-->
      <!--  <label for="exampleInputEmail1"><i class="fa fa-envelope-o" aria-hidden="true"></i> Address</label>-->
      <!--  <input type="text" name="contact_email1" class="form-control" id="contact_email1" placeholder="Address" value="<?php echo @ $contact_email1?>">-->
      <!--  </div>-->
        <div class="form-group">
          <label for="exampleInputEmail1"><i class="fa fa-phone" aria-hidden="true"></i> Phone</label>
          <input type="text" name="contact_phone" class="form-control" id="contact_phone" placeholder="Phone" value="<?php echo @$contact_phone ?>">
        </div>

        <!-- <div class="form-group">
          <label for="exampleInputEmail1"><i class="fa fa-phone" aria-hidden="true"></i> USA</label>
          <input type="text" name="contact_phone1" class="form-control" id="contact_phone1" placeholder="USA" value="<?php echo @$contact_phone1; ?>">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1"><i class="fa fa-phone" aria-hidden="true"></i> International Toll Free</label>
          <input type="text" name="contact_phone2" class="form-control" id="contact_phone2" placeholder="International Toll Free" value="<?php echo @$contact_phone2; ?>">
        </div> -->
          <!-- <div class="form-group">
        <label for="exampleInputEmail1"><i class="fa fa-map-signs" aria-hidden="true"></i> Address</label>
        <textarea class="ckeditor" name="contact_addr" placeholder="Address"><?php echo @$contact_addr ?></textarea>
        </div> -->
        
       
        
        <div class="row">
        <div class="col-md-12">
        <div class="cont">
        <div class="form-group">
        <label for="exampleInputEmail1"><i class="fa fa-map-signs" aria-hidden="true"></i> Address</label>
    
        </div>
        </div>
         <div class="editor">
        <textarea class="ckeditor" name="contact_content" placeholder="Address"><?php echo @$contact_content ?></textarea>
        </div>
          </div>
        <div class="col-md-12">
        <!-- <div class="row">
        <div class="col-md-6">
        <div class="form-group">
        <label for="exampleInputEmail1"><i class="fa fa-map-marker" aria-hidden="true"></i> Latitude</label>
        <input type="text" name="map_latitude" class="form-control" id="map_latitude" placeholder="Latitude" value="<?php echo @$map_latitude ?>">
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
        <label for="exampleInputEmail1"><i class="fa fa-map-marker" aria-hidden="true"></i> Longitude</label>
        <input type="text" name="map_longitude" class="form-control" id="map_longitude" placeholder="Longitude" value="<?php echo @$map_longitude ?>">
        </div>
        </div>
        
        </div> -->
        
        
        <!--<div class="meta">
   <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo"><i class="fa fa-comment"></i> Meta Tags</button>
  <div id="demo" class="collapse">
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">Keyword</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">Description</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
        </div>
        
        <div class="form-group">
        <label for="exampleInputEmail1">Canonical Link</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">H1 Tag</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
        </div>
  </div>
  </div>-->
        
        <div class="ui_button">
        <button type="submit" name="contact_submit" class="btn btn-default hi-icon hi-icon-images"><i class="fa fa-paper-plane-o"></i> Submit</button>
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
if(isset($_POST['contact_submit']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$admin_id=test_input($_SESSION['admin_id']);
	$contact_name=test_input($_POST['contact_name']);
	$contact_email=test_input($_POST['contact_email']);
	$contact_email1=test_input($_POST['contact_email1']);
	$contact_phone=test_input($_POST['contact_phone']);
  /*$contact_phone1=test_input($_POST['contact_phone1']);
  $contact_phone2=test_input($_POST['contact_phone2']);*/
	$contact_addr=test_input($_POST['contact_addr']);
	$contact_content=test_input($_POST['contact_content']);
	$map_longitude=test_input($_POST['map_longitude']);
	$map_latitude=test_input($_POST['map_latitude']);
	$ip = getClientIP();
	
	$insert = mysqli_query($conn,"SELECT * FROM ".$contact_details." WHERE admin_id=$admin_id");
	$row = mysqli_num_rows($insert);
	
	if($row==0)
	{
		
		$insert = mysqli_query($conn,"INSERT into ".$contact_details."(admin_id,contact_name,contact_email,contact_email1,contact_phone,contact_addr,contact_content,map_longitude,map_latitude,contact_det_insert_date,contact_det_ip) VALUES('".$admin_id."','".$contact_name."','".$contact_email."','".$contact_email1."','".$contact_phone."','".$contact_addr."','".$contact_content."','".$map_longitude."','".$map_latitude."', now() ,'".$ip."')");
		
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
			$update = mysqli_query($conn,"UPDATE ".$contact_details." SET contact_name='".$contact_name."', contact_email='".$contact_email."', contact_email1='".$contact_email1."', contact_phone='".$contact_phone."', contact_addr='".$contact_addr."', contact_content='".$contact_content."', map_longitude='".$map_longitude."', map_latitude='".$map_latitude."', contact_det_update_date=now() , contact_det_ip='".$ip."' WHERE contact_id='".$loop['contact_id']."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
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