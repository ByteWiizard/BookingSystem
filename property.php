<?php include 'header.php';
 
   $prop =$conn->query("SELECT * FROM lhk_property_details WHERE property_id ='".$_REQUEST['pid']."'");
   $props =$prop->fetch_assoc();
   $file = $conn->query("SELECT * FROM lhk_files WHERE property_id='".$props['property_id']."' ORDER BY menu_order ASC");


   
 if(isset($_POST['submitf'])){
		
    $txt = 
        "
        <html>
        <head>
        <title>$title</title>
        </head>
        <body>
        <p>Inquiry for Booking</p>
        <table border='1'>
        <tr>
        <th>First Name</th>
        <th>".$_POST['fname']."</th>
        </tr>
        
        
        <tr>
        <th>Email Address</th>
        <th>".$_POST['email']."</th>
        </tr>

        <tr>
        <th>Property</th>
        <th>".$_POST['property']."</th>
        </tr>


        <tr>
        <th>Phone</th>
        <th>".$_POST['phone']."</th>
        </tr>
        <tr>
        <th>Check-in</th>
        <th>".$_POST['checkin']."</th>
        </tr>

        <tr>
        <th>Check-out</th>
        <th>".$_POST['checkout']."</th>
        </tr>
    
         
    
            <tr>
        <th>Message</th>
        <th>".$_POST['message']."</th>
        </tr>
        </table>
        </body>
        </html>
    "	
    ;  
    
  
  $url = 'https://api.sendgrid.com/';
    $user = 'findamerican.rentals';    
    $pass = 'N8coders@123#';
    $json_string = array(
      'to' => array('info@vancouverfurnishedrental.ca'),
    );
    
    $params = array(
      'api_user'  => $user,
      'api_key'   => $pass,
      'x-smtpapi' => json_encode($json_string),
      'to'        => 'info@vancouverfurnishedrental.ca',
      //'toname'    => 'To parameter',
      'subject'   => 'Booking Inquiry Received from VANCOUVER FURNISHED RENTAL',
      'html'      => $txt,
      //'text'      => 'testing body',
      'from'      => $_POST['email'],
      'fromname'  => $_POST['fname'],
      );
    
    $request =  $url.'api/mail.send.json';
    // Generate curl request
    $session = curl_init($request);
    // Tell curl to use HTTP POST
    curl_setopt ($session, CURLOPT_POST, true);
    // Tell curl that this is the body of the POST
    curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, false);
    // Tell PHP not to use SSLv3 (instead opting for TLS)
    //curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false); 
    
    // obtain response
    $response = json_decode(curl_exec($session));
  //print_r($response);
    
  
  
  
  
               if($response->message=='success'){
           $msg="<script>alert('Your Request has been Successfully Submitted. We will Contact You Shortly.');</script>";
        }else{
            $msg="Your inquiry not sent successfully.Please try again.";
        }
  
  
  curl_close($session);
    }
 
