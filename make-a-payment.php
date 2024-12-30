<?php  
include('header.php');
?>  
<?php error_reporting(0);
if(!isset($_POST['totalamount'])){
 echo "<script>window.location.href='index.php';</script>";
} 
if(isset($_POST['q_submit']))
{ ?>

<!--- mobile navigation ------>


<!--==============================content================================-->
<section id="content">


<?php      
if((isset($_POST['q_submit']))||(isset($_POST['p_submit'])))
{
//echo SITE_URL; die;
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
@$name=test_input($_POST['fname']); 
@$email=test_input($_POST['femail']);
$checkin=test_input($_POST['checkin']);
$checkout=test_input($_POST['checkout']);
$fmessage=test_input($_POST['fmessage']);
@$taxv = $_POST['taxv'];
@$tax = $_POST['tax'];
@$pet =$_POST['pets'];
@$refund = $_POST['refund'];
@$clean = $_POST['clean'];
$guests = $_POST['no_of_guests'];
@$request_id = $_POST['item_number'];
@$noofdogs=$_POST['pets'];
@$phoneno=$_POST['phoneno'];	         
@$address=$_POST['address'];
@$totalamount=$_POST['totalamount'];
@$totalnight=$_POST['totalnight'];
@$tax=$_POST['tax'];
@$id_item=$_POST['pro_id'];
@$admin_id=$_POST['admin_id'];
@$prop_name=$_POST['prop_name'];			
@$addr = test_input($_POST['address']);
@$msg = test_input($_POST['fmessage']);
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
$ip = $_SERVER['REMOTE_ADDR'];
}
$pay = $totalamount;
$total_price  = number_format($totalamount ,2);
}


/*$datein=date_create_from_format("Y-m-d",$checkin);
$firstdate = date_format($datein,"jS F, Y");*/
$firstdate = date("jS F, Y", strtotime($checkin));
/*$dateout=date_create_from_format("Y-m-d",$checkout);
$lastdate = date_format($dateout,"jS F, Y");*/
$lastdate = date("jS F, Y", strtotime($checkout));


