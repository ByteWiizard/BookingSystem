<?php include_once('session_destroy.php');
include("include/db.php");
$booking_details = "lhk_booking_details";
$property_details = "lhk_property_details";
$files = "lhk_files";
$ical_events = "lhk_ical_events";
$contact_details = "lhk_contact_details";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>
<link href="framework/css/import.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="framework/js/ajax.js"></script>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<style>
.pd-topBottom {
padding: 5px 0px;
}

.propertyp h1 {
font-size: 2em;
}

.pheading {
font-size: 3em;
padding: 1em 1em 0;
text-align: center;
}

.propertyp section {
background: #e7ecf4 none repeat scroll 0 0;
margin-bottom: 1em;
margin-top: 1em;
padding: 3em 1em;
}

.propertyp fieldset {
border: 0 none;
border-radius: 5px;
padding: 10px;
}
.propertyp .form label {
color: #161616;
display: inline-block;
font-family: "Verlag","Helvetica Neue",Helvetica,Arial,sans-serif;
font-size: 1.1em;
font-style: normal;
font-weight: 500;
line-height: 1.5;
margin-bottom: 0;
max-width: 100%;
}

.propertyp span {
display: inline;
font-size: 15px;
font-weight: 600;
margin-top: 3px;
text-transform: uppercase;
}

.propertyp .form input[type="text"], .propertyp .form select, .propertyp .form textarea {
border: 1px solid #99a1a1;
box-sizing: border-box;
color: #161616;
display: inline-block;
font-size: 1em;
line-height: 1.5;
margin: 5px 0;
padding: 1rem;
width: 100%;
}
.propertyp .half {
margin: 0;
padding: 0 2px;
}
.propertyp input[type="submit"] {
background-color: #375e97;
border: medium none;
border-radius: 4px;
color: #fff;
cursor: pointer;
font-size: 1.4em;
font-style: normal;
font-weight: 500;
margin: 8px 0;
padding: 14px 20px;
text-transform: uppercase;
width: 100%;
}
.propertyp input[type="submit"]:hover {
background-color: #2e4565;
color: #fff;
}
.propertyp h3 {
color: #161616;
font-size: 24px;
font-style: normal;
}
.propertyp #book h2 {
background: #375e97 none repeat scroll 0 0;
color: #fff;
font-size: 1.5em;
margin-bottom: 5px;
padding: 10px;
}
.propertyp #virtual-tour {
padding-top: 50px !important;
}
.propertyp fieldset {
border: 0 none;
border-radius: 5px;
padding: 10px;
}

.booking-info-rental {
    background: #7490b8 none repeat scroll 0 0 !important;
    padding: 0 !important;
}

.booking-info .row, .booking-info-payment .row {
    line-height: 1.55;
    padding: 0 10px 10px;
}
.booking-info .label, .booking-info-payment .label {
    color: #2a2d2d;;
    float: left;
    font-size: 0.9em;
    font-weight: 300;
}

.booking-info .value, .booking-info-payment .value {
    float: right;
    font-size: 0.9em;
}

.booking-info-total {
    background-color: #375e97 !important;
    padding: 1em !important;
}

</style>



</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<div class="wrapper">

<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
$admin_id = $_SESSION['admin_id'];
$booking_id = $_GET['id'];

$fetch = mysqli_query($conn,"SELECT * FROM ".$booking_details." WHERE bok_det_id='".$booking_id."'");
$num = mysqli_num_rows($fetch);
while($show = mysqli_fetch_assoc($fetch))
{

$bok_det_id=$show['bok_det_id'];
$property_id=$show['property_id'];
$prop_name=$show['prop_name'];
$checkin=$show['checkin'];
$checkout=$show['checkout'];
$tot_amt=$show['tot_amt'];
$request_id=$show['request_id'];
$taxamount=$show['tax'];
$taxper=$show['taxv'];
$totalnight=$show['totalnight'];
$name=$show['name'];
$fname=$show['fname'];
$lname=$show['lname'];
$email=$show['email'];
$phone=$show['phone'];
$no_of_ppl=$show['no_of_ppl'];
$child=$show['children'];
$msg=$show['msg'];
$refund=$show['refund'];
$clean=$show['clean'];
$pets_fee=$show['pets_fee'];
$apply_rate=$show['apply_rate'];
$apply_rate_price=$show['apply_rate_price'];
$min_stay=$show['min_stay'];
$g_amount=$show['g_amount'];

$showextraname=$show['showextraname'];
$showextraamount=$show['showextraamount'];

}
?>


