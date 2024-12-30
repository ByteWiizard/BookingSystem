<?php include'header.php';


if(isset($_POST['submit'])){
		
    $txt = 
        "
        <html>
        <head>
        <title>$title</title>
        </head>
        <body>
        <p>Inquiry for Listing a Property</p>
        <table border='1'>
        <tr>
        <th> Name</th>
        <th>".$_POST['name']."</th>
        </tr>
        
          
        
        <tr>
        <th>Email Address</th>
        <th>".$_POST['email']."</th>
        </tr>
        <tr>
        <th>Phone</th>
        <th>".$_POST['Phone']."</th>
        </tr>
        <tr>
        <th>I am</th>
        <th>".$_POST['iam']."</th>
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
      'subject'   => 'Inquiry for Listing a Property from VANCOUVER FURNISHED RENTAL',
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
.select100{
	margin-top:30px;
	padding:20px;
	width:100%;
	border-radius: 5px;
	border: 1px solid #eee;
}

.select100:hover{
	border: 1px solid #bda87f;
}
.contact-box-message{
	padding:50px;
}

.contact-form{
	margin-left:200px !important;
		margin-right:200px !important;
}
</style>
<div class='page-title'>
	<div id='particles-js-pagetitle'></div>
	<div class='container'>
		<h1>List Property</h1><h6>Vancouver Furnished Rentals</h6>
	</div>
</div>
 <div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-sm-8">
            <div class="row contact-box-message">
                <span style="color:red;"></span>
                <span style="color:red;"><?php echo $msg;?></span>
                <form autocomplete='off' class='contact-form' method='post' onsubmit="return validation();"  name="form1">
                	
                    <h3>List Your Vacation Rentals</h3>
 					<div class='col-xs-12'><input required placeholder="  Name" name='name' type='name'></div>
                   
                    <div class='col-xs-12'><input required placeholder="E-mail adress" name='email' type='email'></div>
                    <div class='col-xs-12'><input required placeholder='Phone' name='Phone'></div>
                    <div class='col-xs-12'>
                        <select class="select100" name="iam">
                                <option value="">I am a</option>
                                <option value="Property Owner">Property Owner</option>
                                <option value="Property Manager">Property Manager</option>
                            </select>
					</div>
                    
                    
 
                    <div class='col-xs-12'><textarea required name='message' placeholder="Your Message"></textarea></div>
                    <div class="col-md-4 " style="margin-left: -152px;">
    <input type="text" placeholder="Enter Captcha" class="contact-form" name="chk"  style="margin-left: -2px;">
    <span id="errorc" style="color:red;"></span>

</div>  
<div class="col-md-3">
<input type="text" id="ran" name="ran" readonly="readonly" class="captcha contact-form" style="font-family: 'Homemade Apple',cursive; width:100%;">
</div>
                                
<div class="col-md-5">
<input type="button" value="Referesh" class="contact-form"  onclick="captch()" style="color: #FFF;background: #bda87f;width: 156px;" />
</div>
                    <div class=col-xs-12><button class="center-holder button-md full-width mt-20 primary-button rounded-border" type='submit' name="submit">Sign Up</button></div>
                </form>
            </div>
        </div>
    </div>
</div>	 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function validation()
{


if(document.form1.chk.value=="")
{
document.getElementById("errorc").innerHTML="Enter Captcha!";
document.form1.chk.focus();
return false;
}

if(document.form1.ran.value!=document.form1.chk.value)
{
document.getElementById("errorc").innerHTML="Captcha Not Matched!";
document.form1.chk.focus();
return false;
}
return true;
}

function captch() {
    var x = document.getElementById("ran")
    
    x.value = Math.floor((Math.random() * 10000) + 1);
}

$(function(){
    captch();
   
})

</script>
<?php include'footer.php'; ?>