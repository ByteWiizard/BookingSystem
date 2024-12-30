<?php include_once('session_destroy.php');
include("include/db.php");
$property_default_rates = "lhk_property_default_rates";
$ical_events = "lhk_ical_events";
$property_new_rates = "lhk_property_new_rates";
$property_details = "lhk_property_details";
$files = "lhk_files";
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
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

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

<div class="content-wrapper">
<section class="content-header">
<h1> Quotation Details <small>Update your Quotation Details</small> </h1>

<?php
$property_id = $_POST['property_id'];
$redirect = 'quotation.php?id='.$_POST['booking_id'];
if(isset($_POST['submit_data'])){ 

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];	

$guest = test_input($_POST['guest']);
$child = test_input($_POST['child']);

if($child==''){
$child='0';	
} else {
$child=test_input($_POST['child']);	
}

$booking_id = test_input($_POST['booking_id']);
$pro_id = test_input($_POST['property_id']);	
$prop_name = test_input($_POST['prop_name']);
$request_id = test_input($_POST['request_id']);

$fetch1 = mysqli_query($conn,"SELECT * FROM ".$property_default_rates." ");
$num1 = mysqli_num_rows($fetch1);
$show1 = mysqli_fetch_assoc($fetch1);		
$cleaning=$show1['pro_cleaning_fee'];		
$refund=$show1['pro_refundable_amt'];
$tax=$show1['pro_tax_fee'];		
$pet =$show1['pets_fee'];	
$guests = $guest;

$fname = test_input($_POST['fname']);
$lname = test_input($_POST['lname']);
$cust_email = test_input($_POST['cust_email']);
$cust_phone = test_input($_POST['cust_phone']);
$special_requests = test_input($_POST['special_requests']);



$showgrossamount = test_input($_POST['grossamount']);
$showcleaning_fee = test_input($_POST['cleaning_fee']);
$showpet_fee = test_input($_POST['pet_fee']);
$showtaxamount = test_input($_POST['taxamount']);
$showrefundamount = test_input($_POST['refundamount']);
$showsubtotal = test_input($_POST['subtotal']);
$showextraname = test_input($_POST['extraname']);
$showextraamount = test_input($_POST['extraamount']);


?>