if(isset($_POST['q_submit']))
{
$ins = mysqli_query($conn,"INSERT INTO lhk_booking_details(property_id,admin_id,prop_name,checkin,checkout,tot_amt,request_id,totalnight,name,email,phone,no_of_ppl,pets,addr,msg,added_date,ip) VALUES('".$id_item."','".$admin_id."','".$prop_name."','".$checkin."','".$checkout."','".$totalamount."','".$request_id."','".$totalnight."','".$name."','".$email."','".$phoneno."','".$guests."','".$noofdogs."','".$addr."','".$msg."',now(),'".$ip."')") or die(mysqli_error($conn));


$to = "info@vancouverfurnishedrental.ca";
$subject = "Booking Inquiry Received from Vancouverfurnishedrental";

$message = "<html>
<head>
<style>
table {
border-collapse: collapse;
}

table {
border: 1px solid #9F8531;
background:#fff;
text-align:center;
color:#000;
text-transform:capitalize;
}
table tr td a {
color:#000 !important;
text-decoration:none;
text-transform:none;
}
table tr th{
padding:10px;
font-size:14px;
font-weight:500;
}

table tr td{
padding:10px;
font-size:12px;
}
</style>

</head>
<body>
<h3 style='color:#ff7300;' align='center'>".$prop_name." : Instant Quote </h3>
<table  width='100%' border='1'>
<thead>
<tr>
<th scope='col'>Check-In</th>
<th scope='col'>Check-Out</th>
<!--<th scope='col'>".$_POST['apply_rate']."</th>-->
<th scope='col'>Minimum Stay</th>
<!--<th scope='col'>Pets</th>-->
<th scope='col'>Total Guest</th>
<th scope='col'>Total Nights</th>
<th scope='col'>Gross Amount</th>

</tr>
</thead>
<tbody>
<tr>
<td>".$firstdate."</td>
<td>".$lastdate."</td>
<!--<td>".$_POST['apply_rate_price']."</td>-->
<td>".$_POST['min_stay']."</td>
<!--<td>".$noofdogs."</td>-->
<td>".$_POST['no_of_guests']."</td>
<td>".$totalnight."</td>
<td>".$_POST['g_amount']."</td>
</tr>
<tr>
<td colspan='5'> Refundable Damage Amount</td>
<td> $".$refund.".00 </td>
</tr>
<tr>
<td colspan='5'>Cleaning Fee</td>
<td> $".$clean.".00 </td>
</tr>
<tr>
<td colspan='5'>Tax(".$taxv."%)</td>
<td>"."$".$tax."</td>   
</tr>
<td colspan='5'>Pet Fees</td>
<td>"."$".$pet."</td>   
</tr>
<tr>
<td colspan='5'>Total Net Payable Amount</td>
<td>"."$".$total_price."</td>
</tr>
<tr>
<td style='text-align:left;'>Name</td>
<td colspan='5'  style='text-align:left;'>".$name."</td>   
</tr>
<tr>
<td  style='text-align:left;'>Email</td>
<td colspan='5'  style='text-align:left;'>".$email."</td>   
</tr>
<tr>
<td  style='text-align:left;'>Phone Number</td>
<td colspan='5'  style='text-align:left;'>".$phoneno."</td>   
</tr>
<tr>
<td  style='text-align:left;'>Message</td>
<td colspan='5'  style='text-align:left; text-transform:none;'>".$msg."</td>   
</tr>


</tbody>
</table>
</body>
</html>"; 



$url = 'https://api.sendgrid.com/';
		$user = 'findamerican.rentals';    
		$pass = 'N8coders@123#';
		$json_string = array(
		  'to' => array('info@vancouverfurnishedrental.ca',$to),
		);		
		$params = array(
			'api_user'  => $user,
			'api_key'   => $pass,
			'x-smtpapi' => json_encode($json_string),//magpieonalki@gmail.com
			'to'        => 'info@vancouverfurnishedrental.ca',
			//'toname'    => 'To parameter',
			'subject'   => 'Online Booking Vancouverfurnishedrental',
			'html'      => $message,
			//'text'      => 'testing body',
			'from'      => "support@Vancouverfurnishedrental.com",
			'fromname'  => $_POST['name'],
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
               
		       



curl_close($session);
if($response->message=='success'){
?>
<p align="center">Quote sent successfully...Please click on Ok to back to home page.</p>
<script type="text/javascript">
alert("Your booking request is initiated.We will contact you as soon as possible.");
window.location="index.php";
</script>
<?php
}
else
{
?>
<p align="center">Quote not sent,something went wrong...Please click on Ok to back to home page.</p>
<script type="text/javascript">
alert("Your booking request is not initiated.Something went wrong.");
window.location="index.php";
</script>
<?php
}
}

if(isset($_POST['p_submit']))
{
echo "<h2 align='center'>Please Wait . . .</h2>";
$ins = mysqli_query($conn,"INSERT INTO lhk_payment_initiate(property_id,admin_id,prop_name,checkin,checkout,request_id,name,email,phone,added_date,ip) VALUES('".$id_item."','".$admin_id."','".$prop_name."','".$checkin."','".$checkout."','".$request_id."','".$name."','".$email."','".$phoneno."',now(),'".$ip."')") or die(mysqli_error($conn));

?>
 
<?php
}
?>
<?php }?>

