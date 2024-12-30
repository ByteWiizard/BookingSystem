<?php include_once('session_destroy.php') ;
error_reporting(0);
?>
<?php 
	include_once('include/db.php');
	$tpl_location = $pre_fix."tpl_location";
?>
<?php include_once('include/functions.php');?>
<?php
if(isset($_POST['home_details_submit']))
{
	//print_r($_POST); die;
	$admin_id = $_SESSION['admin_id'];
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$img_name=$_FILES['image']['name'];
	$type=$_FILES['image']['type'];
	$size=$_FILES['image']['size'];
	$tmp=$_FILES['image']['tmp_name'];
	$c_name=$_POST['c_name'];
	$meta_title = $_POST['meta_title'];
	$meta_key= $_POST['meta_key'];
	$meta_desc = $_POST['meta_desc'];
	$canonical_url = $_POST['canonical_url'];

	$loc_title		=	base64_encode($_POST['loc_title']);
	$loc_content	=	$_POST['loc_content'];
	$loc_address	=	test_input($_POST['loc_address']);

	$folder_path = '../uploads/location';
	$targetDir = '../uploads/location/';
	if (!file_exists($folder_path)) {
    	mkdir($folder_path, 0777, true);
	}
	
	 
	if(($_FILES["image"]["type"] == "image/gif") || 
	($_FILES["image"]["type"] == "image/jpeg") || 
	($_FILES["image"]["type"] == "image/png") || 
	($_FILES["image"]["type"] == "image/pjpeg") ||
	($img_name == "")
	){
				
		function compress_image($source_url, $destination_url, $quality) {
				$info = getimagesize($source_url);
			if ($info['mime'] == 'image/jpeg')
				$image = imagecreatefromjpeg($source_url);
			elseif ($info['mime'] == 'image/gif')
				$image = imagecreatefromgif($source_url);
			elseif ($info['mime'] == 'image/png')
				$image = imagecreatefrompng($source_url);
				imagejpeg($image, $destination_url, $quality);
			return $destination_url;
		}
		if($size<=4194304) // 4 Mb
		{
			$targetFile =  $targetDir.$img_name;
			$filenames = compress_image($_FILES["image"]["tmp_name"], $targetFile, 80);
			$compress_size = filesize($folder_path);
			
			$insert = mysqli_query($conn,"INSERT into ".$tpl_location."(admin_id,loc_title,loc_img,loc_content,loc_address,create_date) VALUES('".$admin_id."','".$loc_title."','".$img_name."','".$loc_content."','".$loc_address."', now())");
				
		}
	}else{
	  	echo "<script>alert('Size of image is greater than 4MB, Please insert image than 4 Mb.');</script>";
	?>
		<script>
			window.location = 'location.php';
	    </script>
    <?php
  	}
	if($insert){
		echo "<script>alert('About content added Successfully.');</script>";
	?>
		<script>
			window.location = 'location.php';
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
		
 
<?php
$admin_id = $_SESSION['admin_id'];
$per_page= 5; // number of user to show
$page_query=mysqli_query($conn,"SELECT loc_id FROM ".$tpl_location." WHERE admin_id='".$admin_id."'");
$pages=ceil(mysqli_num_rows($page_query) / $per_page); //total number of pages to show
$page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1; // current page list
$start= ($page - 1) * $per_page; //start list of user from zero becoz php starts from zero
  $fetch11 = mysqli_query($conn,"SELECT * FROM ".$tpl_location." WHERE admin_id='".$admin_id."'  ORDER BY loc_id DESC LIMIT $start, $per_page");
	   $num11 = mysqli_num_rows($fetch11);
	   if($num11>0)
	   {
	?>
        <h3 class="head text-center">Activity Content</h3>
        <table class="responsive-table">
          <thead>
            <tr>
              <th scope="col">S.No.  </th>
              <th scope="col">Activity Title </th>
              <th scope="col">Activity Content </th>
			 <th scope="col">Edit</th>
             
            </tr>
          </thead>
          <tbody>
            <?php
                $i = 1 ;
			while($show11 = mysqli_fetch_assoc($fetch11))
			{
				$c_head=base64_decode($show11['loc_title']);
				$c_review=html_entity_decode($show11['loc_content']);
				$c_rev=substr($c_review,0,150);
	?>
			<tr>
				<td scope="row"><?php echo ++$start ;?></td>
				<td data-title="Start Date"><?php echo $c_head; ?></td>
				<td data-title="Start Date"><?php echo $c_rev?html_entity_decode($c_rev)."...":''; ?></td>
				
				<form method="post" action="edit_loc.php">
				<td data-title="Edit" >
				<input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id'] ;?>" >
				<input type="hidden" name="edit_loc_id" value="<?php echo $show11['loc_id']; ?>">
				<button type="submit" name="edit_review_button"><i class="fa fa-pencil"></i></button>
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
	
	$dt = mysqli_query($conn, "SELECT img FROM ".$tpl_location." WHERE id='".$delete_id."'");
	$dell = mysqli_fetch_assoc($dt);
	$del_file = $dell['img'];
	$delete = mysqli_query($conn, "DELETE FROM ".$tpl_location." WHERE loc_id=$delete_id");
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

</body>
</html>
