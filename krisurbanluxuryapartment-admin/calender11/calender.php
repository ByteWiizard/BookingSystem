 <script type="text/JavaScript">
        
            function AutoRefresh( t ) {
               setTimeout("location.reload(true);", t);
            }
         
</script>
<?php include_once("../include/db.php"); ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    @session_start();
}
$myVar = null;
if($myVar!=@$_GET['id'])
{
 	$_SESSION['myVar'] = @$_GET['id'];
	$myVar = $_SESSION['myVar'];
}
else {
    $myVar = $_SESSION['myVar'];
}
?>

<?php

 function GetDays($sStartDate, $sEndDate){  
      // Firstly, format the provided dates.  
      // This function works best with YYYY-MM-DD  
      // but other date formats will work thanks  
      // to strtotime().  
      $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  
      $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));  

      // Start the variable off with the start date  
     $aDays[] = $sStartDate;  

     // Set a 'temp' variable, sCurrentDate, with  
     // the start date - before beginning the loop  
     $sCurrentDate = $sStartDate;  

     // While the current date is less than the end date  
     while($sCurrentDate < $sEndDate){  
       // Add a day to the current date  
       $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  

       // Add this new day to the aDays array  
       $aDays[] = $sCurrentDate;  
     }  

     // Once the loop has finished, return the  
     // array of days.  
     return $aDays;  
   }  

