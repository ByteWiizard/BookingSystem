<?php include_once('session_destroy.php') ;?>
<?php 
	include("include/db.php"); 
	$reviews_detail = $pre_fix."reviews_detail";
	error_reporting(0);
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
<?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<div class="wrapper">

<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
if(isset($_POST['edit_review_button']))
{
	$admin_id = $_POST['admin_id'];
	$r_id = $_POST['edit_review_id'];
	$pro_id = $_POST['review_pro_id'];
  $fetch = mysqli_query($conn,"SELECT * FROM ".$reviews_detail." WHERE property_id='".$pro_id."' AND admin_id='".$admin_id."' AND id='".$r_id."'");
	$num = @mysqli_num_rows($fetch);
  while($show = @mysqli_fetch_assoc($fetch))
  {
	  $c_name=$show['c_name'];
	$r_img=$show['img'];
            $r_heading=$show['heading'];
			$r_content=$show['c_review'];
			$r_place = $show['c_place'];
$r_submit = $show['sdate'];
$r_stayed= $show['edate'];
  }
  
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Customer Reviews <small>Update your reviews Easily</small> </h1>
      <hr>
      <form method="post" action="" enctype="multipart/form-data">
     <div class="row">
     <div class="col-md-3 col-md-offset-4">
     <div class="image_holder">
      <?php if(@$r_img==""){ ?>
     <img src="framework/img/avatar.png">
     <?php }else{ ?>
      <img src="../uploads/review/<?php echo @$pro_id.'/'.@$r_img ?>">
     <?php } ?>
     <div class="form-group">
    <input type="file" name="image" id="profile_image">
  </div>
     </div>
     </div>
       </div> 
        
        <div class="form-group">
          <label for="exampleInputEmail1">Customer Name </label>
          <input type="text" name="c_name" class="form-control" id="cust_name" placeholder="Customer Name" value="<?php echo html_entity_decode($c_name) ;?>"/>
          <div id="#error_firstname"></div>
        </div>
   		<div class="form-group">
          <label for="exampleInputEmail1">Heading </label>
          <input type="text" name="c_heading" class="form-control" id="home_heading" placeholder="Review Heading" value="<?php echo html_entity_decode($r_heading) ;?>"/>
        </div>
        <div class="editor">
          <label for="exampleInputEmail1">Customer Review</label>
          <textarea class="ckeditor" name="c_review" id="noticeMessage" ><?php echo html_entity_decode($r_content) ;?></textarea>
        </div>
	 <div class="col-md-6 form-group">
          <label for="exampleInputEmail1">Submit date </label>
          <input type="text" name="submit" class="form-control" id="home_heading" value="<?php echo $r_submit;?>" placeholder="Customer Submit"/>
        </div>
 
        <div class="col-md-6 form-group">
          <label for="exampleInputEmail1">Stay date</label>
          <input type="text" name="stayed" class="form-control" id="home_heading" value="<?php echo $r_stayed ;?>" placeholder="Customer Stayed"/>
        </div>	 

		 <!-- <div class="form-group">
          <label for="exampleInputEmail1">Customer Place </label>
          <input type="text" name="c_place" class="form-control" id="home_heading" placeholder="Customer Place"  value="<?php echo html_entity_decode($r_place) ;?>"/>
        </div> -->
         <input type="hidden" name="admin_id" value="<?php echo $admin_id;?>" />
            <input type="hidden" name="ip" value="<?php echo getClientIP();?>" />
           <input type="hidden" name="pro_id" value="<?php echo @$pro_id ;?>" >
           <input type="hidden" name="r_id" value="<?php echo @$r_id ;?>" >
         
<div style="clear:both"></div>
         <p class="text-center">
          <button type="submit" name="home_details_submit" class="btn btn-success btn-outline-rounded green"> Submit <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
      </form>
      
    </section>
  </div>
  <?php } ?>
</div>
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script>
</body>
</html>
<?php
if(isset($_POST['home_details_submit']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$ip = $_POST['ip'];
	$admin_id=$_POST['admin_id'];
	$id=test_input($_POST['r_id']);
	$r_heading=mysqli_escape_string($conn,$_POST['c_heading']);
	$r_content=mysqli_escape_string($conn,$_POST['c_review']);
	$r_cname = mysqli_escape_string($conn,$_POST['c_name']);
        $submit =$_POST['submit'];
        $stayed =$_POST['stayed'];
	$r_place=test_input($_POST['c_place']);
	$pro_id=test_input($_POST['pro_id']);
	$name=$_FILES['image']['name'];
	$type=$_FILES['image']['type'];
	$size=$_FILES['image']['size'];
	$tmp=$_FILES['image']['tmp_name'];
	$folder_path = '../uploads/review/'.$pro_id;
	$targetDir = '../uploads/review/'.$pro_id.'/';
	if (!file_exists($folder_path)) {
    mkdir($folder_path, 0777, true);
	}
	
	$insert = mysqli_query($conn,"SELECT * FROM ".$reviews_detail." WHERE id='".$id."' AND property_id='".$pro_id."' AND admin_id='".$admin_id."'");
	$row = mysqli_num_rows($insert);
	if($row>0)
	{
if(($_FILES["image"]["type"] == "image/gif") || 
			($_FILES["image"]["type"] == "image/jpeg") || 
			($_FILES["image"]["type"] == "image/png") || 
			($_FILES["image"]["type"] == "image/pjpeg") ||
			($name == "")
			) 
			
			{
function compress_image($source_url, $destination_url, $quality) {
		$info = @getimagesize($source_url);
    		if ($info['mime'] == 'image/jpeg')
        			$image = imagecreatefromjpeg($source_url);
    		elseif ($info['mime'] == 'image/gif')
        			$image = imagecreatefromgif($source_url);
   		elseif ($info['mime'] == 'image/png')
        			$image = imagecreatefrompng($source_url);
    		@imagejpeg($image, $destination_url, $quality);
		return $destination_url;
	}
}
		while($loop = mysqli_fetch_assoc($insert))
		{
			$del_file = $loop['img'];
			if($name == "" )
			{
				$name = $loop['img'];
			}
			
			if($size<=4194304) // 4 Mb
			{
				$targetFile =  $targetDir.$name;
			$filenames = compress_image($_FILES["image"]["tmp_name"], $targetFile, 80);
			$compress_size = filesize($folder_path);
	
			$update = mysqli_query($conn,"UPDATE ".$reviews_detail." SET img='".$name."', heading='".$r_heading."', c_review='".$r_content."', c_name='".$r_cname."', c_place='".$r_place."',sdate='".$submit."',edate='".$stayed."', r_update_date=now(), r_ip='".$ip."' WHERE id='".$loop['id']."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
		}
		else
		{
		 echo "<script>alert('Size of image is greater than 4MB, Please insert image than 4 Mb.');</script>";
			?>
			<script>
			window.location = 'review.php';
            </script>
            <?php
		}
	}
		if($update)
		{
			//move_uploaded_file($tmp,"../uploads/review/$pro_id/$name");
			$FileName = '../uploads/review/'.$pro_id.'/'.$del_file;
			@chown($FileName,465); //Insert an Invalid UserId to set to Nobody Owner; for instance 465
			if($name != $del_file)
			{
			@unlink($FileName);
			}
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
<?php
if(!isset($_POST['edit_review_button']))
{
$server = 'review.php';
?>
<script>
window.location ='<?php echo $server ;?>' ;
</script>
<?php
}
?>