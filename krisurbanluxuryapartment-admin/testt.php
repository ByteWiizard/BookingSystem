<?php
include_once('include/db.php'); 
$ical_events = $pre_fix."ical_events";
$property_details = $pre_fix."property_details";
error_reporting(-1);

    define ("DB_HOST", $servername); 
    define ("DB_USER", $username); 
    define ("DB_PASS",$password); 
    define ("DB_NAME",$db); 

    $link = @mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection."); 
    $db = @mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

    $name='ll'. date('Ymd') . ".xls"; //to rename the file
	$admin_id=1;
	$checkin='';
	$checkout='';
    header('Content-Disposition: attachment; filename='.$name); 
    header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
    header('Pragma: no-cache');
    header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');
    $msg="";
    $var="";
	if(($checkin!="")&&($checkout!=""))
	{
		//write your query   
    $sql="select start_date, end_date, text from ".$ical_events." inner join ".$property_details." ON ".$ical_events.".event_pid=".$property_details.".property_id WHERE ".$ical_events.".admin_id=$admin_id AND ".$property_details.".admin_id=$admin_id AND ".$ical_events.".end_date<='".$checkout."' AND ".$ical_events.".start_date>='".$checkin."'";
	}
	else
	{
    //write your query      
    $sql="select start_date, end_date, text from ".$ical_events." inner join ".$property_details." ON ".$ical_events.".event_pid=".$property_details.".property_id WHERE ".$ical_events.".admin_id=$admin_id AND ".$property_details.".admin_id=$admin_id";
	}
    $res = mysql_query($sql);
	$rs = mysql_num_rows($res);
	if($rs>0)
	{
    $numcolumn = mysql_num_fields($res); //will fetch number of field in table
     $msg="<table border='1'><tr><td>Check In</td><td>Check Out</td><td>Booking Details</td></tr>";
    /*for ( $i = 0; $i < $numcolumn; $i++ ) {
        $msg.="<td>";
        $msg.= mysql_field_name($res, $i);  //will store column name of the table to msg variable
        $msg.="</td>";

    }*/
    
    $i=0;
    $count=1; //used to print sl.no
    while($row=mysql_fetch_array($res))  //fetch all the row as array
    {

		$msg.="<tr>";
		$msg.="<td>".$row['start_date']."</td>";
		$msg.="<td>".$row['end_date']."</td>";
	 	$msg.="<td>".$row['text']."</td>";
        $msg.="</tr>";
		$count=$count+1;
    }

    $msg.="</table>";
	}
	else
	{
		$msg.="<table><tr><td>No records are available...</td></tr></table>";
	}
    echo $msg;  //will print the content in the exel page
?>