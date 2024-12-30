<?php 
 @session_start();
?>
<?php  error_reporting(-1);
include_once('../../include/db.php');
?>
<?php
$ical_events = $pre_fix."ical_events";
$myVar = null;
if($myVar!=@$_GET['property'])
{
	$myVar = @$_GET['property'];
}
else {
    $myVar = @$_GET['property'];
}
?>	
<?php
$adm_id = 1;
$property_id = $myVar;
 $clid= $_POST['calid'];
	$problems = Array();

	/*! parsing request if configuration is getted in POST array
	 */
	if (isset($_POST["ical_url"])) {
		if ((isset($_FILES["ical_file"]))&&(file_exists($_FILES["ical_file"]["tmp_name"]))) {
			$ical_content = file_get_contents($_FILES["ical_file"]["tmp_name"]);
		} else {
			if ((isset($_POST["ical_url"]))&&($_POST["ical_url"] != '')) {
				$ical_url = preg_replace('/\s+/', '',$_POST["ical_url"]);
				$ctx = stream_context_create(array(
				'http' => array(
				'method' => 'GET',
				'header' => 'User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; Touch; rv:11.0) like Gecko')
				)
				);
				if (file_get_contents($ical_url,false,$ctx) !== false) {
					$ical_content = preg_replace('/\s+/', '',$_POST["ical_url"]);
				} else {
					$problems[] = "Ical resource specified by url is not available.";
				}
			} else {
				$problems[] = "Resource file or url should be specified.";
			}
		}
		if (isset($_POST["ical_url"])) {
			$ical_url = $_POST["ical_url"];
		}

		if (isset($_POST['db_host'])) {
			$db_host = $_POST['db_host'];
		}
		if (isset($_POST['db_port'])) {
			$db_port = $_POST['db_port'];
		} else {
			$problems[] = "Database port should be specified.";
		}
		if (isset($_POST['db_user'])) {
			$db_user = $_POST['db_user'];
		} else {
			$problems[] = "Database user should be specified.";
		}
		if (isset($_POST['db_pass'])) {
			$db_pass = $_POST['db_pass'];
		} else {
			$problems[] = "Database password should be specified.";
		}
		if (isset($_POST['db_name'])) {
			$db_name = $_POST['db_name'];
		} else {
			$problems[] = "Database name should be specified.";
		}
		if ((isset($_POST['db_table']))&&($_POST['db_table'] != '')) {
			$db_table = $_POST['db_table'];
		} else {
			$problems[] = "Table name should be specified.";
		}
		if (isset($_POST['db_delete_old_data'])) {
			$db_delete_old_data = true;
		} else {
			$db_delete_old_data = false;
		}
		/*! checking database connection
		 */
		//$db_server =  ($db_port !== '') ? $db_host.":".$db_port : $db_host;
                $db_server =  ($db_host !== '') ? $db_host:'localhost';
		@$link = mysqli_connect($db_server, $db_user, $db_pass);
		if (($link)&&(mysqli_select_db($link,$db_name) != false)) {
//			mysqli_close($link);
		} else {
			$problems[] = "Database connection is failed. Check database configuration.";
		}
	}
