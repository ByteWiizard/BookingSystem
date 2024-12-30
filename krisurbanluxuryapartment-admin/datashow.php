<?php include_once('session_destroy.php') ;?>
<?php include_once('include/db.php');?>

<?php

$ical_events = "ical_events";
$property_new_rates = "lhk_property_new_rates";
$property_default_rates = "lhk_property_default_rates";
$pro_id=$_POST['procheckid'];

$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];

			
$todaysDate = date("Y-m-d");
$datetime = DateTime::createFromFormat('Y-m-d', $checkin);
$wekend = $datetime->format('D');
if($pro_id!="")
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
$error = "Some dates are already booked,Choose available dates only.";

}
$day_a = count($ad1)+1 ;
$total_nights = count($ad1);
if($day_a<2)
{
$error = "Please select minimum 2 days.";
}

$offer = returnDates($todaysDate,$checkin);
foreach($offer as $off) {
$op[] = $off->format('Y-m-d');
}
$day_bef = count($op) ;
$sel1234 = mysqli_query($conn, "SELECT * FROM ".$property_new_rates." WHERE property_id='".$pro_id."'");
while($a = mysqli_fetch_assoc($sel1234))
{
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
$error = "Rates of some dates you have selected is not available,because standard rate is not defined.";
	
}
elseif($mini_stay>$minn)
{
$error = "Minimum stay criteria of standard rate is not satisfied,please select the dates which have satisfied the minimum stay criteria.";

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
{foreach($arr_diff as $vall)
{
$sel1 = mysqli_query($conn, "SELECT * FROM ".$property_new_rates." WHERE pro_new_rate_sdate='0000-00-00' AND pro_new_rate_edate='0000-00-00' AND property_id='".$pro_id."' ");
$co = mysqli_num_rows($sel1);
$dat = @mysqli_fetch_assoc($sel1) ;
$mini_stay = trim($dat['pro_new_rate_min_stay']);
if($co == 0)
{
$error = "Rates of some dates you have selected is not available,because standard rate is not defined.";
	
}
elseif($mini_stay>$checking_night)
{
$error = "Minimum stay criteria of standard rate is not satisfied,please select the dates which have satisfied the minimum stay criteria.";

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

/*$per_day = $rate/$day_a;
$rate1 = $rate-$per_day;
$rate = round($rate1, 2);
$tot = $rate ;*/






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
$error = "Minimum stay criteria is not followed.";

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

if($error){
	$returndata= '0|'.$error;
}else{
	
$returndata=sprintf("%0.2f",$total).'|'.$total_nights.'|'.sprintf("%0.2f",$totaling).'|'.sprintf("%0.2f",$cleen_fee).'|'.sprintf("%0.2f",$tax).'|'.sprintf("%0.2f",$refund);
	
}



echo $returndata;


}
?>