<?php include_once('session_destroy.php') ;?>
<?php 
  include_once('include/db.php'); 
  $current_special = $pre_fix."current_special";
  $tbl_things_files = $pre_fix."tbl_things_files";
  $beach_place = $pre_fix."beach_place";
?>
<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="framework/js/ajax.js"></script>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>
<link href="framework/css/import.css" rel="stylesheet">
<link href="framework/css/timepicki.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet">
<link href="framework/css/animation.css" rel="stylesheet">
<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
  #mapCanvas {
    width: 700px;
    height: 300px;
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
<script>
$(document).ready(function(e) {
    $('.del').click(function(){
		var del = $(this).val();
		var img_id = del.split(",");
var ret= confirm(" Do you want to delete2? ");
if(ret==true)
{
		$.ajax({
				url: "delete_gallery.php",
				type: "POST",
				cache: false,
				data: { 'dele': del}
				})
		.done(function(msg){
			$('#menu-order-'+img_id[0]+'').fadeOut( "slow", function() {
				alert(msg);
  			});
		});
		return false;
}
else
{
	return false ;
}
	});
})
</script>
<script>
function check()
{
var retVal= confirm(" Do you want to delete1? ");
if(retVal==true)
{
	return true ;
}
else
{
	return false ;
}
}
</script>
<script type="text/javascript">
  $(document).ready(function(){
    var a = '<?php echo $_GET["data"]; ?>';
    var b  = $(".a").attr('id');
    //alert(b);
    if(a!=''){
      
      $('#'+a).removeClass( "fade" );
      $('#home').removeClass( "active" );
      $('#'+b).removeClass( "active" );
      $('#'+a).addClass( "active" );
      $('#'+a+'li').addClass( "active" );
      $("#"+a).show();
    }
  });
  
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  <script>
  $(function() {
		  $( "#sortable" ).sortable({
    update: function( event, ui ) {
		var sorted = $( "#sortable" ).sortable( "serialize" );
        $.post( "ajax/save_order1.php",{ 'choices': sorted} ,function( data ) {
  $( ".success-msg" ).html( data );
		});
   	 }
  });
	 });
