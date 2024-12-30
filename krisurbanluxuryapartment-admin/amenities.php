<?php include_once('session_destroy.php') ;?>
<?php 
include_once('include/db.php');
$amenity = $pre_fix."amenity";
$amenity_details = $pre_fix."amenity_details";
$property_details = $pre_fix."property_details";

$admin_id = $_SESSION['admin_id'];
//$pid = $_GET['pid'];
$pid = $_SESSION['property_id'];
$pro_fetch = mysqli_query($conn, "SELECT * FROM ".$property_details." WHERE admin_id='".$admin_id."' and property_id='".$pid."'");
$pro_row = mysqli_fetch_assoc($pro_fetch);
$property_id = $pro_row['property_id'];
?>
<?php
if(isset($_GET['del_id']))
{
	$delete_id1 = $_GET['del_id'];
	$admin_id = $_SESSION['admin_id'];
	
	$delete = mysqli_query($conn, "DELETE FROM ".$amenity." WHERE amenity_id='".$delete_id1."' AND admin_id='".$admin_id."'");
	if($delete){
			$delete123 = mysqli_query($conn, "DELETE FROM ".$amenity_details." WHERE amenity_id='".$delete_id1."'") OR die(mysqli_error($conn));
			echo "<script>alert('Deleted Successfully.');</script>";
	?>
            <?php
		}
}
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
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>
<script src="framework/ckeditor/ckeditor.js"></script>
<style>
span.sub_sunda {
    background: #cae2fa;
    margin: 5px;
    padding: 5px 10px;
    display: inline-block;
}
a.butn1,.butn1, a.butn1:hover, a.butn1:focus{
	
	padding:5px 10px;
	color:#fff !important;
	background:#449d44 !important;
	border:0;
	font-size:15px;
	margin-bottom:10px;
}
.responsive-table tr th:nth-child(2){
	width:auto !important;
	
}
#sortable tr td:nth-child(2){
	width:100% !important;
	background:#fff!important;
}
#sortable tr{
	background:#fff!important;
}
</style>
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
	$('#amen_form').hide();
	$('.amen_note').hide();
    $('#add_amenity').click(function(){
		var but = $('#add_amenity').val();
			$('#amen_form').toggle(function(){
			if(but== 'Add New Amenity Category' )
				{
					$('#add_amenity').val('Hide');
				}
			else
				{
					$('#add_amenity').val('Add New Amenity Category');
					$('.amen_note').hide();
				}
		});
		});
})
</script>
 <script>
 $(document).ready(function(){
	 $("#a_amen").click(function(){
		 var amenName = $('#add_amen').val();
                 if(amenName=="")
		 {
			 alert("Please enter a amenity name...");
			 return false;
		 }
	 });
 })
 </script>
 
 
 </head>
 <body style="background:#f2f4f8">
 <div id="main_amenity">
<div class="add" id="add_ameni">
      <h4 style="font-family:Arial, Helvetica, sans-serif;">Add a new Amenity Category from here </h4>
      <div id="amen_form">
     <form name="amenity" id="our_amen" method="post" action="add_amenity.php?pid=<?php echo $property_id; ?>">
     	<input type="text" name="add_amen" id="add_amen" size="40" onClick="this.select()">
        <input type="hidden" name="property_id" value="<?php echo $property_id ;?>" />
		<input type="hidden" name="admin_id" value="<?php echo $admin_id ;?>" />
        <input type="submit" name="amn_submit" id="a_amen" value="Add Amenity Category" title="Add New Amenity Category" class="butn1">
     </form>
     </div>
     <input type="button" class="btn btn-success green" id="add_amenity" value="Add New Amenity Category" style="margin:10px;"/>
    </div>
  
   <?php
   
          $per_page= 10; // number of user to show
$page_query=mysqli_query($conn,"SELECT amenity_id FROM ".$amenity." WHERE admin_id='".$admin_id."' AND property_id='".$pid."'");
$pages=ceil(mysqli_num_rows($page_query) / $per_page); //total number of pages to show
$page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1; // current page list
$start= ($page - 1) * $per_page;
	$page_query1 = mysqli_query($conn,"SELECT * FROM ".$amenity." WHERE admin_id='".$admin_id."' AND property_id='".$pid."' ORDER BY amenity_id DESC LIMIT $start, $per_page");
		$a_no1 = @mysqli_num_rows($page_query1);
			if($a_no1>0)
			{
	?>
    <div class="add">
     <h4>Added Amenity Category</h4>
     <p><b>You can add,delete,show or hide amenities of each category by clicking on the customize amenity button.</b></p>
    <table class="responsive-table">
    <thead>
      <tr>
        <th scope="col">Amenity Category</th>
        <th scope="col">Amenities</th>
        <th scope="col">Customize Your Amenity</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    
    <tbody id="sortable">
 
	<?php
	while(@$show_am1 = mysqli_fetch_assoc($page_query1))
		{
			$amenity_id=$show_am1['amenity_id'];
			
	?>
      <tr class="abcd" id="menu-order-<?php echo $amenity_id; ?>">
       <td><?php echo $show_am1['amenity_name']; ?></td>
       <?php
	   $amen_value="";
	   $sub = mysqli_query($conn, "SELECT amen_value FROM ".$amenity_details." WHERE amenity_id='".$amenity_id."' ORDER BY amen_id ASC");
			while($rowth = @mysqli_fetch_assoc($sub))
			{
				$amen_value .= "<span class='sub_sunda'>".$rowth['amen_value']."</span>";
				
			}
	  
	 ?>   
     <td>
     <?php
	    if($amen_value!="")
		{
			 echo $amen_value ;
		}
		else
		{
			 echo "<span style='color:#627bad'>No amenity has been added to this category.</span>" ;
		}
		?>
       </td>
        <td data-title="Edit" ><a  href="amenity_feature.php?update=<?php echo $show_am1['amenity_id']; ?>" name="update_amenity_button" class="upd_amen" target="_top"></i><button  title="Add or delete amenity to this category"><i class="fa fa-plus"></i> <i class="fa fa-minus"></i></button> </a></td>
      
         
        <td data-title="Delete" ><a name="delete_amenity" href="?del_id=<?php echo $show_am1['amenity_id']; ?>&pid=<?php echo $property_id; ?>"><button type="submit" name="delete_amenity_button" title="Delete this amenity category permanently" onClick="return check()"><i class="fa fa-trash"></i></button></a></td>
       
          </tr>
          <?php
		  $amen_value="";
             }
			
          ?>
         
    	</tbody>
	 </table>

 <div style="text-align:center">
<nav aria-label="Page navigation">
  <ul class="pagination">
<?php
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
<?php }
else
{
?>
<div class="add">
     <h3 style="margin-top:5em;">No Amenity Category is available now.</h3>
<?php	
}
 ?>
 </div>
      </div>
      </body>
      </html>