?>
<style>
.rates{ margin:0px auto 50px; text-transform:capitalize; font-family: 'Source Sans Pro', sans-serif; box-shadow:0 0 8px #ccc; }

.rates th{  padding:5px; font-size:16px; background:#13206b; color:#fff; font-weight:bold; text-align:left; }

.rates td{  padding:5px; font-size:14px; text-align:center;  }

.rates span{font-size:11px;}

.responsive-table b { color: #b80909; display: block; font-weight: 600; font-size: 12px; }

.responsive-table { width: 100%; margin-bottom: 1.5em; box-shadow:0 0 4px #ccc;}

.responsive-table thead { position: absolute; clip: rect(1px 1px 1px 1px);

  /* IE6, IE7 */ clip: rect(1px, 1px, 1px, 1px); padding: 0; border: 0; height: 1px; width: 1px; overflow: hidden;}

.responsive-table td  small {

    display: inline-block;

    width: 100%;

}

.btn-primary{
	    background-color: #bda87f;
    border-color: #bda87f;
	padding:10px;
}
.btn-primary:hover{
		    background-color: #000;
    border-color: #000;
	padding:10px;
}
@media (min-width: 44em) {

.responsive-table thead { position: relative; clip: auto; height: auto; width: auto; overflow: auto;}

}

.responsive-table thead th { background-color:rgb(189, 168, 127); border: 1px solid rgb(190, 172, 90);  text-align: center; color:#fff; font-weight:600; font-size:18px; padding: 15px 15px; font-family:'Josefin Sans', sans-serif;}

.responsive-table thead th:first-of-type { text-align: center;}

.responsive-table tbody,

.responsive-table tr,

.responsive-table th,

.responsive-table td { display: block; padding: 0; text-align: left; white-space: normal;}

@media (min-width: 44em) {

.responsive-table tr { display: table-row;}

}

.responsive-table th,

.responsive-table td { padding: .5em; vertical-align: middle;}

@media (min-width: 30em) {

.responsive-table th,

.responsive-table td { padding: .75em .5em;}

}

@media (min-width: 44em) {

.responsive-table th,

.responsive-table td { display: table-cell; padding: .5em;}

}

@media (min-width: 62em) {

.responsive-table th,

.responsive-table td { padding: .75em .5em;}

}

@media (min-width: 75em) {

.responsive-table th,

.responsive-table td {padding: .75em;}

}

.responsive-table caption { margin-bottom: 1em; font-size: 1em; font-weight: bold; text-align: center;}

@media (min-width: 44em) {

.responsive-table caption { font-size: 1.5em;}

}

.responsive-table tfoot { font-size: .8em; font-style: italic;}

@media (min-width: 62em) {

.responsive-table tfoot { font-size: .9em;}

}

@media (min-width: 44em) {

.responsive-table tbody { display: table-row-group;}

}

.responsive-table tbody tr { margin-bottom: 1em; border: 1px solid #ccc;}

@media (min-width: 44em) {

.responsive-table tbody tr { display: table-row; border-width: 1px;}

}

.responsive-table tbody tr:last-of-type { margin-bottom: 0;}

@media (min-width: 44em) {

.responsive-table tbody tr:nth-of-type(even) { background-color: rgba(94, 93, 82, 0.1);}

}

.responsive-table tbody th[scope="row"] { background-color: #13206b; color: #fff;}

@media (min-width: 44em) {

.responsive-table tbody th[scope="row"] { background-color: transparent; color: #5e5d52; text-align: left;}

}

.responsive-table tbody td { text-align: right; background:#fff;}

@media (min-width: 30em) {

.responsive-table tbody td { border: 1px solid #ccc;font-size: 15px;}

}

@media (min-width: 44em) {

.responsive-table tbody td { 

text-align: center;

color: #000;

font-size: 18px;

padding: 15px;

background: rgba(255, 255, 255, 0.36);

}

}

.responsive-table tbody td[data-type=currency] { text-align: right;}

.responsive-table tbody td[data-title]:before { content: attr(data-title); float: left; font-size:13px;  font-weight:600;color:rgb(17, 90, 41); font-family: 'Josefin Sans', sans-serif; text-shadow: 0 0px 0px #111;}

@media (min-width: 30em) {

.responsive-table tbody td[data-title]:before { font-size: .9em;}

}

@media (min-width: 44em) {

.responsive-table tbody td[data-title]:before { content: none;}

}
.ratesAdditional {
    width: 100%;
    padding: 50px 0;
    text-align: center;
    border-bottom: 1px dashed rgba(0, 0, 0, 0.39);
    margin: 0 auto 50px;
    padding-top: 5px;
}
.ratesAdditional ul {
    vertical-align: top;
    width: 60%;
    margin: 0;
    padding: 0;
}
.ratesAdditional ul li {
    border-bottom: 2px solid #fff;
    padding: 0;
    list-style: none;
    margin: 0;
    display: inline-block;
    width: 100%;
    text-align: left;
}
.ratesAdditional strong {
    width: 50%;
    text-transform: uppercase;
    font-size: 14px;
    font-weight: 400;
    border-right: 1px solid #bbb;
    background: #beac5a;
    display: inline-block;
    color: #fff;
    padding: 10px;
}
.ratesAdditional span {
    background:rgba(32, 41, 53, 0.16);
    color: #000;
    width: 48%;
    display: inline-block;
    padding: 10px;
	font-size: 13px;
    font-weight: bold;
}</style>
<div class='page-title'>
	<div id='particles-js-pagetitle'></div>
	<div class='container'>
    <?php if($props['property_id']=='1'){ ?>
        <h1><?php echo $props['property_heading'];?></h1><i><h6 style="text-transform:none">"an ultimate in luxury"</h6></i>
    <?php }else{ ?>
        <h1><?php echo $props['property_heading'];?></h1><i><h6 style="text-transform:none">"a heaven on earth"</h6></i>
    <?php } ?>
	</div>
</div>

<div class='section-block'>
	<div id='particles-js-project_detail'></div>
	<div class='container'>
		<div class='row'>
			<div class="col-xs-12 col-md-8 col-sm-8">
              
<link href="https://www.perfectstayz.com/royal/royalslider.css" rel="stylesheet">
<script src="https://www.perfectstayz.com/royal/jquery-1.8.3.min.js"></script>
<script src="https://www.perfectstayz.com/royal/jquery.royalslider.min.js?v=9.3.6"></script>
<link href="https://www.perfectstayz.com/royalreset.css?v=1.0.4" rel="stylesheet">
<link href="https://www.perfectstayz.com/royal/rs-default.css?v=1.0.4" rel="stylesheet">
<style>
	#gallery-1 {
	width: 100%;
	height:627px;
	-webkit-user-select: none;
	-moz-user-select: none;  
	user-select: none;
	}
	.royalSlider > .rsImg {
	visibility:hidden;
	}
	.royalSlider img {
	}
	.rsWebkit3d .rsSlide {
	-webkit-transform: none;
	}
	.rsWebkit3d img {
	-webkit-transform: translateZ(0);
	}
	.section-block {
    padding: 90px 0px 0px 0px !important;
    background-color: #fff;
}
</style>
 
  <div  class="page wrapper main-wrapper">  
       
<div class="row clearfix"> 
 
<div class="col span_6 fwImage">
  <div id="gallery-1" class="royalSlider rsDefault">
  <?php while($files =$file->fetch_assoc()){?>
    <a class="rsImg"  data-rsBigImg="uploads/<?php echo $props['property_id'];?>/<?php echo $files['file_name'];?>" href="uploads/<?php echo $props['property_id'];?>/<?php echo $files['file_name'];?>"><img width="96" height="72" class="rsTmb" src="uploads/<?php echo $props['property_id'];?>/<?php echo $files['file_name'];?>" /></a>
    <?php } ?>
  </div>
</div>
</div>
 
  <div class="wrapper page">     
    <script>
      jQuery(document).ready(function($) {


  $('#gallery-1').royalSlider({
    fullscreen: {
      enabled: true,
      nativeFS: true
    },
    controlNavigation: 'thumbnails',
    autoScaleSlider: true, 
    autoScaleSliderWidth: 960,     
    autoScaleSliderHeight: 650,
    loop: false,
    imageScaleMode: 'fit-if-smaller',
    navigateByClick: true,
    numImagesToPreload:2,
    arrowsNav:true,
    arrowsNavAutoHide: true,
    arrowsNavHideOnTouch: true,
    keyboardNavEnabled: true,
    fadeinLoadedSlide: true,
    globalCaption: true,
    globalCaptionInside: false,
    thumbs: {
      appendSpan: true,
      firstMargin: true,
      paddingBottom: 4
    }
  });

    $('.rsContainer').on('touchmove touchend', function(){});

});

    </script>     
  <div style="display:none;">       
  </div> 
	</div>
</div>            
				 
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class='project-detail-1'>
					<h2><?php echo $props['property_heading'];?></h2>
					<ul> 
							<li><span>Bedrooms:</span><?php echo $props['property_no_of_bedrooms'];?></li>
							<li><span>Bathroom:</span><?php echo $props['property_no_of_baths'];?></li>
							<li><span>Sleeps:</span><?php echo $props['property_no_of_sleeps'];?></li>
                            <li><span>Owner Name:</span>  <?php echo $props['property_head_title'];?></li>
 					</ul>
                	<div class="btn btn-primary" id="twobottom">Book Now</div>
				</div>
			</div>
		</div>
		<div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Overview</h2></div>
		<div class="row">
			<div class='col-md-12'>
				<div class='project-detail-1-info'>
					<h3><?php echo $props['property_heading'];?></h3>
					<div class='text-content'>
					<p><?php echo html_entity_decode($props['property_content']);?></p>
					</div>
				</div>
			</div>
		</div>


        <div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">About Owner</h2></div>
		<div class="row">
			<div class='col-md-12'>
				<div class='project-detail-1-info'>
					<h3><?php echo $props['property_head_title'];?></h3>
					<div class='text-content'>
					<p><?php echo html_entity_decode($props['other_content1']);?></p>
					</div>
				</div>
			</div>
		</div>


		<div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Amenities</h2></div>
		<div class="row">
		<?php $ament = mysqli_query($conn,"SELECT * FROM lhk_amenity WHERE property_id ='".$props['property_id']."'");
              while($amenity = mysqli_fetch_assoc($ament)){?>
			<div class='col-md-12'>
				<div class='project-detail-1-info' style="margin:20px 0">					
					<h3><?php echo $amenity['amenity_name'];?></h3>
					<div class='text-content col-md-12'>
					<?php $ame_detal = mysqli_query($conn,"SELECT * FROM lhk_amenity_details WHERE amenity_id=".$amenity['amenity_id']."");
                                        while($amedetail = mysqli_fetch_assoc($ame_detal)){
                                     
                                    ?> 
					<div class="col-md-3"><i class="fa fa-check"></i> <?php echo $amedetail['amen_value'];?></div>
					 <?php } ?>
					</div>
				</div>				
			</div>
		<?php } ?>	
		</div>
        
 <!-- //////////////////////////////////////////////////////////////////////////////////////////  -->      
<!--  
<style>
.select100{
    margin-top: 30px;
    padding: 15px;
    width: 100%;
    border-radius: 5px;
    border: 1px solid #eee;
}
</style> 

 <div class="col-xs-12 col-md-12 col-sm-8">
 			<div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft; ">Book Now</h2></div>
 
					<div class="row contact-box-message" style="  -webkit-box-shadow: 0px 6px 11px 1px rgba(0, 0, 0, 0.51); padding-bottom:30px;">
                    <span style="color:red;"></span>
                    <span style="color:red;"><?php echo $msg;?></span>
						<form autocomplete='off' class='contact-form' method='post'>
						<div class='col-xs-6'><input required placeholder="Name" name='fname'></div>
                        
                        <div class='col-xs-6'>
                        	<select class="select100" name="property">
                                <option value="">Select Property</option>
                                <?php
								$filez = mysqli_query($conn,"SELECT * FROM lhk_property_details");
                                while($p = mysqli_fetch_assoc($filez)){ 
                                ?>
                                <option value="<?php echo $p['property_heading']; ?>"><?php echo $p['property_heading']; ?></option>
                                <?php } ?>                               
                            </select>
						</div>                       
						<div class='col-xs-6'><input required placeholder="E-mail adress" name='email' type='email'></div>
						<div class='col-xs-6'><input required placeholder='Mobile No' name='phone'></div>
                        <div class='col-xs-6'><input required placeholder="Check In" id="txtFrom" name='checkin' type='text'></div>
						<div class='col-xs-6'><input required placeholder='Check Out' id="txtTo" name='checkout' type='text'></div>
 						<div class='col-xs-12'><textarea required name='message' placeholder="Your Message"></textarea></div>
						
						<div class="col-xs-12"><button class="center-holder button-md mt-20 primary-button rounded-border" type='submit' name="submitf" style="margin-left:35%;">Submit Request To Owner For Quote</button></div> 
						</form>
					</div>
				</div>     
  -->
 
 
  <!-- //////////////////////////////////////////////////////////////////////////////////////////  -->                     
                
       <div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Rates</h2></div>  
                    <div class="">
                     <div class="rates">
                        <div class="responsiveTab">
                            <table class="responsive-table">
                             <thead>
                            <tr>
                            <th scope="col">Dates</th>
                            <th scope="col">Nightly</th>
                            <th scope="col">Weekend Night</th>
                            <th scope="col">Weekly</th>
                            <th scope="col">Monthly*</th>
                            <!--<th scope="col">Events</th>-->
                            </tr>
                            </thead>                            
                            <tbody>
                 <?php 
                     
                 $rate = mysqli_query($conn,"SELECT * FROM lhk_property_new_rates where property_id='".$props['property_id']."'"); 
                       while($rates = mysqli_fetch_assoc($rate)){?>           
                <tr>
                  <th scope="row"><?php echo $rates['pro_new_rate_desc'];?><br/> <?php echo $rates['pro_new_rate_min_stay'];?> nights min stay</small></th>
                  <td data-title="Nightly"><?php echo $rates['pro_new_rate_week_nt']!=""?'CAD '.$rates['pro_new_rate_week_nt']:"-";?></td>
          <td data-title="Weekend Night"><?php echo $rates['pro_new_rate_weekend_nt']!=""?'CAD '.$rates['pro_new_rate_weekend_nt']:"-";?></td>
        <td data-title="Weekly"><?php echo $rates['pro_new_rate_weekly_nt']!=""?'CAD '.$rates['pro_new_rate_weekly_nt']:"-";?></td>
        <td data-title="Monthly"><?php echo $rates['pro_new_rate_monthly']!=""?'CAD '.$rates['pro_new_rate_monthly']:"-";?></td>
          <!--<td data-title="Event"> - </td>-->
                </tr>
                 <?php } ?>
                                             </tbody>
                            
                            </table>
                       </div>
                       
                       
                       
                                              <!--<p class="text-center"><strong>* Approximate monthly rate. Actual rate will depend on the days of the month you stay.</strong>
</p>-->		
                                           </div>
                    </div>
                    
<?php 

$prate = mysqli_query($conn,"SELECT * FROM lhk_property_default_rates where  property_id='".$props['property_id']."'");
        $prates =mysqli_fetch_assoc($prate)
?>
               		<div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Additional information about rental rates</h2></div>  
                    <div class="pricing-box">
                    <ul>
                                             <li>
                        
                    <strong>Property Damage Protection</strong> : <span><?php echo $prates['pro_refundable_amt']!=""?'CAD '.$prates['pro_refundable_amt']:"0";?></span>
                    </li>            
                                                             <li>
                    <strong>Cleaning Fee</strong> : <span><?php echo $prates['pro_cleaning_fee']!=""?'CAD '.$prates['pro_cleaning_fee']:"0";?></span>
                    </li>
                                                            <li>
                    <strong>Tax Rate</strong> : <span><?php echo $prates['add_fees']!=""?$prates['add_fees'].'%':"0";?></span>
                    </li>
                    
                    </ul>
                    </div>
					
             <?php if($prates['can_policy']!=""){?>
		               <div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Owner's Cancellation Policy</h2>
                   </div>
                    
                    <div class="text-content">
                       <p><?php echo html_entity_decode($prates['can_policy']);?></p>
                    </div>
            <?php } ?>
              <?php if($prates['notes']!=""){?>
                    <div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Notes</h2>
                    </div>
                    <div class="text-content">
                       <p><?php echo html_entity_decode($prates['notes']);?></p>
                    </div>
              <?php } ?>
                   <div class="mt-30 section-heading" id="myDiv"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Availability</h2></div>
                     <iframe class="container-fluid" id="pro_cal" src="calender/calender.php?property=<?php echo $props['property_id'];?>" width="100%" height="560px" frameborder="0"></iframe>
			
		</div>	
		
				
	</div>
</div>

<section>
    <div class="container">
        <div class="row">
        <div class="mt-30 section-heading" id="myDiv"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Location</h2></div>
        <?php  if($props['property_id']=='1'){ ?>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1301.4353060315575!2d-123.10838834174886!3d49.27884889483274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5486717b0a5befad%3A0xdfb9fe6401d71b9!2s688+Abbott+St%2C+Vancouver%2C+BC+V6B+0C1%2C+Canada!5e0!3m2!1sen!2sin!4v1547929498474" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        
        <?php } ?>
        <?php  if($props['property_id'] =='2'){ ?>

<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1301.4131845817917!2d-123.1100055!3d49.2796872!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5486717bc757e8d3%3A0xcf1d12b0f2282ac4!2s188+Keefer+Pl%2C+Vancouver%2C+BC+V6B+0B9%2C+Canada!5e0!3m2!1sen!2sin!4v1547929234499" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            <?php } ?>
        </div>
    </div>
</section>



<div class="margin" style="margin-bottom:100px;"></div>


<?php include 'footer.php';?>

<script>
$("#twobottom").click(function() {
    $('html, body').animate({
        scrollTop: $("#myDiv").offset().top -100
    }, 1000);
});
</script>
