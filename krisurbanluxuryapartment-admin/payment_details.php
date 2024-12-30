<?php include_once('session_destroy.php'); ?>
<?php 
  include("include/db.php"); 
  $transaction = $pre_fix."transaction";
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
    <section class="content-header">
    
      <h1> Payments <small>List of all payments</small> </h1>
      <hr>
  <?php
	  $fetch11 = mysqli_query($conn,"SELECT * FROM ".$transaction." WHERE trans_status=0 OR trans_status=1");
	   @$num11 = mysqli_num_rows($fetch11);
	   if($num11>0)
	   {
            ?> 	
    <h3 class="head text-center">Payment List</h3>
        <div class="ta_pad">
         <table class="responsive-table">
    
    <thead>
      <tr>
        <th scope="col"> S.No </th>
        
        <th scope="col">Property Name</th>
        <th scope="col">Booking</th>
        <th scope="col">Transaction ID</th>
        <th scope="col">Client Name</th>
        <th scope="col">Client Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Paid Amount</th>
        <th scope="col">Payment Date</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    
    <tbody>
           <?php
		   $i=1;
		while(@$show11 = mysqli_fetch_assoc($fetch11))
		  {
			$property_id = $show11['property_id'];
                        $property_name = $show11['prop_name'];
			$transaction_id = $show11['transaction_id'];
                        $checkin = $show11['trans_checkin'];
                        $checkout = $show11['trans_checkout'];
			$request_id = $show11['request_id'];
			$trans_name = $show11['trans_name'];
			$trans_email = $show11['trans_email'];
			$trans_phone = $show11['trans_phone'];
			$trans_amt = $show11['trans_amt'];
                        $trans_curr = $show11['trans_curr'];
			$trans_date = $show11['trans_date'];
		  
	?>
      <tr>
      	<td><?php echo $i ?></td>
       
        <td><?php echo @$property_name; ?> </td>
        <td><?php echo @$checkin." to ".$checkout; ?> </td>
        <td><?php echo @$transaction_id; ?> </td>
        <td><?php echo html_entity_decode(@$trans_name); ?></td>
        <td><?php echo @$trans_email; ?></td>
        <td><?php echo @$trans_phone; ?></td>
        <td><?php echo $trans_curr=='USD'?'$':'';echo html_entity_decode(@$trans_amt); ?></td>
        <td><?php echo @$trans_date; ?></td>
   
         <form action="" method="post">
        <td data-title="Delete" ><input type="hidden" name="delete_property" value="<?php echo @$request_id; ?>"><button type="submit" name="delete_pro_button" onClick="return check()"><i class="fa fa-trash"></i></button></td>
        </form>
          </tr>
          <?php
		  $i++;
             }
           echo "</tbody>";
           }
		   else
		   {
			   echo "<p><h4> No payment has been done yet. </h4></p>";
		   }
          ?>
       </table>
     </div>
     </section>
	 </div>
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
</div>
</html>
<?php
if(isset($_POST['delete_pro_button']))
{
	$delete_id = $_POST['delete_property'];
	
	$delete = mysqli_query($conn, "UPDATE ".$transaction." SET trans_status=2 WHERE request_id='".$delete_id."'");
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