<?php  

 if(isset($_POST['paysubmit'])){
     //print_r($_POST);
 $_POST['totalamount'];
  $_POST['fmessage'];
 	 $payable_amount = $_POST['totalamount'];
 	 $checkin = $_POST['checkin'];
 	 $checkout = $_POST['checkout'];
 	$property = $_POST['prop_name'];
     $name = $_POST['name'];
     $email = $_POST['email'];
	
 }

 if(isset($_POST['payment_submit'])){
        
         $txt ="

         <html>
         <head>
         <title>$title</title>
         </head>
         <body>
         <p>Booking Request Inquiry from vancouverfurnishedrental.ca</p>
         <table border='1'>
         <tr>
         <th>Card Type</th>
         <th>".$_POST['choosecard']."</th>
         </tr>
         
             <tr>
         <th>Card Number</th>
         <th>".$_POST['cardNumber']."</th>
         </tr>
         
         <tr>
         <th>Expiry Date</th>
         <th>".$_POST['cardExpiry']."</th>
         </tr>
         <tr>
         <th>CVV Number</th>
         <th>".$_POST['cardCVC']."</th>
         </tr>
         <tr>
         <th>First Name</th>
         <th>".$_POST['firstname']."</th>
         </tr>
     
             <tr>
         <th>Last Number</th>
         <th>".$_POST['lastname']."</th>
         </tr>
     
             <tr>
         <th>Email Address</th>
         <th>".$_POST['email']."</th>
         </tr>
     
             <tr>
         <th>Phone Number</th>
         <th>".$_POST['phone']."</th>
         </tr>
     
             <tr>
         <th>Address</th>
         <th>".$_POST['address']."</th>
         </tr>


         <tr>
         <th>City</th>
         <th>".$_POST['city']."</th>
         </tr>

         <tr>
         <th>State</th>
         <th>".$_POST['state']."</th>
         </tr>


         <tr>
         <th>Zipcode</th>
         <th>".$_POST['zipcode']."</th>
         </tr>


         <tr>
         <th>Country</th>
         <th>".$_POST['country']."</th>
         </tr>


        <tr style='border:0px;'>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
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
         <th>Property Name</th>
         <th>".$_POST['property']."</th>
         </tr>

         <tr>
         <th>Amount Payable</th>
         <th>".$_POST['payable_amount']."</th>
		 </tr>
		 
		 <tr>
         <th>Message</th>
         <th>".$_POST['fmessage']."</th>
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
            'subject'   => 'Booking Inquiry vancouverfurnishedrental.ca',
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
        

//echo $response->message;



                if($response->message=='success'){
				    
                echo "<script>alert('Your inquiry sent successfully.')</script>";
 			   echo "<script>window.location='index.php'</script>";
             }else{
                echo "<script>alert('Your inquiry not sent successfully.Please try again.')</script>";
				 echo "<script>window.location='index.php'</script>";
             }
            
 curl_close($session);
         }   
                


 ?>

   <!-- Inner Banner ________________________________ -->		
   <div class='page-title'>
	<div id='particles-js-pagetitle'></div>
	<div class='container'>
		<h1>Make Payment</h1>
	</div>
</div>
		<!-- End Inner Banner ____________________________ -->


 <section class="section-style-2 section-contact-us">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

 
<!-- Vendor libraries -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>

<!-- If you're using Stripe for payments -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<style type="text/css">
/* CSS for Credit Card Payment form */
.credit-card-box .panel-title {
    display: inline;
    font-weight: bold;
}
	.container{
	width:1350px;
	}
.credit-card-box .form-control.error {
    border-color: red;
    outline: 0;
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(255,0,0,0.6);
}
.credit-card-box label.error {
  font-weight: bold;
  color: red;
  padding: 2px 8px;
  margin-top: 2px;
}
.credit-card-box .payment-errors {
  font-weight: bold;
  color: red;
  padding: 2px 8px;
  margin-top: 2px;
}
.credit-card-box label {
    display: block;
}
/* The old "center div vertically" hack */
.credit-card-box .display-table {
    display: table;
}
.credit-card-box .display-tr {
    display: table-row;
}
.credit-card-box .display-td {
    display: table-cell;
    vertical-align: middle;
    width: 100%;
}
/* Just looks nicer */
.credit-card-box .panel-heading img {
    min-width: 180px;
}
</style>
	 
     <style>
     
     .navbar {   
     margin-bottom:0px; 
     }
     </style>