<?php
$todaysDate = date("Y-m-d");
$datetime = DateTime::createFromFormat('Y-m-d', $checkin);
$wekend = $datetime->format('D');
if(isset($pro_id))
{
$date1 = $checkin;
$date2 = $checkout;
$referer = $_SERVER['HTTP_REFERER'];
function returnDates($fromdate, $todate){
$fromdate = \DateTime::createFromFormat('Y-m-d', $fromdate);
$todate = \DateTime::createFromFormat('Y-m-d', $todate);
return new \DatePeriod(
$fromdate,
new \DateInterval('P1D'),
@$todate->modify('+1 day')
);
}
$datePeriod = returnDates($date1, $date2);
foreach($datePeriod as $date) {
$ad1[] = $date->format('Y-m-d');
}

array_pop($ad1);

$sel12 = mysqli_query($conn, "SELECT * FROM ".$ical_events." WHERE end_date <= '".$date2."' AND start_date >= '".$date1."' AND event_pid='".$pro_id."'");
$row=mysqli_num_rows($sel12);

if($row>0)
{
echo "<script>alert('Some dates are already booked,Choose available dates only.');</script>";
echo "<script>window.location='$redirect'</script>";
}
$day_a = count($ad1)+1 ;
$total_nights = count($ad1);
if($day_a<2)
{
echo "<script>alert('Please select minimum 2 days.')</script>";
$referer = $_SERVER['HTTP_REFERER'];
echo "<script>window.location='$redirect'</script>";
}

$offer = returnDates($todaysDate,$checkin);
foreach($offer as $off) {
$op[] = $off->format('Y-m-d');
}
$day_bef = count($op) ;
$sel1234 = mysqli_query($conn, "SELECT * FROM ".$property_new_rates." WHERE property_id='".$pro_id."'");
while($a = mysqli_fetch_assoc($sel1234))
{
$b=array();	
$b[] = $a;
$c = count($b);
}

for($i=0; $i<$c; $i++)
{
$dat[] = array($b[$i]['pro_new_rate_sdate'], $b[$i]['pro_new_rate_edate'], $b[$i]['pro_new_rate_week_nt'], $b[$i]['pro_new_rate_weekend_nt'], $b[$i]['pro_new_rate_weekly_nt'], $b[$i]['pro_new_rate_monthly']);
$from = trim($dat[$i][0]);
$to = trim($dat[$i][1]);
$one_night = trim($dat[$i][2]);
$weekend = trim($dat[$i][3]);
$weekly =  trim($dat[$i][4]);
$monthly = trim($dat[$i][5]);

if(($from!="")&&($to!=""))
{
$datePeriod1 = returnDates($from, $to);
foreach($datePeriod1 as $date1)
{
@$ad[$i][] = $date1->format('Y-m-d');
}
}

@$result = array_intersect($ad[$i], $ad1);
@$k1[$i]=count($result);

@$result1 = array_intersect($result, $ad[$i]);

$rateres[] = $result1;

}

@$as = array_filter($rateres);

if(empty($as))
{
$as = $ad1;
}

if(!empty($as)){
foreach($as as $key=>$val)
{
$ke[] = $key;
$valu[] = $val;
}

foreach($valu as $vall)
{
$valll = $vall;
}


$array  = @$as ;

$result = array_flatten($array);

@$last_mat = count($result);

foreach($result as $valu)
{
$ids = "";
$night_rate = "";
$tot_rate = "";
$month_rate = "";
$week_rate = "";
$sql = mysqli_query($conn, "SELECT * FROM ".$property_new_rates." where '$valu' between pro_new_rate_sdate and pro_new_rate_edate ");
$sk = mysqli_num_rows($sql);


if ($sk > 0) {
$dat = @mysqli_fetch_assoc($sql) ;
$a = trim($dat['pro_new_rate_id']);
$ddd[$valu] = $a ;
$ids[] = trim($dat['pro_new_rate_id']);
$dating = $valu;
$datetime = DateTime::createFromFormat('Y-m-d', $valu);
$wekend = trim($datetime->format('D'));
$one_night = trim($dat['pro_new_rate_week_nt']);
$weekend = trim($dat['pro_new_rate_weekend_nt']);
$weekend_day = trim($dat['pro_new_rate_weekend_day']);
$weekly =  trim($dat['pro_new_rate_weekly_nt']);
$monthly = trim($dat['pro_new_rate_monthly']);
if($total_nights>=30)
{
if($monthly!="")
{
$one_rate = $monthly/30;
}
elseif($weekly!="")
{
$one_rate = $weekly/7;
}
elseif($weekend!="")
{
if($weekend_day==3){
if(($wekend==="Fri")||($wekend==="Sat")||($wekend==="Sun"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
else{
if(($wekend==="Fri")||($wekend==="Sat"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
}
else
{
$one_rate = $one_night/1;
}
}

elseif($total_nights>=7)
{
if($weekly!="")
{
$one_rate = $weekly/7;
}
elseif($weekend!="")
{
if($weekend_day==3){
if(($wekend==="Fri")||($wekend==="Sat")||($wekend==="Sun"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
else{
if(($wekend==="Fri")||($wekend==="Sat"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
}
else
{
$one_rate = $one_night/1;
}
}

elseif($total_nights<=6)
{
if($weekend!="")
{
if($weekend_day==3){
if(($wekend==="Fri")||($wekend==="Sat")||($wekend==="Sun"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
else{
if(($wekend==="Fri")||($wekend==="Sat"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
}
else
{
$one_rate = $one_night/1;
}
}

$tot_rate = $one_rate;
$rate_array[] = $tot_rate;
$total_date[] = $dating;


}
else
{

$minn = count($result);	
$sel12 = mysqli_query($conn, "SELECT * FROM ".$property_new_rates." WHERE pro_new_rate_sdate='0000-00-00' AND pro_new_rate_edate='0000-00-00' AND property_id='".$pro_id."' ");
$co = mysqli_num_rows($sel12);
$dat = @mysqli_fetch_assoc($sel12) ;
$mini_stay = trim($dat['pro_new_rate_min_stay']);
if($co == 0)
{
echo "<script>alert('Rates of some dates you have selected is not available,because standard rate is not defined.')</script>";
echo "<script>window.location='$redirect'</script>";	
}
elseif($mini_stay>$minn)
{
echo "<script>alert('Minimum stay criteria of standard rate is not satisfied,please select the dates which have satisfied the minimum stay criteria.')    </script>";
echo "<script>window.location='$redirect'</script>";
}
else{

$a = trim($dat['pro_new_rate_id']);
$ddd[$valu] = $a ;
$ids[] = trim($dat['pro_new_rate_id']);
$datetime = DateTime::createFromFormat('Y-m-d', $valu);
$wekend = trim($datetime->format('D'));
$one_night = trim($dat['pro_new_rate_week_nt']);
$weekend = trim($dat['pro_new_rate_weekend_nt']);
$weekly =  trim($dat['pro_new_rate_weekly_nt']);
$monthly = trim($dat['pro_new_rate_monthly']);	
if(($total_nights>=30)&&($minn>=30))
{
if($monthly!="")
{
$one_rate = $monthly/30;
}
elseif($weekly!="")
{
$one_rate = $weekly/7;
}
elseif($weekend!="")
{
if($weekend_day==3){
if(($wekend==="Fri")||($wekend==="Sat")||($wekend==="Sun"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
else{
if(($wekend==="Fri")||($wekend==="Sat"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
}
else
{
$one_rate = $one_night/1;
}
}

elseif(($total_nights>=7)&&($minn>=7))
{
if($weekly!="")
{
$one_rate = $weekly/7;
}
elseif($weekend!="")
{
if($weekend_day==3){
if(($wekend==="Fri")||($wekend==="Sat")||($wekend==="Sun"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
else{
if(($wekend==="Fri")||($wekend==="Sat"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
}
else
{
$one_rate = $one_night/1;
}
}

elseif(($total_nights<=6)&&($minn<=6))
{
if($weekend!="")
{
if($weekend_day==3){
if(($wekend==="Fri")||($wekend==="Sat")||($wekend==="Sun"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
else{
if(($wekend==="Fri")||($wekend==="Sat"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
}
else
{
$one_rate = $one_night/1;
}
}
$tot_rate = $one_rate;
$rate_array[] = $tot_rate;
}
}
}






if(!empty($total_date))
{
$arr_diff = array_diff($ad1,$total_date);
}
else
{
$arr_diff = $ad1;
}
$checking_night = $total_nights - $last_mat ;
$rate_array1 = "";
$ddd1 = "";
$ids1 = "";
if($checking_night>0)
{
foreach($arr_diff as $vall)
{
$sel1 = mysqli_query($conn, "SELECT * FROM ".$property_new_rates." WHERE pro_new_rate_sdate='0000-00-00' AND pro_new_rate_edate='0000-00-00' AND property_id='".$pro_id."' ");
$co = mysqli_num_rows($sel1);
$dat = @mysqli_fetch_assoc($sel1) ;
$mini_stay = trim($dat['pro_new_rate_min_stay']);
if($co == 0)
{
echo "<script>alert('Rates of some dates you have selected is not available,because standard rate is not defined.')</script>";
echo "<script>window.location='$redirect'</script>";	
}
elseif($mini_stay>$checking_night)
{
echo "<script>alert('Minimum stay criteria of standard rate is not satisfied,please select the dates which have satisfied the minimum stay criteria.')    </script>";
echo "<script>window.location='$redirect'</script>";
}
else{
$a = trim($dat['pro_new_rate_id']);
$ddd1[$valu] = $a ;
$ids1[] = trim($dat['pro_new_rate_id']);
$datetime1 = DateTime::createFromFormat('Y-m-d', $vall);
$wekend = trim($datetime1->format('D'));
$one_night = trim($dat['pro_new_rate_week_nt']);
$weekend = trim($dat['pro_new_rate_weekend_nt']);
$weekly =  trim($dat['pro_new_rate_weekly_nt']);
$monthly = trim($dat['pro_new_rate_monthly']);	
if(($total_nights>=30)&&($checking_night>=30))
{
if($monthly!="")
{
$one_rate = $monthly/30;
}
elseif($weekly!="")
{
$one_rate = $weekly/7;
}
elseif($weekend!="")
{
if($weekend_day==3){
if(($wekend==="Fri")||($wekend==="Sat")||($wekend==="Sun"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}	
else{
if(($wekend==="Fri")||($wekend==="Sat"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
}
else
{
$one_rate = $one_night/1;
}
}
elseif(($total_nights>=7)&&($checking_night>=7))
{
if($weekly!="")
{
$one_rate = $weekly/7;
}
elseif($weekend!="")
{
if($weekend_day==3){
if(($wekend==="Fri")||($wekend==="Sat")||($wekend==="Sun"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
else{
if(($wekend==="Fri")||($wekend==="Sat"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
}
else
{
$one_rate = $one_night/1;
}
}
elseif(($total_nights<=6)&&($checking_night<=6))
{
if($weekend!="")
{
if($weekend_day==3){
if(($wekend==="Fri")||($wekend==="Sat")||($wekend==="Sun"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
else{
if(($wekend==="Fri")||($wekend==="Sat"))
{ 
$one_rate = $weekend/1;
}
else
{
$one_rate = $one_night/1;
}
}
}
else
{
$one_rate = $one_night/1;
}
}
$tot_rate1 = $one_rate;
$rate_array1[] = $tot_rate1;
}

}
}

if(!empty($rate_array))
{
$sum1 = array_sum($rate_array);
}
else
{
$sum1 = 0 ;
}
if(!empty($rate_array1))
{
$sum2 = array_sum($rate_array1);
}
else
{
$sum2 = 0 ;
}
$check_min_stay = array_count_values($ddd);
// if(!empty($check_min_stay))
// {
// foreach($check_min_stay as $key1=>$valu1)
// {
// $sel15 = mysqli_query($conn, "SELECT pro_new_rate_min_stay FROM `property_new_rates` WHERE property_id='".$pro_id."' AND pro_new_rate_min_stay<='".$valu1."' AND pro_new_rate_id='".$key1."'");
// $run5 = @mysqli_num_rows($sel15);
// if($run5==0)
// {
// echo "<script>alert('Minimum stay criteria is not satisfied,please select the dates which have satisfied the minimum stay criteria.') </script>";
// echo "<script>window.location='$redirect'</script>";
// }
// }
// }


$pets_fee =0;
$refund =0;
$taxv =0;
$cleen_fee =0;
$sel11 = mysqli_query($conn, "SELECT * FROM ".$property_default_rates." WHERE property_id='".$pro_id."' ");
$run1 = mysqli_fetch_assoc($sel11);

$refund = $run1['pro_refundable_amt'];
$taxv = $run1['add_fees'];
/*if($pets){ $pets_fee = $run1['pets_fee']; }*/
$cleen_fee = $run1['pro_def_rate_rates'];

// $per_day = $rate/$day_a;
// $rate1 = $rate-$per_day;
// $rate = round($rate1, 2);
// $tot = $rate ;


$totaling = $sum1 + $sum2 ;
$refund = $refund;
$tax = ($totaling * $taxv)/100 ;
$total = $totaling + $tax + $refund + $cleen_fee;


foreach($ke as $ke1){
$sel1 = mysqli_query($conn, "SELECT * FROM ".$property_new_rates." WHERE property_id='".$pro_id."' LIMIT 1 OFFSET $ke1");
$run = @mysqli_fetch_assoc($sel1);
$sdate = $run['pro_new_rate_sdate'];
$edate = $run['pro_new_rate_edate'];
$k = $run['pro_new_rate_min_stay'];
}
$minimum_night = $k;
foreach($as as $q)
{
@$num_of_night += count($q);
}
if(($last_mat < $minimum_night)&&($num_of_night!="")){
echo "<script>alert('Minimum stay criteria is not followed.')</script>";
echo "<script>window.location='$redirect'</script>";
}
}
else
{
}// end else

?>
<?php
if($day_a>=31)
{
if($run['pro_new_rate_monthly']!=""){
$r = $run['pro_new_rate_monthly'];
$apply_rate = "Monthly Rate";

}
elseif($run['pro_new_rate_weekly_nt']!=""){
$r = $run['pro_new_rate_weekly_nt'];
$apply_rate = "Weekly Rate";
}
elseif(($run['pro_new_rate_weekend_nt']!="")&&($wekend=="Sat"||$wekend=="Fri"))
{
$r = $run['pro_new_rate_weekend_nt'];
$apply_rate = "Weekend Rate";


}
elseif($run['pro_new_rate_week_nt']!="")
{
$r = $run['pro_new_rate_week_nt'];
$apply_rate = "Nightly Rate";
}

}
elseif($day_a>=8)
{
if($run['pro_new_rate_weekly_nt']!=""){
$r = $run['pro_new_rate_weekly_nt'];
$apply_rate = "Weekly Rate";

}
elseif(($run['pro_new_rate_weekend_nt']!="")&&($wekend=="Sat"||$wekend=="Fri"))
{
$r = $run['pro_new_rate_weekend_nt'];
$apply_rate = "Weekend Rate";
}
elseif($run['pro_new_rate_week_nt']!="")
{
$r = $run['pro_new_rate_week_nt'];
$apply_rate = "Nightly Rate";

}
}
elseif(($day_a>=3))
{
if(($run['pro_new_rate_weekend_nt']!="")&&($wekend=="Sat"||$wekend=="Fri"))
{
$r = $run['pro_new_rate_weekend_nt'];
$apply_rate = "Weekend Rate";
}
elseif($run['pro_new_rate_week_nt']!="")
{ 
$r = $run['pro_new_rate_week_nt'];
$apply_rate = "Nightly Rate";
}

}

elseif(($day_a==2)&&($wekend=="Sat"||$wekend=="Fri"))
{
$r = $run['pro_new_rate_weekend_nt'];
$apply_rate = "Weekend Rate";
}
elseif($day_a==2)
{
$r = $run['pro_new_rate_week_nt'];
$apply_rate = "Nightly Rate";
}

?>

<?php
$datein=date_create_from_format("Y-m-d",$checkin);
$firstdate = date_format($datein,"jS F, Y");
$dateout=date_create_from_format("Y-m-d",$checkout);
$lastdate = date_format($dateout,"jS F, Y");
?>


<div class="pd-topBottom">


<form method="post"  action="bookquote.php" id="form_list" onsubmit="return checkCheckBoxes(this);">
<div class="content_bottom">
<div class="propertyp">
<div class="row">
<h1 class="pheading">Your Booking Information</h1>
<div class="col-md-8">
<section>
<h1>Traveler Information</h1>
<div class="form">
<input name="checkin" type="hidden" value="<?php echo $firstdate ; ?>" >
<input name="checkout" type="hidden" value="<?php echo $lastdate ; ?>" >
<input name="startdate" type="hidden" value="<?php echo $checkin ; ?>" >
<input name="enddate" type="hidden" value="<?php echo $checkout ; ?>" >
<input name="booking_id" type="hidden" value="<?php echo $booking_id ; ?>" >

<input name="admin_id" type="hidden" value="1" >
<input name="totalamount" type="hidden" value="<?php echo $showsubtotal; ?>" >            
<input name="totalnight" type="hidden" value="<?php echo @$total_nights ;?>" >
<input name="item_number" type="hidden" value="<?php echo @$request_id ;?>">
<input name="no_of_guests" type="hidden" value="<?php echo $guests ;?>">
<input id="pro_id" type="hidden" name="pro_id" value="<?php echo $pro_id ;?>"/>
<input id="prop_name" type="hidden" name="prop_name" value="<?php echo $prop_name ;?>"/>
<input id="apply_rate" type="hidden" name="apply_rate" value="<?php echo $apply_rate ;?>"/>
<input id="apply_rate_price" type="hidden" name="apply_rate_price" value="<?php echo $r!="" ? "$".number_format(@$r,2): "" ;?>"/>
<input id="min_stay" type="hidden" name="min_stay" value="<?php echo @$minimum_night ;?>"/>
<input id="g_amount" type="hidden" name="g_amount" value="<?php echo $showgrossamount; ?>"/>
<input type="hidden" id="clean_fee" name="clean_fee" value="<?php echo $showcleaning_fee; ?>" />
<input type="hidden" id="refund" name="refund" value="<?php echo $showrefundamount; ?>" />
<input id="taxv" type="hidden" name="taxv" value="<?php echo $taxv ?>"/>
<input id="tax" type="hidden" name="tax" value="<?php echo $showtaxamount; ?>"/>
<input id="child" type="hidden" name="child" value="<?php echo $child ?>"/>
<input id="pets_fee" type="hidden" name="pets_fee" value="<?php echo $showpet_fee; ?>"/>

<input id="showextraname" type="hidden" name="showextraname" value="<?php echo $showextraname ?>"/>
<input id="showextraamount" type="hidden" name="showextraamount" value="<?php echo $showextraamount ?>"/>


<fieldset>
<div class="col-md-6 half">
<label for="fname">First Name <span style="color:red;">*</span></label>
<input type="text" id="fname" name="fname" value="<?php echo $fname; ?>" required/>
</div>
<div class="col-md-6 half">
<label for="fname">Last Name <span style="color:red;">*</span></label>
<input type="text" id="lname" name="lname" value="<?php echo $lname; ?>" required/>
</div>
<div class="col-md-6 half">
<label for="email">Email <span style="color:red;">*</span></label>
<input type="text" id="cust_email" name="cust_email" value="<?php echo $cust_email; ?>" required/>
</div>
<div class="col-md-6 half">
<label for="phone">Phone No. <span style="color:red;">*</span></label>
<input type="text" id="cust_phone" name="cust_phone" value="<?php echo $cust_phone; ?>" required/>
</div>
<div class="clearfix"></div>
</fieldset>
</div>
</section>

<section>
<h1>VACATION RENTAL AGREEMENT</h1>
<div class="form">
<fieldset>
<embed src="../agreement/Windcilff-Rental-Agreement.pdf" type="application/pdf" style="width: 100%;height: 300px;"></embed>
<div class="col-md-12">
<div class="col-md-6">
<input type="checkbox" name="acc_Agreement" value="" checked="checked" required>
&nbsp;I have read and agree to these terms. </div>
</div>
</fieldset>
</div>
</section>


<section>
<h1>Special Requests</h1>
<div class="form">
<fieldset>
<div class="col-md-12">
<textarea placeholder="Leave a special request." name="special_requests" class="fsvr_special_requests" maxlength="2048" style="resize:none; height:300px;"><?php echo $special_requests; ?></textarea>
</div>
</fieldset>
</section>

<div align="center">
<input type="submit" name="submit_data" value="Send Quote" class="btn btn-transparent blue">
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
<span class="value"><?php echo $firstdate ;?></span>
</div>
<div class="row">
<span class="label">Check Out</span>
<span class="value"><?php echo  $lastdate ;?></span>
</div>
<div class="row">
<span class="label">Nights</span>
<span class="value"><?php echo @$total_nights ;?></span>
</div>
<div class="row">
<span class="label">Number of Guests</span>
<span class="value"><?php echo @$guests ;?></span>
</div>
<?php if($minimum_night){ ?>
<div class="row">
<span class="label">Min Stay</span>
<span class="value"><?php echo @$minimum_night;?></span>
</div>
<?php } ?>
<?php 
if($child!='0') { ?>
<div class="row">
<span class="label">Children</span>
<span class="value"><?php echo @$child; ?></span>
</div>
<?php } ?>
</div>
<div class="column-pricing">
<h3>  PRICING</h3>
<div class="row">
<span class="label">Gross Amount</span>
<span class="value">$<?php echo @$showgrossamount;?></span>
</div>

<?php if($showcleaning_fee){ ?>
<div class="row">
<span class="label">Pet Fee </span>
<span class="value">$<?php echo $showcleaning_fee;?></span>
</div>
 <?php } ?>
<div class="row">
<span class="label">Taxes(<?php echo $taxv; ?>%)</span>
<span class="value">$<?php echo $showtaxamount;?></span>
</div>
<div class="row">
<span class="label">Refundable Security Deposit</span>
<span class="value">($<?php echo $showrefundamount;?>)</span>
</div>

<?php if($showextraname!='' && $showextraamount!='') { ?>
<div class="row">
<span class="label"><?php echo $showextraname; ?></span>
<span class="value">$<?php echo $showextraamount; ?></span>
</div>
<?php }  ?>


<div class="row">
<span class="label" style="color:black;">Subtotal</span>
<span class="value" style="font-weight:bold;">$<?php echo $showsubtotal;?></span>
</div>

</div>
</section>
<section class="booking-info-total">
<span class="label">Total Owed</span>
<span class="value">$<?php echo $showsubtotal;?></span>
</section>

</div>



</div>
</div>
</div>
</div>
</form>


<?php 
}
}else{
echo "<script>window.location='$redirect'</script>";
}
?>


</div>
</section>

</div>
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script>
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