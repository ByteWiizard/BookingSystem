<?php include_once('session_destroy.php') ;
error_reporting(0);
?>
<?php 
	include_once('include/db.php');
	$area_info = $pre_fix."area_info";
?>
<?php include_once('include/functions.php');?>
<?php
	if(isset($_POST['home_details_submit']))
	{
		//echo "bfsdf";die();
		$admin_id = $_SESSION['admin_id'];
	 
	    	function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			$c_name=$_POST['c_name'];
	$heading=base64_encode($_POST['heading']);
	$content = htmlentities($_POST['c_review']);
	$sub_title = $_POST['c_name'];
	$icons = $_POST['c_place'];
	$loc_id = $_POST['location'];
	$c_place=test_input($_POST['c_place']);
	$pro_id=test_input($_POST['pro_id']);
	

			$name=$_FILES['image']['name'];
			$type=$_FILES['image']['type'];
			$size=$_FILES['image']['size'];
			$tmp=$_FILES['image']['tmp_name'];
			$ip = getClientIP();

			$folder_path = '../uploads/areainfo';
	                $targetDir = '../uploads/areainfo/';
			$dotcount = substr_count($name, '.');
			if (!file_exists($folder_path)) {
				mkdir($folder_path, 0777, true);
			}


			if($heading){
				if($dotcount>1){
					echo"<script>alert('File Not Supportable')</script>";
					?>
					<script>
					window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
			        </script>
			        <?php
				}else{
					if(($_FILES["image"]["type"] == "image/gif") || 
					($_FILES["image"]["type"] == "image/jpeg") || 
					($_FILES["image"]["type"] == "image/png") || 
					($_FILES["image"]["type"] == "image/pjpeg") ||
					($name == "")
					){
						if($name==""){
							$img_name = $_POST['profile_image'];
						}else{

							$upload_image = $_FILES["image"]["name"];
							$folder = $targetDir;
							move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
							$file = $targetDir.$_FILES["image"]["name"];
							$uploadimage = $folder.$_FILES["image"]["name"];
							$newname = $_FILES["image"]["name"];
							// Set the resize_image name
							$resize_image = $folder.$newname; 
							$actual_image = $folder.$newname;
							

							//$img_name = $resize_image;
							$insert = mysqli_query($conn,"INSERT into ".$area_info."(admin_id,loc_id,img,heading,content,sub_title,icons,added_date) VALUES('".$admin_id."','".$loc_id."','".$resize_image."','".$heading."', '".$content."', '".$sub_title."', '".$icons."', now())");
						if($insert==true){
							echo "<script>alert('Inserted Successfully.');</script>";
						?>
							<script>
								window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
							</script>
						<?php
						}
						}
						
						
					}
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
	<script>
	$(document).ready(function(e) {
		var a = "<?php echo $about_id; ?>";
		if(a!=""){
			$('#add_rev').show();
		}else{
			$('#add_rev').hide();
		}
	    $('#add_areview').click(function(){
			var but = $('#add_areview').val();
				$('#add_rev').toggle(function(){
				if(but== 'Add Area Attractions' ){
					$('#add_areview').val('Close X');
				}else{
					$('#add_areview').val('Add Area Attractions');
					$('#add_rev').hide();
				}
			});
			return false;
		});
	});
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
		<section class="content-header">
			<h1>Area Attractions<small>Add Area Attractions From Here</small> </h1>
			<hr>
			<input type="button" class="btn btn-success green" id="add_areview" value="Add Area Attractions" style="margin:10px;"/>
			<div id="add_rev">
				<form method="post" action="" id="review_form" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-3">
							<div class="image_holder">
								<img src="../img/default.jpg">
								<div class="form-group">
									<input type="file" name="image" id="about_profile_img">
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="exampleInputEmail1">Title </label>
						<input type="text" name="heading" class="form-control" id="home_heading" placeholder="Title"/>
					</div>
                    
                    <div class="form-group">
						<label for="exampleInputEmail1">Link </label>
						<input type="text" name="c_name" class="form-control" id="home_heading" placeholder="Link"/>
					</div>
                    
					<?php /*?><div class="form-group">
						<label for="exampleInputEmail1">Category</label>
						<select  name="location" class="form-control">
							<option value="" style="display:none;">Select</option>
							<option value="1" <?php echo $loc_id==1?'Selected':''?>>Providenciales</option>
							<option value="2" <?php echo $loc_id==2?'Selected':''?>>Middle Caicos</option>
							<option value="3" <?php echo $loc_id==3?'Selected':''?>>North Caicos</option>
						</select>
					</div><?php */?>
					<div class="editor">
						<label for="exampleInputEmail1">Content</label>
						<textarea class="ckeditor" name="c_review" id="noticeMessage" placeholder="Content"></textarea>
					</div>
					
					
					<div style="clear:both"></div>
					<p class="text-center">
					<button type="submit" name="home_details_submit" class="btn btn-success btn-outline-rounded green"> Submit <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
					</p>
				</form>
			</div>
		</section>
 
<?php
$admin_id = $_SESSION['admin_id'];
$per_page= 5; // number of user to show
$page_query=mysqli_query($conn,"SELECT id FROM ".$area_info." WHERE admin_id='".$admin_id."'");
$pages=ceil(mysqli_num_rows($page_query) / $per_page); //total number of pages to show
$page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1; // current page list
$start= ($page - 1) * $per_page; //start list of user from zero becoz php starts from zero
  $fetch11 = mysqli_query($conn,"SELECT * FROM ".$area_info." WHERE admin_id='".$admin_id."'  ORDER BY id DESC LIMIT $start, $per_page");
	   $num11 = mysqli_num_rows($fetch11);
	   $num11 = mysqli_num_rows($fetch11);
	   if($num11>0)
	   {
	?>
        <h3 class="head text-center">Area Attractions List Section</h3>
        <table class="responsive-table">
          <thead>
            <tr>
              <th scope="col">S.No.  </th>
              <th scope="col"> Heading </th>
              <!--<th scope="col"> Category</th>-->
			 <th scope="col">Edit</th>
             <th scope="col">Delete</th>
             
            </tr>
          </thead>
          <tbody>
            <?php
                $i = 1 ;
			while($show11 = mysqli_fetch_assoc($fetch11))
			{
				$c_head=base64_decode($show11['heading']);
				$c_id=base64_decode($show11['loc_id']);
				$c_review=html_entity_decode($show11['content']);
				$c_rev=substr($c_review,0,150);
	?>
			<tr>
				<td scope="row"><?php echo ++$start ;?></td>
				<td data-title="Start Date"><?php echo $c_head; ?></td>
				<!--<td data-title="Start Date"><?php echo $c_id; ?></td>-->

				<form method="post" action="edit_info.php">
				<td data-title="Edit" >
				<input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id'] ;?>" >
				<input type="hidden" name="edit_review_id" value="<?php echo $show11['id']; ?>">
				<button type="submit" name="edit_review_button"><i class="fa fa-pencil"></i></button>
				</td>
				</form>
				<form action="" method="post">
				<td data-title="Delete" ><input type="hidden" name="delete_rate" value="<?php echo $show11['id']; ?>">
				<button type="submit" name="delete_rate_button" onClick="return check()"><i class="fa fa-trash"></i></button></td>
				</form>
			</tr>
          <?php
             }
	   
          ?>
            </tbody>
          
        </table>
        
        <div style="text-align:center">
<nav aria-label="Page navigation">
  <ul class="pagination">
<?php
/* ----------------- Pages Links -------------- */
$prev=$page - 1;
$next=$page + 1;
if(!($page<=1))
echo  "<li><a href='?page=$prev' aria-label='Previous'> <span aria-hidden='true'>&laquo;</span> </a> </li>";
if($pages>=1)
{
	for($x=1;$x<=$pages;$x++){
	echo ($x==$page) ? '<li class="active"><a href="?page='.$x.'">'.$x.'</a></li>' : '<li><a href="?page='.$x.'">'.$x.'</a></li>' ;
	}
	
}
if(!($page>=$pages))
{
echo "<li> <a href='?page=$next' aria-label='Next'> <span aria-hidden='true'>&raquo;</span> </a> </li>";
}
/*-------------------------------------------------*/
?>
</ul>
</nav>
</div>

<?php
}
?>
 </div>
</div>
<?php 
   if(isset($_POST['delete_rate_button']))
{
	$delete_id = $_POST['delete_rate'];
	
	$dt = mysqli_query($conn, "SELECT img FROM ".$area_info." WHERE id='".$delete_id."'");
	$dell = mysqli_fetch_assoc($dt);
	$del_file = $dell['img'];
	echo $qry="DELETE FROM ".$area_info." WHERE id=$delete_id";
	$delete = mysqli_query($conn,$qry);
	if($delete)
		{
			$FileName = '../uploads/areainfo/'.$del_file;
			@chown($FileName,465); //Insert an Invalid UserId to set to Nobody Owner; for instance 465
			@unlink($FileName);
			echo "<script>alert('Deleted Successfully.');</script>";
			echo "<script>window.location = 'area_information.php'</script>";
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
<script type="text/javascript"> 
	$(document).ready( function() {
		$('#msgata').delay(1000).fadeOut();
	});
</script>
</body>
</html>