<div class="content-wrapper">
<section class="content-header">
<h1> Quotation Details <small>Update your Quotation Details</small> </h1>

<div class="pd-topBottom">

<form method="post"  action="quotation-detail.php" id="form_list" onsubmit="return checkCheckBoxes(this);">
<div class="content_bottom">
<div class="propertyp">
<div class="row">
<h1 class="pheading">Your Booking Information</h1>
<div class="col-md-8">
<section>
<h1>Traveler Information</h1>
<div class="form">
<fieldset>
<div class="col-md-6 half">
<label for="fname">First Name <span style="color:red;">*</span></label>
<input type="text" id="fname" name="fname" value="<?php echo $fname; ?>" required/>

<input type="hidden" id="booking_id" name="booking_id" value="<?php echo $bok_det_id; ?>"/>
<input type="hidden" id="property_id" name="property_id" value="<?php echo $property_id; ?>"/>
<input type="hidden" id="prop_name" name="prop_name" value="<?php echo $prop_name; ?>"/>
<input type="hidden" id="request_id" name="request_id" value="<?php echo $request_id; ?>"/>

</div>
<div class="col-md-6 half">
<label for="fname">Last Name <span style="color:red;">*</span></label>
<input type="text" id="lname" name="lname" value="<?php echo $lname; ?>" required/>
</div>
<div class="col-md-6 half">
<label for="email">Email <span style="color:red;">*</span></label>
<input type="text" id="cust_email" name="cust_email" value="<?php echo $email; ?>" required/>
</div>
<div class="col-md-6 half">
<label for="phone">Phone No. <span style="color:red;">*</span></label>
<input type="text" id="cust_phone" name="cust_phone" value="<?php echo $phone; ?>" required/>
</div>
<div class="clearfix"></div>
</fieldset>
</div>
</section>


<section>
<h1>VACATION RENTAL AGREEMENT</h1>
<div class="form">
<?php if($property_id==2){ ?>

<fieldset>
<div class="col-md-12">
<embed src="../agreement/Dunecastle-East-Agreement.pdf" type="application/pdf" style="width: 100%;height: 300px;"></embed>
</div>
<div class="col-md-12">
<div class="col-md-6">
<input type="checkbox" name="acc_Agreement" value="" required>
&nbsp;I have read and agree to these terms. </div>
<div class="col-md-6">

<i class="fa fa-file-text-o" aria-hidden="true"></i>
Vacation Rental Agreement 
<a style="margin-left: 2%;font-size: 16px;" href="../agreement/Dunecastle-East-Agreement.pdf"  download="Dunecastle East Agreement.pdf"  ><i class="fa fa-download" aria-hidden="true"></i>
Download </a>

</div></div>
</fieldset>

<?php } ?>


<?php if($property_id==1){ ?>
<fieldset>
<div class="col-md-12">
<embed src="../agreement/Dunecastle-West-Agreement.pdf" type="application/pdf" style="width: 100%;height: 300px;"></embed>
</div>
<div class="col-md-12">
<div class="col-md-6">
<input type="checkbox" name="acc_Agreement" value="" required>
&nbsp;I have read and agree to these terms. </div>
<div class="col-md-6">

<i class="fa fa-file-text-o" aria-hidden="true"></i>
Vacation Rental Agreement 
<a style="margin-left: 2%;font-size: 16px;" href="../agreement/Dunecastle-West-Agreement.pdf"  download="Dunecastle West Agreement.pdf"  ><i class="fa fa-download" aria-hidden="true"></i>
Download </a>

</div></div>
</fieldset>



<?php } ?>


</div>
</section>


<section>
<h1>Special Requests</h1>
<div class="form">
<fieldset>
<div class="col-md-12">
<textarea placeholder="Leave a special request." name="special_requests" class="fsvr_special_requests" maxlength="2048" style="resize:none; height:300px;"><?php echo $msg; ?></textarea>
</div>
</fieldset>
</section>

<div align="center">
<input type="submit" name="submit_data" value="Continue" class="btn btn-transparent blue">
</div>
</div>

