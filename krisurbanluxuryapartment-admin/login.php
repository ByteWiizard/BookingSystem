<?php session_start(); ?>
<?php include_once('include/functions.php'); ?>
<?php 
	include_once("include/db.php"); 
	$login_details = $pre_fix."login_details";
	$alternate_details = $pre_fix."alternate_details";
	$profile_details = $pre_fix."profile_details";
?>
<?php
		if(isset($_POST['login_submit'])){
			$username = mysqli_real_escape_string($conn, $_POST['user_name']);
			$user_pass = mysqli_real_escape_string($conn, md5($_POST['user_pass']));
			$user_ip = mysqli_real_escape_string($conn, $_POST['user_ip']);
			//echo $query = "select * from ".$login_details." where user_name='".$username."' && user_pass='".$user_pass."'";
			$insert = mysqli_query($conn,"SELECT * FROM ".$login_details." WHERE user_name='".$username."' && user_pass='".$user_pass."'");

			$row = mysqli_num_rows($insert);
			$row1 = mysqli_fetch_row($insert);
			if($row!=0){
				$_SESSION['admin_id']=$row1[0];
			?>
			<script>
				window.location="index.php";
			</script>
			<?php
			}else{
			?>
			<script>
				alert("Username and Password not matched,Try again.");
			</script>
			<?php
			}
		}
		?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login</title>
		<link href="framework/css/import.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body id="login">
		<div class="login_form wow zoomInDown" style="margin-top: 11em;">
			<h2><?php echo @$website_name;?></h2>
			<div class="form ">
				<!-- <div class="thumbnail">
					<?php if(@$profile_img==""){ ?>
						<img src="framework/img/user2-160x160.jpg" alt=""/>
					<?php }else{ ?>
						<img src="../uploads/profile/<?php echo @$profile_img ?>">
					<?php } ?>
				</div> -->
				<form class="login-form" name="login" method="post" action="">
					<input type="text" name="user_name" placeholder="username"/>
					<input type="password" name="user_pass" placeholder="password"/>
					<input type="hidden" name="user_ip" value="<?php echo getClientIP() ;?>"/>
					<button type="submit" name="login_submit">login</button>
				</form>
			</div>
		</div>
		<script src="framework/js/ajax.js"></script>
		<script src="framework/js/bootstrap.min.js"></script>
		<script src="framework/js/wow.js"></script>
		<script>
			new WOW().init();
		</script>
		
	</body>
</html>