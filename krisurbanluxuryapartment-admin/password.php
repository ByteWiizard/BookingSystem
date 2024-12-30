<?php include_once('session_destroy.php') ;?>
<?php 
  include("include/db.php"); 
  $profile_details = $pre_fix."profile_details";
  $login_details = $pre_fix."login_details";
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
$(document).ready(function(e) {
    $('#submit_id').click(function(){
		var pass = $('#new_pass').val();
		var conf_pass = $('#confirm_pass').val();
		if(pass != conf_pass){
		     alert('Both passwords are not matched,Try a similar passwords...');
			return false;
		}
	});
    });
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">

  <?php include_once('include/functions.php');?>
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
  $fetch1 = mysqli_query($conn,"SELECT user_name,user_pass FROM ".$login_details." WHERE admin_id='".$admin_id."'");
	$num1 = mysqli_num_rows($fetch1);
  while($show1 = mysqli_fetch_assoc($fetch1))
  {
	$user_name = $show1['user_name'];
	$user_back_pass = $show1['user_pass'];
  }
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Login Details <small>Update login details easily</small> </h1>
      <hr>
      <form method="post" action="" enctype="multipart/form-data">
     <div class="row">
     <div class="col-md-3 col-md-offset-4">
     <div class="image_holder">
      <?php if(@$profile_img==""){ ?>
     <img src="framework/img/user2-160x160.jpg">
     <?php }else{ ?>
      <img src="<?php echo @$profile_img ?>">
     <?php } ?>
     <div class="form-group">
    	<h4><?php echo @$profile_name ;?></h4>
  </div>
     </div>
     </div>
       </div> 
        
        <div class="col-md-6">
        <div class="form-group">
        <label for="exampleInputEmail1">User Name</label>
        <input type="text" name="user_name"  class="form-control" id="user_name" placeholder="User Name" value="<?php echo @$user_name ?>">
        </div>
        </div>
        
        <div class="col-md-6">
        <div class="form-group">
        <label for="exampleInputEmail1">New Password </label>
        <input type="password" name="new_pass"  class="form-control" id="new_pass" placeholder="New Password">
        </div>
        </div>
        
        <div class="col-md-6">
        <div class="form-group">
        <label for="exampleInputEmail1">Confirm Password </label>
        <input type="password" name="confirm_pass" class="form-control" id="confirm_pass" placeholder="Confirm Password">
        </div>
        </div>
       
        <p>
        <div class="ui_button">
        <button type="submit" name="profile_submit" id="submit_id" class="btn btn-default"><i class="fa fa-paper-plane-o"></i>Submit</button>
        </div>
       </p>
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
if(isset($_POST['profile_submit'])){
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$admin_id=test_input($_SESSION['admin_id']);
	$user_name=test_input($_POST['user_name']);
	$new_pass1=test_input($_POST['new_pass']);
	$new_pass = md5($new_pass1);
	$insert = mysqli_query($conn,"SELECT * FROM ".$login_details." WHERE admin_id=$admin_id");
	$row = mysqli_num_rows($insert);
	$emp = "";
	echo $user_back_pass;
	if($new_pass == md5($emp))
	{
		$new_pass = $user_back_pass;
	}
	
	if($row>0){
		while($loop = mysqli_fetch_assoc($insert))
		{
			$update = mysqli_query($conn,"UPDATE ".$login_details." SET user_name='".$user_name."', user_pass='".$new_pass."' WHERE admin_id='".$admin_id."'") or (die(mysqli_error($conn)));
		}
		if($update){
			echo "<script>alert('Password Changed Successfully.');</script>";
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
?>