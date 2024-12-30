<?php
include_once('../include/db.php');
if(isset($_POST['id']))
{
	$property_id = $_POST['id'];
	$dat = $_POST['dat'];
	
$sel = mysqli_query($conn, "SELECT * FROM ical_events WHERE event_pid='".$property_id."' AND end_date > '".$dat."' AND start_date <= '".$dat."'");

$row=mysqli_num_rows($sel);
$book_client = mysqli_fetch_assoc($sel);

if($row>0)
	{
		echo $book_client['text'];
	}
}
?>