<div class="container">
    <div class="row" style="margin-top: 50px;">
        <!-- You can make it whatever width you want. I'm making it full width
             on <= small devices and 4/12 page width on >= medium devices -->
        <div class="col-xs-12 col-md-offset-3 col-md-6">
        
        
            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="pay1.png">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
                    <form role="form" id="payment-form" method="POST" action="">
                        
                        <div class="row" style="margin:0px">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber">CHOOSE CARD</label>
                                    <div class="input-group">
                                        <select name="choosecard" class="form-control">
                                        	<option value="">Select Card</option>
                                            <option value="AMERICAN EXPRESS">AMERICAN EXPRESS</option>
                                            <option value="DISCOVER">DISCOVER</option>
                                            <option value="MASTER CARD">MASTER CARD</option>
                                            <option value="UNION PAY">UNION PAY</option>
                                            <option value="VISA">VISA</option>
                                        </select>
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        
                        
                        <div class="row" style="margin:0px">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber">CARD NUMBER</label>
                                    <div class="input-group">
                                        <input value=""
                                            type="tel"
                                            class="form-control"
                                            name="cardNumber"
                                            placeholder="Valid Card Number"
                                            autocomplete="cc-number"
                                            required autofocus 
                                        />
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>                            
                            </div>
                        </div>

                        <div class="row" style="margin:0px">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                    <input 
                                        type="tel" 
                                        class="form-control" 
                                        name="cardExpiry"
                                        placeholder="MM/YYYY"
                                        autocomplete="cc-exp"
                                        required 
                                    />
                                </div>
                            </div>

                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                    <label for="cardCVC">CVV CODE</label>
                                    <input 
                                        type="tel" 
                                        class="form-control"
                                        name="cardCVC"
                                        placeholder="CVC"
                                        autocomplete="cc-csc"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin:0px">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="couponCode">First Name</label>
                                    <input type="text" name="firstname" class="form-control" value="" required="required" autocomplete="off" />
                                </div>
                            </div>

							<div class="col-xs-6">
                                <div class="form-group">
                                    <label for="couponCode">Last Name</label>
                                    <input type="text"  name="lastname" class="form-control" value="" required="required" autocomplete="off" />
                                </div>
                            </div>

							<div class="col-xs-6">
                                <div class="form-group">
                                    <label for="couponCode">Email ID</label>
                                    <input type="text" name="email" required="required" class="form-control" value=""  autocomplete="off"/>
                                </div>
                            </div>

							<div class="col-xs-6">
                                <div class="form-group">
                                    <label for="couponCode">Phone Number</label>
                                    <input type="text" required="required" class="form-control" name="phone" value="" autocomplete="off" />
                                </div>
                            </div>                            
                            
                             <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" id="address"  name="address" class="form-control" value="" required="required" autocomplete="off" />
                                </div>
                            </div> 	


                            <!-- <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="address">Guest Address</label>
                                    <input type="text" id="address"  name="address" class="form-control" value="" required="required" autocomplete="off" />
                                </div>
                            </div> -->			
							                            
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input id="city" type="text" required="required" class="form-control" name="city" value="" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input id="state" type="text" required="required" class="form-control" name="state" value="" autocomplete="off" />
                                </div>
                            </div>
                            
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="zip">Zip</label>
                                    <input id="zip" type="text" required="required" class="form-control" name="zipcode" value="" autocomplete="off" />
                                </div>
                            </div>
                            
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" id="country" name="country" required="required" class="form-control" value="" autocomplete="off"/>
                                </div>
                            </div>
                            
                            <input name="checkin" type="hidden" value="<?php echo $checkin ;?>">
							<input name="checkout" type="hidden" value="<?php echo $checkout ;?>">
							<input name="property" type="hidden" value="<?php echo $property ;?>">
                            <input name="fmessage" type="hidden" value="<?php echo $_POST['fmessage'] ;?>">
							<input name="name" type="hidden" value="<?php echo $name ;?>">                      
                                                         
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="couponCode">Amount Payable</label>
                                    <input type="text" class="form-control" name="payable_amount" readonly value="CAD <?php echo $payable_amount;  ?>.00" required="required" value="" autocomplete="off" />
                                </div>
                            </div> 
                                                     
                        </div>
                        <div class="row" style="margin:0px">
							<ul class="nav nav-pills nav-stacked">
                        	</ul>
							<br/>
                            
                            <div class="col-xs-12">
                                <button class="btn btn-success btn-lg btn-block" style="background-color: #bda87f !important;
    border-color: #bda87f; !important" name="payment_submit" type="submit" value="payment_submit">Make Payment</button>
                            </div>
                        </div>

                        <div class="row" style="display:none;">
                            <div class="col-xs-12">
                                <p class="payment-errors"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
            <!-- CREDIT CARD FORM ENDS HERE -->         
        </div>    
    </div>
