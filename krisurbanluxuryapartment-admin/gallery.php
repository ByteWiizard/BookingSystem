<?php include_once('session_destroy.php') ;?>
<?php 
	include_once('include/db.php'); 
	$gallery = $pre_fix."gallery";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="framework/js/ajax.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>
<link href="framework/css/import.css" rel="stylesheet">
<link href="framework/css/animation.css" rel="stylesheet">
<link href="framework/css/timepicki.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet">
<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script>
$(document).ready(function(e) {
    $('.del').click(function(){
		var del = $(this).val();
		var img_id = del;
var ret= confirm(" Do you want to delete? ");
if(ret==true)
{
		$.ajax({
				url: "delete_gallery.php",
				type: "POST",
				cache: false,
				data: { 'dele_gallery': del}
				})
		.done(function(msg){
			$('#menu-order-'+img_id+'').fadeOut( "slow", function() {
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  <script>
  $(function() {
		  $( "#sortable" ).sortable({
    update: function( event, ui ) {
		var sorted = $( "#sortable" ).sortable( "serialize" );
        $.post( "ajax/save_order_gallery.php",{ 'choices': sorted} ,function( data ) {
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
			$('#form_mul_del :checked').each(function(i){
				id[i] = $(this).val();
			});
			if(id.length===0)
			{
				alert('Please select atleast one checkbox');
			}
			else
			{
				$.ajax({
				url: "delete_home_gallery.php",
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
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<div class="content-wrapper">
<section class="content-header">
<section  class="section how-it-works" id="how-it-works">
<div class="row">
  <div class="col-md-12 board">
 <style>
  .dz-max-files-reached {background-color: red};
</style>
      <div class="tab-pane" id="uidesign">
<?php
$file_query = mysqli_query($conn,"SELECT count(image_id) as c_no,sum(file_size) as file FROM ".$gallery." WHERE admin_id='".$admin_id."'");
$run = mysqli_fetch_assoc($file_query);
$file_size = $run['file'];
$file_count = $run['c_no'];
if($file_count<8)
{
if($file_size<20971520)//less than 20 MB
{
?>
        <h3 class="head text-center">Home Page Banner</h3>
        	
            <div class="heading"><h1>Drag&amp;Drop Multiple Files Upload</h1></div>
<div class="image_upload_div">
	<form action="gallery_upload.php" method="post" class="dropzone" id="HomeSlideGallery">
    </form>
</div>
<?php 
}
else
{
	echo "<p class='faa-flash animated rishi'>Your Image Quota for a property is exceeded over 20 Mb.For uploading more images,please delete some images first.</p>";
}
}
else
{
	echo "<p class='faa-flash animated rishi'>Maximum number of images for a property is 8.For uploading more images,please delete some images first.</p>";
}
 ?>
<div class="buttonContainer">
<p>Click to Refresh Gallery Button after uploading images
<a href="gallery.php" class="btn btn-success btn-outline-rounded green" onClick="return gallery()">Refresh Gallery</a></p>
</div>
<div style="clear:both;"></div>
<form name="k" id="form_mul_del" method="post" action="">
<input type="button" name="del_mul_img" id="del_mul_img" class="btn btn-success btn-outline-rounded green" value="Delete Selected Images" />
<button type="submit" class="btn btn-success btn-outline-rounded green" id="add_caption" name="image_caption"/>Update Caption</button>
<ul class="img_ul" id="sortable">
<?php
$admin_id = $_SESSION['admin_id'];
$fetch = mysqli_query($conn,"SELECT * FROM ".$gallery." WHERE admin_id='".$admin_id."' ORDER BY menu_order ASC");
@$count = mysqli_num_rows($fetch);
while(@$row = mysqli_fetch_assoc($fetch))
{
	?>
    <li class="img_li" id="menu-order-<?php echo $row['image_id'] ?>"><img src="../uploads/gallery/<?php echo $row['file_name']; ?>" /><div class="img_dt"><input type="text" name="img_<?php echo $row['image_id'] ?>" placeholder="" value="<?php echo @$row['caption'] ;?>" /><div class="deleteCheck_box"><input type="checkbox" name="del_immg[]" class="del_imgg" id="del_imgg" value="<?php echo $row['image_id'];?>" /></div><button class="del" type="submit" value="<?php echo $row['image_id'] ?>">Delete</button></div>
    </li>
	<?php
	
}
?>
</ul>
 </form>
<div class="success-msg"></div>
        
      </div>
      
      <div class="clearfix"></div>
    </div>
   
  
    </section>
  </div>
</div>
<?php
if(isset($_POST['image_caption']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$admin_id = $_SESSION['admin_id'] ;
	array_shift($_POST);
	foreach($_POST as $key=>$cap)
	{
		$cap_id= str_replace('img_','', $key);
		$update = mysqli_query($conn,"UPDATE ".$gallery." SET caption='".$cap."', updated_image_date=now() WHERE image_id='".$cap_id."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
	}
	if($update)
		{
			echo "<script>alert('Caption updated Successfully.');</script>";
			 echo "<script>window.location = 'gallery.php'</script>";
		}
		else
		{
			echo "<script>alert('Updatation Failed.');</script>";
		}
	
}
?>
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