<?php 
$QueryPro = mysqli_query($conn, "SELECT * FROM ".$property_details." ");
$ResPro = mysqli_fetch_assoc($QueryPro);
$QueryGall = mysqli_query($conn, "SELECT * FROM ".$files."  ORDER BY menu_order asc");
$Rowdata = mysqli_fetch_assoc($QueryGall);
?>

<div class="col-md-4 pinfo">

<section class="booking-info-rental">
<div class="row">
<div class="col-md-12"> 
<img src="<?php echo $Rowdata['file_name']; ?>" title="<?php echo ucwords($ResPro['property_heading']);?>" class="img-responsive"> </div>
<div class="col-md-12">
<h1 style="text-align:center;"><?php echo ucwords($ResPro['property_heading']);?></h1>
<!--  <p>this is dummy text.  this is dummy text.  this is dummy text.</p>-->   
</div>
</div>
</section>


<section class="booking-info">
<h3>BOOKING</h3>
<div class="details-content">
<div class="row">
<span class="label">Check In</span>
<span class="value">
<div class='input-group date' id='datetimepicker8'>
<input type="text" class="form-control" name="checkin" id="checkin" value="<?php echo $checkin ;?>" readonly>
</div>
</span>
</div>
<div class="row">
<span class="label">Check Out</span>
<span class="value">
<div class='input-group date' id='datetimepicker9'>
<input type="text" class="form-control" name="checkout" id="checkout" value="<?php echo $checkout ;?>" readonly>
</div>
</span>
</div>

<div class="row">
<span class="label">Calculate</span>
<span class="value">
<button type="button" class="btn" onclick="paymentcalculation()" name="checkval" value="checkval" style="background:#375e97; color:#fff;"> Calculate </button>
</span>
</div>

<div class="row">
<span class="label">Nights</span>
<span class="value"><input type="text" class="form-control" name="nightshow" id="nightshow" value="<?php echo @$totalnight ;?>" readonly></span>
</div>
<?php if($min_stay){ ?>
<div class="row">
<span class="label">Min Stay</span>
<span class="value"><input type="text" class="form-control" name="minstay" id="minstay" value="<?php echo @$min_stay ;?>" readonly></span>
</div>
<?php } ?>
<div class="row">
<span class="label">No. of Guests</span>
<span class="value">
<select name="guest" class="form-control" required="" style="width:180px;">
<option value="">--No of Guests--</option>
<option value="1" <?php if($no_of_ppl=='1') { echo "selected"; } ?>>1</option>
<option value="2" <?php if($no_of_ppl=='2') { echo "selected"; } ?>>2</option>
<option value="3" <?php if($no_of_ppl=='3') { echo "selected"; } ?>>3</option>
<option value="4" <?php if($no_of_ppl=='4') { echo "selected"; } ?>>4</option>
<option value="5" <?php if($no_of_ppl=='5') { echo "selected"; } ?>>5</option>
<option value="6" <?php if($no_of_ppl=='6') { echo "selected"; } ?>>6</option>
<option value="7" <?php if($no_of_ppl=='7') { echo "selected"; } ?>>7</option>
<option value="8" <?php if($no_of_ppl=='8') { echo "selected"; } ?>>8</option>
<option value="9" <?php if($no_of_ppl=='9') { echo "selected"; } ?>>9</option>
<option value="10" <?php if($no_of_ppl=='10') { echo "selected"; } ?>>10</option>
</select></span>
</div>

<div class="row">
<span class="label">Children</span>
<span class="value">
<select name="child" class="form-control" style="width:180px;">
<option value="0">--No of Children--</option>
<option value="1" <?php if($child=='1') { echo "selected"; } ?>>1</option>
<option value="2" <?php if($child=='2') { echo "selected"; } ?>>2</option>
<option value="3" <?php if($child=='3') { echo "selected"; } ?>>3</option>
<option value="4" <?php if($child=='4') { echo "selected"; } ?>>4</option>
<option value="5" <?php if($child=='5') { echo "selected"; } ?>>5</option>
<option value="6" <?php if($child=='6') { echo "selected"; } ?>>6</option>
<option value="7" <?php if($child=='7') { echo "selected"; } ?>>7</option>
<option value="8" <?php if($child=='8') { echo "selected"; } ?>>8</option>
<option value="9" <?php if($child=='9') { echo "selected"; } ?>>9</option>
<option value="10" <?php if($child=='10') { echo "selected"; } ?>>10</option>
</select>

</span>
</div>
</div>