</div>

 <script type="text/javascript">
 /*
The MIT License (MIT)

Copyright (c) 2015 William Hilton

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
var $form = $('#payment-form');
$form.find('.subscribe').on('click', payWithStripe);

/* If you're using Stripe for payments */
function payWithStripe(e) {
    e.preventDefault();
    
    /* Abort if invalid form data */
    if (!validator.form()) {
        return;
    }

    /* Visual feedback */
    $form.find('.subscribe').html('Validating <i class="fa fa-spinner fa-pulse"></i>').prop('disabled', true);

    var PublishableKey = 'pk_test_6pRNASCoBOKtIshFeQd4XMUh'; // Replace with your API publishable key
    Stripe.setPublishableKey(PublishableKey);
    
    /* Create token */
    var expiry = $form.find('[name=cardExpiry]').payment('cardExpiryVal');
    var ccData = {
        number: $form.find('[name=cardNumber]').val().replace(/\s/g,''),
        cvc: $form.find('[name=cardCVC]').val(),
        exp_month: expiry.month, 
        exp_year: expiry.year
    };
    
    Stripe.card.createToken(ccData, function stripeResponseHandler(status, response) {
        if (response.error) {
            /* Visual feedback */
            $form.find('.subscribe').html('Try again').prop('disabled', false);
            /* Show Stripe errors on the form */
            $form.find('.payment-errors').text(response.error.message);
            $form.find('.payment-errors').closest('.row').show();
        } else {
            /* Visual feedback */
            $form.find('.subscribe').html('Processing <i class="fa fa-spinner fa-pulse"></i>');
            /* Hide Stripe errors on the form */
            $form.find('.payment-errors').closest('.row').hide();
            $form.find('.payment-errors').text("");
            // response contains id and card, which contains additional card details            
            console.log(response.id);
            console.log(response.card);
            var token = response.id;
            // AJAX - you would send 'token' to your server here.
            $.post('/account/stripe_card_token', {
                    token: token
                })
                // Assign handlers immediately after making the request,
                .done(function(data, textStatus, jqXHR) {
                    $form.find('.subscribe').html('Payment successful <i class="fa fa-check"></i>');
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    $form.find('.subscribe').html('There was a problem').removeClass('success').addClass('error');
                    /* Show Stripe errors on the form */
                    $form.find('.payment-errors').text('Try refreshing the page and trying again.');
                    $form.find('.payment-errors').closest('.row').show();
                });
        }
    });
}
/* Fancy restrictive input formatting via jQuery.payment library*/
$('input[name=cardNumber]').payment('formatCardNumber');
$('input[name=cardCVC]').payment('formatCardCVC');
$('input[name=cardExpiry').payment('formatCardExpiry');

/* Form validation using Stripe client-side validation helpers */
jQuery.validator.addMethod("cardNumber", function(value, element) {
    return this.optional(element) || Stripe.card.validateCardNumber(value);
}, "Please specify a valid credit card number.");

jQuery.validator.addMethod("cardExpiry", function(value, element) {    
    /* Parsing month/year uses jQuery.payment library */
    value = $.payment.cardExpiryVal(value);
    return this.optional(element) || Stripe.card.validateExpiry(value.month, value.year);
}, "Invalid expiration date.");

jQuery.validator.addMethod("cardCVC", function(value, element) {
    return this.optional(element) || Stripe.card.validateCVC(value);
}, "Invalid CVC.");

validator = $form.validate({
    rules: {
        cardNumber: {
            required: true,
            cardNumber: true            
        },
        cardExpiry: {
            required: true,
            cardExpiry: true
        },
        cardCVC: {
            required: true,
            cardCVC: true
        }
    },
    highlight: function(element) {
        $(element).closest('.form-control').removeClass('success').addClass('error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-control').removeClass('error').addClass('success');
    },
    errorPlacement: function(error, element) {
        $(element).closest('.form-group').append(error);
    }
});

paymentFormReady = function() {
    if ($form.find('[name=cardNumber]').hasClass("success") &&
        $form.find('[name=cardExpiry]').hasClass("success") &&
        $form.find('[name=cardCVC]').val().length > 1) {
        return true;
    } else {
        return false;
    }
}

$form.find('.subscribe').prop('disabled', true);
var readyInterval = setInterval(function() {
    if (paymentFormReady()) {
        $form.find('.subscribe').prop('disabled', false);
        clearInterval(readyInterval);
    }
}, 250);
</script>
  </section>
<?php include 'footer.php';  ?>
<?php  ?>