$insert = mysqli_query($conn, "SELECT start_date,end_date FROM ical_events WHERE event_pid='".$myVar."'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($insert,MYSQLI_ASSOC))
		  {
			  @$start[] = $row['start_date'];
			  @$end[] = $row['end_date'];
			 @$ful[] = GetDays($row['start_date'], $row['end_date']);
					
		  }
if(@$ful!=""){
foreach($ful as $val)
{
		array_shift($val);
		array_pop($val);
		@$kd[] = $val;
}
}

function array_flatten($array) {

   $return = array();
   if($array!="")
   {
   foreach ($array as $key => $value) {
       if (is_array($value)){ $return = array_merge($return, array_flatten($value));}
       else {$return[$key] = $value;}
   }
   }
   return $return;
}

$array  = @$kd;

$full = array_flatten($array);

@$s_count = count($start);
@$e_count = count($end);
@$f_count = count($full);
 
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Calender</title>
<link rel="stylesheet" href="css/style.css" />
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!--- bootstrap ------>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>
<!--- bootstrap ------>
<script>
 $(document).ready(function(){
  $('div.ac').click(function(){
  var aj = $(this).data('seq');
  $('div.ac').removeClass('active');
 $(this).addClass('active');
  });
$("div.full-book").parents("td").addClass('complete');
$("div.first-half-book").parents("td").addClass('start');
$("div.last-half-book").parents("td").addClass('end');
 
  $('.booking-box.complete').click(function(event){
        event.stopPropagation();
    });
    });
</script>

<script>

 $(document).ready(function(){

$('.booking-box.complete').mouseover(function(){
  var aj = $(this).attr('id');
  var myId = '#hov-'+ $(this).attr('id');
	var pro_id = <?php echo $myVar ?> ;
   
  $.ajax({

  method: "POST",

  url: "hover.php",

  cache: false,

  data: {'dat':aj, 'id': pro_id}

  })

  .done(function( msg ) {

	var mg = $.trim(msg);
	if(mg!=""){
		$(myId).attr('style','display:block;background:#000; color:#fff; width:200px; padding:5px; z-index:9999; overflow:hidden; position:absolute; left:-90%; margin-top:-90px; ');
	$(myId).html(mg);
	}
	else
	{
		return false;
	}
  	});

	});
return false;
 })

</script>

<script>

 $(document).ready(function(){
   $( ".booking-box.complete" ).mouseout(function() {
	   $('.tuf-hov').attr('style','display:none');
  $('.tuf-hov').html("");
});
return false;
 })

</script>

<script>

 $(document).ready(function(){

$('.booking-box.start').mouseover(function(){
  var aj = $(this).attr('id');
  var myId = '#hov-'+ $(this).attr('id');
	var pro_id = <?php echo $myVar ?> ;
   
  $.ajax({

  method: "POST",

  url: "hover.php",

  cache: false,

  data: {'dat':aj, 'id': pro_id}

  })

  .done(function( msg ) {

	var mg = $.trim(msg);
	if(mg!=""){
		$(myId).attr('style','display:block;background:#000; color:#fff; width:200px; padding:5px; z-index:9999; overflow:hidden; position:absolute; left:-90%; margin-top:-90px; ');
	$(myId).html(mg);
	}
	else
	{
		return false;
	}
  	});

	});
return false;
 })

</script>

<script>

 $(document).ready(function(){
   $( ".booking-box.start" ).mouseout(function() {
	   $('.tuf-hov').attr('style','display:none');
  $('.tuf-hov').html("");
});
return false;
 })

</script>

<script>

 $(document).ready(function(){

$('.before-today.complete').mouseover(function(){
  var aj = $(this).attr('id');
  var myId = '#hov-'+ $(this).attr('id');
	var pro_id = <?php echo $myVar ?> ;
   
  $.ajax({

  method: "POST",

  url: "hover.php",

  cache: false,

  data: {'dat':aj, 'id': pro_id}

  })

  .done(function( msg ) {

	var mg = $.trim(msg);
	if(mg!=""){
		$(myId).attr('style','display:block;background:#000; color:#fff; width:200px; padding:5px; z-index:9999; overflow:hidden; position:absolute; left:-90%; margin-top:-90px; ');
	$(myId).html(mg);
	}
	else
	{
		return false;
	}
  	});

	});
return false;
 })

</script>

<script>

 $(document).ready(function(){
   $( ".before-today.complete" ).mouseout(function() {
	   $('.tuf-hov').attr('style','display:none');
  $('.tuf-hov').html("");
});
return false;
 })

</script>

<script>

 $(document).ready(function(){

$('.before-today.start').mouseover(function(){
  var aj = $(this).attr('id');
  var myId = '#hov-'+ $(this).attr('id');
	var pro_id = <?php echo $myVar ?> ;
   
  $.ajax({

  method: "POST",

  url: "hover.php",

  cache: false,

  data: {'dat':aj, 'id': pro_id}

  })

  .done(function( msg ) {

	var mg = $.trim(msg);
	if(mg!=""){
		$(myId).attr('style','display:block;background:#000; color:#fff; width:200px; padding:5px; z-index:9999; overflow:hidden; position:absolute; left:-90%; margin-top:-90px; ');
	$(myId).html(mg);
	}
	else
	{
		return false;
	}
  	});

	});
return false;
 })

</script>
<script>

 $(document).ready(function(){
   $( ".before-today.start" ).mouseout(function() {
	   $('.tuf-hov').attr('style','display:none');
  $('.tuf-hov').html("");
});
return false;
 })

</script>

<script>

 $(document).ready(function(){

$('.today.start').mouseover(function(){
  var aj = $(this).attr('id');
  var myId = '#hov-'+ $(this).attr('id');
	var pro_id = <?php echo $myVar ?> ;
   
  $.ajax({

  method: "POST",

  url: "hover.php",

  cache: false,

  data: {'dat':aj, 'id': pro_id}

  })

  .done(function( msg ) {

	var mg = $.trim(msg);
	if(mg!=""){
		$(myId).attr('style','display:block;background:#000; color:#fff; width:200px; padding:5px; z-index:9999; overflow:hidden; position:absolute; left:-90%; margin-top:-90px; ');
	$(myId).html(mg);
	}
	else
	{
		return false;
	}
  	});

	});
return false;
 })

</script>

<script>

 $(document).ready(function(){
   $( ".today.start" ).mouseout(function() {
	   $('.tuf-hov').attr('style','display:none');
  $('.tuf-hov').html("");
});
return false;
 })

</script>

<script>

 $(document).ready(function(){

$('.today.complete').mouseover(function(){
  var aj = $(this).attr('id');
  var myId = '#hov-'+ $(this).attr('id');
	var pro_id = <?php echo $myVar ?> ;
   
  $.ajax({

  method: "POST",

  url: "hover.php",

  cache: false,

  data: {'dat':aj, 'id': pro_id}

  })

  .done(function( msg ) {

	var mg = $.trim(msg);
	if(mg!=""){
		$(myId).attr('style','display:block;background:#000; color:#fff; width:200px; padding:5px; z-index:9999; overflow:hidden; position:absolute; left:-90%; margin-top:-90px; ');
	$(myId).html(mg);
	}
	else
	{
		return false;
	}
  	});

	});
return false;
 })

</script>

<script>

 $(document).ready(function(){
   $( ".today.complete" ).mouseout(function() {
	   $('.tuf-hov').attr('style','display:none');
  $('.tuf-hov').html("");
});
return false;
 })

</script>

<script>
function check()
{
var retVal= confirm(" Do you want to delete? ");
if(retVal==true)
{
	return true ;
}
else
{
	return false ;
}
}
</script>
<?php
/* MULTI-REMOVAL-SCRIPT */
$server_url = $_SERVER['REQUEST_URI'];
$ex = explode("?", $server_url);
$url = $ex[0];
$url = strip_tags($url, '<br/>');
?>
<?php
if (strpos($server_url,'&') == false) {
    ?>
    	<script>
		$(document).ready(function(){
			$(".leftButton").hide();
			$(".ret-book").hide();
		})
		</script>
    <?php
}

$month_check=date('n');
$year_check =date('Y');
$count_month_len = strlen($month_check);
if($count_month_len==1)
{
	 $new_month = "0".$month_check;
}
else
{
	 $new_month = $month_check;
}

if(strpos($server_url,'month='.$new_month.'&year='.$year_check) !== false)
	{
	?>
 <script>
		$(document).ready(function(){
			$(".leftButton").hide();
			$(".ret-book").hide();
			
		})
</script>
<?php
}
?>

<script>
/*calender back button*/
function goLastMonth(month, year){
	if(month == 1)
	{
		--year;
		month = 13;
	}
	--month;
	var monthstring = ""+month+"";
	var monthlength = monthstring.length;
	if(monthlength <= 1)
	{
		monthstring = "0" + monthstring;
	}
	document.location.href = "<?php $_SERVER['PHP_SELF'] ;?>?month="+monthstring+"&year="+year;
}
/*calender forward button */
function goNextMonth(month, year){
	if(month == 12)
	{
		++year;
		month = 0;
	}
	++month;
	var monthstring = ""+month+"";
	var monthlength = monthstring.length;
	if(monthlength <= 1)
	{
		monthstring = "0" + monthstring;
	}
	document.location.href = "<?php $_SERVER['PHP_SELF'] ;?>?month="+monthstring+"&year="+year;
}
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
$(document).ready(function(e) {
	$('#book-sub').click(function(){
    var name = $('#first-name').val();
	var email = $('#email').val();
	
if(name=="")
	{
		alert('Please enter Name.');
		$('#first-name').focus();
		return false;
	}
	if(email=="")
	{
		alert('Please enter Email.');
		$('#email').focus();
		return false;
	}

    $.ajax({
  method: "POST",
  url: "bookpage.php",
  cache: false,
  data: $("form#myform :input").serializeArray()
  })
  .done(function( msg ) {
	var msg1 = $.trim(msg);
	alert(msg1);
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
			return false;	 
  	});
         return false;
	});
})
</script>

</head>

<body onLoad="JavaScript:AutoRefresh(320000);">
<div class="container topCon">
<?php
$a ="<div class='success-msg' style='display:none'></div>";
echo $a;
?>
<?php
//--------- First Table Starts -----------//

if(isset($_GET['month']))
{
	$month = $_GET['month'];
}
else
{
$month=date('n');

}
if(isset($_GET['year']))
{
	$year = $_GET['year'];
}
else
{
$year=date('Y');
}
// Calender Variable
$day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$currentTimeStamp = strtotime("$year-$month-$day");
$monthName = date("F", $currentTimeStamp);
$numDays = date("t", $currentTimeStamp);
$counter = 0;
?>
<?php
$nw = mysqli_query($conn, "SELECT property_heading FROM property_details WHERE id='".$myVar."'");
@$pp = mysqli_fetch_assoc($nw);
@$prop_name = $pp['property_heading'];
?>

<p align="center"><strong>Please select two unbooked dates for booking by clicking on the dates.</strong></p>
<iframe src="ical_link/index1.php?property=<?php echo $myVar ;?>&prop_name=<?php echo $prop_name ;?>" frameborder="0" width="100%" height="150px" scrolling="no"></iframe>

<div id="next-prev" class="prev-next">

<div class="col-md-4">
<div class="leftButton">
<button name="prev-button" onClick="goLastMonth(<?php echo $month.",".$year ?>)"> <i aria-hidden="true" class="fa fa-arrow-left"></i> Previous Month </button></div>
</div>

<div class="col-md-4">
<div class="remove_tab">

<a class="multi" href=""><button>Click to Refresh</button></a>

</div>
</div>

<div class="col-md-4">
<div class="rightButton">
<button name="next-button" onClick="goNextMonth(<?php echo $month.",".$year ?>)">Next Month <i aria-hidden="true" class="fa fa-arrow-right"></i></button></div>
</div>

<div style="clear:both;"></div>
</div>

	<div class="col-md-12 back_booking">
	<a class='ret-book' href='<?php echo $url ?>'>Back to Current Date</a>
	</div>

</div>

<div class="container" id="call-box-s">
	<div class="tabl_1 col-md-6">
<table id="table-1">
<tr class="hea">
	<td><div class="cell"></div></td>
	<td colspan="5" class="cell5"><?php echo $monthName.", ".$year ;?></td>
    <td><div class="cell"></div></td>
</tr>
<tr>
	<td><div class="cell">Sun</div></td>
    <td><div class="cell">Mon</div></td>
    <td><div class="cell">Tues</div></td>
    <td><div class="cell">Wed</div></td>
    <td><div class="cell">Thu</div></td>
    <td><div class="cell">Fri</div></td>
    <td><div class="cell">Sat</div></td>
</tr>

<?php
echo "<tr>";
	for($i=1; $i < $numDays+1; $i++, $counter++)
		{
			$timeStamp = strtotime("$year-$month-$i");
			if($i==1)
			{
				$firstDay = date("w", $timeStamp);
			
			for($j=0; $j < $firstDay; $j++, $counter++)
			{
				//blank space
				echo "<td><div class='cell'></div></td>";
			}
		  }
		 if($counter%7 == 0)
		  {
			 echo "</tr><tr>";
		  }
		  $monthstring = $month;
		  $monthlength = strlen($monthstring);
		  $daystring = $i;
		  $daylength = strlen($daystring);
		  if($monthlength <= 1)
		  {
			$monthstring = "0".$monthstring;  
		  }
		  if($daylength <= 1)
		  {
			$daystring = "0".$daystring;  
		  }
		  
		  $todaysDate = date("Y-m-d");
		  $bookdate = $year."-".$monthstring."-".$daystring;
		  $format = "Y-m-d";
		   $date1  = DateTime::createFromFormat($format, $todaysDate);
		   $date2  = DateTime::createFromFormat($format, $bookdate);
		 
		  echo "<td ";
		  if($date2 < $date1)
		  {
			  echo "class='before-today' id='".$bookdate."'";
		  }
		  elseif($todaysDate==$bookdate)
		  {
			  echo "class='today' id='".$bookdate."'";
		  }
		  else
		  {
			  echo "class='booking-box' id='".$bookdate."'";
		  }
		  
		  echo "><div class='ac cell' id='book-".$bookdate."' data-theme='div' data-seq='".$bookdate."' href=''>".$i."<span id='hov-".$bookdate."' class='tuf-hov' style='display:none;'></span></div>";
		 if(isset($start)){
			  
			  for($k=0;$k<$s_count;$k++)
			  {
				  if($start[$k]==$bookdate)
				    {
				
			  				echo "<div class='first-half-book'><img src='img/left.png' /></div>";
						
			  		}
			  } 	 
		
			  }
			  if(isset($full)){
			  
			  for($l=0;$l<$f_count;$l++)
			  {
				  if($full[$l]==$bookdate)
				    {
				
			  				echo "<div class='full-book'><img src='img/full.png' /></div>";
						
			  		}
			  } 	 
		
			  }
			   if(isset($end)){
			  
			  for($m=0;$m<$e_count;$m++)
			  {
				  if($end[$m]==$bookdate)
				    {
				
			  				echo "<div class='last-half-book'><img src='img/right.png' /></div>";
						
			  		}
			  } 	 
		
			  }
		  echo "</td>";
		}
echo "</tr>";

?>
</table>
</div>
	<?php //--------- First Table Ends -----------// ?>

<?php

//--------- Second Table Starts -----------//

if(isset($_GET['month']))
{
	$month = $_GET['month']+1;
	if($_GET['month']==12){
	$month=1;
	}
}
else
{
$month=date('n', strtotime('+1 month'));
}
if(isset($_GET['year']))
{
	if($_GET['month']==12)
	{
		$year=$_GET['year']+1;
	}
	else
	{
	$year = $_GET['year'];
	}
}
else
{
if($month==1)
{
	$year=date('Y', strtotime('+1 year'));
}
else
{
	$year=date('Y');	
}
}
// Calender Variable
$day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
 $currentTimeStamp = strtotime("$year-$month-$day");
$monthName = date("F", $currentTimeStamp);
$numDays = date("t", $currentTimeStamp);
$counter = 0;
?>
<div class="tabl_2 col-md-6">
<table id="table-2" >
<tr class="hea">
	<td align="center"></td>
	<td colspan="5" class="cell5"><?php echo $monthName.", ".$year ;?></td>
    <td align="center"></td>
</tr>
<tr>
	 <td><div class="cell">Sun</div></td>
    <td><div class="cell">Mon</div></td>
    <td><div class="cell">Tues</div></td>
    <td><div class="cell">Wed</div></td>
    <td><div class="cell">Thu</div></td>
    <td><div class="cell">Fri</div></td>
    <td><div class="cell">Sat</div></td>
</tr>

<?php
echo "<tr>";
	for($i=1; $i < $numDays+1; $i++, $counter++)
		{
			$timeStamp = strtotime("$year-$month-$i");
			if($i==1)
			{
				$firstDay = date("w", $timeStamp);
			
			for($j=0; $j < $firstDay; $j++, $counter++)
			{
				//blank space
				echo "<td><div class='cell'></div></td>";
			}
		  }
		 if($counter%7 == 0)
		  {
			 echo "</tr><tr>";
		  }
		  $monthstring = $month;
		  $monthlength = strlen($monthstring);
		  $daystring = $i;
		  $daylength = strlen($daystring);
		  if($monthlength <= 1)
		  {
			$monthstring = "0".$monthstring;  
		  }
		  if($daylength <= 1)
		  {
			$daystring = "0".$daystring;  
		  }
		  
		  $todaysDate = date("Y-m-d");
		  $bookdate = $year."-".$monthstring."-".$daystring;
		  $format = "Y-m-d";
		   $date1  = DateTime::createFromFormat($format, $todaysDate);
		   $date2  = DateTime::createFromFormat($format, $bookdate);
		 
		   echo "<td ";
		  if($date2 < $date1)
		  {
			  echo "class='before-today' id='".$bookdate."'";
		  }
		  elseif($todaysDate==$bookdate)
		  {
			  echo "class='today' id='".$bookdate."'";
		  }
		  else
		  {
			  echo "class='booking-box' id='".$bookdate."'";
		  }
		  
		  echo "><div class='ac cell' id='book-".$bookdate."' data-theme='div' data-seq='".$bookdate."' href=''>".$i."<span id='hov-".$bookdate."' class='tuf-hov' style='display:none;'></span></div>";
		 if(isset($start)){
			  
			  for($k=0;$k<$s_count;$k++)
			  {
				  if($start[$k]==$bookdate)
				    {
				
			  				echo "<div class='first-half-book'><img src='img/left.png' /></div>";
						
			  		}
			  } 	 
		
			  }
			  if(isset($full)){
			  
			  for($l=0;$l<$f_count;$l++)
			  {
				  if($full[$l]==$bookdate)
				    {
				
			  				echo "<div class='full-book'><img src='img/full.png' /></div>";
						
			  		}
			  } 	 
		
			  }
			   if(isset($end)){
			  
			  for($m=0;$m<$e_count;$m++)
			  {
				  if($end[$m]==$bookdate)
				    {
				
			  				echo "<div class='last-half-book'><img src='img/right.png' /></div>";
						
			  		}
			  } 	 
		
			  }
		  echo "</td>";
		}
echo "</tr>";

?>
</table>

</div>

<?php //--------- Second Table Ends -----------// ?>
    
</div>
<!------- Start Hiding 3rd and 4th table here -------------
<div class="container">

<?php
//--------- Third Table Starts -----------//

if(isset($_GET['month']))
{
	$month = $_GET['month']+2;
	if($_GET['month']==11){
	$month=1;
	}
	if($_GET['month']==12){
	$month = 2;
	}
}
else
{
$month=date('n', strtotime('+2 month'));
}
if(isset($_GET['year']))
{
	if((10 < $_GET['month']) && ($_GET['month']<=12) )
	{
		$year=$_GET['year']+1;
	}
	else
	{
	$year = $_GET['year'];
	}
}
else
{
	if(($month==1)||($month==2))
{
	$year=date('Y', strtotime('+1 year'));
}
else
{
	$year=date('Y');	
}
}
// Calender Variable
$day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$currentTimeStamp = strtotime("$year-$month-$day");
$monthName = date("F", $currentTimeStamp);
$numDays = date("t", $currentTimeStamp);
$counter = 0;
?>
<div class="tabl_3 col-md-6">
<table id="table-3" >
<tr class="hea">
	<td align="center"></td>
	<td colspan="5" class="cell5"><?php echo $monthName.", ".$year ;?></td>
    <td align="center"></td>
</tr>
<tr>
	 <td><div class="cell">Sun</div></td>
    <td><div class="cell">Mon</div></td>
    <td><div class="cell">Tues</div></td>
    <td><div class="cell">Wed</div></td>
    <td><div class="cell">Thu</div></td>
    <td><div class="cell">Fri</div></td>
    <td><div class="cell">Sat</div></td>
</tr>

<?php
echo "<tr>";
	for($i=1; $i < $numDays+1; $i++, $counter++)
		{
			$timeStamp = strtotime("$year-$month-$i");
			if($i==1)
			{
				$firstDay = date("w", $timeStamp);
			
			for($j=0; $j < $firstDay; $j++, $counter++)
			{
				//blank space
				echo "<td><div class='cell'></div></td>";
			}
		  }
		 if($counter%7 == 0)
		  {
			 echo "</tr><tr>";
		  }
		  $monthstring = $month;
		  $monthlength = strlen($monthstring);
		  $daystring = $i;
		  $daylength = strlen($daystring);
		  if($monthlength <= 1)
		  {
			$monthstring = "0".$monthstring;  
		  }
		  if($daylength <= 1)
		  {
			$daystring = "0".$daystring;  
		  }
		  
		  $todaysDate = date("Y-m-d");
		  $bookdate = $year."-".$monthstring."-".$daystring;
		   $format = "Y-m-d";
		   $date1  = DateTime::createFromFormat($format, $todaysDate);
		   $date2  = DateTime::createFromFormat($format, $bookdate);
		 
		  echo "<td align='center'";
		  if( $date2 < $date1 )
		   {
			   echo "class='before-today' id='".$bookdate."'";
		   }
		   
		  elseif($todaysDate==$bookdate)
		  {
			  echo "class='today' id='".$bookdate."'";
		  }
		  
		  else
		  {
			  echo "class='booking-box' id='".$bookdate."'";
		  }
		  
		  echo "><div class='ac' id='book-".$bookdate."' data-theme='div' data-seq='".$bookdate."' href=''>".$i."<span id='hov-".$bookdate."' class='tuf-hov' style='display:none;'></span></div>";
		 if(isset($matching)){
			  
			  for($k=0;$k<$count;$k++)
			  {
				  if($matching[$k]==$bookdate)
				    {
						if($booking_state[$k]==1)
						{
			  				echo "<div class='full-book'><img src='images/full.png'></div>";
						}
						if($booking_state[$k]==2)
						{
			  				echo "<div class='first-half-book'><img src='images/left.png'></div>";
						}
						if($booking_state[$k]==3)
						{
			  				echo "<div class='last-half-book'><img src='images/right.png'></div>";
						}
			  		}
			  } 	 
		
		}
		  echo "</td>";
		}
echo "</tr>";

?>
</table>
</div>
<?php //--------- Third Table Ends -----------// ?>


    
<?php
//--------- Fourth Table Starts -----------//

if(isset($_GET['month']))
{
	$month = $_GET['month']+3;
	if($_GET['month']==10){
	$month=1;
	}
	if($_GET['month']==11){
	$month=2;
	}
	if($_GET['month']==12){
	$month = 3;
	}
	
}
else
{
$month=date('n', strtotime('+3 month'));
}

if(isset($_GET['year']))
{
	if((9 < $_GET['month']) && ($_GET['month']<=12) )
	{
		$year=$_GET['year']+1;
	}
	else
	{
	$year = $_GET['year'];
	}
}
else
{
	if(($month==1)||($month==2)||($month==3))
{
	$year=date('Y', strtotime('+1 year'));
}
else
{
	$year=date('Y');	
}
}
// Calender Variable
$day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$currentTimeStamp = strtotime("$year-$month-$day");
$monthName = date("F", $currentTimeStamp);
$numDays = date("t", $currentTimeStamp);
$counter = 0;
?>
<div class="tabl_4 col-md-6">
<table id="table-4" >
<tr class="hea">
	<td align="center"></td>
	<td colspan="5" class="cell5"><?php echo $monthName.", ".$year ;?></td>
    <td align="center"></td>
</tr>
<tr>
	 <td><div class="cell">Sun</div></td>
    <td><div class="cell">Mon</div></td>
    <td><div class="cell">Tues</div></td>
    <td><div class="cell">Wed</div></td>
    <td><div class="cell">Thu</div></td>
    <td><div class="cell">Fri</div></td>
    <td><div class="cell">Sat</div></td>
</tr>

<?php
echo "<tr>";
	for($i=1; $i < $numDays+1; $i++, $counter++)
		{
			$timeStamp = strtotime("$year-$month-$i");
			if($i==1)
			{
				$firstDay = date("w", $timeStamp);
			
			for($j=0; $j < $firstDay; $j++, $counter++)
			{
				//blank space
				echo "<td><div class='cell'></div></td>";
			}
		  }
		 if($counter%7 == 0)
		  {
			 echo "</tr><tr>";
		  }
		  $monthstring = $month;
		  $monthlength = strlen($monthstring);
		  $daystring = $i;
		  $daylength = strlen($daystring);
		  if($monthlength <= 1)
		  {
			$monthstring = "0".$monthstring;  
		  }
		  if($daylength <= 1)
		  {
			$daystring = "0".$daystring;  
		  }
		  
		  $todaysDate = date("Y-m-d");
		  $bookdate = $year."-".$monthstring."-".$daystring;
		  $format = "Y-m-d";
		   $date1  = DateTime::createFromFormat($format, $todaysDate);
		   $date2  = DateTime::createFromFormat($format, $bookdate);
		 
		  echo "<td align='center'";
		  if( $date2 < $date1 )
		   {
			   echo "class='before-today' id='".$bookdate."'";
		   }
		  
		  if($todaysDate==$bookdate)
		  {
			  echo "class='today' id='".$bookdate."'";
		  }
		  
		  else
		  {
			  echo "class='booking-box' id='".$bookdate."'";
		  }
		  
		  echo "><div class='ac' id='book-".$bookdate."' data-theme='div' data-seq='".$bookdate."' href=''>".$i."<span id='hov-".$bookdate."' class='tuf-hov' style='display:none;'></span></div>";
		 if(isset($matching)){
			  
			  for($k=0;$k<$count;$k++)
			  {
				  if($matching[$k]==$bookdate)
				    {
						if($booking_state[$k]==1)
						{
			  				echo "<div class='full-book'><img src='images/full.png'></div>";
						}
						if($booking_state[$k]==2)
						{
			  				echo "<div class='first-half-book'><img src='images/left.png'></div>";
						}
						if($booking_state[$k]==3)
						{
			  				echo "<div class='last-half-book'><img src='images/right.png'></div>";
						}
			  		}
			  } 	 
		
		}
		  echo "</td>";
		}
echo "</tr>";
?>
</table>
</div>

<?php //--------- Fourth Table Ends -----------// ?>
<--------ends hiding 3rd And 4th table------------>

</div>

<div class="cal_details">
	<ul>
		<li>Current Date <img src="images/current_date.png" alt="am"></li>
		
		<li>Start Date <img src="images/pm.png" alt="am"></li>
		<li>End Date <img src="images/am.png" alt="pm"></li>
		<li>Booked <img src="images/full_book.png" alt="full Book"></li>
	</ul>
</div>

<div id="demo" style="display:none"></div>
<div class="new-show">
<?php
$admin_id = $_SESSION['admin_id'];
?>
<?php

$per_page= 5; // number of user to show
$page_query=mysqli_query($conn,"SELECT client_id FROM client_details  WHERE property_id='".$myVar."' AND admin_id='".$admin_id."'");
$pages=ceil(mysqli_num_rows($page_query) / $per_page); //total number of pages to show
$page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1; // current page list
$start= ($page - 1) * $per_page; //start list of user from zero becoz php starts from zero

 $fetch11 = mysqli_query($conn,"SELECT * FROM client_details WHERE property_id='".$myVar."' AND admin_id='".$admin_id."'  ORDER BY client_id DESC LIMIT $start, $per_page");
	   @$num11 = mysqli_num_rows($fetch11);
	   if($num11>0)
	   {
 ?>
  <table class="table" align="center">
    <thead>
      <tr>
        <th scope="col"> S.No </th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">firstdate</th>
        <th scope="col">lastdate</th>
        <th scope="col">adddate</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    
    <tbody>
   
    <?php
		
		while($show11 = mysqli_fetch_assoc($fetch11))
		  {
			$client_id = $show11['client_id'];
			$property_id = $show11['property_id'];
			$name=$show11['name'];
			$email=$show11['email'];
			$firstdate=$show11['firstdate'];
			$lastdate=$show11['lastdate'];
			$adddate=$show11['adddate'];  
	?>
      <tr>
      	<td><?php echo ++$start; ?></td>
        <td data-title="Property name"><?php echo @$name; ?> </td>
        <td data-title="Property email"><?php echo @$email ?></td>
        <td data-title="First date" ><?php echo @$firstdate; ?></td>
        <td data-title="Last date" ><?php echo @$lastdate; ?></td>
        <td data-title="Add date" ><?php echo @$adddate; ?></td>
   
        <form action="" method="post">
        <td data-title="Delete" ><input type="hidden" name="delete_property" value="<?php echo @$client_id ; ?>"><button type="submit" name="delete_pro_button" onClick="return check()"><i class="fa fa-trash"></i></button></td>
        </form>
          </tr>
          <?php
             }
          ?>
         
    	</tbody>
	 </table>
  
  <div style="text-align:center">
<nav aria-label="Page navigation">
  <ul class="pagination">
<?php
/* ----------------- Pages Links -------------- */

$prev=$page - 1;
$next=$page + 1;
if(!($page<=1))
echo  "<li><a href='?page=$prev' aria-label='Previous'> <span aria-hidden='true'>&laquo;</span> </a> </li>";

if($pages>=1)
{
	for($x=1;$x<=$pages;$x++){
	echo ($x==$page) ? '<li class="active"><a href="?page='.$x.'">'.$x.'</a></li>' : '<li><a href="?page='.$x.'">'.$x.'</a></li>' ;
	}
	
}

if(!($page>=$pages))
{
echo "<li> <a href='?page=$next' aria-label='Next'> <span aria-hidden='true'>&raquo;</span> </a> </li>";
}
/*-------------------------------------------------*/

?>

</ul>
</nav>
</div>
     <?php
	   }
	   ?>
	 </div>
<!--
<form id="my-form" method="post" action="contact.php">

<input type="text" name="first" id="first-name" class="datepicker1" required="required" />
<input type="text" name="last" id="last-name" class="datepicker1" required="required" />
<input type="submit" class="book_submit" name="sub_book" value="Click to book" />

</form>
-->
<!-- Pop Up form -->
<div class="modal fade" id="my-form">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>&times;</span></button>
            <h4 class="modal-title">Signup</h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal">
            	<div class="form-group">
                	<label class="col-md-4 col-md-offset-1">Name</label>
                    <div class="col-md-5">
                    	<input type="text" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                    	<input type="submit" class="form-control input-sm" />
                    </div>
                </div>
                 <div class="modal-footer">
                 </div>  
            </form> 
		</div>
	</div>
</div>
<div id="dialog" class="ui-dialog" title="Basic dialog">
<form id="myform" method="post" action="">
 				<div class="form-group">
                	<label class="col-md-4 col-md-offset-1">Name</label>
                    <div class="col-md-8">
                    	<input type="text" name="first-name" id="first-name" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-md-4 col-md-offset-1">Email</label>
                    <div class="col-md-8">
                    	<input type="email" name="email" id="email" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-md-4 col-md-offset-1">First date</label>
                    <div class="col-md-8">
                    	<input type="text" name="first" id="first-date" class="datepicker1" readonly/>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-md-4 col-md-offset-1">Last date</label>
                    <div class="col-md-8">
                    	<input type="text" name="last" id="last-date" class="datepicker1" readonly/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                    	<input type="hidden" name="id" value="<?php echo $myVar ?>"  />
                    	<input type="submit" name="book-sub" id="book-sub" class="form-control input-sm" value="Book" />
                    </div>
                </div>
</form>   
</div>
<script>
/* MULTI-SELECT-SCRIPT */

    $(document).ready(function(){
		$('#my-form').hide();
		$('.before-today').click(function(event){
        event.stopPropagation();
    });
	
		$('.booking-box.complete').click(function(event){
        event.stopPropagation();
    });
  
	$('div.ac').click(function(){
		
		var pro_id = <?php echo $myVar ?> ;
		 var aj = $(this).data('seq');
		 $('div.ac').removeClass('active');
		 $(this).addClass('active');
		 var k = $('#demo').append(aj+',');
		  var ki = $('#demo').html();
		
		$.ajax({
  method: "POST",
  url: "insert.php",
  cache: false,
  data: {data: ki, 'id': pro_id}
  //data: $("div#myform :input").serializeArray()
})

  .done(function( msg ) {
	  if(msg !=" ")
	  {
		  var count = ki.split(',').length; // results 4
		  
			if (count % 2 == 0)
			{
			  var cc = 'even';
			}
			else
			{
			  var cc = 'odd';
			} 
    $('.success-msg').html(msg);
	var msg2 = msg;
	
	var msg1 = msg2.split(',');
	var arr1 = jQuery.makeArray( msg1 );

	
	var lastEl = msg1.slice(-1)[0];
	var one = msg1[0];
	var first_date = one.replace('#', '');
	var two = lastEl;
	var last_date = two.replace('#', '');
	fi = $("#first-date").val();
	la = $("#last-date").val();

	if((fi ===" ") || (la ===" ") || (arr1 == ""))
	{
		$( ".booking-box" ).removeClass( "selected" );
		$("#dialog").dialog('close');
	}
	else
	{
		if(cc == 'even')
		{
			$( ".booking-box" ).removeClass( "selected" );
		$("#dialog").dialog('close');
		}
		if(cc == 'odd')
		{
		 $("#dialog").dialog({
        height: 238,
        width: 465,
        resizable: false,
        title: "Booking form",
		show: {effect: 'drop', direction: "up"},
    });
   var s = $("#first-date").val(first_date);
	var l = $("#last-date").val(last_date);
		jQuery.each( arr1, function( i, val) {
	$( val ).addClass( "selected" );
	// Will stop running after "three"
  		//return ( val !== "three" );
	});
		}
	}
	  }
	  else
	  {
		$( ".booking-box" ).removeClass( "selected" );
		$("#dialog").dialog('close');
	  }
 	 });
	});
	
});
</script>

<?php
if(isset($_POST['delete_pro_button']))
{
	$del = $_POST['delete_property'];
	$admin_id = $_SESSION['admin_id'];
	
			$fety = mysqli_query($conn, "SELECT * FROM client_details WHERE client_id='".$del."' AND admin_id='".$admin_id."'");
			if($fety)
			{
			while($rowy = mysqli_fetch_assoc($fety))
			{	
				$prop_id = $rowy['property_id'];
				$email1 = $rowy['email'];
				$req_num  = $rowy['req_num'];
				$firstdate1 = $rowy['firstdate'];
				$lastdate1 = $rowy['lastdate'];
			}
			
            
			$delet_ical = mysqli_query($conn, "DELETE FROM ical_events WHERE  admin_id='".$admin_id."' AND start_date='".$firstdate1."' AND end_date='".$lastdate1."' AND event_pid='".$prop_id."'") or die(mysqli_error($conn));
			
			$dele = mysqli_query($conn, "DELETE FROM client_details WHERE property_id='".$prop_id."' AND client_id='".$del."' AND admin_id='".$admin_id."' AND req_num='".$req_num."'") or die(mysqli_error($conn));
			
			?>
			<script>
			alert('Delete successfully.');
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
            </script>
            <?php
		}
         
}
?>

</body>
</html>