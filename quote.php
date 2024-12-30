<?php  session_start();?>
<?php error_reporting(0); ?>
<!doctype html>
<html lang="en">
<head>
<meta name="" content="text/html" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vancouver Furnished Rental</title>


<meta name="robots" content="index,follow">
<meta name="geo.region" content="US-FL" /> 
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<?php include("header.php"); ?>
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="css/responsive.css" rel="stylesheet">
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->

<!-- fotorama.css & fotorama.js. -->
<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
<style type="text/css">
/**
 * Override feedback icon position
 * See http://formvalidation.io/examples/adjusting-feedback-icon-position/
 */
#dateRangeForm .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>


<style>
.go-to-site {
color:#9F8531;
text-align:center;
text-decoration:underline;

}
.go-to-site a{
color:#9F8531;
text-align:center;
text-decoration:underline;

}
.go-to-site a:hover{
color:#0082B5;
text-decoration:none;

}
.go-to-site:hover{
color:#0082B5;
text-decoration:none;

}
</style>
<style>

.quot {
text-align:center;
}

.pay{
text-align:left;
}

/*Responsive Table*/


.responsive-table {
	width: 100%;
	margin-bottom: 1.5em;
}

@media (min-width: 44em) {
.responsive-table {
	font-size: .9em;
}
}

@media (min-width: 62em) {
.responsive-table {
	font-size: 1em;
}
}
.responsive-table thead {
	position: absolute;
	clip: rect(1px 1px 1px 1px);
	/* IE6, IE7 */
	clip: rect(1px, 1px, 1px, 1px);
	padding: 0;
	border: 0;
	height: 1px;
	width: 1px;
	overflow: hidden;
}

@media (min-width: 44em) {
.responsive-table thead {
	position: relative;
	clip: auto;
	height: auto;
	width: auto;
	overflow: auto;
}
}
.responsive-table thead th {
	background-color: #6F839C;
	border: 1px solid #6F839C;
	font-weight: normal;
	text-align: center !important;
	color: white;
	font-size: 16px;
}
.responsive-table thead th:first-of-type {
	text-align: left;
}
.responsive-table tbody, .responsive-table tr, .responsive-table th, .responsive-table td {
	display: block;
	padding: 0;
	text-align: left;
	white-space: normal;
}

@media (min-width: 44em) {
.responsive-table tr {
	display: table-row;
}
}
.responsive-table th, .responsive-table td {
	padding: .5em;
	vertical-align: middle;
}

@media (min-width: 30em) {
.responsive-table th,  .responsive-table td {
	padding: .75em .5em;
}
}

@media (min-width: 44em) {
.responsive-table th,  .responsive-table td {
	display: table-cell;
	padding: .5em;
}
}

@media (min-width: 62em) {
.responsive-table th,  .responsive-table td {
	padding: .75em .5em;
}
}

@media (min-width: 75em) {
.responsive-table th,  .responsive-table td {
	padding: .75em;
}
}
.responsive-table caption {
	margin-bottom: 1em;
	font-size: 1em;
	font-weight: bold;
	text-align: center;
}

@media (min-width: 44em) {
.responsive-table caption {
	font-size: 1.5em;
}
}
.responsive-table tfoot {
	font-size: .8em;
	font-style: italic;
}

@media (min-width: 62em) {
.responsive-table tfoot {
	font-size: .9em;
}
}

@media (min-width: 44em) {
.responsive-table tbody {
	display: table-row-group;
}
}
.responsive-table tbody tr {
	margin-bottom: 1em;
	border: 2px solid #21A171;
}

@media (min-width: 44em) {
.responsive-table tbody tr {
	display: table-row;
	border-width: 1px;
}
}
.responsive-table tbody tr:last-of-type {
	margin-bottom: 0;
}

@media (min-width: 44em) {
.responsive-table tbody tr:nth-of-type(even) {
	background-color: rgba(94, 93, 82, 0.1);
}
}
.responsive-table tbody th[scope="row"] {
	background-color: #ff5203;
	color: white;
}

