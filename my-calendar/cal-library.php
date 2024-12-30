<?php
$config = array('January','Febrary','March','Apirl','May','June','July','August','September','October','November','December');
$date = date('y/n');
if(isset($_GET['state']) && $_GET['state'] != ''){
	$date = $_GET['state'];
}
$date = explode('/',$date);
$y = $date[0];
$m = $date[1];
$pre = $y;
$next = $y;

function pre($y,$m){
	
	if($m <= 0){
		$y = $y - 1;
		$m = abs($m);
		$m = abs($m -12);		
	}
	
	return $y.'/'.$m;
}

function nextt($y,$m){
	if($m >= 12){
		$y = $y + 1;
		$m = abs($m - 12);		
	}
	if($m ==0){
		$y = $y - 1;
		$m = 12;
	}
	return $y.'/'.$m;	
}
function calh($y,$m){
	if($m > 12){
		$y = $y + 1;
		$m = $m - 12;		
	}elseif($m < 0){
		$y = $y - 1;
		$m = $m -12;
	}
	return array('m'=>$m-1,'y'=>$y);
}

function build_html_calendar($year, $month, $events = null,$price=null) {
  // CSS classes
  $css_cal = 'calendar';
  $css_cal_row = 'calendar-row';
  $css_cal_day_head = 'calendar-day-head';
  $css_cal_day = 'calendar-day';
  $css_cal_day_number = 'day-number';
  $css_cal_day_blank = 'calendar-day-np';
  $css_cal_day_event = 'booked';
  $css_cal_event = 'calendar-event';

  // Table headings
  $headings = array('Sun','Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

  // Start: draw table
  $calendar =
    "<table cellpadding='0' cellspacing='0' class='{$css_cal}'>" .
    "<tr class='{$css_cal_row}'>" .
    "<td width='50' height='20' class='{$css_cal_day_head}'>" .
    implode("</td><td width='50' height='20' class='{$css_cal_day_head}'>", $headings) .
    "</td>" .
    "</tr>";

  // Days and weeks
  $running_day = date('N', mktime(0, 0, 0, $month, 1, $year));
  if($running_day < 7){
	  $running_day = $running_day+1;
  }elseif($running_day >= 7){
	  $running_day = 1;
  }
 
  $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));

  // Row for week one
  $calendar .= "<tr class='{$css_cal_row}'>";

  // Print "blank" days until the first of the current week
  for ($x = 1; $x < $running_day; $x++) {
    $calendar .= "<td class='{$css_cal_day_blank}'> </td>";
  }

  // Keep going with days...
  for ($day = 1; $day <= $days_in_month; $day++) {

    // Check if there is an event today
    $cur_date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
    $draw_event = false;
    if (isset($events) && isset($events[$cur_date])) {
      $draw_event = true;
    }
	
	$draw_price = false;
	if (isset($price) && isset($price[$cur_date])){
      $draw_price = true;
    }

    // Day cell
	$lastdate = false;
	$data_event = false;
	$preclass = false;
$firstdate = false;
	if($cur_date > date('Y-m-d',strtotime('- 1 days'))){
		$lastdate = $events[$cur_date]['class']=='available last'?"data-event='{$events[$cur_date]['date']}'":'';
                $firstdate = $events[$cur_date]['class']=='first'?"data-event='{$events[$cur_date]['date']}'":'';
		$data_event = "data-event='$cur_date'";
		$lastdateClass = $events[$cur_date]['class']=='available last'?$events[$cur_date]['date']:'';
	}else{
		$lastdateClass = $events[$cur_date]['class']=='available last'?'last-previous-date':'';
		$preclass = 'previous-date';
	}
	
	
	
    $calendar .= $draw_event?
      "<td width='50' height='20' class='{$css_cal_day} {$events[$cur_date]['class']} {$lastdateClass}' $lastdate $firstdate >" :
      "<td width='50' height='20' class='{$css_cal_day} {$cur_date} {$preclass}' $data_event >";

    // Add the day number
    $calendar .= "<div class='{$css_cal_day_number}'>" . $day . "</div>";
	$calendar .= "<div class='first-last'></div>";

    // Insert an event for this day
    if ($draw_price) {
      $calendar .=
        "<div class='{$css_cal_event}'>" .
        "<a href='javascript:void();'>" .
        $price[$cur_date]['text'].
        "</a>" .
        "</div>";
    }

    // Close day cell
    $calendar .= "</td>";
	
	

    // New row
    if ($running_day == 7) {
      $calendar .= "</tr>";
      if (($day + 1) <= $days_in_month) {
        $calendar .= "<tr class='{$css_cal_row}'>";
      }
      $running_day = 1;
    }

    // Increment the running day
    else {
      $running_day++;
    }

  } // for $day

  // Finish the rest of the days in the week
  if ($running_day != 1) {
    for ($x = $running_day; $x <= 7; $x++) {
      $calendar .= "<td height='20' class='{$css_cal_day_blank}'> </td>";
    }
  }

  // Final row
  $calendar .= "</tr>";

  // End the table
  $calendar .= '</table>';

  // All done, return result
  return $calendar;
}


		
function getDatesFromRange($start, $end, $format = 'Y-m-d') {
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
	
    foreach($period as $date) {
         $array[] = $date->format($format); 
    }
	$myarray = array();
    if(sizeof($array)>0){
		$i =0;
		foreach($array as $a){$i++;
			$class = "booked";
			if($i === sizeof($array)){
				$class = "available last";
			}elseif($i === 1){
				$class = "first";
			}
			$myarray[$a] = array('class'=>$class,'date'=>$a);
		}
		
	}
	return $myarray;
	
}

function getDatesPrice($start,$end,$price,$format = 'Y-m-d'){
	$array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
	
    foreach($period as $date) {
         $array[] = $date->format($format); 
    }
	$myarray = array();
    if(sizeof($array)>0){
		foreach($array as $a){
			$myarray[$a] = array('text'=>$price);
		}
	}
	return $myarray;
}
?>