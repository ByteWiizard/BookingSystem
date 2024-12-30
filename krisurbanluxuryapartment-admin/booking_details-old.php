<?php 
@include_once('session_destroy.php');
include("include/db.php");
$booking_details = "lhk_booking_details";
$property_details = "lhk_property_details";
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
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<div class="wrapper">
<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>

     <div class="content-wrapper">
    <section class="content-header" style="overflow-y: scroll;">
      <h1> Booking Details <small> your  Current Details</small></h1>
      <hr>
      	<form method="post" action="other_quotation.php">
      	<select name="select_property" id="select_property" class="form-control" style="width: 17%;display: -webkit-inline-box;">
      		<?php
      			$ProData = mysqli_query($conn, "select property_id,property_heading from ".$property_details." ");
      			while($ResPro = mysqli_fetch_assoc($ProData)){
      		?>
			<option value="<?php echo $ResPro['property_id']; ?>"><?php echo $ResPro['property_heading']; ?></option>
			<?php } ?>
		</select>
		<button type="submit" class="btn" name="checkval" value="checkval" style="background:#636365; color:#fff;"> Send Other Quote </button>
		</form>
<?php  
 $i = 1;
$q=mysqli_query($conn,"select * from ".$booking_details." order by bok_det_id DESC");
$num = mysqli_num_rows($q);
?>
<?php if($num!=""){ ?>
<h3 class="head text-center">Booking Request List</h3> 


    <table class="responsive-table">
    
    <thead>
      <tr>
         <th scope="col">S.No.</th>
         <!-- <th scope="col">Property ID</th> 
        <th scope="col">Property Name</th>-->
          <th scope="col">Check In</th>
        <th scope="col">Check Out</th>
        <th scope="col">Client Name</th>
       <th scope="col">Client Email</th>
	   <!-- <th scope="col">Phone</th> -->
	   <th scope="col">Amount</th>
	   <th scope="col">Booking Request Date</th>
	   <th scope="col">Quote Send</th>
	    <th scope="col">Sent quotes</th>
           <th scope="col">Delete</th>
	 
       
      </tr>
    </thead>
    
    <tbody>
   
   <?php

		while($show11 = mysqli_fetch_assoc($q))
		  {
                        $p_id=$show11['property_id'];
			$p_name=$show11['prop_name'];
			$c_in=$show11['checkin'];
			$c_out=$show11['checkout'];
			$cname=$show11['name'];
			$email=$show11['email'];
			$phone=$show11['phone'];
			$amount=$show11['tot_amt'];
			$message_send_status=$show11['message_send_status'];
			$b_date=$show11['added_date'];
		  
		
	?>

      <tr>
      <td><?php echo $i ;?></td>
       <!-- <td><?php echo $p_id ;?></td> 
       <th scope="row"><?php echo $p_name ;?></td>-->
        <td><?php echo $c_in; ?> </td>
        <td><?php echo $c_out;?></td>
        <td><?php echo $cname; ?></td>
		<td><?php echo $email; ?></td>
		<!-- <td><?php echo $phone; ?></td> -->
		<td><?php echo "$".$amount; ?></td>
		<td><?php echo $b_date; ?></td>
		<td><?php echo $message_send_status; ?></td>
		<td>
		<button type="button" class="btn btn-default" onClick="document.location.href='quotation.php?id=<?php echo @$show11['bok_det_id']; ?>';">Sent Quote</button></td>
     <form action="" method="post">
        <td data-title="Delete" ><input type="hidden" name="delete_property" value="<?php echo @$show11['bok_det_id']; ?>"><button type="submit" name="delete_pro_button" onClick="return check()"><i class="fa fa-trash"></i></button></td>
        </form>
        </tr>
		  <?php 
                    $i++;
                    } 
                   ?>
     </tbody>
	 </table>
<?php 
} 
else
{
    echo "<p><h4>No booking requests has been done yet.</h4></p>";
}
?>
 <div class="tab-pane fade" id="prototyping">

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
<?php
if(isset($_POST['delete_pro_button']))
{
	$delete_id = $_POST['delete_property'];
	$admin_id = $_SESSION['admin_id'];
	
	$delete = mysqli_query($conn, "DELETE FROM ".$booking_details." WHERE bok_det_id=$delete_id");
	if($delete)
		{
			echo "<script>alert('Deleted Successfully.');</script>";
			?>
			<script>
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
            </script>
            <?php
		}
}
?>