if ((count($problems) == 0)&&(isset($link))&&($link != false)) {
	/*! export functionality
	 */

	/*! log array is used for export process logging
	 * Array(
	 *	[0] => Array(
	 *			"text" => "Text of message"
	 *			"type" => "success||error" (used for stylization)
	 *		)
	 * )
	 */
	$log = Array();
	$log[] = Array("text" => "Checking table '{$db_table}' exists...", "type" => "success");

	/*! checking if table exists */
	$query = "SELECT table_name FROM information_schema.tables WHERE table_schema = '{$db_name}' AND table_name = '{$db_table}' LIMIT 1";
	$res = mysqli_query($link,$query);
	if (mysqli_num_rows($res) == 1) {
		$log[] = Array("text" => "Table '{$db_table}' exists", "type" => "success");
		if ($db_delete_old_data) {
			/*! clearing table */
			 $query = "DELETE FROM {$db_table} WHERE event_pid='".$property_id."' AND event_type='".$clid."'";
			$res = mysqli_query($link,$query);
			if (mysqli_error($link) == "") {
				$log[] = Array("text" => "Table '".$db_table."' was cleared successfully.", "type" => "success");
			} else {
				$log[] = Array("text" => "Some error occured during table {$db_table} clearing (".mysqli_error($link).")", "type" => "error");
			}
		}
	} else {
		
		/*! table doesn't exist. creation*/
		$log[] = Array("text" => "Table {$db_table} doesn't exist", "type" => "success");
		$query = "CREATE TABLE `{$db_table}` (";
		$query .= "`event_id` int(11) NOT NULL AUTO_INCREMENT, ";
		$query .= "`admin_id` int(11) NOT NULL, ";
		$query .= "`start_date` date NOT NULL, ";
		$query .= "`end_date` date NOT NULL, ";
		$query .= "`text` text NOT NULL, ";
		$query .= "`event_pid` int(11) NOT NULL, ";
                $query .= "`cat_id` int(11) NOT NULL, ";
		$query .= "`event_type` varchar(30) NOT NULL, ";
		$query .= "`added_date` date NOT NULL, ";
		$query .= "`booking_status` int(11) NOT NULL, ";
		$query .= "PRIMARY KEY (`event_id`))";
		$res = mysqli_query($link,$query);
	
		if (mysqli_error($link) == "") {
			$log[] = Array("text" => "Table {$db_table} was created successfully.", "type" => "success");
		} else {
			$log[] = Array("text" => "Some error occured during table {$db_table} creating (".mysqli_error($link).")", "type" => "error");
		}
	}


     

	/*! exporting event from source into hash */
	require_once("codebase/class.php");
	$exporter = new ICalExporter();
	$log[] = Array("text" => "Events rendering...", "type" => "success");
	$events = $exporter->toHash($ical_content);
	$log[] = Array("text" => count($events)." event(s) was found.", "type" => "success");
	$log[] = Array("text" => "Inserting events in database...", "type" => "success");
	$success_num = 0;
	$error_num = 0;
	
	/*! inserting events in database */
	for ($i = 1; $i <= count($events); $i++) {
	   $event = $events[$i];
	   $pro_id = $property_id;
	   $cl = $clid;
	   $admin_id = $adm_id;
	   $Weddingdate = new DateTime($event['start_date']);
	   $start_date = $Weddingdate->format('Y-m-d');
	   $Weddingdate1 = new DateTime($event['end_date']);
	   $end_date = $Weddingdate1->format('Y-m-d');
	   $text = $event["text"];
	   $rec_type = $event["rec_type"];
	   $event_pid = $event["event_pid"];
	   $event_length = $event["event_length"];
	   $event_type = 'ical' ;
           $cat = 'ical' ;
	   $booking_status = 1 ;
	   $added_date = date('Y-m-d');
	   $booking[] = $start_date.",".$end_date.",".$pro_id.",".$admin_id;
		 $query = "INSERT INTO `{$db_table}` VALUES (null, ";
		 $query .= "'".mysqli_real_escape_string($link,$admin_id)."', ";
		 $query .= "'".mysqli_real_escape_string($link,$start_date)."', ";
		 $query .= "'".mysqli_real_escape_string($link,$end_date)."', ";
		 $query .= "'".mysqli_real_escape_string($link,$event["text"])."', ";
		 $query .= "'".mysqli_real_escape_string($link,$pro_id)."', ";
                  $query .= "'".mysqli_real_escape_string($link,$cl)."', ";    
	          
		 $query .= "'".mysqli_real_escape_string($link,$added_date)."', ";
		 $query .= "'".mysqli_real_escape_string($link,$booking_status)."')";
		$res = mysqli_query($link,$query) or die(mysqli_error($link));
		
		
		if (mysqli_error($link) == "") {
			$success_num++;
		} else {
			$error_num++;
			$log[] = Array("text" => "Some error occured during event inserting (".mysqli_error($link).", [ QUERY:  {$query} ])", "type" => "error");
		}
		
	}
	$red = $_SERVER['HTTP_REFERER'];
	echo "ical updated successfully,please refresh your calendar.";
	//$log[] = Array("text" => "{$success_num} events were inserted successfully", "type" => "success");
	if ($error_num > 0) {
		$log[] = Array("text" => "{$error_num} error(s) occur(s)", "type" => "error");
	}
	
	mysqli_close($link);
}


