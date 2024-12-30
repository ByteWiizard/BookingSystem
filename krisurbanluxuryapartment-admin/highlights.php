<?php include_once('session_destroy.php') ;?>
<?php 
include_once('include/db.php');
$tbl_highlights = $pre_fix."tbl_highlights";
$tbl_area_information = $pre_fix."tbl_area_information";
$property_details = $pre_fix."property_details";
$admin_id = $_SESSION['admin_id'];
//$pid = $_GET['pid'];
$pid = $_SESSION['property_id'];

/* insert data into highlights */
if(isset($_POST['amn_submit'])){

	$property_id = $_POST['property_id'];
	$admin_id = $_POST['admin_id'];
	$title = $_POST['high_title'];
	$content = $_POST['hight_content'];
	$create_date = date("Y-m-d");
	
	$QueryAdd = mysqli_query($conn, "insert into ".$tbl_highlights."(property_id,admin_id,title,content,create_date) values ('$property_id','$admin_id','$title','$content','$create_date')");
	if($QueryAdd){
		$a = "Highlight added successfully.";
	}
}



$pro_fetch = mysqli_query($conn, "SELECT * FROM ".$property_details." WHERE admin_id='".$admin_id."' and property_id='".$pid."'");
$pro_row = mysqli_fetch_assoc($pro_fetch);
$property_id = $pro_row['property_id'];
?>
<!-- delete highlights -->
<?php
	if(isset($_POST['delete_amenity_button'])){
		$proid = $_POST['proid'];
		$highid = $_POST['highid'];
		$delete = mysqli_query($conn, "DELETE FROM ".$tbl_highlights." WHERE high_id='".$highid."' AND admin_id='".$proid."'");
		if($delete){
			$error = "Deleted successfully.";
		}
	}
?>
<!-- end delete highlights -->
<!-- get all area information -->
<?php
	$QueryAll = mysqli_query($conn, "SELECT * FROM ".$tbl_area_information."");
	$ResAll = mysqli_fetch_assoc($QueryAll);
	$area_id = $ResAll['area_id'];
	$title = $ResAll['title'];
	$content = $ResAll['content'];
?>
<!-- get all area information -->
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
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>
<script src="framework/ckeditor/ckeditor.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
		  $( "#sortable" ).sortable({
    update: function( event, ui ) {
		var sorted = $( "#sortable" ).sortable( "serialize" );
        $.post( "ajax/save_main_aminity_order.php",{ 'choices': sorted} ,function( data ) {
  $( ".success-msg" ).html( data );
		});
   	 }
  });
	 });
</script>

 
 </head>
 <body style="background:#f2f4f8">
 <div id="main_amenity">
 <!-- area content -->
 
 <!-- area content -->
<div class="add" id="add_ameni">
      <h4 style="font-family:Arial, Helvetica, sans-serif;">Add a new Highlights from here </h4>
      <h5><span style="color: green"><?php if(@$a){ echo @$a; } ?></span></h5>
      <div id="amen_form">
     <form name="amenity" id="our_amen" method="post" action="">
     	<div class="col-md-12">
	        <label for="exampleInputEmail1" style="float: left;">Title</label>
	        <input type="text" name="high_title" placeholder="Title" class="form-control" id="high_title">
        </div>

        <div class="col-md-12">
	        <label for="exampleInputEmail1" style="float: left;">Content <small>(You can enter highlights with (,) comma)</small></label>
	        <input type="text" name="hight_content" placeholder="Content" class="form-control" id="hight_content">
        </div>
     	
     	
        <input type="hidden" name="property_id" value="<?php echo $property_id ;?>" />
		<input type="hidden" name="admin_id" value="<?php echo $admin_id ;?>" /><br>
        <input type="submit" name="amn_submit" id="a_amen" value="Add Highlights" title="Add Highlights" class="btn btn-success green" style="margin:10px;">
     </form>
     </div>
     
    </div>
  
		<?php
			$page_query = mysqli_query($conn,"SELECT * FROM ".$tbl_highlights." WHERE admin_id='".$admin_id."' AND property_id='".$pid."' ORDER BY menu_order ASC");

			$a_no1 = @mysqli_num_rows($page_query);
			if($a_no1>0){
		?>
    	<div class="add">
     		<h4>Added Highlights <?php if(@$error){ ?><span style="color:red;">Deleted 
     		Successfully.</span><?php } ?></h4>
     		<p><b>Drag & Drop You can set highlights order.</b></p>
			<table class="responsive-table">
				<thead>
					<tr>
						<th scope="col" style="text-align: center;">Title</th>
						<th scope="col" style="text-align: center;">Content</th>
						<th scope="col" style="text-align: center;">Delete</th>
					</tr>
				</thead>
				<tbody id="sortable">
					<?php
					while(@$show_am1 = mysqli_fetch_assoc($page_query)) :
						$high_id=$show_am1['high_id'];
					?>
						<tr class="abcd" id="menu-order-<?php echo $high_id; ?>">
							<td><?php echo $show_am1['title']; ?></td>
							<td><?php echo $show_am1['content']; ?></td>
							<td data-title="Delete" >
								<form method="post" action="">
										<input type="hidden" name="proid" value="<?php echo $property_id; ?>">
										<input type="hidden" name="highid" value="<?php echo $show_am1['high_id']; ?>">
										<button type="submit" name="delete_amenity_button" title="Delete this highlight permanently" class="confirmation"><i class="fa fa-trash"></i></button>
								</form>
							</td>
						</tr>
					<?php
					endwhile;
					?>
				</tbody>
			</table>

			<?php }else{ ?>
			<div class="add">
				<h3 style="margin-top:5em;">No Highlight is available now.</h3>
			<?php } ?>
			</div>
		</div>
	</body>
</html>
