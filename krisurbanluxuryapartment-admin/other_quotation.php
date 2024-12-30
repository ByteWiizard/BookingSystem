<?php 
include_once('session_destroy.php');
include("include/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>
<link href="framework/css/import.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="framework/js/ajax.js"></script>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<style>
.pd-topBottom {
padding: 5px 0px;
}

.propertyp h1 {
font-size: 2em;
}

.pheading {
font-size: 3em;
padding: 1em 1em 0;
text-align: center;
}

.propertyp section {
background: #e7ecf4 none repeat scroll 0 0;
margin-bottom: 1em;
margin-top: 1em;
padding: 3em 1em;
}

.propertyp fieldset {
border: 0 none;
border-radius: 5px;
padding: 10px;
}
.propertyp .form label {
color: #161616;
display: inline-block;
font-family: "Verlag","Helvetica Neue",Helvetica,Arial,sans-serif;
font-size: 1.1em;
font-style: normal;
font-weight: 500;
line-height: 1.5;
margin-bottom: 0;
max-width: 100%;
}

.propertyp span {
display: inline;
font-size: 15px;
font-weight: 600;
margin-top: 3px;
text-transform: uppercase;
}

.propertyp .form input[type="text"], .propertyp .form select, .propertyp .form textarea {
border: 1px solid #99a1a1;
box-sizing: border-box;
color: #161616;
display: inline-block;
font-size: 1em;
line-height: 1.5;
margin: 5px 0;
padding: 1rem;
width: 100%;
}
.propertyp .half {
margin: 0;
padding: 0 2px;
}
.propertyp input[type="submit"] {
background-color: #375e97;
border: medium none;
border-radius: 4px;
color: #fff;
cursor: pointer;
font-size: 1.4em;
font-style: normal;
font-weight: 500;
margin: 8px 0;
padding: 14px 20px;
text-transform: uppercase;
width: 100%;
}
.propertyp input[type="submit"]:hover {
background-color: #2e4565;
color: #fff;
}
.propertyp h3 {
color: #161616;
font-size: 24px;
font-style: normal;
}
.propertyp #book h2 {
background: #375e97 none repeat scroll 0 0;
color: #fff;
font-size: 1.5em;
margin-bottom: 5px;
padding: 10px;
}
.propertyp #virtual-tour {
padding-top: 50px !important;
}
.propertyp fieldset {
border: 0 none;
border-radius: 5px;
padding: 10px;
}

.booking-info-rental {
    background: #7490b8 none repeat scroll 0 0 !important;
    padding: 0 !important;
}

.booking-info .row, .booking-info-payment .row {
    line-height: 1.55;
    padding: 0 10px 10px;
}
.booking-info .label, .booking-info-payment .label {
    color: #2a2d2d;;
    float: left;
    font-size: 0.9em;
    font-weight: 300;
}

.booking-info .value, .booking-info-payment .value {
    float: right;
    font-size: 0.9em;
}

.booking-info-total {
    background-color: #375e97 !important;
    padding: 1em !important;
}

</style>



</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<div class="wrapper">

