<?php include_once('session_destroy.php') ;?>
<?php 
  include_once('include/db.php'); 
  $property_details = $pre_fix."property_details";
  $property_default_rates = $pre_fix."property_default_rates";
  $property_back_details = $pre_fix."property_back_details";
  $files = $pre_fix."files";
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

<script>
$(document).ready(function(e) {
    $('.del').click(function(){
		var del = $(this).val();
		var img_id = del.split(",");
var ret= confirm(" Do you want to delete? ");
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
        $.post( "ajax/save_order.php",{ 'choices': sorted} ,function( data ) {
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
				url: "delete_gallery.php",
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
<?php
$pro_fetch = mysqli_query($conn, "SELECT * FROM ".$property_details."");
$pro_row = mysqli_fetch_assoc($pro_fetch);
$property_id = $pro_row['property_id'];
?>
<?php
$property_id = @$property_id;
$admin_id = $_SESSION['admin_id'];
  $fetch = mysqli_query($conn,"SELECT * FROM ".$property_details." WHERE property_id='".$property_id."' AND admin_id='".$admin_id."'");
	$num = mysqli_num_rows($fetch);
  while($show = mysqli_fetch_assoc($fetch))
  {
	$pro_heading=$show['property_heading'];
	$pro_head_title=$show['property_head_title'];
	$pro_content=$show['property_content'];
	$pro_acc_type=$show['property_acc_type'];
	$pro_addr=$show['property_address'];
	$pro_latt=$show['property_latt'];
	$pro_long=$show['property_long'];
	$pro_status=$show['property_status'];
	$pro_type=$show['property_type'];
	$pro_no_of_bedrooms=$show['property_no_of_bedrooms'];
	$pro_no_of_sleeps=$show['property_no_of_sleeps'];
	$pro_no_of_baths=$show['property_no_of_baths'];
	$pro_on_floor=$show['property_floor'];
	$pro_feet=$show['property_feet'];
	$pro_garage=$show['property_garage'];
	$pro_elev=$show['property_elevator'];
	/*$pro_city=$show['property_city'];*/
  }
?>

<?php
$property_id = @$property_id;
  $fetch1 = mysqli_query($conn,"SELECT * FROM ".$property_default_rates." WHERE property_id='".$property_id."' AND admin_id='".$admin_id."'");
	$num1 = mysqli_num_rows($fetch1);
  while($show1 = mysqli_fetch_assoc($fetch1))
  {
	$pro_cur_rate=$show1['pro_def_rate_rates'];
	$pro_cur_rate_check_in=$show1['pro_def_rate_check_in'];
	$pro_cur_rate_check_out=$show1['pro_def_rate_check_out'];
	$pro_cur_rate_min_stay=$show1['pro_def_rate_min_stay'];
	$pro_cur_rate_currency=$show1['pro_def_rate_currency'];
	$pro_cur_rate_add_fees=$show1['add_fees'];
	$pro_cur_rate_can_policy=$show1['can_policy'];
	
  }
   
  
  $fetch12 = mysqli_query($conn,"SELECT * FROM ".$property_back_details." WHERE property_id='".$property_id."' AND admin_id='".$admin_id."'");
	$row12 = mysqli_num_rows($fetch12);
	 while($show12 = mysqli_fetch_assoc($fetch12))
	 {
		$pro_king_bed = $show12['pro_king_bed'];
		$pro_queen_bed = $show12['pro_queen_bed'];
		$pro_single_bed = $show12['pro_single_bed'];
		$pro_double_bed = $show12['pro_double_bed'];
		$pro_twin_bed = $show12['pro_twin_bed'];
		$pro_sofa_bed = $show12['pro_sofa_bed'];
		$pro_bunk_bed = $show12['pro_bunk_bed'];
		$pro_cribs = $show12['pro_cribs'];
		$pro_cot = $show12['pro_cot'];
	 }
?>

<div class="content-wrapper">
<section class="content-header">
<h1> Property Details <small>Update your Property Easily</small> </h1>
<hr>

<section  class="section how-it-works" id="how-it-works">
<div class="row">
  <div class="col-md-12 board">
    <div class="board-inner">
      <ul class="nav nav-tabs" id="myTab">
        <div class="liner"></div>
        <li class="active"> <a href="#home" aria-controls="home" role="tab" data-toggle="tab" title="About Property"> <span class="round-tabs one"><i class="fa fa-home" aria-hidden="true"></i> <span class="pun"> About Property</span> </span> </a></li>
        <li><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" title="Rates"> <span class="round-tabs two"><i class="fa fa-usd" aria-hidden="true"></i><span class="pun"> Rates </span></span> </a> </li>
        <li><a href="#prototyping" aria-controls="prototyping" role="tab" data-toggle="tab" title="Amenities"> <span class="round-tabs three"> <i class="fa fa-clipboard" aria-hidden="true"></i><span class="pun"> Amenities </span></span> </a> </li>
        <li><a href="#uidesign" aria-controls="uidesign" role="tab" data-toggle="tab" title="Gallery"> <span class="round-tabs four"> <i class="fa fa-picture-o" aria-hidden="true"></i> <span class="pun"> Gallery </span></span> </a></li>
        <li><a href="#doner" aria-controls="doner" role="tab" data-toggle="tab" title="calendar"> <span class="round-tabs five"> <i class="fa fa-calendar" aria-hidden="true"></i><span class="pun"> Calendar </span></span> </a> </li>
      </ul>
    </div>
    <div class="tab-content">
      <div class="tab-pane fade in active" id="home">
      <form class="ac-custom ac-checkbox ac-boxfill" method="post" action=""  enctype="multipart/form-data">
        <h3 class="head text-center">About Property</h3>
        <div class="form-group">
          <label for="exampleInputEmail1">Heading</label>
          <input type="text" name="property_heading" class="form-control" id="property_heading" placeholder="Heading" value="<?php echo @$pro_heading ;?>" />
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Heading Title</label>
          <input type="text" name="property_head_title" class="form-control" id="property_head_title" placeholder="Heading Title" value="<?php echo @$pro_head_title ;?>" />
        </div>
        <div class="editor">
          <label for="exampleInputEmail1">Content</label>
          <textarea class="ckeditor" name="property_content" id="property_content"><?php echo htmlspecialchars(@$pro_content) ;?></textarea>
        </div>
        <input type="hidden" name="property_id" value="<?php echo @$property_id ?>" />
         
        <p class="text-center">
          <button type="submit" name="property_details_submit" class="btn btn-success btn-outline-rounded green"> Submit <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
        </form>
      </div>
      <div class="tab-pane fade" id="profile">
        <h3 class="head text-center">Rates</h3>
        <div class="row">
          <div class="heading">
            <h3><i class="fa fa-home" aria-hidden="true"></i> Current Property Details</h3>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
          <!--<div class="col-md-4">
            <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Rates</label>
                <input type="text" class="form-control" name="pro_def_rate_rates" id="pro_def_rate_rates" placeholder="Rates" value="<?php echo @$pro_cur_rate ;?>">
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="check_in">
              <div class="form-group">
                <label for="exampleInputEmail1">Check In Time</label>
                <input class="form-control" name="pro_def_rate_check_in" id='timepicker' type='text' value="<?php echo @$pro_cur_rate_check_in ;?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="check_out">
              <div class="form-group">
                <label for="exampleInputEmail1">Check Out Time</label>
                <input class="form-control" name="pro_def_rate_check_out" id='timepicker1' type='text' value="<?php echo @$pro_cur_rate_check_out ;?>"/>
              </div>
            </div>
          </div>
           <input type="hidden" name="property_id" value="<?php echo @$property_id ?>" />
          <div class="col-md-4">
            <div class="prop_type">
              <section>
                <select name="pro_def_rate_min_stay" class="cs-select cs-skin-underline">
                  <?php
				$selected = @$pro_cur_rate_min_stay ;
				$options  = array('Per Night', 'Per Week', 'Per Month');
				if($selected==""){
              	echo "<option value='' disabled selected>Minimum Stay</option>";
				}
					echo "<option value=''>Minimum Stay</option>";
					foreach($options as $option){
						if($selected == $option){
							echo "<option selected='selected' value='$option'>$option</option>" ;
						}else{
							echo "<option value='$option'>$option</option>" ;
						}
					}
				?>
                </select>
              </section>
            </div>
          </div>
          <div class="col-md-4">
            <div class="prop_type">
              <section>
                <select name="pro_def_rate_currency" class="cs-select cs-skin-underline">
                       <?php
				$selected = @$pro_cur_rate_currency ;
				$options  = array('GBP', 'USD', 'CAD', 'INR', 'EUR');
				if($selected==""){
              	echo "<option value='' disabled selected>Currency Name</option>";
				}
					echo "<option value=''>Currency Name</option>";
					foreach($options as $option){
						if($selected == $option){
							echo "<option selected='selected' value='$option'>$option</option>" ;
						}else{
							echo "<option value='$option'>$option</option>" ;
						}
					}
				?>
                </select>
              </section>
            </div>
          </div>-->
          <div class="col-md-12">
         
          <h3 class="head text-center">Additional information about rental rates</h3>
          
           <div class="editor">
          <label for="exampleInputEmail1">Additional Fees</label>
          <textarea class="ckeditor" name="add_fees" id="property_content"><?php echo @$pro_cur_rate_add_fees ;?></textarea>
        	</div></div>
           <div class="col-md-12">
      	  <div class="form-group">
          <label for="exampleInputEmail1">Notes</label>
          <input type="text" name="can_policy" class="form-control" id="can_policy" placeholder="Notes" value="<?php echo @$pro_cur_rate_can_policy ;?>" />
       		</div></div>      
      		</div>
            <input type="hidden" name="property_id" value="<?php echo @$property_id ?>" />
         <p class="text-center">
          <button type="submit" name="rate_update_submit" class="btn btn-success btn-outline-rounded green"> Update <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
        </form>
         <h3 class="head text-center">Add New Rates</h3>
        <div class="row">
          <div class="heading">
            <h3><i class="fa fa-home" aria-hidden="true"></i> Enter Property Rates</h3>
          </div>
<p><strong>Note*</strong> Please don't insert currency symbol and commas while filling the price.</p>
		<form method="post" action="" enctype="multipart/form-data">
          <div class="col-md-4">
            <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Season</label>
                <input type="text" name="pro_new_rate_desc" class="form-control" id="pro_new_rate_desc" placeholder="Season" />
              </div>
            </div>
          </div>
          <div class="col-md-4">
             <div class="form-group">
          <label for="exampleInputEmail1">Start Date</label>
          <div class='input-group date' id='datetimepicker8'>
            <input type='text' class="form-control" name="pro_new_rate_sdate" id="pro_new_rate_sdate"/>
            </div>
        </div>
          </div>
          <div class="col-md-4">
             <div class="form-group">
          <label for="exampleInputEmail1">End Date</label>
          <div class='input-group date' id='datetimepicker9'>
            <input type='text' class="form-control" name="pro_new_rate_edate" id="pro_new_rate_edate" />
           </div>
        </div>
          </div>
          
          <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Weekend Night</label>
                <input type="text" name="pro_new_rate_weekend_nt" class="form-control" id="pro_new_rate_weekend_nt" placeholder="Weekend Night" />
              </div>
            </div>
          
          </div>
          
           <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Week Night</label>
                <input type="text" name="pro_new_rate_week_nt" class="form-control" id="pro_new_rate_week_nt" placeholder="Week Night" />
              </div>
            </div>
          
          </div>
          
           <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Weekly Night</label>
                <input type="text" name="pro_new_rate_weekly_nt" class="form-control" id="pro_new_rate_weekly_nt" placeholder="Weekly Night" />
              </div>
            </div>
          
          </div>
          
           <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Monthly</label>
                <input type="text" name="pro_new_rate_monthly" class="form-control" id="pro_new_rate_monthly" placeholder="Monthly" />
              </div>
            </div>
          
          </div>
 
          <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Minimum Stay</label>
                <input type="text" name="pro_new_rate_min_stay" class="form-control" id="pro_new_rate_min_stay" placeholder="Minimum stay in nights" />
              </div>
            </div>
          
          </div>
          
          <!--<div class="col-md-4">
            <div class="prop_type">
              <section>
                <select name="pro_new_rate_min_stay" class="cs-select cs-skin-underline">
                  <?php
				$options  = array('Per Night', 'Per Week', 'Per Month');
				if($selected==""){
              	echo "<option value='' disabled selected>Minimum Stay</option>";
				}
					echo "<option value=''>Minimum Stay</option>";
					foreach($options as $option){
						if($selected == $option){
							echo "<option selected='selected' value='$option'>$option</option>" ;
						}else{
							echo "<option value='$option'>$option</option>" ;
						}
					}
				?>
                </select>
              </section>
            </div>
          </div>-->
        </div>
    	<input type="hidden" name="property_id" value="<?php echo @$property_id ?>" />
         <p class="text-center">
          <button type="submit" name="rate_insert_submit" class="btn btn-success btn-outline-rounded green"> Insert <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
        </form>
    <?php

	  $fetch11 = mysqli_query($conn,"SELECT * FROM ".$property_new_rates." WHERE property_id='".$property_id."' AND admin_id='".$admin_id."'");
	   $num11 = mysqli_num_rows($fetch11);
	   if($num11>0)
	   {
	?>     
        <h3 class="head text-center">Current Rate List</h3>
 
        <table class="responsive-table">
    
    <thead>
      <tr>
        <th scope="col">Season </th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Week Night</th>
        <th scope="col">Weekend Night</th>
        <th scope="col">Weekly</th>
        <th scope="col">Monthly</th>
        <th scope="col">Minimum Stay</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    
    <tbody>
   
   <?php
		while($show11 = mysqli_fetch_assoc($fetch11))
		  {
			$pro_new_rate_desc=$show11['pro_new_rate_desc'];
			$pro_new_rate_sdate=$show11['pro_new_rate_sdate'];
			$pro_new_rate_edate=$show11['pro_new_rate_edate'];
			$pro_new_rate_weekend_night=$show11['pro_new_rate_weekend_nt'];
			$pro_new_rate_week_night=$show11['pro_new_rate_week_nt'];
			$pro_new_rate_weekly_night=$show11['pro_new_rate_weekly_nt'];
			$pro_new_rate_monthly=$show11['pro_new_rate_monthly'];
			$pro_new_rate_min_stay=$show11['pro_new_rate_min_stay'];
			if($pro_new_rate_min_stay > 1)
			{
				$t = 'Nights';
			}
			else
			{
				$t = 'Night';
			}
			if($pro_new_rate_sdate=="0000-00-00"){$pro_new_rate_sdate="";}
			if($pro_new_rate_edate=="0000-00-00"){$pro_new_rate_edate="";}
	?>
      <tr>
      
       <th scope="row"><?php echo $show11['pro_new_rate_desc']; ?></th>
        <td data-title="Start Date"><?php echo $pro_new_rate_sdate; ?> </td>
        <td data-title="End Date"><?php echo $pro_new_rate_edate; ?></td>
        <td data-title="Week Night" ><?php echo $pro_new_rate_week_night?'$'.number_format($pro_new_rate_week_night,2):'' ;?></td>
        <td data-title="Weekend Night"><?php echo $pro_new_rate_weekend_night?'$'.number_format($pro_new_rate_weekend_night,2).' fri,Sat':'' ;?></td>
        <td data-title="Weekly"><?php echo $pro_new_rate_weekly_night?'$'.number_format($pro_new_rate_weekly_night,2):'' ;?></td>
        <td data-title="Monthly" ><?php echo $pro_new_rate_monthly?'$'.number_format($pro_new_rate_monthly,2):'' ;?></td>
         <td data-title="Minimum Stay"><?php echo $show11['pro_new_rate_min_stay'].' '.$t; ?></td>
   
         <form action="" method="post">
        <td data-title="Delete" ><input type="hidden" name="delete_rate" value="<?php echo $show11['pro_new_rate_id']; ?>"><button type="submit" name="delete_rate_button" onClick="return check()"><i class="fa fa-trash"></i></button></td>
        </form>
         <form method="post" action="edit_rate.php">
        <td data-title="Edit" >
        <input type="hidden" name="edit_rate_pro_id" value="<?php echo $property_id; ?>">
        <input type="hidden" name="edit_rate" value="<?php echo $show11['pro_new_rate_id']; ?>">
        <button type="submit" name="edit_rate_button"><i class="fa fa-pencil"></i></button>
        </td>
         </form>
          </tr>
          <?php
             }
           }
          ?>
         
    	</tbody>
	 </table>

      </div>
      <div class="tab-pane fade" id="prototyping">
  
<!----------  Amenities  ------------>
  <iframe src="amenities.php" frameborder="0" width="100%" height="500px" scrolling="auto"></iframe>
      </div>
      
 
    
      <div class="tab-pane fade" id="uidesign">
      <style>
  .dz-max-files-reached {background-color: red};
</style> 

                  <?php
$file_query = mysqli_query($conn,"SELECT count(image_id) as c_no,sum(file_size) as file FROM ".$files." WHERE property_id='".$property_id."' AND admin_id='".$admin_id."'");
$run = mysqli_fetch_assoc($file_query);
$file_size = $run['file'];
$file_count = $run['c_no'];
if($file_count<=40)
{
if($file_size<52428800)//less than 50 MB
{
?>
 <h3 class="head text-center">Property Gallery</h3>
        	
            <div class="heading"><h1>Drag&amp;Drop Multiple Files Upload</h1></div>
<div class="image_upload_div">
	<form action="upload.php" method="post" class="dropzone" id="my-awesome-dropzone">
    <input type="hidden" name="property_id" value="<?php echo $property_id ?>" >
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
<a href="property_details.php" class="btn btn-success btn-outline-rounded green" onClick="return gallery()">Refresh Gallery</a></p>
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
$fetch = mysqli_query($conn,"SELECT * FROM ".$files." WHERE property_id='".$property_id."' AND admin_id='".$admin_id."' ORDER BY menu_order ASC");
@$count = mysqli_num_rows($fetch);
while(@$row = mysqli_fetch_assoc($fetch))
{
	?>
    <li class="img_li" id="menu-order-<?php echo $row['image_id'] ?>"><img src="uploads/<?php echo $property_id.'/'.$row['file_name'] ?>" /><div class="img_dt"><input type="text" name="img_<?php echo $row['image_id'] ?>" placeholder="Write Caption" value="<?php echo @$row['caption'] ;?>" /><div class="deleteCheck_box"><input type="checkbox" name="del_immg[]" class="del_imgg" id="del_imgg" value="<?php echo $row['image_id'].",".$property_id.",".$admin_id ;?>" /></div><button class="del" type="submit" value="<?php echo $row['image_id'] ?>,<?php echo $property_id ?>">Delete</button></div>
    </li>
	<?php
	
}
?>
</ul>
 </form>
<?php } ?>
<div class="success-msg"></div>
      </div>
      <div class="tab-pane fade" id="doner">
        <div class="text-center"> <i class="img-intro icon-checkmark-circle"></i> </div>
        <div class="ical">
        	<h3 class="head text-center">Availability Calendar</h3>
          <iframe src="<?php echo $base_url ?>calender/calender.php?id=<?php echo $property_id; ?>"></iframe>
        </div>
        <!--<p class="text-center">
          <button class="btn btn-success btn-outline-rounded green"> Submit <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>-->
      </div>
      <div class="clearfix"></div>
    </div>
    
    <!--<div class="meta">
      <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo"><i class="fa fa-comment"></i> Meta Tags</button>
      <div id="demo" class="collapse">
      <form method="post" action="">
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
    </div>
    
    <div class="ui_button">
        <button type="button" class="btn btn-default hi-icon hi-icon-images"><i class="fa fa-paper-plane-o"></i> Submit</button>
        </div>
    </form>-->
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
<?php
if(isset($_POST['property_details_submit']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$pro_id = test_input($_POST['property_id']);
	$admin_id=test_input($_SESSION['admin_id']);
	$pro_heading=test_input($_POST['property_heading']);
	$pro_head_title=test_input($_POST['property_head_title']);
	$pro_content=$_POST['property_content'];
	$pro_acc_type=test_input($_POST['acc_type']);
	$pro_addr=test_input($_POST['pro_addr']);
	$pro_latt=test_input($_POST['pro_latt']);
	$pro_long=test_input($_POST['pro_long']);
	$pro_status =test_input($_POST['property_status']);
	$pro_type=test_input($_POST['property_type']);
	$pro_no_of_bedrooms=test_input($_POST['property_no_of_bedrooms']);
	$pro_no_of_sleeps=test_input($_POST['property_no_of_sleeps']);
	$pro_no_of_baths=test_input($_POST['property_no_of_baths']);
	$pro_on_floor=test_input($_POST['property_on_floor']);
	$pro_feet=test_input($_POST['property_feet']);
	$pro_garage=test_input($_POST['property_garage']);
	$pro_elev=test_input($_POST['property_elevator']);
	/*$pro_city=test_input($_POST['property_city']);*/
	$ip = getClientIP();
	
	$insert = mysqli_query($conn,"SELECT * FROM ".$property_details." WHERE property_id=$pro_id AND admin_id=$admin_id");
	$row = mysqli_num_rows($insert);
	
	if($row==0)
	{
		
		$insert = mysqli_query($conn,"INSERT into ".$property_details."(property_id,admin_id,property_heading,property_head_title,property_content,property_acc_type,property_address,property_latt,property_long,property_status,property_type,property_no_of_bedrooms,property_no_of_sleeps,property_no_of_baths,property_floor,property_feet,property_garage,property_elevator,pro_det_insert_date,pro_det_ip) VALUES('".$pro_id."','".$admin_id."','".$pro_heading."','".$pro_head_title."','".$pro_content."','".$pro_acc_type."','".$pro_addr."','".$pro_latt."','".$pro_long."','".$pro_status."','".$pro_type."','".$pro_no_of_bedrooms."','".$pro_no_of_sleeps."','".$pro_no_of_baths."','".$pro_on_floor."','".$pro_feet."','".$pro_garage."','".$pro_elev."', now() ,'".$ip."')") or die(mysqli_error($conn));
		
		if($insert)
		{
			echo "<script>alert('Inserted Successfully.');</script>";
			?>
			<script>
			window.location = 'property_details.php';
            </script>
            <?php
		}
	}
	if($row>0)
	{
		while($loop = mysqli_fetch_assoc($insert))
		{
			$update = mysqli_query($conn,"UPDATE ".$property_details." SET property_heading='".$pro_heading."', property_head_title='".$pro_head_title."', property_content='".$pro_content."', property_acc_type='".$pro_acc_type."', property_address='".$pro_addr."',property_latt='".$pro_latt."',property_long='".$pro_long."', property_status='".$pro_status."', property_type='".$pro_type."', property_no_of_bedrooms='".$pro_no_of_bedrooms."', property_no_of_sleeps='".$pro_no_of_sleeps."', property_no_of_baths='".$pro_no_of_baths."', property_floor='".$pro_on_floor."',property_feet='".$pro_feet."',property_garage='".$pro_garage."', property_elevator='".$pro_elev."', pro_det_update_date=now() , pro_det_ip='".$ip."' WHERE property_id='".$loop['property_id']."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
		}
		if($update)
		{
			echo "<script>alert('Updated Successfully.');</script>";
			?>
			<script>
			window.location = 'property_details.php';
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
if(isset($_POST['rate_update_submit']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$pro_id = test_input($_POST['property_id']);
	$admin_id=test_input($_SESSION['admin_id']);
	$pro_cur_rate=test_input($_POST['pro_def_rate_rates']);
	$pro_cur_rate_check_in=test_input($_POST['pro_def_rate_check_in']);
	$pro_cur_rate_check_out=test_input($_POST['pro_def_rate_check_out']);
	$pro_cur_rate_min_stay=test_input($_POST['pro_def_rate_min_stay']);
	$pro_cur_rate_currency=test_input($_POST['pro_def_rate_currency']);
	$pro_cur_rate_add_fees=test_input($_POST['add_fees']);
	$pro_cur_rate_can_policy=test_input($_POST['can_policy']);
	$ip = getClientIP();
	
	$insert = mysqli_query($conn,"SELECT * FROM ".$property_default_rates." WHERE property_id='".$pro_id."' AND admin_id='".$admin_id."'");
	$row = mysqli_num_rows($insert);
	
	if($row==0)
	{
		$insert = mysqli_query($conn,"INSERT into ".$property_default_rates."(property_id,admin_id,
pro_def_rate_rates,pro_def_rate_check_in,pro_def_rate_check_out,pro_def_rate_min_stay,pro_def_rate_currency,add_fees,can_policy,pro_def_insert_date,pro_def_ip) VALUES('".$pro_id."','".$admin_id."','".$pro_cur_rate."','".$pro_cur_rate_check_in."','".$pro_cur_rate_check_out."','".$pro_cur_rate_min_stay."','".$pro_cur_rate_currency."', '".$pro_cur_rate_add_fees."', '".$pro_cur_rate_can_policy."',now(),'".$ip."')");
		
		if($insert)
		{
			echo "<script>alert('Inserted Successfully.');</script>";
			?>
			<script>
			window.location = 'property_details.php';
            </script>
            <?php
		}
	}
	
	if($row>0)
	{
		while($loop = mysqli_fetch_assoc($insert))
		{
			$update = mysqli_query($conn,"UPDATE ".$property_default_rates." SET pro_def_rate_rates='".$pro_cur_rate."', pro_def_rate_check_in='".$pro_cur_rate_check_in."', pro_def_rate_check_out='".$pro_cur_rate_check_out."', pro_def_rate_min_stay='".$pro_cur_rate_min_stay."', pro_def_rate_currency='".$pro_cur_rate_currency."', add_fees='".$pro_cur_rate_add_fees."', can_policy='".$pro_cur_rate_can_policy."', pro_def_update_date=now(), pro_def_ip='".$ip."' WHERE property_id='".$pro_id."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
		}
		
		if($update)
		{
			echo "<script>alert('Updated Successfully.');</script>";
			?>
			<script>
			window.location = 'property_details.php';
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
if(isset($_POST['rate_insert_submit']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$pro_id = test_input($_POST['property_id']);
	$pro_new_rate_desc=test_input($_POST['pro_new_rate_desc']);
	$pro_new_rate_sdate=test_input($_POST['pro_new_rate_sdate']);
	$pro_new_rate_edate=test_input($_POST['pro_new_rate_edate']);
	$pro_new_rate_weekend_night=test_input($_POST['pro_new_rate_weekend_nt']);
	$pro_new_rate_week_night=test_input($_POST['pro_new_rate_week_nt']);
	$pro_new_rate_weekly_night=test_input($_POST['pro_new_rate_weekly_nt']);
	$pro_new_rate_monthly=test_input($_POST['pro_new_rate_monthly']);
	$pro_new_rate_min_stay=test_input($_POST['pro_new_rate_min_stay']);
	$ip = getClientIP();
	
	$insert1 = mysqli_query($conn,"SELECT * FROM ".$property_new_rates." WHERE admin_id=$admin_id");
	
			$insert1 = mysqli_query($conn,"INSERT into ".$property_new_rates."(property_id,admin_id,pro_new_rate_desc,pro_new_rate_sdate,pro_new_rate_edate,pro_new_rate_weekend_nt,pro_new_rate_week_nt,pro_new_rate_weekly_nt,pro_new_rate_monthly,pro_new_rate_min_stay,pro_new_insert_date,pro_new_ip) VALUES('".$pro_id."','".$admin_id."','".$pro_new_rate_desc."','".$pro_new_rate_sdate."','".$pro_new_rate_edate."','".$pro_new_rate_weekend_night."','".$pro_new_rate_week_night."','".$pro_new_rate_weekly_night."','".$pro_new_rate_monthly."','".$pro_new_rate_min_stay."',now(),'".$ip."')");
		
		if($insert1)
		{
			echo "<script>alert('Inserted Successfully.');</script>";
			?>
			<script>
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
            </script>
            <?php
		}
	
}
?>

<?php
if(isset($_POST['delete_rate_button']))
{
	$delete_id = $_POST['delete_rate'];
	$admin_id = $_SESSION['admin_id'];
	
	$delete = mysqli_query($conn, "DELETE FROM ".$property_new_rates." WHERE pro_new_rate_id=$delete_id AND admin_id=$admin_id");
	if($delete)
		{
			echo "<script>alert('Deleted Successfully.');</script>";
			echo "<script>window.location = 'property_details.php'</script>";
		}
}
?>
<?php
if(isset($_POST['image_caption']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	 $pro_id = array_shift($_POST);
	 $admin_id = array_shift($_POST);
	foreach($_POST as $key=>$cap)
	{
		$cap_id= str_replace('img_','', $key);
		$update = mysqli_query($conn,"UPDATE ".$files." SET caption='".$cap."', updated_img_date=now() WHERE image_id='".$cap_id."' AND property_id='".$pro_id."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
	}
	
	if($update)
		{
			echo "<script>alert('Caption updated Successfully.');</script>";
			echo "<script>window.location = 'property_details.php'</script>";
		}
		else
		{
			echo "<script>alert('Updatation Failed.');</script>";
		}
	
}
?>
<script>
$(document).ready(function(){
document.addEventListener("leftclick",handler,true);

function handler(e){
    e.stopPropagation();
    e.preventDefault();
}
})
</script>