if (isset($log)) {
	/*! output export result */
	?>
									
	<?php
	for ($i = 6; $i < count($log); $i++) {

        ?>								
	<div class="log_msg <?php echo $log[$i]["type"]; ?>">
    <div class="num"><?php  echo ($i + 1); ?>)
    </div>
	<?php echo $log[$i]["text"]; ?>
    </div>
		<?php
	}
	?>
									
								
	<?php
} else {

$ical11 = mysqli_query($conn,"SELECT i_id,link FROM lhk_ical_links WHERE property_id='".$property_id."' AND admin_id='".$adm_id."'");
$num = @mysqli_num_rows($ical11);
while($r = mysqli_fetch_assoc($ical11)){
    $linkshow = $r['link'];
    $calid =$r['i_id'];
?>
<div class="row" style="width:100%;">
<?php
if($num!=0){
	echo '<div class="col1" style="float:left;">';
	/*! outputing configuration form */
?>
		<form action="index1.php?property=<?php echo $myVar ;?>" method="post" id="formID" enctype="multipart/form-data">
                   <!-- <input type="file" class="input" name="ical_file" />-->
                    Ical link: <input class="input" size="65" name="ical_url" value="<?php echo (isset($ical_url) ? $ical_url : @$linkshow ) ?>" type="text" readonly>
                    <input class="input" id="db_host" name="db_host" value="<?php echo (isset($db_host) ? $db_host : $servername) ?>" type="hidden">
                    <input class="input" id="db_port" name="db_port" value="<?php echo (isset($db_port) ? $db_port : '3306') ?>" type="hidden" onChange="portChanged(true);">
                    <input class="input" name="db_name" value="<?php echo (isset($db_name) ? $db_name : $db) ?>" type="hidden">
                    <input class="input" name="db_user" value="<?php echo (isset($db_user) ? $db_user : $username) ?>" type="hidden">
                    <input class="input" name="db_pass" value="<?php echo (isset($db_pass) ? $db_pass : $password) ?>" type="hidden">
                    <input class="input" name="db_table" value="<?php echo (isset($db_table) ? $db_table : $ical_events ) ?>" type="hidden">
                    <input class="input" name="calid" value="<?php echo $calid;?>" type="hidden">
                    <input type="hidden" name="db_delete_old_data" <?php echo ((isset($db_delete_old_data))&&($db_delete_old_data == true)) ? 'checked="true"' : ''; ?> />
                    <button id="nbut" class="continue-button" type="submit" name="next">Import Calendar</button>
                    </form>
		
<?php
echo "</div>";
?>

<!--<div class="col1" style="float:left; margin-left:10px;">
<form method="post" action="PHPtoICS.php" enctype="multipart/form-data">
<input type="hidden" name="prop_ical" value="<?php echo $myVar ;?>" />
<input type="submit" id='sub_ical' name="sub_ical" class="poin" value="Export Calender(Get an ics link)" />
</form>
</div>-->
<?php } ?>
<?php
if($num==0){
?>
<!--<div class="col1" style="float:left; margin-left:10px;">
<form method="post" action="PHPtoICS.php" id="ical_ID" enctype="multipart/form-data">
<input type="hidden" name="prop_ical" value="<?php echo $myVar ;?>" />
<input type="submit" id='sub_ical' name="sub_ical" class="poin" value="Export Calender(Get an ics link)" />
</form>
</div>-->
<?php } ?>
</div>
<?php
} }
?>

<?php
// Define site url and email(for getting ics link by mail)

define("ICS_URL1", 'http://'.$_SERVER['SERVER_NAME'].'/');

$url = SITE_URL ? SITE_URL : ICS_URL1 ;

define("ICS_URL", $url);

//---------------------------------------------------------------------

$site = $_SERVER['SERVER_NAME'];
$pro_id=$myVar;

// the iCal date format. Note the Z on the end indicates a UTC timestamp.
function dateToCal($timestamp) {
  return date('Ymd\THis\Z', $timestamp);
}

 $id= sprintf("%06d", $pro_id);

// max line length is 75 chars. New line is \\n

$n = mysqli_query($conn, "SELECT * FROM '".$ical_events."' WHERE event_pid='".$pro_id."'");

//---------------------------------------------------------------------------

$output = "BEGIN:RJ-CALENDAR

METHOD:PUBLISH

VERSION:1.0

CREATED BY:-// Ajeet #ajeetkumarup4@gmail.com #\n";

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
}
else{
  echo "Cannot create file (".basename($newFileName).")";
}
?>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>
<script>
$(document).ready(function(e) {
   $(window).load(function(){
	 $('.spinner', window.parent.document).hide();
	  $('#tt', window.parent.document).show();
	  $('#pp', window.parent.document).show();
}); 
});
</script>

<?php
if($_SESSION['check']!=@$myVar)
{
	if($num!=0){
?>
<script type="text/javascript">
	 setTimeout(function(){
		 $('#ical_ID').submit();
      $('#formID').submit();
	  $('.spinner', window.parent.document).show();
	  $('#pp', window.parent.document).hide();
	  $('#tt', window.parent.document).hide();
    },1000);
</script>
<?php
	}
}
$_SESSION['check'] = @$_GET['property'];
?>