<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
$admin_id = $_SESSION['admin_id'];
$property_details = "lhk_property_details";
$ical_events = "ical_events";
$files = "lhk_files";
$contact_details = "lhk_contact_details";
if(isset($_POST['checkval'])){
   $property_id = $_POST['select_property'];
   if($property_id){
    $ProData = mysqli_query($conn, "select property_id,property_heading from ".$property_details." where property_id='$property_id' limit 1");
    $ResPro = mysqli_fetch_assoc($ProData);

    $proid = $ResPro['property_id'];
    $prop_name = $ResPro['property_heading'];
    /* image for property */
    $FilData = mysqli_query($conn, "select * from ".$files." where property_id='$proid' order by menu_order asc limit 1");
    $Rowdata = mysqli_fetch_assoc($FilData);
    /* image for property */
?>
    
    <div class="content-wrapper">
    <section class="content-header">
    <h1> Quotation Details <small>Update your Quotation Details</small> </h1>

    <div class="pd-topBottom">

    <form method="post"  action="other-quotation-detail.php" id="form_list" onsubmit="return checkCheckBoxes(this);">
    <div class="content_bottom">
    <div class="propertyp">
    <div class="row">
    <h1 class="pheading">Your Booking Information</h1>
    <div class="col-md-8">
    <section>
    <h1>Traveler Information</h1>
    <div class="form">
    <fieldset>
    <div class="col-md-6 half">
    <label for="fname">First Name <span style="color:red;">*</span></label>
    <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>" required/>

    <?php
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    ?>

    <input type="hidden" id="booking_id" name="booking_id" value="1111111"/>
    <input type="hidden" id="property_id" name="property_id" value="<?php echo $ResPro['property_id']; ?>"/>
    <input type="hidden" id="prop_name" name="prop_name" value="<?php echo $ResPro['property_heading']; ?>"/>
    <input type="hidden" id="request_id" name="request_id" value="<?php echo generateRandomString() ;?>"/>

    </div>
    <div class="col-md-6 half">
    <label for="fname">Last Name <span style="color:red;">*</span></label>
    <input type="text" id="lname" name="lname" value="" required/>
    </div>
    <div class="col-md-6 half">
    <label for="email">Email <span style="color:red;">*</span></label>
    <input type="text" id="cust_email" name="cust_email" value="" required/>
    </div>
    <div class="col-md-6 half">
    <label for="phone">Phone No. <span style="color:red;">*</span></label>
    <input type="text" id="cust_phone" name="cust_phone" value="" required/>
    </div>
    <div class="clearfix"></div>
    </fieldset>
    </div>
    </section>

    <section>
    <h1>VACATION RENTAL AGREEMENT</h1>
    <div class="form">
    <fieldset>
    <div class="col-md-12">
    <embed src="../agreement/Windcilff-Rental-Agreement.pdf" type="application/pdf" style="width: 100%;height: 300px;"></embed>
    </div>
    <div class="col-md-12">
    <div class="col-md-6">
    <input type="checkbox" name="acc_Agreement" value="" checked="checked" required>
    &nbsp;I have read and agree to these terms. </div>
    </div>
    </fieldset>
    </div>
    </section>


    <section>
    <h1>Special Requests</h1>
    <div class="form">
    <fieldset>
    <div class="col-md-12">
    <textarea placeholder="Leave a special request." name="special_requests" class="fsvr_special_requests" maxlength="2048" style="resize:none; height:300px;"></textarea>
    </div>
    </fieldset>
    </section>

    <div align="center">
    <input type="submit" name="submit_data" value="Continue" class="btn btn-transparent blue">
    </div>
    </div>


    <div class="col-md-4 pinfo">
       
    <section class="booking-info-rental">
    <div class="row">
    <div class="col-md-12"> 
    <?php if($Rowdata['file_name']){ ?>
    <img src="<?php echo $Rowdata['file_name']; ?>" title="<?php echo ucwords($ResPro['property_heading']);?>" class="img-responsive"> 
    <?php }else{ ?>
    <img src="../img/default.jpg" title="<?php echo ucwords($ResPro['property_heading']);?>" class="img-responsive"> 
    <?php } ?>
    </div>
    <div class="col-md-12">
    <h1 style="text-align:center;"><?php echo ucwords($ResPro['property_heading']);?></h1>
    <!--  <p>this is dummy text.  this is dummy text.  this is dummy text.</p>-->   
    </div>
    </div>
    </section>


    <section class="booking-info">
    <h3>BOOKING</h3>
    <div class="details-content">
    <div class="row">
    <span class="label">Check In</span>
    <span class="value">
    <div class='input-group date' id='datetimepicker8'>
    <input type="text" class="form-control" name="checkin" id="checkin" value="" required>
    </div>
    </span>
    </div>
    <div class="row">
    <span class="label">Check Out</span>
    <span class="value">
    <div class='input-group date' id='datetimepicker9'>
    <input type="text" class="form-control" name="checkout" id="checkout" value="" required>
    </div>
    </span>
    </div>

    <div class="row">
    <span class="label">Calculate</span>
    <span class="value">
    <input type="hidden" name="procheckid" id="procheckid" value="<?php echo $ResPro['property_id']; ?>">
    <button type="button" class="btn" onclick="paymentcalculation()" name="checkval" value="checkval" style="background:#375e97; color:#fff;"> Calculate </button>
    </span>
    </div>

    <div class="row">
    <span class="label">Nights</span>
    <span class="value"><input type="text" class="form-control" name="nightshow" id="nightshow" value="" readonly></span>
    </div>

    <!--<div class="row">
    <span class="label">Min Stay</span>
    <span class="value"><input type="text" class="form-control" name="minstay" id="minstay" value="1" readonly></span>
    </div>-->

    <div class="row">
    <span class="label">No. of Guests</span>
    <span class="value">
    <select name="guest" class="form-control" required="" style="width:180px;">
    <option value="">--No of Guests--</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    </select></span>
    </div>

    <div class="row">
    <span class="label">Children</span>
    <span class="value">
    <select name="child" class="form-control" style="width:180px;">
    <option value="0">--No of Children--</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    </select>

    </span>
    </div>
    </div>


    <div class="column-pricing">
    <h3>PRICING</h3>
    <div class="row">
    <span class="label">Gross Amount ($)</span>
    <span class="value"><input type="text" class="form-control" required="" name="grossamount" id="grossamount" value=""></span>
    </div>
    <div class="row">
    <span class="label">Pet Fee ($)</span>
    <span class="value"><input type="text" class="form-control" required="" onblur="calculation()" name="cleaning_fee" id="cleaning_fee" value=""></span>
    </div>
    <?php if($pets){ ?>
    <div class="row">
    <span class="label">Pet Fee ($)</span>
    <span class="value"><input type="text" class="form-control" required="" onblur="calculation()" name="pet_fee" id="pet_fee" value=""></span>
    </div>
    <?php } ?>
    <div class="row">
    <span class="label">Taxes (<?php echo $taxper; ?>%)</span> 
    <span class="value"><input type="text" class="form-control" onblur="calculation()" name="taxamount" id="taxamount" value=""></span>
    </div>
    <div class="row">
    <span class="label">Security Deposit ($)</span>
    <span class="value"><input type="text" class="form-control" onblur="calculation()" name="refundamount" id="refundamount" value=""></span>
    </div>

    <div class="row">
    <span class="label">Extra </span>
    <span class="value"><input type="text" class="form-control" name="extraname" id="extraname" placeholder="Name" value=""></span>
    </div>

    <div class="row">
    <span class="label">Extra ($)</span>
    <span class="value"><input type="text" class="form-control" onblur="calculation()" name="extraamount" id="extraamount" placeholder="Amount" value=""></span>
    </div>


    <div class="row">
    <span class="label" style="color:black;">Subtotal</span>
    <span class="value" style="font-weight:bold;">
    <input type="text" class="form-control" name="subtotal" required="" id="subtotal" value=""></span>
    </div>

    </div>

    </section>

    <section class="booking-info-total">
    <span class="label">Total Owed</span>
    <span class="value">
    <input type="text" class="form-control" name="subtotal" id="subtotal1" value=""></span>
    </section>

    </div>



    </div>
    </div>
    </div>
    </div>
    </form>



    <?php 
    $dateslistselect1[]='';
    $queryres = mysqli_query($conn, "SELECT start_date,end_date FROM ".$ical_events." WHERE event_pid='".$property_id."'") or die(mysqli_error($conn));
    while($rowmm = mysqli_fetch_array($queryres))
    {

    $startmm = strtotime($rowmm['start_date']);
    $endmm = strtotime($rowmm['end_date'].'-1 day');
    for ($i1=$startmm; $i1<=$endmm; $i1+=86400) { 
    $dateslistselect1[]= '"'.date('d-m-Y',$i1).'"';   
    }
    }
    $dateslistselect1=array_filter($dateslistselect1);
    $totaldayslist =implode(", ", $dateslistselect1);
    ?>





    </div>
    </section>

    </div>
    <script src="framework/js/bootstrap.min.js"></script> 
    <script src="framework/js/custom.js"></script> 
    <script src="framework/js/app.min.js"></script> 
    <script src="framework/ckeditor/ckeditor.js"></script>



    <script>

    var disableddates = [<?php echo $totaldayslist; ?>];
     
    function DisableSpecificDates(date) {
       var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
       return [disableddates.indexOf(string) == -1];
    }



    $(function() {
        
    var disableddates = [<?php echo $totaldayslist; ?>];        
        
    $("#checkin").datepicker({
    beforeShowDay: DisableSpecificDates,    
    minDate: 0 ,
    changeMonth: true,
    dateFormat: 'yy-mm-dd',
    numberOfMonths: 1,
    onClose: function( selectedDate ) {
    $("#checkout").datepicker( "option", "minDate", selectedDate );
    }
    });
    $("#checkout").datepicker({
    beforeShowDay: DisableSpecificDates,    
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    numberOfMonths: 1,
    onClose: function( selectedDate ) {
    $("#checkin").datepicker( "option", "maxDate", selectedDate );
    }
    });
    });
    </script>

    <script>
    function paymentcalculation() { 
    var procheckid = document.getElementById("procheckid").value;
    var checkindata = document.getElementById("checkin").value;
    var checkoutdata = document.getElementById("checkout").value;

    $.ajax({
    method: "POST",
    url: "datashow.php",
    cache: false,
    data: {'checkin': checkindata ,'checkout':checkoutdata,'procheckid':procheckid}
    })

    .done(function( msg ) {

    var msg2 = msg.trim();
    var catt =  msg.trim(); 
        
    var ct = catt.split('|');
	
	if(ct[0]==0){

    alert(ct[1]);
	document.getElementById("subtotal1").value = "";
    document.getElementById("subtotal").value = "";
    document.getElementById("nightshow").value = "";
    document.getElementById("grossamount").value = "";
    document.getElementById("cleaning_fee").value = "";
    document.getElementById("refundamount").value = "";
    document.getElementById("taxamount").value = "";
	
	
	}else{
	document.getElementById("subtotal1").value = ct[0];
    document.getElementById("subtotal").value = ct[0];
    document.getElementById("nightshow").value = ct[1];
    document.getElementById("grossamount").value = ct[2];
    document.getElementById("cleaning_fee").value = ct[3];;
    document.getElementById("refundamount").value = ct[5];;
    document.getElementById("taxamount").value = ct[4];;
	}

    })

    }

    </script>

    <script>
    function calculation() { 

    var grossamount = document.getElementById("grossamount").value;
    var cleaning_fee = document.getElementById("cleaning_fee").value;
    var taxamount = document.getElementById("taxamount").value;
    var refundamount = document.getElementById("refundamount").value;
    var extraamount = document.getElementById("extraamount").value;

    if(grossamount=='') {
    var grossamount='0';    
    } else {
    var grossamount=grossamount;    
    }

    if(cleaning_fee=='') {
    var cleaning_fee='0';   
    } else {
    var cleaning_fee=cleaning_fee;  
    }

    if(taxamount=='') {
    var taxamount='0';  
    } else {
    var taxamount=taxamount;    
    }

    if(refundamount=='') {
    var refundamount='0';   
    } else {
    var refundamount=refundamount;  
    }

    if(extraamount=='') {
    var extraamount='0';    
    } else {
    var extraamount=extraamount;    
    }

    var totalval = +grossamount + +cleaning_fee + +taxamount + +refundamount + +extraamount;
    document.getElementById("subtotal1").value = totalval;
    document.getElementById("subtotal").value = totalval;

    }
    </script>



    </body>
    </html>
    <?php
    if(isset($_POST['contact_submit']))
    {
    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    $admin_id=test_input($_SESSION['admin_id']);
    $contact_name=test_input($_POST['contact_name']);
    $contact_email=test_input($_POST['contact_email']);
    $contact_email1=test_input($_POST['contact_email1']);
    $contact_phone=test_input($_POST['contact_phone']);
    $contact_addr=$_POST['contact_addr'];
    $contact_check_addr=$_POST['contact_check_addr'];
    $contact_content=test_input($_POST['contact_content']);
    $map_longitude=test_input($_POST['map_longitude']);
    $map_latitude=test_input($_POST['map_latitude']);
    $ip = getClientIP();

    $insert = mysqli_query($conn,"SELECT * FROM ".$contact_details." WHERE admin_id=$admin_id");
    $row = mysqli_num_rows($insert);

    if($row==0)
    {

    $insert = mysqli_query($conn,"INSERT into ".$contact_details."(admin_id,contact_name,contact_email,contact_email1,contact_phone,contact_addr,contact_check_addr,contact_content,map_longitude,map_latitude,contact_det_insert_date,contact_det_ip) VALUES('".$admin_id."','".$contact_name."','".$contact_email."','".$contact_email1."','".$contact_phone."','".$contact_addr."','".$contact_check_addr."','".$contact_content."','".$map_longitude."','".$map_latitude."', now() ,'".$ip."')");

    if($insert)
    {
    echo "<script>alert('Inserted Successfully.');</script>";
    ?>
    <script>
    window.location = 'booking_details.php';
    </script>
    <?php
    }
    }
    if($row>0)
    {
    while($loop = mysqli_fetch_assoc($insert))
    {
    $update = mysqli_query($conn,"UPDATE ".$contact_details." SET contact_name='".$contact_name."', contact_email='".$contact_email."', contact_email1='".$contact_email1."', contact_phone='".$contact_phone."', contact_addr='".$contact_addr."',contact_check_addr='".$contact_check_addr."', contact_content='".$contact_content."', map_longitude='".$map_longitude."', map_latitude='".$map_latitude."', contact_det_update_date=now() , contact_det_ip='".$ip."' WHERE contact_id='".$loop['contact_id']."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
    }
    if($update)
    {
    echo "<script>alert('Updated Successfully.');</script>";
    ?>
    <script>
    window.location = 'booking_details.php';
    </script>
    <?php
    }
    else
    {
    echo "<script>alert('Updatation Failed.');</script>";
    }

    }

    }
    ?>
<?php }else{ ?>
    <script>
    window.location = 'booking_details.php';
    </script>
<?php
   }
}else{
    ?>
    <script>
    window.location = 'booking_details.php';
    </script>
<?php
}

?>

