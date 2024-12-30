<?php
include_once('../../include/db.php');
$contact_details = $pre_fix."contact_details";
$ical_events = $pre_fix."ical_events";
// Define site url and email(for getting ics link by mail)
define("ICS_URL1", 'http://'.$_SERVER['SERVER_NAME'].'/');
$url = SITE_URL ? SITE_URL : ICS_URL1 ;
define("ICS_URL", $url);
$email = "";
//---------------------------------------------------------------------
$site = $_SERVER['SERVER_NAME'];


	$pro_id=@$_POST['prop_ical'];
	
// the iCal date format. Note the Z on the end indicates a UTC timestamp.
function dateToCal($timestamp) {
  return date('Ymd\THis\Z', $timestamp);
}
 
 $id= sprintf("%06d", $pro_id);
 $n = mysqli_query($conn, "SELECT * FROM ".$contact_details." WHERE contact_id='".$pro_id."'");
  @$mm = mysqli_fetch_assoc($n);
  @$email_id = $mm['contact_email'];
// max line length is 75 chars. New line is \\n
$n = mysqli_query($conn, "SELECT * FROM ".$ical_events." WHERE event_pid='".$pro_id."'");

//---------------------------------------------------------------------------

$output = "BEGIN:RJ-CALENDAR
METHOD:PUBLISH
VERSION:1.0
CREATED BY:-// Rishabh #rishabh@personalwebsites.com #\n";

function generateRandomString($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$req_num = generateRandomString();

 
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

?>
