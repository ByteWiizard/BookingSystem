<?php
	include_once("../include/db.php");
	$ical_events = $pre_fix."ical_events";
	$property_details = $pre_fix."property_details";
	$client_details = $pre_fix."client_details";
   	@session_start();
	$myVar =null;

if($myVar!= @$_GET['id'])
{
	$myVar = @$_GET['id'];
        $_SESSION['back_url']= $_SERVER['HTTP_REFERER'];
        $my_url = $_SESSION['back_url'];
}
else {
    $myVar = @$_GET['id'];
    $my_url = $_SESSION['back_url'];
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

     $aDays[] = gmdate("m-d-Y", strtotime($sStartDate)); 
     // Set a 'temp' variable, sCurrentDate, with  

     // the start date - before beginning the loop  

     $sCurrentDate = $sStartDate;  
     // While the current date is less than the end date  

     while($sCurrentDate < $sEndDate){
       // Add a day to the current date  

       $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  
       // Add this new day to the aDays array  
       $date = DateTime::createFromFormat('Y-m-d', $sCurrentDate);
       $nice_date = $date->format('m-d-Y');
       $aDays[] = $nice_date; 

     }

     // Once the loop has finished, return the  

     // array of days.  

     return $aDays;  

   }

$insert = mysqli_query($conn, "SELECT start_date,end_date FROM ".$ical_events." WHERE event_pid='".$myVar."'") or die(mysqli_error($conn));

while($row = mysqli_fetch_array($insert,MYSQLI_ASSOC))

		  {
              
			  $sdate = DateTime::createFromFormat('Y-m-d', $row['start_date']);
               $start_dates = $sdate->format('m-d-Y');
			  $edate = DateTime::createFromFormat('Y-m-d', $row['end_date']);
               $end_dates = $edate->format('m-d-Y');
			  
			  @$start[] = $start_dates;

			  @$end[] = $end_dates;

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
<?php
$ser = mysqli_query($conn, "SELECT property_heading FROM ".$property_details." WHERE property_id='".$myVar."'") or die(mysqli_error($conn));
while(@$row1 = mysqli_fetch_array($ser,MYSQLI_ASSOC))
		  {
			  $pro_head = $row1['property_heading'];
		  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Calendar</title>
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
<style>
#cursor
{
  font-size: 20px;
  font-weight:600;
  color: #424bf4;
}

@media only screen and (max-width: 768px) {
#prop_ical{
height:100px !important;
}
}
</style>
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

$url = $ex[0]."?id=$myVar";

$url = strip_tags($url, '<br/>');

?>

<script>
		$(document).ready(function(){
			$(".leftButton").hide();
		})
		</script>
<?php

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
?>

<script>
$(document).ready(function(){
$("#tt").hide();
})

</script>

<script>

/*calender back button*/

function goLastMonth(month, year){

$(".leftButton").show();

	if(month == 1)

	{
		--year;

		month = 13;

	}
	if(month == 2)

	{
		--year;

		month = 14;

	}

	--month;
    --month;
	var monthstring = ""+month+"";

	var monthlength = monthstring.length;

	if(monthlength <= 1)

	{

		monthstring = "0" + monthstring;

	}

	// document.location.href = "<?php $_SERVER['PHP_SELF'] ;?>?month="+monthstring+"&year="+year;


	var element = document.getElementById("pp");
  element.setAttribute("onClick", "goLastMonth("+monthstring+","+year+")"); 
  var element = document.getElementById("tt");
  element.setAttribute("onClick", "goNextMonth("+monthstring+","+year+")");
  
            var id = <?php echo $myVar ?>;
            var month = monthstring ;
            var year = year ; // or get them from the user's choice. I am hardcoding them here
            var url  = "calander_function.php";
            $.ajax({'url' : url ,
                'type' : 'post',
                'data' : {'month' : month , 'year' : year , 'proId' : id } ,
                'success' : function(data){
                    $('#tabl').html(data);
                }
            });

}

/*calender forward button */
function goNextMonth(month, year){
	if(month == 11)
	{
		++year;
		month = -1;
	}

	if(month == 12)
	{
		++year;
		month = 0;
	}
	++month;
	++month;
	var monthstring = ""+month+"";
	var monthlength = monthstring.length;
	if(monthlength <= 1)
	{
		monthstring = "0" + monthstring;
	}
	// document.location.href = "<?php $_SERVER['PHP_SELF'] ;?>?month="+monthstring+"&year="+year;
   var element = document.getElementById("tt");
  element.setAttribute("onClick", "goNextMonth("+monthstring+","+year+")"); 
  var element = document.getElementById("pp");
  element.setAttribute("onClick", "goLastMonth("+monthstring+","+year+")"); 
            var id = <?php echo $myVar ?>;
            var month = monthstring ;
            var year = year ; // or get them from the user's choice. I am hardcoding them here
            var url  = "calander_function.php";
            $.ajax({'url' : url ,
                'type' : 'post',
                'data' : {'month' : month , 'year' : year , 'proId' : id } ,
                'success' : function(data){
                    $('#tabl').html(data);
                }
            });
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
	alert(msg);
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
			return false;	 
  	});
         return false;
	});
})
</script>
<script>
$(document).ready(function(e) {
window.onbeforeunload = function () {
localStorage.clear();
 }
})
</script>
</head>
<body>
<div class="container topCon width4">
  <?php
