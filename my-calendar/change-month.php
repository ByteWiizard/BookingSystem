<?php
include_once('cal-library.php');
include('booking.php');
?>
<div class="col-sm-12">
	<div class="col-sm-6 col-xs-6">
    
    	<h5 class="text-left">
        <?php if($m <= date('n') && $y <= date('y')){}else{ ?>
        	<a id="precal" class="btn btn-sm btn-prev" href="change-month.php?state=<?php echo pre($y,$m-2); ?>&property=<?php echo $pid; ?>"><i class="fa fa-angle-left fa-2x fa-2x" aria-hidden="true"></i></a>
        <?php } ?>
        </h5></div>
        
        
        <div class="col-sm-6 col-xs-6">
        	<h5 class="text-right">
            	<a id="nextcal" class="btn btn-sm btn-next" href="change-month.php?state=<?php echo nextt($y,$m+2); ?>&property=<?php echo $pid; ?>"><i class="fa fa-angle-right fa-2x fa-2x" aria-hidden="true"></i></a>
            </h5>
        </div>
        
        
    </div>
    
	<div class="col-sm-6">
		<h2 class="text-center" style='font-family: Roboto, sans-serif; font-weight:600; font-size:20px;'><?php echo $config[calh($y,$m)['m']]; ?>  <?php echo '20'.calh($y,$m)['y']; ?></h2>
		<?php echo build_html_calendar('20'.$y, $m, $booked,$myprice); ?>
	</div>
    
    <div class="col-sm-6">
		<h2 class="text-center" style='font-family: Roboto, sans-serif;font-weight:600;font-size:20px;'><?php echo $config[calh($y,$m+1)['m']]; ?>  <?php echo '20'.calh($y,$m+1)['y']; ?></h2>
		<?php echo build_html_calendar('20'.$y, $m+1, $booked,$myprice); ?>
    </div>
    
    <!-- <div class="col-sm-4">
		<h2 class="text-center" style='font-family: Roboto, sans-serif;font-weight:600;font-size:20px;'><?php echo $config[calh($y,$m+2)['m']]; ?>  <?php echo '20'.calh($y,$m+2)['y']; ?></h2>
		<?php //echo build_html_calendar('20'.$y, $m+2, $booked,$myprice); ?>
    </div> -->
    <input type="hidden" value="" class="d1"/>
    <div class="col-md-12">
    	<div class="col-md-4 col-xs-4">
        	Start <p class="book-start"></p>
        </div>
        <div class="col-md-4 col-xs-4">
        	Booked <p class="book-status"></p>
        </div>
        <div class="col-md-4 col-xs-4">
        	End<p class="book-end"></p>
        </div>
    </div>
    
<script type="text/javascript">
$(function(){
	//if the booking start and end date is same
	$('.last-previous-date').removeClass('available last'); 
	$("table.calendar tr").find('td.first').each(function(index){
		if($(this).prev().attr('class') == 'calendar-day booked '){
			$(this).css({'background-color':'orange','cursor':'pointer'});
			$(this).removeClass('first');
			$(this).removeClass('unavailable');
			$(this).attr('title','Previous booking completed and new booking has started');
			$(this).find('div').css({'color':'#fff'});
			$(this).find('a').css({'color':'#fff'});
		}
	});
});
</script>