<div class="column-pricing">
<h3>PRICING</h3>
<div class="row">
<span class="label">Gross Amount ($)</span>
<span class="value"><input type="text" class="form-control" name="grossamount" id="grossamount" value="<?php echo $g_amount!="" ? sprintf("%0.2f",@$g_amount): "" ;?>" onblur="calculation()"></span>
</div>
<?php if($pets_fee){ ?>
<div class="row">
<span class="label">Cleaning Fee ($)</span>
<span class="value"><input type="text" class="form-control"  name="pet_fee"  id="pet_fee" value="<?php echo $clean?sprintf("%0.2f",$clean):"" ;?>" onblur="calculation()"></span>
</div>
<?php } ?>
<?php if($clean){ ?>
<div class="row">
<span class="label">Pet Fee ($)</span>
<span class="value"><input type="text" class="form-control"  onblur="calculation()" name="cleaning_fee" name="pet_fee" id="cleaning_fee" value="<?php echo $clean?sprintf("%0.2f",$clean):"" ;?>"></span>
</div>
<?php } ?>
<div class="row">
<span class="label">Taxes (<?php echo $taxper; ?>%)</span>
<span class="value"><input type="text" class="form-control" name="taxamount" id="taxamount" value="<?php echo $taxamount?sprintf("%0.2f",$taxamount):"" ;?>" onblur="calculation()"></span>
</div>
<div class="row">
<span class="label">Security Deposit ($)</span>
<span class="value"><input type="text" class="form-control" name="refundamount" id="refundamount" value="<?php echo $refund?sprintf("%0.2f",$refund):"" ;?>" onblur="calculation()"></span>
</div>

<div class="row">
<span class="label">Extra </span>
<span class="value"><input type="text" class="form-control" name="extraname" id="extraname" placeholder="Name" value="<?php echo $showextraname;?>"></span>
</div>

<div class="row"> 
<span class="label">Extra ($)</span>
<span class="value"><input type="text" class="form-control" name="extraamount" id="extraamount" placeholder="Amount" value="<?php echo $showextraamount;?>" onblur="calculation()"></span>
</div>


<div class="row">
<span class="label" style="color:black;">Subtotal</span>
<span class="value" style="font-weight:bold;">
<input type="text" class="form-control" name="subtotal" id="subtotal" value="<?php echo sprintf("%0.2f",@$tot_amt);?>"></span>
</div>

</div>

</section>

<section class="booking-info-total">
<span class="label">Total Owed</span>
<span class="value">
<input type="text" class="form-control" name="subtotal" id="subtotal1" value="<?php echo sprintf("%0.2f",@$tot_amt);?>"></span>
</section>

</div>



</div>
</div>
</div>
</div>
</form>

<?php 
$dateslistselect1[]='';
$queryres = mysqli_query($conn, "SELECT start_date,end_date FROM ".$ical_events." WHERE event_pid='".$property_id."'") or die(mysqli_error($conn));
while($rowmm = mysqli_fetch_array($queryres))
{

$startmm = strtotime($rowmm['start_date']);
$endmm = strtotime($rowmm['end_date'].'-1 day');
for ($i1=$startmm; $i1<=$endmm; $i1+=86400) { 
$dateslistselect1[]= '"'.date('d-m-Y',$i1).'"';   
}
}
$dateslistselect1=array_filter($dateslistselect1);
$totaldayslist =implode(", ", $dateslistselect1);
?>





</div>
</section>

</div>
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script>



<!--
<script>
$(document).ready(function(e) {
$( "#checkin" ).datepicker();
$( "#checkout" ).datepicker();
$( ".form-control" ).datepicker( "option", "dateFormat", 'yy-mm-dd' );
})
</script>
-->

<script>

var disableddates = [<?php echo $totaldayslist; ?>];
 
function DisableSpecificDates(date) {
   var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
   return [disableddates.indexOf(string) == -1];
}



$(function() {
	
var disableddates = [<?php echo $totaldayslist; ?>];		
	
$("#checkin").datepicker({
beforeShowDay: DisableSpecificDates,	
minDate: 0 ,
changeMonth: true,
dateFormat: 'yy-mm-dd',
numberOfMonths: 1,
onClose: function( selectedDate ) {
$("#checkout").datepicker( "option", "minDate", selectedDate );
}
});
$("#checkout").datepicker({
beforeShowDay: DisableSpecificDates,	
dateFormat: 'yy-mm-dd',
changeMonth: true,
numberOfMonths: 1,
onClose: function( selectedDate ) {
$("#checkin").datepicker( "option", "maxDate", selectedDate );
}
});
});
</script>

