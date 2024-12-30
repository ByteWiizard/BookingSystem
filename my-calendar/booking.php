<?php
error_reporting(0);
define (DB_USER, "surya150_kris_db");
define (DB_PASSWORD, "krisurbanluxuryapartment#@!");
define (DB_DATABASE, "surya150_krisurbanluxuryapartment");
define (DB_HOST, "localhost");
define(dbprefix, "lhk_");
define("SITE_URL", 'http://'.$_SERVER['SERVER_NAME'].'/my-calendar');
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

include_once('cal-library.php');
$pid = isset($_GET['property'])?$_GET['property']:0;
//echo "SELECT i_id,property_id,link FROM lhk_ical_links WHERE property_id='".$pid."'";
$ical11 = mysqli_query($mysqli,"SELECT i_id,property_id,link FROM lhk_ical_links WHERE property_id='".$pid."'");
$num = @mysqli_num_rows($ical11);
if($num >0){
    while($r = mysqli_fetch_assoc($ical11)){
        $linkshow = $r['link'];
        $cid =$r['i_id'];
        $myVar = $r['property_id'];
        callApi($linkshow,$cid,$myVar,1);
    } 
}

function callApi($link,$id,$propertyid,$admin_id){
    global $mysqli;
$link =$link;
$id =$id;
$admin_id =1;
$propertyid =$propertyid;


$ch = curl_init();
$url = "http://vacastayz.com/perfectstayz/ical/request-execute-calendar?link=".$link;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); ////// i was missing this line.
$response = curl_exec($ch);
$data = json_decode($response);
//print_r($data);

if(sizeof($data)>0){
    $qry = mysqli_query($mysqli,"DELETE FROM lhk_ical_events WHERE event_pid='$propertyid' AND event_type='$id'");
    foreach($data as $d){
        //echo "INSERT INTO lhk_ical_events(admin_id,start_date,end_date,text,event_pid,event_type,added_date)VALUES($admin_id,'".$d->start."','".$d->end."','".$d->title."','".$propertyid."','".$id."','".date('Y-m-d')."')";
        $insert =mysqli_query($mysqli,"INSERT INTO lhk_ical_events(admin_id,start_date,end_date,text,event_pid,event_type,added_date)VALUES($admin_id,'".$d->start."','".$d->end."','".$d->title."','".$propertyid."','".$id."','".date('Y-m-d')."')");   
    }
}
curl_close($ch);
}




$sql = "SELECT start_date, end_date FROM lhk_ical_events where event_pid='$pid'";

$result = $mysqli->query($sql);
$booked = array();
if($result->num_rows >0){
	while($row = $result->fetch_assoc()){//date must be yyyy-mm-dd format	
		//echo $row['start_date'].'----------'.$row['end_date'];
		//echo "<br/>";
		 //$booked = array_merge($booked,getDatesFromRange(date('Y-m-d',$row['bookingfrom']), date('Y-m-d',$row['bookingto'])));
		 $booked = array_merge($booked,getDatesFromRange($row['start_date'], $row['end_date']));
	}
}

$d=1;
$yr = '20';
$pricedate = strtotime($yr.$y.'-'.$m.'-'.$d);
$pricedate = date('Y-m-d',$pricedate);
//$pricedate = date('Y-m-d',$pricedate);

$price = array(	
        array('start'=>$pricedate,'end'=>date('Y-m-d', strtotime('+4 months',strtotime($pricedate)))),
);


$ends= date('Y-m-d', strtotime('+4 months',strtotime($pricedate)));

function createDateRange($startDate, $endDate, $format = "Y-m-d")
{
    $begin = new DateTime($startDate);
    $end = new DateTime($endDate);

    $interval = new DateInterval('P1D'); // 1 Day
    $dateRange = new DatePeriod($begin, $interval, $end);

    $range = array();
    foreach ($dateRange as $date) {
        $range[] = $date->format($format);
    }

    return $range;
}

$myprice = array();
$dtas= createDateRange($pricedate,$ends);

foreach($dtas as $valu ){

$sql = $mysqli->query("SELECT pro_new_rate_week_nt FROM `lhk_property_new_rates` where '$valu' between pro_new_rate_sdate and pro_new_rate_edate and property_id='".$pid."'");
$ss = $sql->fetch_assoc();
$rate =$ss['pro_new_rate_week_nt'];
if($rate==''){
$sql = $mysqli->query("SELECT pro_new_rate_week_nt FROM `lhk_property_new_rates` WHERE pro_new_rate_sdate='0000-00-00' AND pro_new_rate_edate='0000-00-00'  AND property_id='".$pid."'");
$ss =$sql->fetch_assoc();
$rate =$ss['pro_new_rate_week_nt'];
}
//$myprice = array_merge($myprice,getDatesPrice($valu, $ends,$rate));
}




?>