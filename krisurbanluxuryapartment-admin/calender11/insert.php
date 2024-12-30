<?php
include_once('../include/db.php');
@session_start();
if(isset($_POST['data'])){
$a = $_POST['data'];
$property_id = $_POST['id'];
$b = explode(",", $a);
array_pop($b);

for ($i=0; array_key_exists($i, $b); $i+=2) {
    $aa[] = $b[$i];
}
	for ($j=1; array_key_exists($j, $b); $j+=2) {
   $zz[] = $b[$j];
}

if(isset($aa)){
$startDate[] = end($aa);
}
if(isset($zz)){
$endDate[] = end($zz);
}
	
?>
<?php
if(isset($startDate) && isset($endDate)){
$date1 = $startDate[0];
$date2 = $endDate[0];

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
$bbb = "";
$seperator = ",";
foreach($ad as $val)
{
	$aaa .= "'".$val."'".$seperator;
	$bbb .= "#".$val.$seperator;
}
$t = rtrim($aaa, $seperator);
$s = rtrim($bbb, $seperator);
$sel = mysqli_query($conn, "SELECT * FROM ical_events WHERE end_date <= '".$date2."' AND start_date >= '".$date1."' AND event_pid='".$property_id."'");
$row=mysqli_num_rows($sel);
if($row>0)
{
	echo "<script>alert('Some dates are already booked,Choose available dates only.');</script>";
	echo "<script>window.location='calender.php'</script>";
}
else
{
	if($count>1) //if select more than one date
	{
			echo $s;
	}
	else
	{
	echo "<script>alert('Please select minimum two days for booking.');</script>";
	echo "<script>window.location='calender.php'</script>";
	}
} //if select more than one date ends 
}  //else row > 0 ends
} // if isset $ad ends

}
?>
