<?php
include_once('../include/db.php');
include_once('../include/functions.php');
$ip = getClientIP();
@session_start();
$admin_id = $_SESSION['admin_id'];
function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

$name = test_input($_POST['first-name']);
$email = test_input($_POST['email']);
$startDate = test_input($_POST['first']);
$endDate = test_input($_POST['last']);
$property_id = $_POST['id'];
if(isset($_POST['first']) && isset($_POST['last'])){
$date1 = $startDate;
$date2 = $endDate;

function returnDates($fromdate, $todate) {
    $fromdate = \DateTime::createFromFormat('Y-m-d', $fromdate);
    $todate = \DateTime::createFromFormat('Y-m-d', $todate);
    return new \DatePeriod(
        $fromdate,
        new \DateInterval('P1D'),
        $todate->modify('+1 day')
    );
}
$datePeriod = returnDates($date1, $date2);
foreach($datePeriod as $date) {
    $ad[] = $date->format('Y-m-d');
}

if(isset($ad))
{
$count = count($ad);
$aaa = "";
$seperator = ",";
foreach($ad as $val)
{
	$aaa .= "'".$val."'".$seperator;
	
}
$t = rtrim($aaa, $seperator);
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$req_num = generateRandomString();


$sel = mysqli_query($conn, "SELECT * FROM ical_events WHERE end_date <= '".$date2."' AND start_date >= '".$date1."' AND event_pid='".$property_id."'");
 
$row=mysqli_num_rows($sel);

if($row>0)
{
	echo "<script>alert('Some dates are already booked,Choose available dates only.');</script>";
	echo "<script>return false;</script>";
}
else
{
	if($count>1) //if select more than one date
	{
		
		$ins_ical= mysqli_query($conn, "insert into ical_events(admin_id,start_date,end_date,text,event_pid,event_type,added_date,booking_status) VALUES('".$admin_id."','".$date1."','".$date2."','Reserved - ".$name."','".$property_id."','self',now(),'0')") or die(mysqli_error($conn));
		
		 // Define site url and email(for getting ics link by mail)
define("ICS_URL1", 'http://'.$_SERVER['SERVER_NAME'].'/');
$url = SITE_URL ? SITE_URL : ICS_URL1 ;
define("ICS_URL", $url);

//---------------------------------------------------------------------
$site = $_SERVER['SERVER_NAME'];

	$pro_id=$property_id;
	
// the iCal date format. Note the Z on the end indicates a UTC timestamp.
function dateToCal($timestamp) {
  return date('Ymd\THis\Z', $timestamp);
}
 
 $id= sprintf("%06d", $pro_id);

// max line length is 75 chars. New line is \\n
$n = mysqli_query($conn, "SELECT * FROM ical_events WHERE event_pid='".$pro_id."'");

//---------------------------------------------------------------------------

$output = "BEGIN:RJ-CALENDAR
METHOD:PUBLISH
VERSION:1.0
CREATED BY:-// Rishabh #rishabh@personalwebsites.com #\n";

function generateRandomStrings($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$req_num = generateRandomStrings();

 
// loop over events
while(@$ical = mysqli_fetch_assoc($n))
{
	$a = $ical['event_id'];
	$b = $ical['start_date'];
	$c = $ical['end_date'];
	$d = $ical['text'];
	$e = $ical['event_pid'];
	$f = $ical['added_date'];

 $output .=
"BEGIN:VEVENT
SUMMARY:$d
UID:$req_num#$a#rj@$site
STATUS:booked
DTSTART:" . dateToCal(strtotime($b)) . "
DTEND:" . dateToCal(strtotime($c)) . "
PROPERTYID:$e
LAST-MODIFIED:" . dateToCal(strtotime($f)) . "
END:VEVENT\n";
}
// close calendar
$output .= "END:RJ-CALENDAR";

//------------------------------------------------------------

$pagename = 'listing-'.$id;
if (!file_exists('../../ics-file')) {
    mkdir('../../ics-file', 0777, true);
}
$fileaddress = '../../ics-file/'.$pagename.".ics";
$newFileName = 'ics-file/'.$pagename.".ics";

if(file_put_contents($fileaddress,$output)!=false){
 
  $ics_link = ICS_URL.$newFileName;
}
else{
   echo "Cannot create file (".basename($newFileName).")";
}
		
	
			if($ins_ical)
	{
		$ins= mysqli_query($conn, "insert into client_details(property_id,admin_id,req_num,name,email,firstdate,lastdate,adddate,client_ip) VALUES('".$property_id."','".$admin_id."','".$req_num."','".$name."','".$email."','".$date1."','".$date2."',now(),'".$ip."')") or die(mysqli_error($conn));
		
		echo "Booked successfully";
	}
	else
	{
		echo "Booking Failed";
	}
	}
	else
	{
		echo "<script>alert('Please select minimum two days for booking.');</script>";
	echo "<script>return false;</script>";
	}
} //if select more than one date ends 
}  //else row > 0 ends
} // if isset $ad ends

?>