<?php
if ( isset( $_POST['proId'] ) ) {
    $pro_id = $_POST['proId'];
    $month  = $_POST['month'];
    $year   = $_POST['year'];
?>

<!--- bootstrap ------>

<?php
$month_check=date('n');
$year_check=date('Y');
$count_month_len = strlen($month_check);

if($count_month_len==1)
{

	$new_month = "0".$month_check;

}
else

{
	$new_month = $month_check;
}

if(($new_month==$month)&&($year_check==$year))
{
?>
<script>
		$(document).ready(function(){
			$(".leftButton").hide();
		})
</script>
<?php
}
else
{
?>
<script>
		$(document).ready(function(){
			$(".leftButton").show();
		})
</script>
<?php
}
?>
<?php
    $a = "<div class='success-msg' style='display:none'></div>";
    echo $a;
?>
<?php
    include_once( "../include/db.php" );
    $ical_events = $pre_fix."ical_events";
    $property_details = $pre_fix."property_details";
?>
<script>
$(document).ready(function(){
	var theID = localStorage.getItem("someVarName");
	if(theID!="")
	{
	 $currItem = $('div.ac[data-seq=' + theID + ']')
	 $currItem.addClass('active');
	}
})
</script>
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
$insert = mysqli_query($conn, "SELECT start_date,end_date FROM ".$ical_events." WHERE event_pid='".$pro_id."'") or die(mysqli_error($conn));
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
    $ser = mysqli_query( $conn, "SELECT property_heading FROM ".$property_details." WHERE property_id='".$pro_id."'" ) or die( mysqli_error( $conn ) );
    while ( @$row1 = mysqli_fetch_array( $ser, MYSQLI_ASSOC ) ) {
        $pro_head = $row1['property_heading'];
    }
?>
<?php
    if ( isset( $_POST['month'] ) ) {
        $month = $_POST['month'];
    }
    if ( isset( $_POST['year'] ) ) {
        $year = $_POST['year'];
    }
    $day              = cal_days_in_month( CAL_GREGORIAN, $month, $year );
    $currentTimeStamp = strtotime( "$year-$month-$day" );
    $monthName        = date( "F", $currentTimeStamp );
    $numDays          = date( "t", $currentTimeStamp );
    $counter          = 0;
?>
<div class="tabl_1 col-xs-6 width2">
  <table id="table-1">
    <tr class="hea">
      <td><div class="cell"></div></td>
      <td class="cell5" id="nn"><?php
    echo $monthName . ", " . $year;
?></td>
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
    for ( $i = 1; $i < $numDays + 1; $i++, $counter++ ) {
        $timeStamp = strtotime( "$year-$month-$i" );
        if ( $i == 1 ) {
            $firstDay = date( "w", $timeStamp );
            for ( $j = 0; $j < $firstDay; $j++, $counter++ ) {
                //blank space
                echo "<td><div class='cell'></div></td>";
            }
        }
        if ( $counter % 7 == 0 ) {
            echo "</tr><tr>";
        }
        $monthstring = $month;
        $monthlength = strlen( $monthstring );
        $daystring   = $i;
        $daylength   = strlen( $daystring );
        if ( $monthlength <= 1 ) {
            $monthstring = "0" . $monthstring;
        }
        if ( $daylength <= 1 ) {
            $daystring = "0" . $daystring;
        }
        $todaysDate = date( "m-d-Y" );
        $bookdate   =  $monthstring."-".$daystring."-".$year ;
        $format     = "m-d-Y";
        $date1      = DateTime::createFromFormat( $format, $todaysDate );
        $date2      = DateTime::createFromFormat( $format, $bookdate );
        echo "<td ";
        if ( $date2 < $date1 ) {
            echo "class='before-today' id='" . $bookdate . "'";
        } elseif ( $todaysDate == $bookdate ) {
            echo "class='today' id='" . $bookdate . "'";
        } else {
            echo "class='booking-box' id='" . $bookdate . "'";
        }
        echo "><div class='ac cell' id='book-" . $bookdate . "' data-theme='div' data-seq='" . $bookdate . "' href=''>" . $i . "</div>";
        if ( isset( $start ) ) {
            for ( $k = 0; $k < $s_count; $k++ ) {
                if ( $start[$k] == $bookdate ) {
                    echo "<div class='first-half-book'><img src='img/left.png' /></div>";
                }
            }
        }
        if ( isset( $full ) ) {
            for ( $l = 0; $l < $f_count; $l++ ) {
                if ( $full[$l] == $bookdate ) {
                    echo "<div class='full-book'><img src='img/full.png' /></div>";
                }
            }
        }
        if ( isset( $end ) ) {
            for ( $m = 0; $m < $e_count; $m++ ) {
                if ( $end[$m] == $bookdate ) {
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
    if ( isset( $_POST['month'] ) ) {
        $month = $_POST['month'] + 1;
        if ( $_POST['month'] == 12 ) {
            $month = 1;
        }
    } 
   
    if ( isset( $_POST['year'] ) ) {
        if ( $_POST['month'] == 12 ) {
            $year = $_POST['year'] + 1;
        } else {
            $year = $_POST['year'];
        }
    }
    // Calender Variable
    $day              = cal_days_in_month( CAL_GREGORIAN, $month, $year );
    $currentTimeStamp = strtotime( "$year-$month-$day" );
    $monthName        = date( "F", $currentTimeStamp );
    $numDays          = date( "t", $currentTimeStamp );
    $counter          = 0;
?>
<div class="tabl_2 col-xs-6 width2">
  <table id="table-2">
    <tr class="hea">
      <td><div class="cell"></div></td>
      <td class="cell5"><?php
    echo $monthName . ", " . $year;
?></td>
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
    for ( $i = 1; $i < $numDays + 1; $i++, $counter++ ) {
        $timeStamp = strtotime( "$year-$month-$i" );
        if ( $i == 1 ) {
            $firstDay = date( "w", $timeStamp );
            for ( $j = 0; $j < $firstDay; $j++, $counter++ ) {
                //blank space
                echo "<td><div class='cell'></div></td>";
            }
        }
        if ( $counter % 7 == 0 ) {
            echo "</tr><tr>";
        }
        $monthstring = $month;
        $monthlength = strlen( $monthstring );
        $daystring   = $i;
        $daylength   = strlen( $daystring );
        if ( $monthlength <= 1 ) {
            $monthstring = "0" . $monthstring;
        }
        if ( $daylength <= 1 ) {
            $daystring = "0" . $daystring;
        }
        $todaysDate = date( "m-d-Y" );
        $bookdate   = $monthstring."-".$daystring."-".$year ;
        $format     = "m-d-Y";
        $date1      = DateTime::createFromFormat( $format, $todaysDate );
        $date2      = DateTime::createFromFormat( $format, $bookdate );
        echo "<td ";
        if ( $date2 < $date1 ) {
            echo "class='before-today' id='" . $bookdate . "'";
        } elseif ( $todaysDate == $bookdate ) {
            echo "class='today' id='" . $bookdate . "'";
        } else {
            echo "class='booking-box' id='" . $bookdate . "'";
        }
        echo "><div class='ac cell' id='book-" . $bookdate . "' data-theme='div' data-seq='" . $bookdate . "' href=''>" . $i . "</div>";
        if ( isset( $start ) ) {
            for ( $k = 0; $k < $s_count; $k++ ) {
                if ( $start[$k] == $bookdate ) {
                    echo "<div class='first-half-book'><img src='img/left.png' /></div>";
                }
            }
        }
        if ( isset( $full ) ) {
            for ( $l = 0; $l < $f_count; $l++ ) {
                if ( $full[$l] == $bookdate ) {
                    echo "<div class='full-book'><img src='img/full.png' /></div>";
                }
            }
        }
        if ( isset( $end ) ) {
            for ( $m = 0; $m < $e_count; $m++ ) {
                if ( $end[$m] == $bookdate ) {
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

<!--
<form id="my-form" method="post" action="contact.php">
<input type="text" name="first" id="first-name" class="datepicker1" required="required" />
<input type="text" name="last" id="last-name" class="datepicker1" required="required" />
<input type="submit" class="book_submit" name="sub_book" value="Click to book" />
</form>
-->
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
		var pro_id = <?php echo $pro_id ?> ;
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
	$(val).addClass( "selected" );
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
}
?>
