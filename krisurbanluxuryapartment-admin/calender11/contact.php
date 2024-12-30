<?php
include_once('includes/db.php');
$server_url = @$_SERVER["HTTP_REFERER"];
if(isset($_POST['sub_book']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$from = test_input($_POST['first']);
	$to = test_input($_POST['last']);
	if($from > $to)
	{
		echo "<script>alert('From Date is not less than To Date,Try to select a valid date.');</script>";
		echo "<script>window.location='$server_url'</script>";
	}
	else
	{
		
				echo "<h2>WELCOME TO BOOKING CALCULATION PAGE.</h2>";
				echo"<br/>From: ".$from;
				echo"<br/>To: ".$to;
		
	}
}
else
{
	echo "<script>window.location='calender.php'</script>";
}
?>