@media (min-width: 44em) {
.responsive-table tbody th[scope="row"] {
	background-color: #fff;
	color: #000;
	text-align: left;
}
}
.responsive-table tbody td {
    text-align: right;
    border-bottom: 1px solid #21A171;
    background: #fff;
}

@media (min-width: 30em) {
.responsive-table tbody td {
	border-bottom: 1px solid #21A171;
}
}

@media (min-width: 44em) {
.responsive-table tbody td {
	text-align: center;
	background: #fff;
	font-weight: bold;
	font-size: 15px;
	border-left: 1px solid #21A171;
padding:8px;
}
}
.responsive-table tbody td[data-type=currency] {
	text-align: center;
}
.responsive-table tbody td[data-title]:before {
	content: attr(data-title);
	float: left;
	font-size: .8em;
	color: #000;
	font-weight: bold;
}

@media (min-width: 30em) {
.responsive-table tbody td[data-title]:before {
	font-size: .9em;
}
}

@media (min-width: 44em) {
.responsive-table tbody td[data-title]:before {
	content: none;
}
}


.enq_form  input[type="text"], input[type="button"], input[type="submit"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
       border: none;
    width: 90%;
    height: 32px;
    padding: 5px;
    margin: 2px;
    text-align:left;
}


.enq_form textarea{
	width: 100%;
	border: 1px solid #ccc;
}

.enq_form select{
width: 100%;
border: 1px solid #ccc;
height: 31px;
padding: 0px;
margin-top: 2px;
margin-bottom: 6px;
}


#butt {
    line-height: 9px;
    width: 230px;
    font-weight: bold;
    padding-top: 20px;
    font-size: 16px;
    border: 1px solid #ccc;
    box-shadow: 0px 0px 0px 3px #fff;
    padding-bottom: 27px;
    background:rgb(216, 162, 1);
    color: #333;
	text-align: center;
}


@media (max-width:768px){

.enq_form  input[type="text"], input[type="button"], input[type="submit"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
       border: none;
    width: 90%;
    height: 32px;
    padding: 5px;
    margin: 2px;
    text-align:right;
}
.pay {
    text-align: center;
}
.quot {
    text-align: center;
}
}


	</style>


</head>
<body>

<?php include("menu.php"); ?> 
    <section id="content" >
<?php

