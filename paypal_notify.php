<?php 
session_start();

error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>Collett Greek Cabin</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<!--Responsive-->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="css/responsive.css" rel="stylesheet">
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
<!-- fotorama.css & fotorama.js.-->
<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script>
$(document).ready(function(){				   	
$('.slider')._TMS({
show:0,
pauseOnHover:true,
prevBu:'.prev',
nextBu:'.next',
playBu:false,
duration:10000,
preset:'zoomer',
pagination:true,
pagNums:false,
slideshow:7000,
numStatus:false,
banners:'fade',
waitBannerAnimation:false,
progressBar:false
})		
});
</script>
<!--[if lt IE 8]>
<div style=' clear: both; text-align:center; position: relative;'>
<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
</a>
</div>
<![endif]-->
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
<![endif]-->

<!--- menu js-------------------->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script>
$(function() {
var pull 	= $('#pull');
menu 		= $('nav ul');
menuHeight	= menu.height();
$(pull).on('click', function(e) {
e.preventDefault();
menu.slideToggle();
});

$(window).resize(function(){
var w = $(window).width();
if(w > 640 && menu.is(':hidden')) {
menu.removeAttr('style');
}
});
});
</script>
<!--- slider js and css & menu js-------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>


</head>
<body>

<!--- mobile navigation ------>
<?php 
include('dido-admin/include/db.php');
include('header.php');

?>  

<!--==============================content================================-->
<section id="content">
<?php $paycat = $_POST['pay'];?>

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
		



//echo "SELECT * FROM lhk_info WHERE s_id ='".session_id()."'";
$info =$conn->query("SELECT * FROM lhk_info WHERE s_id ='".$_SESSION['sid']."'");
$infos =$info->fetch_assoc();

 $id_item=$infos['pid'];
$checkin= $infos['sdate'];
$checkout=$infos['edate'];
$gros_amount = $infos['g_amount'];
 $totalamount =number_format($infos['total_amt'],2);
$request_id = generateRandomString();
$totalnight =$infos['t_night'];
$name = $infos['name'];
$email = $infos['email'];
$phoneno = $_REQUEST['phone'];
$guests = $infos['guest'];
$msg =$_REQUEST['message'];
$refund =$infos['r_fees'];
$clean =$infos['clean'];
$discount =$infos['discount'];
$taxv =$infos['tax'];
$tax =$infos['tax_fees'];

$total_price = number_format($totalamount/2,2);

$firstdate = date("jS F, Y", strtotime($checkin));

$lastdate = date("jS F, Y", strtotime($checkout));

$prop =$conn->query("SELECT property_heading ,property_elevator FROM lhk_property_details WHERE property_id='".$id_item."'");
 $props =$prop->fetch_assoc();

$ins = mysqli_query($conn,"INSERT INTO lhk_booking_details(property_id,prop_name,checkin,checkout,tot_amt,request_id,totalnight,name,email,phone,no_of_ppl,pets,addr,msg,added_date,ip) VALUES('".$id_item."','".$prop_name."','".$checkin."','".$checkout."','".$totalamount."','".$request_id."','".$totalnight."','".$name."','".$email."','".$phoneno."','".$guests."','".$noofdogs."','".$addr."','".$msg."',now(),'".$ip."')");

if($ins){

$to = "msfundraiser@bellsouth.net";
//$mailBCC = "$email";
$subject = "Booking Confirmation";
if($_REQUEST['pay']=='half') 
{
$halftr = "<tr>
<td colspan='5'>Due Amount</td>
<td>"."$".$total_price."</td>
</tr>";

}

  $message = "<html>
<head>
<style>
table {
border-collapse: collapse;
}

table {
border: 1px solid #9F8531;
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
<h3 style='color:#ff7300;' align='center'>".$props['property_heading']." : Instant Quote </h3>
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
<td>".$props['property_elevator']."</td>
<!--<td>".$noofdogs."</td>-->
<td>".$guests."</td>
<td>".$totalnight."</td>
<td>".$gros_amount."</td>
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
<tr>
<td colspan='5'>Discount Amount</td>
<td>"."$".$discount."</td>
</tr>
<tr>
<td colspan='5'>Total Net Payable Amount</td>
<td>"."$".$totalamount."</td>
</tr>
".$halftr."
 
<tr>
<td style='text-align:left;'>Name</td>
<td colspan='5'  style='text-align:left;'>".$name."</td>   
</tr>
<tr>
<td  style='text-align:left;'>Email</td>
<td colspan='5'  style='text-align:left;'>".$email."</td>   
</tr>

</tbody>
</table>
</body>
</html>"; 

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'Bcc:harryjoneswork1@gmail.com' . "\r\n";

// More headers
$headers .= 'From: <'.$email.'>' . "\r\n";

if(mail($to,$subject,$message,$headers)){  

$ical =$conn->query("INSERT INTO lhk_ical_events (admin_id,start_date,end_date,text,event_pid,added_date,booking_status)VALUES('1','".$checkin."','".$checkout."','".$name."','".$id_item."','".date('Y-m-d')."','1')");
unset($_SESSION['sid']);
session_destroy();
?>
<p align="center">Quote sent successfully...Please click on OK to back to home page.</p>
<script type="text/javascript">
alert("Your booking request is initiated. We will contact you as soon as possible.");
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


echo "<h2 align='center'>Please Wait . . .</h2>";
$ins = mysqli_query($conn,"INSERT INTO lhk_payment_initiate(property_id,admin_id,prop_name,checkin,checkout,request_id,name,email,phone,added_date,ip) VALUES('".$id_item."','".$admin_id."','".$prop_name."','".$checkin."','".$checkout."','".$request_id."','".$name."','".$email."','".$phoneno."',now(),'".$ip."')") or die(mysqli_error($conn));



?>
 

</div>
</div>


<div class="container lightBg">
<div class="row">
<div style="padding:100px;"></div>
</div>
</div>

</section> 
<!--==============================footer=================================-->
<?php 
include('include/footer.php');
?>  

<script src="js/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/script.js"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
<script type="text/javascript">
jQuery(document).ready(function($){

$(".accordion_example1").smk_Accordion();

$(".accordion_example2").smk_Accordion({
closeAble: true, //boolean
});

$(".accordion_example3").smk_Accordion({
showIcon: false, //boolean
});

$(".accordion_example4").smk_Accordion({
closeAble: true, //boolean
closeOther: false, //boolean
});

$(".accordion_example5").smk_Accordion({closeAble: true});

$(".accordion_example6").smk_Accordion();

$(".accordion_example7").smk_Accordion({
activeIndex: 2 //second section open
});
$(".accordion_example8, .accordion_example9").smk_Accordion();


// Demo text. Let's save some space to make the code readable. ;)


});
</script>
<script>
$(function(){
	$(".dropdown").hover(            
	  function() {
		  $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
		  $(this).toggleClass('open');
		  $('b', this).toggleClass("caret caret-up");                
	  },
	  function() {
		  $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
		  $(this).toggleClass('open');
		  $('b', this).toggleClass("caret caret-up");                
	  });
	});
</script>
<script>
Cufon.now();
</script>
</body>
</html>