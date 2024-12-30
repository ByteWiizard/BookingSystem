<?php
error_reporting(0);
define (DB_USER, "surya150_kris_db");
define (DB_PASSWORD, "krisurbanluxuryapartment#@!");
define (DB_DATABASE, "surya150_krisurbanluxuryapartment");
define (DB_HOST, "localhost");
define(dbprefix, "lhk_");
define("SITE_URL", 'http://'.$_SERVER['SERVER_NAME'].'/my-calendar');
$conn= new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


$from = date('Y-m-d', strtotime('+1 day', strtotime($_GET['from'])));

$to = date('Y-m-d', strtotime('-1 day', strtotime($_GET['to'])));

$pid = $_GET['id'];


$sql = "SELECT * FROM lhk_ical_events WHERE ((start_date between '".$from."' AND '".$to."' OR end_date between '".$from."' AND '".$to."') OR (start_date <= '".$from."' AND end_date >= '".$to."')) and event_pid='$pid'";



$result = $conn->query($sql);



$array = array();

if ($result->num_rows > 0) {

    // output data of each row

	$array = array('status'=>0,'message'=>'Some dates are already booked between your selected dates  from '.$from.'-'.$pid.' to '. $to);

		

} else {

	

    $array = array('status'=>1,'message'=>'No records found');

}

echo json_encode($array);

