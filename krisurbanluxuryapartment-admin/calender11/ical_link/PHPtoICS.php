<?php
include_once('../../include/db.php');
// Define site url and email(for getting ics link by mail)
define("ICS_URL1", 'http://'.$_SERVER['SERVER_NAME'].'/');
$url = SITE_URL ? SITE_URL : ICS_URL1 ;
define("ICS_URL", $url);
$email = "";
//---------------------------------------------------------------------
$site = $_SERVER['SERVER_NAME'];

if(isset($_POST['sub_ical']))
{
	$pro_id=@$_POST['prop_ical'];
     $pro_name=@$_POST['prop_name'];
	
// the iCal date format. Note the Z on the end indicates a UTC timestamp.
function dateToCal($timestamp) {
  return date('Ymd\THis\Z', $timestamp);
}
 
 $id= sprintf("%06d", $pro_id);
 $n = mysqli_query($conn, "SELECT * FROM contact_details WHERE contact_id='".$pro_id."'");
  @$mm = mysqli_fetch_assoc($n);
  @$email_id = $mm['contact_email'];
// max line length is 75 chars. New line is \\n
$n = mysqli_query($conn, "SELECT * FROM ical_events WHERE event_pid='".$pro_id."'");

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
if (!file_exists('../../../ics-file')) {
    mkdir('../../../ics-file', 0777, true);
}
$fileaddress = '../../../ics-file/'.$pagename.".ics";
$newFileName = 'ics-file/'.$pagename.".ics";

if(file_put_contents($fileaddress,$output)!=false){
 
  $ics_link = ICS_URL.$newFileName;
   echo "<p style='margin-bottom:2px;'>your ics link is - "."<b>".$ics_link."</b></p>";
   echo "<p style='margin-top:0;'>Please copy the ics link generated above.</p>";
   echo "<script>alert('Your ics link is - $ics_link generated successfully.')</script>";
   
   // mail the ics link to the email id defined on the top -------------
           $to = $email_id ? $email_id : $email ;
		   $subject = "Request ICS Link - '".$ics_link."'";
		$message = "<html>
		<head>
		<title></title>
		<style>
		div,p{
		text-align:center;
		}
		</style>
		</head>
		<body>
		
		<p>Your ics link is generated for the property id - ".$pro_id." (named as ".$pro_name.")</p>
		<p><b>Your ICS link is : </b>".$ics_link." </p>
		</body>
		</html>";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		$headers .= "From: <".$to.">" . "\r\n";;
		@mail($to,$subject,$message,$headers);
   //-----------------------------------------------------------------------
}
else{
   echo "Cannot create file (".basename($newFileName).")";
}
}
?>