//print_r($_POST);die();
				if(isset($_POST['book-sub']))
                                   {

						function test_input($data) {
						  $data = trim($data);
						  $data = stripslashes($data);
						  $data = htmlspecialchars($data);
						  return $data;
						}
						$checkin = test_input($_POST['first']);
						$checkout = test_input($_POST['last']);
						$name = test_input($_POST['name']);
						$email = test_input($_POST['email']);
						$guest = test_input($_POST['guest']);
						$pets = @test_input($_POST['pet']);
						$pro_id = test_input($_POST['pro_id']);
						$prop_name = test_input($_POST['pro_head']);
						$guests = $guest;
//$redirect = "property_detail.php?proid=$pro_id";
//$datetime11 = DateTime::createFromFormat('m-d-Y', $checkin);
$checkin = date("Y-m-d", strtotime($checkin));
//$checkin = $datetime11->format('Y-m-d');

/*$datetime22 = DateTime::createFromFormat('m-d-Y', $checkout);
$checkout = $datetime22->format('Y-m-d');*/
$checkout = date("Y-m-d", strtotime($checkout));

$redirect = "property/".$pro_id;			
$todaysDate = date("Y-m-d");
/*$datetime = DateTime::createFromFormat('Y-m-d', $checkin);
$wekend = $datetime->format('D');*/
$wekend = date("D", strtotime($checkout));
if(isset($pro_id))
{
$date1 = $checkin;
$date2 = $checkout;
$referer = $_SERVER['HTTP_REFERER'];
 function returnDates($date1, $date2){
			$d1 = date("Y-m-d", strtotime($date1));
			$d2 = date("Y-m-d", strtotime($date2));
			$begin = new DateTime($d1);
			$end = new DateTime($d2);
			$end = $end->modify( '+1 day' ); 
			$interval = new DateInterval('P1D');
			$daterange = new DatePeriod($begin, $interval ,$end);
			return $daterange;
		}

		$datePeriod = returnDates($date1, $date2);
		//print_r($datePeriod); die;
		foreach($datePeriod as $date) {
			$ad1[] = $date->format('Y-m-d');
			//$ad1[] = date("Y-m-d", $date);
		}
array_pop($ad1);

$sel12 = mysqli_query($conn, "SELECT * FROM lhk_ical_events WHERE end_date <= '".$date2."' AND start_date >= '".$date1."' AND event_pid='".$pro_id."'");
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
$sel1234 = mysqli_query($conn, "SELECT * FROM lhk_property_new_rates WHERE  property_id='".$pro_id."'");
while($a = mysqli_fetch_assoc($sel1234))
{
	$b[] = $a;
	$c = count($b);
}
//print_r($c); die;
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
//print_r($as); die;
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


function array_flatten($array) {
    $return = array();
    foreach ($array as $key => $value) {
        if (is_array($value)){
            $return = array_merge($return, array_flatten($value));
        } else {
            $return[$key] = $value;
        }
    }

    return $return;
}

$array  = @$as ;

$result = array_flatten($array);
//print_r($result); die;
@$last_mat = count($result);
//echo $last_mat; die;
foreach($result as $valu)
{
	$ids = "";
	$night_rate = "";
	$tot_rate = "";
	$month_rate = "";
	$week_rate = "";

	$sql = mysqli_query($conn, "SELECT * FROM `lhk_property_new_rates` where '$valu' between pro_new_rate_sdate and pro_new_rate_edate and property_id='".$pro_id."'");
	$sk = mysqli_num_rows($sql);
	//echo $sk; die;
	if ($sk > 0) {
	$dat = @mysqli_fetch_assoc($sql);
	//print_r($dat); die;
	$a = trim($dat['pro_new_rate_id']);
	$ddd[$valu] = $a ;
	$ids[] = trim($dat['pro_new_rate_id']);
	$dating = $valu;
	$datetime = date("Y-m-d", strtotime($valu));
	$wekend = date("D", strtotime($datetime));
	$one_night = trim($dat['pro_new_rate_week_nt']);
	$weekend = trim($dat['pro_new_rate_weekend_nt']);
	$weekly =  trim($dat['pro_new_rate_weekly_nt']);
	$monthly = trim($dat['pro_new_rate_monthly']);
	$mini_stay = trim($dat['pro_new_rate_min_stay']);
	$minimum_night = $mini_stay;
	//echo $total_nights; die;
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
					 if(($wekend==="Fri")||($wekend==="Sat"))
						{ 
						 $one_rate = $weekend/1;
						}
						else
						{
							$one_rate = $one_night/1;
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
		 if(($wekend==="Fri")||($wekend==="Sat"))
	{ 
     $one_rate = $weekend/1;
	}
	else
	{
		$one_rate = $one_night/1;
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
	if(($wekend==="Fri")||($wekend==="Sat"))
	{ 
     $one_rate = $weekend/1;
	}
	else
	{
		$one_rate = $one_night/1;
	}
	 }
	else
	{
		$one_rate = $one_night/1;
	}
	}

	$tot_rate = $one_rate;
	//print_r($tot_rate); die;
	$rate_array[] = $tot_rate;
	$total_date[] = $dating;
	}else{

		$minn = count($result);
		        
			$sel12 = mysqli_query($conn, "SELECT * FROM `lhk_property_new_rates` WHERE pro_new_rate_sdate='0000-00-00' AND pro_new_rate_edate='0000-00-00'  AND property_id='".$pro_id."' ");
		$co = mysqli_num_rows($sel12);
		
		$dat = @mysqli_fetch_assoc($sel12);
		//print_r($dat); die;
		$mini_stay = $dat['pro_new_rate_min_stay'];
		$minimum_night = $mini_stay;
		$ke = $dat['pro_new_rate_id'];
		if($co == 0)
		{
		 echo "<script>alert('Rates1 of some dates you have selected is not available, because standard rate is not defined.')</script>";
		  echo "<script>window.location='$redirect'</script>";	
		}
		elseif($minimum_night>$minn)
		{
			echo "<script>alert('Minimum stay criteria of standard rate is not satisfied, please select the dates which have satisfied the minimum stay criteria.')    </script>";
		 echo "<script>window.location='$redirect'</script>";
		}else{
		    
			$a = trim($dat['pro_new_rate_id']);
			$ddd[$valu] = $a ;
			$ids[] = trim($dat['pro_new_rate_id']);
			$datetime = DateTime::createFromFormat('Y-m-d', $valu);
			$wekend = trim($datetime->format('D'));
			$one_night = trim($dat['pro_new_rate_week_nt']);
			$weekend = trim($dat['pro_new_rate_weekend_nt']);
			$weekly =  trim($dat['pro_new_rate_weekly_nt']);
			$monthly = trim($dat['pro_new_rate_monthly']);
			$mini_stay = trim($dat['pro_new_rate_min_stay']);
			$minimum_night = $mini_stay ;
			if(($total_nights>=30)&&($minn>=30)){
				if($monthly!=""){
					$one_rate = $monthly/30;
				}elseif($weekly!=""){
					$one_rate = $weekly/7;
				}elseif($weekend!=""){
					if(($wekend==="Fri")||($wekend==="Sat")){ 
						$one_rate = $weekend/1;
					}else{
						$one_rate = $one_night/1;
					}
				}else{
					$one_rate = $one_night/1;
				}
			}elseif(($total_nights>=7)&&($minn>=7)){
			 	if($weekly!=""){
				  	$one_rate = $weekly/7;
			 	}elseif($weekend!=""){
				 	if(($wekend==="Fri")||($wekend==="Sat")){	 
		     			$one_rate = $weekend/1;
					}else{
						$one_rate = $one_night/1;
					}
				}else{
					$one_rate = $one_night/1;
				}
			}elseif(($total_nights<=6)&&($minn<=6)){
			 	if($weekend!=""){
					if(($wekend==="Fri")||($wekend==="Sat")){
		     			$one_rate = $weekend/1;
					}else{
						$one_rate = $one_night/1;
					}
			 	}else{
					$one_rate = $one_night/1;
				}
			}
				$tot_rate = $one_rate;
				$rate_array[] = $tot_rate;
		}
	}
}
	//print_r($total_date); die;
	if(!empty($total_date))
	{
		$arr_diff = array_diff($ad1,$total_date);
	}else{
		$arr_diff = $ad1;
	}

	$checking_night = $total_nights - $last_mat;

	$rate_array1 = "";
	$ddd1 = "";
	$ids1 = "";
if($checking_night>0){
	foreach($arr_diff as $vall)
	{
	
	$sel1 = mysqli_query($conn, "SELECT * FROM `lhk_property_new_rates` WHERE pro_new_rate_sdate='0000-00-00' AND pro_new_rate_edate='0000-00-00'  AND property_id='".$pro_id."' ");
$co = mysqli_num_rows($sel1);
$dat = @mysqli_fetch_assoc($sel1) ;
$mini_stay = trim($dat['pro_new_rate_min_stay']);
$minimum_night = $mini_stay ;
if($co == 0)
{
 echo "<script>alert('Rates of some dates you have selected is not available,because standard rate is not defined.')</script>";
  echo "<script>window.location='$redirect'</script>";	
}
elseif($minimum_night>$checking_night)
{
	echo "<script>alert('Minimum stay criteria of standard rate is not satisfied, please select the dates which have satisfied the minimum stay criteria.')    </script>";
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
					 if(($wekend==="Fri")||($wekend==="Sat"))
						{ 
						 $one_rate = $weekend/1;
						}
						else
						{
							$one_rate = $one_night/1;
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
		 if(($wekend==="Fri")||($wekend==="Sat"))
	{ 
     $one_rate = $weekend/1;
	}
	else
	{
		$one_rate = $one_night/1;
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
	if(($wekend==="Fri")||($wekend==="Sat"))
	{ 
     $one_rate = $weekend/1;
	}
	else
	{
		$one_rate = $one_night/1;
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
//print_r($rate_array); die;
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
//print_r($check_min_stay); die;
if(!empty($check_min_stay))
{
	foreach($check_min_stay as $key1=>$valu1)
	{
		
		$sel15 = mysqli_query($conn, "SELECT pro_new_rate_min_stay FROM `lhk_property_new_rates` WHERE property_id='".$pro_id."' AND pro_new_rate_min_stay<=$valu1 AND pro_new_rate_id='".$key1."'");
		$run5 = @mysqli_num_rows($sel15);
		if($run5==0)
		{
			echo "<script>alert('Minimum stay criteria is not satisfied, please select the dates which have satisfied the minimum stay criteria.') </script>";
  			echo "<script>window.location='$redirect'</script>";
		}
	}
}

$totaling = $sum1 + $sum2;
//echo $totaling; die;
if($pro_id)
{       
	$Querycal = mysqli_query($conn, "select * from lhk_property_default_rates where property_id='$pro_id'");
	$Rescal = mysqli_fetch_assoc($Querycal);
	//print_r($Rescal); die;
	$cleaning_fee = explode("+", $Rescal['pro_cleaning_fee']);
	 $clean1 = $cleaning_fee[0];
	if($clean1){
		$clean = $clean1;
	}else{
		$clean = 0;
	}
	//$dmgpro = $Rescal['pro_def_rate_check_in'];
	$refund1 = $Rescal['pro_refundable_amt'];
	if($refund1){
		$refund = $refund1;
	}else{
		$refund = 0;
	}
	$tax1 = $Rescal['add_fees'];
	if($tax1){
		if(is_numeric($tax1)){
			 $ta = $totaling*$tax1/100;
		}else{
			$ta = 0;
		}
	}else{
		$ta = 0;
	}
	
}

if($_POST[pet]=='Yes'){
  $pet = 100;
  }
// echo $ta; die;
$total = $totaling + $clean + $ta + $refund+$pet;
//print_r($ke); die;
if(is_array($ke)){
	foreach($ke as $ke1){
	$sel1 = mysqli_query($conn, "SELECT * FROM `lhk_property_new_rates` WHERE admin_id=1 AND property_id='".$pro_id."' LIMIT 1 OFFSET $ke1");
	$run = @mysqli_fetch_assoc($sel1);
	 $sdate = $run['pro_new_rate_sdate'];
	 $edate = $run['pro_new_rate_edate'];
	 $k[] = $run['pro_new_rate_min_stay'];
	}
}else{
	$sel1 = mysqli_query($conn, "SELECT * FROM `lhk_property_new_rates` WHERE   property_id='".$pro_id."' AND pro_new_rate_id='".$ke."' LIMIT 1");
	$run = @mysqli_fetch_assoc($sel1);
	$k[] = $run['pro_new_rate_min_stay'];
}


$minimum_night = $k[0];
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
    
  $prop = mysqli_query($conn,"SELECT property_heading FROM lhk_property_details WHERE property_id='".$pro_id."'");
  $prRow = mysqli_fetch_assoc($prop);
$prop_name = $prRow['property_heading'];

?>

<?php
     $_SESSION['sid'] = session_id();
   if($_SESSION['sid']!=""){

             $info =$conn->query("SELECT * FROM lhk_info WHERE s_id='".$_SESSION['sid']."'");
             $count =$info->num_rows;
            if($count==0){

                   $insert =$conn->query("INSERT INTO lhk_info (s_id,pid,sdate,edate,name,email,t_night,total_amt,guest,min_stay,g_amount,clean,r_fees,tax,tax_fees,addedon)VALUES('".$_SESSION['sid']."','".$pro_id."','".$checkin."','".$checkout."','".$name."','".$email."','".$total_nights."','".$total."','".$guests."','".$minimum_night."','".$totaling."','".$clean."','".$refund."','".$tax1."','".$ta."','".date('Y-m-d H:m:s')."')");
                }else{

             $Update =$conn->query("UPDATE lhk_info SET s_id= '".$_SESSION['sid']."', pid='".$pro_id."',sdate='".$checkin."',edate='".$checkout."',name='".$name."',email='".$email."',t_night='".$total_nights."',total_amt='".$total."',guest='".$guests."',min_stay='".$minimum_night."',g_amount='".$totaling."',clean='".$clean."',r_fees='".$refund."',tax='".$tax1."',tax_fees='".$ta."',updateon='".date('Y-m-d H:m:s')."' WHERE s_id ='".$_SESSION['sid']."'");

             }

      }
?>
	<div class="container top-1" style="padding:40px 0px 0px 0px;">
		<div id="getquote" class="class="box-booking booking-inline newStyle_form" style="margin-top: 5em;" >
			<h2 align="center" style="color:#000;"><?php echo @$prop_name ;?> : Booking Quote </h2>
			<table cellspacing="0" cellpadding="0" class='responsive-table' id="propertyRates" style="width:100%; margin-top:20px;">
				<thead>
					<tr>
						<th scope='col'><strong>Check In</strong></th>
						<th scope='col'><strong>Check Out</strong></th>
						<!--<th scope='col'><strong><?php echo $apply_rate ;?></strong></th>-->
						<!-- <th scope='col'><strong>Min Stay</strong></th> -->
						<th scope='col'><strong>Total Guest</strong></th>
						<th scope='col'><strong>Total Nights</strong></th>
						<!--<th scope='col'><strong>Pets</strong></th>-->
						<th scope='col'><strong>Gross Amount</strong></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$datein=date_create_from_format("Y-m-d",$checkin);
						$firstdate = date_format($datein,"F jS, Y");
						$dateout=date_create_from_format("Y-m-d",$checkout);
						$lastdate = date_format($dateout,"F jS, Y");
					?> 
					<tr>
						<td data-title='Check In'> <?php echo $firstdate ;?></td>
						<td data-title='Check Out'> <?php echo  $lastdate ;?></td>
						<!--<td data-title='<?php echo $apply_rate ;?>'><?php echo $r!="" ? "CAD ".number_format(@$r,2): "" ;?></td>-->
						<!-- <td data-title='Min Stay'><?php echo @$minimum_night;?><?php if($minimum_night==1){echo " night";}else{echo " nights";} ?></td> -->
						<td data-title='Total Guest'><?php echo @$guests ;?></td>
						<td data-title='Total Nights'><?php echo @$total_nights ;?></td>
						<!-- <td data-title='Pets'><?php echo @$pet ;?></td> -->
						<td data-title='Gross Amount'><?php echo $totaling!="" ? "CAD ".number_format(@$totaling,2): "" ;?></td>
					</tr>
					<?php if($clean!=0){ ?>
					<tr>
						<td colspan="4" style="color: black;text-align: left;">Cleaning Fee</td>
						<td style="color: black;"> <?php echo "CAD ".number_format($clean,2); ?> </td>
					</tr>
					<?php } ?>
					
					<?php if($refund!='' || $refund!=0){ ?>
					<tr>
						<td colspan="4" style="color: black;text-align: left;">Refundable Damage Deposit</td>
						<td style="color: black;"> <?php echo "CAD ".number_format($refund,2); ?> </td>
					</tr>
					<?php } ?>
					<?php if($ta!=0){ ?>
					<tr>
						<td colspan="4" style="color: black;text-align: left;">Tax</td>
						<td style="color: black;"> <?php echo $ta!="" ? "CAD ". number_format(@$ta,2): ""; ?> </td>
					</tr>
					<?php } ?>
					
                    <?php if($pet!=0){ ?>
					<tr>
						<td colspan="4" style="color: black;text-align: left;">Pet Fee</td>
						<td style="color: black;"> <?php echo $pet!="" ? "CAD ". number_format(@$pet,2): ""; ?> </td>
					</tr>
					<?php } ?>
					<tr>
						<td colspan="4" style="color: black;text-align: left;">Net Payable Amount</td>
						<td style="color: black;"> <?php echo $total!="" ? "CAD ".number_format(@$total,2): "" ;?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="enq_form">
		<div class="grid_12  background"><hr>
		<?php
		function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
		}
		?>
		<form action="make-a-payment.php"  method="post" class="form-inline">
		<input name="checkin" type="hidden" value="<?php echo $checkin ; ?>" >
		<input name="fmessage" type="hidden" value="<?php echo $fmessage ; ?>" >
		<input name="checkout" type="hidden" value="<?php echo $checkout ; ?>" >
		<input name="admin_id" type="hidden" value="1" >
		<input name="totalamount" type="hidden" value="<?php echo $total; ?>" >            
		<input name="totalnight" type="hidden" value="<?php echo @$total_nights ;?>" >
		<input name="item_number" type="hidden" value="<?php echo generateRandomString() ;?>">
		<input name="no_of_guests" type="hidden" value="<?php echo $guests ;?>">
		<input id="pro_id" type="hidden" name="pro_id" value="<?php echo $pro_id ;?>"/>
		<input id="prop_name" type="hidden" name="prop_name" value="<?php echo $prop_name ;?>"/>
		<input id="apply_rate" type="hidden" name="apply_rate" value="<?php echo $apply_rate ;?>"/>
		<input id="apply_rate_price" type="hidden" name="apply_rate_price" value="<?php echo $r!="" ? "$".number_format(@$r,2): "" ;?>"/>
		<input id="min_stay" type="hidden" name="min_stay" value="2"/>
		<input id="g_amount" type="hidden" name="g_amount" value="<?php echo $totaling!="" ? "$".number_format(@$totaling,2): "" ;?>"/>
		<input id="clean" type="hidden" name="clean" value="<?php echo $clean ?>"/>
		<input type="hidden" id="refund" name="refund" value="<?php echo $refund ?>" />
		<input id="taxv" type="hidden" name="taxv" value="<?php echo $tax1 ?>"/>
		<input id="tax" type="hidden" name="tax" value="<?php echo $ta ?>"/>
		<input id="pets" type="hidden" name="pets" value="<?php echo $pet;?>"/>
		<table cellspacing="0" cellpadding="0" class='responsive-table' id="propertyRates" style="width:100%; margin-top:20px;">
		<tbody>
		<tr>
		<td class="even boxSpacingSet8" style="text-align: left;"><strong>Name</strong></td>
		<td class="even-1 boxSpacingSet8"><input id="fname" type="text" name="fname" placeholder="Enter Name" value="<?php echo $name;?>" required ></td>
		</tr>
		<tr>
		<td class="even boxSpacingSet8" style="color: black;text-align: left;"><strong>Email</strong></td>
		<td class="even-1 boxSpacingSet8"><input id="femail" type="text" name="femail" placeholder="Enter Email Id"   value="<?php echo $email;?>" required ></td>
		</tr>
		<tr>
		<td class="even boxSpacingSet8" style="text-align: left;"><strong>Phone</strong></td>
		<td class="even-1 boxSpacingSet8"><input id="phoneno" type="text" name="phoneno" placeholder="Enter Phone Number" required></td>
		</tr>
		<tr>
		<td class="even boxSpacingSet8" style="color: black;text-align: left"><strong>Message</strong></td>
		<td class="even-1 boxSpacingSet8"> <textarea id="message" placeholder="Write message..." name="fmessage" value="" cols="5" style="resize:none" required></textarea></td>
		</tr>
		</tbody>
		</table>
		<div class="col-md-12">
		<div class="quot">
		<input id="butt" name="q_submit" type="submit" value="Submit Request To Owner">
		<input id="butt" name="paysubmit" type="submit" value="Pay Now To Book">
		</form>
				   <!-- <form id="paypalsubmit" action="make-a-payment.php" method="post" target="_top">
					<input name="checkin" type="hidden" value="<?php //echo $checkin ; ?>" >
		<input name="checkout" type="hidden" value="<?php //echo $checkout ; ?>" >
		<input name="admin_id" type="hidden" value="1" >
		<input name="name" type="hidden" value="<?php //echo $name; ?>" >
		<input name="email" type="hidden" value="<?php //echo $email; ?>" >
		<input name="totalamount" type="hidden" value="<?php //echo $total; ?>" >            
		<input name="totalnight" type="hidden" value="<?php //echo @$total_nights ;?>" >
		<input name="item_number" type="hidden" value="<?php //echo generateRandomString() ;?>">
		<input name="no_of_guests" type="hidden" value="<?php //echo $guests ;?>">
		<input id="pro_id" type="hidden" name="pro_id" value="<?php //echo $pro_id ;?>"/>
		<input id="prop_name" type="hidden" name="prop_name" value="<?php //echo $prop_name ;?>"/>
		<input id="apply_rate" type="hidden" name="apply_rate" value="<?php //echo $apply_rate ;?>"/>
		<input id="apply_rate_price" type="hidden" name="apply_rate_price" value="<?php //echo $r!="" ? "$".number_format(@$r,2): "" ;?>"/>
		<input id="min_stay" type="hidden" name="min_stay" value="2"/>
		<input id="g_amount" type="hidden" name="g_amount" value="<?php //echo $totaling!="" ? "$".number_format(@$totaling,2): "" ;?>"/>
		<input id="clean" type="hidden" name="clean" value="<?php //echo $clean ?>"/>
		<input type="hidden" id="refund" name="refund" value="<?php //echo $refund ?>" />
		<input id="taxv" type="hidden" name="taxv" value="<?php //echo $tax1 ?>"/>
		<input id="tax" type="hidden" name="tax" value="<?php //echo $ta ?>"/>
		<input id="pets" type="hidden" name="pets" value="<?php //echo $pet;?>"/>
                   <input id="butt" name="paysubmit" type="submit" value="Pay Now To Book">
                </form> -->
		</div>  
		</div>
		 <div class="col-md-12">
		<div class="pay">
		&nbsp;
		</div>
		</div> 
		 
		</div>
		</div>
		<?php 
		}
		}
		else
		{
		echo "<script>window.location='$redirect'</script>";
		}
		?>
	</div>
</div>
</div>


 </section> 
<style>
.activeClass{
    background: #F00 !important; 
  }
 
</style>

<?php include'footer.php'; ?>
<script src="js/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/script.js"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
 <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script>
  $(document).ready(function() {
    $('#dateRangePicker')
        .datepicker({
            format: 'mm/dd/yyyy',
            startDate: '01/01/2010',
            endDate: '12/30/2020'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#dateRangeForm').formValidation('revalidateField', 'date');
        });

        $('#dateRangePicker1')
        .datepicker({
            format: 'mm/dd/yyyy',
            startDate: '01/01/2010',
            endDate: '12/30/2020'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#dateRangeForm').formValidation('revalidateField', 'date');
        });
  });
</script>
<script>
$(function(){
	$(".dropdown").hover(            
	  function() {
		  $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
		  $(this).toggleClass('open');
		  $('b', this).toggleClass("caret caret-up");                
	  },
	  function() {
		  $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
		  $(this).toggleClass('open');
		  $('b', this).toggleClass("caret caret-up");                
	  });
	});
</script>
</body>
</html>