$a ="<div class='success-msg' style='display:none'></div>";
echo $a;
// for first table

$month=date("n");
$year=date("Y");


$day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$currentTimeStamp = strtotime("$year-$month-$day");

$monthName = date("F", $currentTimeStamp);
$numDays = date("t", $currentTimeStamp);
$counter = 0;

?>
<?php
$nw = mysqli_query($conn, "SELECT property_heading FROM ".$property_details." WHERE property_id='".$myVar."'");
@$pp = @mysqli_fetch_assoc($nw);
@$prop_name = $pp['property_heading'];
?>


 <h4 align="center"><strong>Note* </strong><span id="cursor" class="blink">Please click first on Checkin Date then Checkout Date for booking.<span></h4>
<iframe id="prop_ical" src="ical_link/index1.php?property=<?php echo $myVar ;?>&prop_name=<?php echo $prop_name ;?>" frameborder="0" width="100%" height="180px" scrolling="no"></iframe>
  
  <div class="cal_details">
    <ul>
      <li>Current Date <img src="images/current_date.png" alt="am"></li>
      <li>Start Date <img src="images/pm.png" alt="am"></li>
      <li>End Date <img src="images/am.png" alt="pm"></li>
      <li>Booked <img src="images/full_book.png" alt="full Book"></li>
    </ul>
  </div>
  <div id="next-prev" class="prev-next container">
    <div class="col-xs-4 width2">
      <div class="leftButton">
        <button name="prev-button" id="pp" onClick="goLastMonth(<?php echo $month.",".$year ?>)"> <i aria-hidden="true" class="fa fa-arrow-left"></i> Previous Months </button>
      </div>
    </div>
    <div class="col-xs-4 remove_tab width2" align="center">
    <a class='' href='<?php echo $url ?>' ><button>Refresh Calendar</button></a>
    </div>
    <div class="col-xs-4 width2 rightButton">
      <button name="next-button" id="tt" onClick="goNextMonth(<?php echo $month.",".$year ?>)">Next Months <i aria-hidden="true" class="fa fa-arrow-right"></i></button>
    </div>
    <div style="clear:both;"></div>
    
	<div class="col-md-12 back_booking">

    <?php if(@$_GET['logout']==1) unset($_SESSION['check']); ?>

	<a class='ret-book' href='<?php echo $url ?>?logout=1' style="display:none;">Back to Current Date</a>

	</div>

    
  </div>
 <div id='spinner1' class="spinner"><img src='images/spinner.gif' class='out'/></div>
  <div id='spinner2' class="spinner"><img src='images/spinner.gif' class='out' /></div>
<div class="container width3" id="call-box-s">
<?php //--------- First and Second Table Starts -----------// ?>
<div class="tabl" id="tabl">
<div class="tabl_1 col-xs-6 width2">
    <table id="table-1">
      <tr class="hea">
        <td><div class="cell"></div></td>
        <td class="cell5" id="nn"><?php echo $monthName.", ".$year ;?></td>
        <td><div class="cell"></div></td>
      </tr>
      <tr class="day_name">
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

		  $todaysDate = date("m-d-Y");
		  $bookdate = $monthstring."-".$daystring."-".$year;
		  $format = "m-d-Y";
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

		  echo "><div class='ac cell' id='book-".$bookdate."' data-theme='div' data-seq='".$bookdate."' href=''>".$i."</div>";

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
<?php

// for second table

$date = date("Y-m-d");
$month = date("n", strtotime($date ."first day of +1 month"));

