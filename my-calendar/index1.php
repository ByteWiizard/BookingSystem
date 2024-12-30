  	<link rel="stylesheet" href="assets/mycalendar.css">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">    
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/mycalendar.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
    
</head>
<body>
<?php
  $pid = isset($_GET['property'])?$_GET['property']:0; 
  include('booking.php'); 
?>
<div class="container">
<div class="row" id="availablityCalendar">
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
		<h2 class="text-center cal-month-name"><?php echo $config[calh($y,$m)['m']]; ?>  <?php echo '20'.calh($y,$m)['y']; ?></h2>
		<?php echo build_html_calendar('20'.$y, $m, $booked,$myprice); ?>
	</div>
    <div class="col-sm-6">
		<h2 class="text-center cal-month-name"><?php echo $config[calh($y,$m+1)['m']]; ?>  <?php echo '20'.calh($y,$m+1)['y']; ?></h2>
		<?php echo build_html_calendar('20'.$y, $m+1, $booked,$myprice); ?>
    </div>
    <?php /*?><div class="col-sm-4">
		<h2 class="text-center cal-month-name"><?php echo $config[calh($y,$m+2)['m']]; ?>  <?php echo '20'.calh($y,$m+2)['y']; ?></h2>
		<?php echo build_html_calendar('20'.$y, $m+2, $booked,$myprice); ?>
    </div>
    
   <div class="col-sm-4">
		<h2 class="text-center" style='font-family: Roboto, sans-serif; font-weight:600; font-size:20px;'><?php echo $config[calh($y,$m+3)['m']]; ?>  <?php echo '20'.calh($y,$m+3)['y']; ?></h2>
		<?php echo build_html_calendar('20'.$y, $m+3, $booked,$price); ?>
	</div>
    <div class="col-sm-4">
		<h2 class="text-center" style='font-family: Roboto, sans-serif;font-weight:600;font-size:20px;'><?php echo $config[calh($y,$m+4)['m']]; ?>  <?php echo '20'.calh($y,$m+4)['y']; ?></h2>
		<?php echo build_html_calendar('20'.$y, $m+4, $booked,$price); ?>
    </div>
    <div class="col-sm-4">
		<h2 class="text-center" style='font-family: Roboto, sans-serif;font-weight:600;font-size:20px;'><?php echo $config[calh($y,$m+5)['m']]; ?>  <?php echo '20'.calh($y,$m+5)['y']; ?></h2>
		<?php echo build_html_calendar('20'.$y, $m+5, $booked,$price); ?>
    </div><?php */?>
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
</div>
<div id="myCalendar" class="modal">
    <!-- Modal content-->
    
    <div class="row">
    	<div class="col-md-6 col-md-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" onClick="closeModal();">&times;</button>
                <h4 class="modal-title text-center">Get a Quote</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                      <form class="form-horizontal" id="book-property-form" role="form" method="post" action="../quote.php" target="_parent">
                        <fieldset>
                
                          <!-- Text input-->
                           <!-- Text input-->
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="textinput">Check In Date</label>
                            <div class="col-sm-4">
                              <input type="text" name="first" readonly placeholder="Check In Date" class="form-control startdate">
                            </div>
                
                            <label class="col-sm-2 control-label" for="textinput">Check Out Date</label>
                            <div class="col-sm-4">
                              <input type="text" name="last" readonly placeholder="Check Out Date" class="form-control enddate">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="textinput">Name</label>
                            <div class="col-sm-10">
                              <input type="text" name="name" placeholder="Enter Your Name" class="form-control" required>
                            </div>
                          </div>
                
                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="textinput">Email</label>
                            <div class="col-sm-10">
                              <input name="email" type="text" placeholder="Email Address" class="form-control" required />
                            </div>
                          </div>
                
                          <!-- Text input-->
                         <div class="form-group">
                            <label class="col-sm-2 control-label" for="textinput">No of Guest</label>
                            <div class="col-sm-10">
                              <select name="guest" class="form-control" required>
                              	<option value="">Select No of Guest</option>
                                <?php for($i=1;$i <= 6; $i++){ ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?> Guest(s)</option>
                                <?php } ?>
                                
                              </select>
                         <input type="hidden" name="pro_id" value="<?php echo @$pid;?>">
                            </div>
                          </div>

                             <!-- <div class="form-group">
                            <label class="col-sm-2 control-label" for="textinput">Pets</label>
                            <div class="col-sm-10">
<select name="pet" class="form-control input-sm">
								<option>Pet</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
								
							</select> 
</div>
</div> -->
                           <!-- <div class="form-group">
                            <label class="col-sm-2 control-label" for="textinput">Bonus Room</label>
                            <div class="col-sm-10">
                              <select name="bonos" class="form-control" required>
                                <option value="">--Select Bonos Room--</option>
                                <option value="1">0</option>
                                <option value="2">1</option>
                                <option value="3">2</option>
                              </select>
                         <input type="hidden" name="pro_id" value="<?php //echo @$pid;?>">
                            </div>
                          </div>                  -->
                
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <div class="pull-right">
                                <button type="button" onClick="closeModal();" class="btn btn-default">Reset Dates</button>
                                <button type="submit" id="book-property" name="book-sub" class="btn btn-primary">Quote Request</button>
                              </div>
                            </div>
                          </div>
                
                        </fieldset>
                      </form>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
              </div>
              <div class="modal-footer">                
              </div>
            </div>
        </div>
	</div>
</div>

</div>
</body>
</html>