</script>
<!-- Add Dropzone -->
<link rel="stylesheet" type="text/css" href="framework/css/dropzone.css" />
<script type="text/javascript" src="framework/js/dropzone.js"></script>
<script>
function gallery()
{
	alert('Gallery is refreshed now.');
}
</script>
<script>
$(document).ready(function() {
    $('#del_mul_img').click(function(){
		if(confirm("Are you sure you want to delete this?"))
		{
			var id = [];
			$(':checkbox:checked').each(function(i){
				id[i] = $(this).val();
			});
			if(id.length===0)
			{
				alert('Please select atleast one checkbox');
			}
			else
			{
				$.ajax({
				url: "delete_gallery1.php",
				type: "POST",
				cache: false,
				data: { 'dele_id': id},
				success: function(mes)
				{
					for(var i=0; i<id.length; i++)
					{
					$('#menu-order-'+id[i]+'').fadeOut("slow");
					}
					alert(mes);
				}
				});
				return false;
			}
		}
		else
		{
			return false;
		}
	});
})
</script>
<script>
function check()
{
var retVal= confirm(" Do you want to delete? ");
if(retVal==true)
{
	return true ;
}
else
{
	return false ;
}
}
</script>
<script>
$(document).ready(function(e) {
	$('#add_rev').hide();
    $('#add_areview').click(function(){
		var but = $('#add_areview').val();
			$('#add_rev').toggle(function(){
			if(but== 'Add Activities' )
				{
					$('#add_areview').val('Close X');
				}
			else
				{
					$('#add_areview').val('Add Activities');
					$('#add_rev').hide();
				}
		});
		return false;
		});

    $("#upload_gallery1").change(function(){
		var a = $(this).val();
		$("#upload_gallery").val(a);
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
if(isset($_POST['home_details_submit']))
{
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
	$things_category = $_POST['things_category'];
	$heading=base64_encode($_POST['heading']);
	$c_review=test_input($_POST['c_review']);
	$c_name = $_POST['c_name'];
	$c_place=test_input($_POST['c_place']);
	$pro_id=1;
	$folder_path = '../uploads/specials';
	$targetDir = '../uploads/specials/';
	$dotcount = substr_count($name, '.');
	if (!file_exists($folder_path)) {
    	mkdir($folder_path, 0777, true);
	}
	
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
		($img_name == "")
		){
			$upload_image = $_FILES["image"]["name"];
			$folder = $targetDir;
			move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
			$file = $targetDir.$_FILES["image"]["name"];
			$uploadimage = $folder.$_FILES["image"]["name"];
			$newname = $_FILES["image"]["name"];
			// Set the resize_image name
			$resize_image = $folder.$newname; 
			$actual_image = $folder.$newname;
			// It gets the size of the image
			list( $width,$height ) = getimagesize( $uploadimage );
			// It makes the new image width of 350
			$newwidth = 1800;
			// It makes the new image height of 350
			$newheight = 1238;
			// It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
			$thumb = imagecreatetruecolor( $newwidth, $newheight );
			$source = imagecreatefromjpeg( $resize_image );
			// Resize the $thumb image.
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagejpeg( $thumb, $resize_image, 80 );
			
			$insert = mysqli_query($conn,"INSERT into ".$current_special."(beach_id,img,heading,content,url,added_date) VALUES('".$things_category."','".$resize_image."','".$heading."','".$c_review."', '".$c_name."', now())");

			if($insert){
				echo "<script>alert('Inserted Successfully.');</script>";
			?>
				<script>
					window.location = 'things-to-do.php';
		        </script>
		    <?php
			}
		
	}else{
	  	echo "<script>alert('Size of image is greater than 4MB, Please insert image than 4 Mb.');</script>";
	?>
		<script>
			window.location = 'things-to-do.php';
	    </script>
    <?php
	  	}
	 }
  }
?>

<div class="content-wrapper">
<section class="content-header">

<section  class="section how-it-works" id="how-it-works">
<div class="row">
  <div class="col-md-12 board">
    
    <div class="tab-content">
      <div class="tab-pane fade in active" id="home">
			<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
			<?php
				$admin_id = $_SESSION['admin_id'];
			?>
			  
					<section class="content-header">
						<h1>Activities<small>Add Activities From Here</small> </h1>
						<hr>
						<input type="button" class="btn btn-success green" id="add_areview" value="Add Activities" style="margin:10px;"/>
						<div id="add_rev">
							<form method="post" action="" id="review_form" enctype="multipart/form-data">
								<!--<div class="row">
									<div class="col-md-3">
										<div class="image_holder">
											<img src="../img/default.jpg" style="width: 55%;border: 3px solid #ccc;margin-left: -113px;">
											<div class="form-group">
												<input type="file" name="image" id="about_profile_img">
											</div>
										</div>
									</div>
								</div>-->
								

								<div class="form-group">
									<label for="exampleInputEmail1">Title </label>
									<input type="text" name="heading" required="" class="form-control" id="home_heading" placeholder="Title"/>
								</div>
								
								<!-- <div class="editor">
									<label for="exampleInputEmail1">Content</label>
									<textarea class="ckeditor" required="" name="c_review" id="noticeMessage" ></textarea>
								</div> -->
								
							
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
			$page_query=mysqli_query($conn,"SELECT current_id FROM ".$current_special."");
			$pages=ceil(mysqli_num_rows($page_query) / $per_page); //total number of pages to show
			$page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1; // current page list
			$start= ($page - 1) * $per_page; //start list of user from zero becoz php starts from zero
			  $fetch11 = mysqli_query($conn,"SELECT * FROM ".$current_special." ORDER BY current_id DESC LIMIT $start, $per_page");
				   $num11 = mysqli_num_rows($fetch11);
				   if($num11>0)
				   {
				?>
			        <h3 class="head text-center">Activities List Section</h3>
			        <table class="responsive-table">
			          <thead>
			            <tr>
			              <th scope="col">S.No.  </th>
			              <th scope="col"> Title </th>
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
							$c_rev=substr($c_review,0,150);
				?>
						<tr>
							<td scope="row"><?php echo ++$start ;?></td>
							<td data-title="Start Date"><?php echo $c_head; ?></td>							
							<form method="post" action="edit_things.php?id=<?php echo $show11['current_id']; ?>">
							<td data-title="Edit" >
							<input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id'] ;?>" >
							<input type="hidden" name="edit_review_id" value="<?php echo $show11['current_id']; ?>">
							<button type="submit" name="edit_review_button"><i class="fa fa-plus"></i> <i class="fa fa-minus"></i></button>
							</td>
							</form>
							<form action="" method="post">
							<td data-title="Delete" ><input type="hidden" name="delete_rate" value="<?php echo $show11['current_id']; ?>">
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
      
     
 
    
      <div class="tab-pane fade" id="uidesign">
      <style>
  .dz-max-files-reached {background-color: red};
</style>
 <?php
    	if($_REQUEST['upload_gallery1']){
    		$_SESSION['uploadvale'] = $_POST['upload_gallery1'];
    	}
    ?> 
<?php
if($_SESSION['uploadvale']){
	$property_id = $_SESSION['uploadvale'];
}
?>
<?php
$file_query = mysqli_query($conn,"SELECT count(image_id) as c_no,sum(file_size) as file FROM ".$tbl_things_files." WHERE current_id='".$property_id."' AND admin_id='".$admin_id."'");
$run = mysqli_fetch_assoc($file_query);
$file_size = $run['file'];
$file_count = $run['c_no'];
if($file_count<=100)
{
if($file_size<52428800)//less than 50 MB
{
?>
 <h3 class="head text-center">Activities Gallery</h3>
   
	<div class="heading"><h1>Drag&amp;Drop Multiple Files Upload</h1>
	<form method="post" name="getid" action="things-to-do.php?data=uidesign">
		<select name="upload_gallery1" id="upload_gallery1" onchange='this.form.submit()'>
				<?php
					$QueryS = mysqli_query($conn, "select * from current_special");
					while($ResS = mysqli_fetch_assoc($QueryS)) :
				?>
				<option <?php if($_SESSION['uploadvale']==$ResS['current_id']){ echo "selected"; } ?> value="<?php echo $ResS['current_id'] ?>"><?php echo base64_decode($ResS['heading']); ?></option>
			<?php endwhile; ?>
			</select>
			<input type="hidden" name="">
		</div>
	</form>
	
	<div class="image_upload_div">
		<form action="upload_things_gallery.php" method="post" class="dropzone" id="my-awesome-dropzone">
			<input type="hidden" name="upload_gallery" id="upload_gallery" value="<?php echo $property_id; ?>" >
		</form>
	</div>
<?php 
}
else
{
	echo "<p class='faa-flash animated rishi'>Your Image Quota for a property is exceeded over 50 Mb.For uploading more images,please delete some images first.</p>";
}
}
else
{
	echo "<p class='faa-flash animated rishi'>Maximum number of images for a property is 40.For uploading more images,please delete some images first.</p>";
}
 ?>
<div class="buttonContainer">
<p>Click to Refresh Gallery Button after uploading images
<a href="things-to-do.php?data=uidesign" class="btn btn-success btn-outline-rounded green" onClick="return gallery()">Refresh Gallery</a></p>
</div>
<div style="clear:both;"></div>
<?php if($file_count>0){?>

<form name="k" method="post" action="">
<input type="button" name="del_mul_img" id="del_mul_img" class="btn btn-success btn-outline-rounded green" value="Delete Selected Images" />
<input type="hidden" name="property_id" value='<?php echo $property_id ;?>'>
<input type="hidden" name="admin_id" value="<?php echo $admin_id ;?>">
<button type="submit" class="btn btn-success btn-outline-rounded green" id="add_caption" name="image_caption"/>Update Caption</button>
<ul class="img_ul" id="sortable">
<?php
include_once("include/db.php");

$fetch = mysqli_query($conn,"SELECT * FROM ".$tbl_things_files." WHERE current_id='".$property_id."' AND admin_id='".$admin_id."' ORDER BY menu_order ASC");
@$count = mysqli_num_rows($fetch);
while(@$row = mysqli_fetch_assoc($fetch))
{
	?>
    <li class="img_li" id="menu-order-<?php echo $row['image_id'] ?>"><img src="../uploads/specials/<?php echo $property_id.'/'.$row['file_name'] ?>" /><div class="img_dt"><input type="text" name="img_<?php echo $row['image_id'] ?>" placeholder="Write Caption" value="<?php echo @$row['caption'] ;?>" /><div class="deleteCheck_box"><input type="checkbox" name="del_immg[]" class="del_imgg" id="del_imgg" value="<?php echo $row['image_id'].",".$property_id.",".$admin_id ;?>" /></div><button class="del" type="submit" value="<?php echo $row['image_id'] ?>,<?php echo $property_id ?>">Delete</button></div>
    </li>
	<?php
	
}
?>
</ul>
 </form>
<?php } ?>
<div class="success-msg"></div>
      </div>
      
      <div class="clearfix"></div>
    </div>
    
    </section>
  </div>
</div>
<script>
  $(document).ready(function(e) {
	$( "#pro_new_rate_sdate" ).datepicker();
	$( "#pro_new_rate_edate" ).datepicker();
	$( ".form-control" ).datepicker( "option", "dateFormat", 'yy-mm-dd' );
 })
</script>

<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script> 
<script src="framework/js/dropdown.js"></script> 
<script src="framework/js/select.js"></script> 
<script src="framework/js/timepicki.js"></script>
<!--<script src="framework/js/checkbox.js"></script>-->
<script >
        $(function () {
            $('#datetimepicker8, #datetimepicker9').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });
        });
    </script> 
<script type="text/javascript"> 
	$('#timepicker').timepicki(); 
	$('#timepicker1').timepicki(); 
	$('#timepicker3').timepicki(); 
	$('#timepicker4').timepicki(); 
</script>
<script>
			(function() {
				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
					new SelectFx(el);
				} );
			})();
			
        </script> 
</body>
</html>


<script>
$(document).ready(function(){
document.addEventListener("leftclick",handler,true);
function handler(e){
    e.stopPropagation();
    e.preventDefault();
}
})
</script>

<?php
if(isset($_POST['delete_rate_button']))
{
	$delete_id = $_POST['delete_rate'];
	$delete = mysqli_query($conn, "DELETE FROM lhk_current_special WHERE current_id=$delete_id");
	$delete = mysqli_query($conn, "DELETE FROM sub_activities WHERE aid=$delete_id");
	if($delete)
		{		
		echo "<script>alert('Deleted Successfully.');</script>";
			?>
				<script>
					window.location = 'things-to-do.php';
		        </script>
		    <?php
			}
			}
		?>