if($month==1)
{
	$year=date('Y', strtotime('+1 year'));
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
<div class="tabl_2 col-xs-6 width2">

<table id="table-2">
<tr class="hea">

	<td><div class="cell"></div></td>

	<td class="cell5"><?php echo $monthName.", ".$year ;?></td>

    <td><div class="cell"></div></td>

</tr>

<tr class="day_name">
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
		  $todaysDate = date("m-d-Y");



		 $bookdate = $monthstring."-".$daystring."-".$year;



		  $format = "m-d-Y";
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
		  echo "><div class='ac cell' id='book-".$bookdate."' data-theme='div' data-seq='".$bookdate."' href=''>".$i."</div>";
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
</div>
<?php //--------- First and Second Table Ends -----------// ?>
</div>

<!------- Start Hiding 3rd and 4th table here -------------





<?php //--------- Fourth Table Ends -----------// ?>



<--------ends hiding 3rd And 4th table------------>


<div id="demo" style="display:none"></div>

<div class="new-show">
<?php
$admin_id = $_SESSION['admin_id'];
?>
<?php

$per_page= 5; // number of user to show
$page_query=mysqli_query($conn,"SELECT client_id FROM ".$client_details."  WHERE property_id='".$myVar."' AND admin_id='".$admin_id."'");
$pages=ceil(mysqli_num_rows($page_query) / $per_page); //total number of pages to show
$page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1; // current page list
$start= ($page - 1) * $per_page; //start list of user from zero becoz php starts from zero

 $fetch11 = mysqli_query($conn,"SELECT * FROM ".$client_details." WHERE property_id='".$myVar."' AND admin_id='".$admin_id."'  ORDER BY client_id DESC LIMIT $start, $per_page");
	   @$num11 = mysqli_num_rows($fetch11);
	   if($num11>0)
	   {
 ?>
<div class="table-responsive">
  <table class="table table-striped table-hover bg-clr22" align="center">
    <thead>
      <tr>
        <th> S.No </th>
        <th>Name</th>
        <th>Email</th>
        <th>Check In</th>
        <th>Check Out</th>
        <th>Booking Date</th>
        <th>Delete</th>
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
                       
                        $sdate = DateTime::createFromFormat('Y-m-d', $firstdate);
                        $firstdate1 = $sdate->format('m-d-Y');
                        $edate = DateTime::createFromFormat('Y-m-d', $lastdate);
                        $lastdate1 = $edate->format('m-d-Y');
                        $adate = DateTime::createFromFormat('Y-m-d', $adddate);
                        $adddate1 = $adate->format('m-d-Y');
	?>
      <tr>
      	<td><?php echo ++$start; ?></td>
        <td data-title="Property name"><?php echo @$name; ?> </td>
        <td data-title="Property email" class="text-email"><?php echo @$email ?></td>
        <td data-title="First date" ><?php echo @$firstdate1; ?></td>
        <td data-title="Last date" ><?php echo @$lastdate1; ?></td>
        <td data-title="Add date" ><?php echo @$adddate1; ?></td>
   
        <form action="" method="post">
        <td data-title="Delete" ><input type="hidden" name="delete_property" value="<?php echo @$client_id ; ?>"><button type="submit" name="delete_pro_button" class="del-bttn" onClick="return check()"><i class="fa fa-trash"></i></button></td>
        </form>
          </tr>
          <?php
             }
          ?>
         
    	</tbody>
	 </table>
  </div>
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
        <div class="modal-footer"> </div>
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
	$("div.full-book").parents("td").addClass('complete');
	$("div.first-half-book").parents("td").addClass('start');
	$("div.last-half-book").parents("td").addClass('end');

		$('.booking-box.complete').click(function(event){
        event.stopPropagation();
    });

	$('div.ac').click(function(){
		var pro_id = <?php echo $myVar ?> ;
		 var aj = $(this).data('seq');
		 var someVarName = aj ;
         localStorage.setItem("someVarName", someVarName);
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
	var msg2 = msg.trim();
	var msg1 = msg2.split(',');
	var arr1 = jQuery.makeArray( msg1 );
	var lastEl = msg1.slice(-1)[0];
	var one = msg1[0];
	var first_date = one.replace('#', '');
	var two = lastEl;
	var last_date = two.replace('#', '');
	fi = $("#first-date").val();
	la = $("#last-date").val();
	
	if((fi ==" ") || (la ==" ") || (arr1 ==" "))
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

var fvalues=first_date.trim();	
var lvalues=last_date.trim();

if(fvalues=='' || lvalues=='') {
alert('Checkout date should be greater than Checkin date.');
$('div.ac').removeClass('active');
} 
else {
if(fvalues=='zero' || lvalues=='zero') {
alert('Some dates are already booked,Choose another dates.');
$('div.ac').removeClass('active');
}
else if(fvalues=='two' || lvalues=='two') {
alert('Please choose two different dates for booking.');
$('div.ac').removeClass('active');
}
else
{
	
	$("#dialog").dialog({
        height: 1000,
        width: 550,
        resizable: false,
        title: "Get Instant Quote",
        show: {effect: 'drop', direction: "up"},
        close: function(event, ui) {
          $('div.ac').removeClass('active');
          $('.booking-box').removeClass('selected');
          localStorage.clear();
         }
         });
        var s = $("#first-date").val(first_date);
	    var l = $("#last-date").val(last_date);
}
}
	
	
	
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
	
			$fety = mysqli_query($conn, "SELECT * FROM ".$client_details." WHERE client_id='".$del."' AND admin_id='".$admin_id."'");
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
			
            
			$delet_ical = mysqli_query($conn, "DELETE FROM ".$ical_events." WHERE  admin_id='".$admin_id."' AND start_date='".$firstdate1."' AND end_date='".$lastdate1."' AND event_pid='".$prop_id."'") or die(mysqli_error($conn));
			
			$dele = mysqli_query($conn, "DELETE FROM ".$client_details." WHERE property_id='".$prop_id."' AND client_id='".$del."' AND admin_id='".$admin_id."' AND req_num='".$req_num."'") or die(mysqli_error($conn));
			
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