<script>
function paymentcalculation() { 
var checkindata = document.getElementById("checkin").value;
var checkoutdata = document.getElementById("checkout").value;
var product_id = document.getElementById("property_id").value;

$.ajax({
method: "POST",
url: "datashow.php",
cache: false,
data: {'checkin': checkindata ,'checkout':checkoutdata,'procheckid':product_id}
//data: $("div#myform :input").serializeArray()
})

.done(function( msg ) {
	
var msg2 = msg.trim();
var catt =  msg.trim();	
	
var ct = catt.split('|');

document.getElementById("subtotal1").value = ct[0];
document.getElementById("subtotal").value = ct[0];
document.getElementById("nightshow").value = ct[1];
document.getElementById("grossamount").value = ct[2];
document.getElementById("cleaning_fee").value = ct[3];;
document.getElementById("refundamount").value = ct[5];;
document.getElementById("taxamount").value = ct[4];;

})

}

</script>

<script>
function calculation() { 

var grossamount = document.getElementById("grossamount").value;
var cleaning_fee = document.getElementById("cleaning_fee").value;
var taxamount = document.getElementById("taxamount").value;
var refundamount = document.getElementById("refundamount").value;
var extraamount = document.getElementById("extraamount").value;

if(grossamount=='') {
var grossamount='0';	
} else {
var grossamount=grossamount;	
}

if(cleaning_fee=='') {
var cleaning_fee='0';	
} else {
var cleaning_fee=cleaning_fee;	
}

if(taxamount=='') {
var taxamount='0';	
} else {
var taxamount=taxamount;	
}

if(refundamount=='') {
var refundamount='0';	
} else {
var refundamount=refundamount;	
}

if(extraamount=='') {
var extraamount='0';	
} else {
var extraamount=extraamount;	
}

var totalval = +grossamount + +cleaning_fee + +taxamount + +refundamount + +extraamount;
document.getElementById("subtotal1").value = totalval;
document.getElementById("subtotal").value = totalval;

}
</script>




</body>
</html>
<?php
if(isset($_POST['contact_submit']))
{
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
$admin_id=test_input($_SESSION['admin_id']);
$contact_name=test_input($_POST['contact_name']);
$contact_email=test_input($_POST['contact_email']);
$contact_email1=test_input($_POST['contact_email1']);
$contact_phone=test_input($_POST['contact_phone']);
$contact_addr=$_POST['contact_addr'];
$contact_check_addr=$_POST['contact_check_addr'];
$contact_content=test_input($_POST['contact_content']);
$map_longitude=test_input($_POST['map_longitude']);
$map_latitude=test_input($_POST['map_latitude']);
$ip = getClientIP();

$insert = mysqli_query($conn,"SELECT * FROM ".$contact_details." WHERE admin_id=$admin_id");
$row = mysqli_num_rows($insert);

if($row==0)
{

$insert = mysqli_query($conn,"INSERT into ".$contact_details."(admin_id,contact_name,contact_email,contact_email1,	contact_phone,contact_addr,contact_check_addr,contact_content,map_longitude,map_latitude,contact_det_insert_date,contact_det_ip) VALUES('".$admin_id."','".$contact_name."','".$contact_email."','".$contact_email1."','".$contact_phone."','".$contact_addr."','".$contact_check_addr."','".$contact_content."','".$map_longitude."','".$map_latitude."', now() ,'".$ip."')");

if($insert)
{
echo "<script>alert('Inserted Successfully.');</script>";
?>
<script>
window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
</script>
<?php
}
}
if($row>0)
{
while($loop = mysqli_fetch_assoc($insert))
{
$update = mysqli_query($conn,"UPDATE ".$contact_details." SET contact_name='".$contact_name."', contact_email='".$contact_email."', contact_email1='".$contact_email1."', contact_phone='".$contact_phone."', contact_addr='".$contact_addr."',contact_check_addr='".$contact_check_addr."', contact_content='".$contact_content."', map_longitude='".$map_longitude."', map_latitude='".$map_latitude."', contact_det_update_date=now() , contact_det_ip='".$ip."' WHERE contact_id='".$loop['contact_id']."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
}
if($update)
{
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