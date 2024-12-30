<?php include_once('session_destroy.php') ;
include("include/db.php");
include("../mailer-function/class.phpmailer.php");	
$property_default_rates = "property_default_rates";
$ical_events = "ical_events";
$property_new_rates = "property_new_rates";
$property_details = "property_details";
$files = "files";
$booking_details ="lhk_booking_details";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>
<link href="framework/css/import.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="framework/js/ajax.js"></script>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>


<?php if(isset($_POST['submit_data'])) { 

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
@$fname=test_input($_POST['fname']); 
@$lname=test_input($_POST['lname']);
@$full_name = $fname.' '.$lname; 			
@$cust_email=test_input($_POST['cust_email']);
$checkin=test_input($_POST['checkin']);
$checkout=test_input($_POST['checkout']);	
$startdate=test_input($_POST['startdate']);
$booking_id=test_input($_POST['booking_id']);
$enddate=test_input($_POST['enddate']);	
$cust_phone = $_POST['cust_phone'];

$guests = $_POST['no_of_guests'];
@$request_id = $_POST['item_number'];
@$child=$_POST['child'];
@$refund=$_POST['refund'];	
@$taxv=$_POST['taxv'];
@$tax=$_POST['tax'];
@$clean=$_POST['clean_fee'];	
/*@$pets=$_POST['pets']? $_POST['pets']: 0;*/
@$pets_fee=$_POST['pets_fee'];
//@$address=$_POST['address'];
@$totalamount=$_POST['totalamount'];
@$totalnight=$_POST['totalnight'];

@$id_item=$_POST['pro_id'];
@$admin_id=$_POST['admin_id'];
@$prop_name=test_input($_POST['prop_name']);			
//@$addr = test_input($_POST['address']);
@$msg = test_input($_POST['special_requests']);

$pay = $totalamount;
$total_price  = $totalamount;
$apply_rate=$_POST['apply_rate'];
$apply_rate_price=$_POST['apply_rate_price'];
$min_stay=$_POST['min_stay'];
$g_amount=$_POST['g_amount'];

$showextraname=$_POST['showextraname'];
$showextraamount=$_POST['showextraamount'];

if($showextraname!='' && $showextraamount!='') {
$showextratext="<tr>
<td colspan='5'>".$showextraname."</td>
<td>$".number_format($showextraamount,2)."</td>   
</tr>";	
} else {
$showextratext="";		
}


$paymenturl1="<a href='".SITE_URL."pay-now.php?booking=".$booking_id."' target='_blank' style='padding:12px; font-size:18px; background: #20617a;'>Pay Via Paypal </a>";
$paymenturl2="<a href='".SITE_URL."pay-now.php?booking=".$booking_id."' target='_blank' style='padding:12px; font-size:18px; background: #169552;'>Pay Via Cheque </a>";

$fetch = mysqli_query($conn,"SELECT * FROM ".$booking_details." WHERE bok_det_id='".$booking_id."'");
while($show = mysqli_fetch_assoc($fetch))
{
$message_send_status=$show['message_send_status']+1;
}



$update = mysqli_query($conn,"UPDATE ".$booking_details." SET property_id='".$id_item."', prop_name='".$prop_name."', checkin='".$startdate."', checkout='".$enddate."',admin_id= 1, tot_amt='".$totalamount."',  request_id='".$request_id."', totalnight='".$totalnight."', name='".$full_name."', fname='".$fname."', lname='".$lname."', email='".$cust_email."',phone='".$cust_phone."', no_of_ppl='".$guests."',children='".$child."', pets='".$pets."', msg='".$msg."', refund='".$refund."', taxv='".$taxv."', tax='".$tax."', clean='".$clean."',  apply_rate='".$apply_rate."', apply_rate_price='".$apply_rate_price."', min_stay='".$min_stay."', g_amount='".$g_amount."', showextraname='".$showextraname."', showextraamount='".$showextraamount."'  WHERE bok_det_id='".$booking_id."'") or (mysqli_error($conn));
	
$mailSenderEmail= "sandeep@personalwebsites.co.in"; 
$mailSenderName='Dune Castle West'; 

$mailEmailAdress= $cust_email;
$mailAddressName= $full_name;

$mailBccEmail='sandeep@personalwebsites.co.in'; 

$mailBodyHeader= "The Details are given below:";
$mailBodyFooter= "<b>Thank You</b> <br> Dune Castle West";

$mail = new PHPMailer(); // defaults to using php "mail()"

$mail->IsSendmail();


$body = "<html>
<head>
<style>
table {
border-collapse: collapse;
}

table {
border: 1px solid #9F8531;
background:rgba(0,0,0,0.8);
text-align:center;
color:#fff;
text-transform:capitalize;
}
table tr td a {
color:#fff !important;
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
<!--<th scope='col'>Minimum Stay</th>-->
<th scope='col'>Total Guest</th>
<th scope='col'>Children</th>
<th scope='col'>Total Nights</th>
<th scope='col'>Gross Amount</th>
</tr>
</thead>
<tbody>
<tr>
<td>".$checkin."</td>
<td>".$checkout."</td>
<!--<td>".$min_stay."</td>-->
<td>".$guests."</td>
<td>".$child."</td>
<td>".$totalnight."</td>
<td>$".$g_amount."</td>
</tr>
<tr>
<td colspan='5'> Refundable Security Deposit</td>
<td> $".$refund."</td>
</tr>
<tr>";

if($clean){
$body .="<td colspan='5'> Pet Fee</td>
<td> $".$clean." </td>
</tr>";
}

$body .="<tr>
<td colspan='5'>Tax(".$taxv." %)</td>
<td>$".$tax."</td>   
</tr>".$showextratext."
<tr>
<td colspan='5'>Total Net Payable Amount</td>
<td>$".$total_price."</td> 
</tr>
<tr>
<td style='text-align:left;'>Name</td>
<td colspan='5'  style='text-align:left;'>".$fname.' '.$lname."</td>   
</tr>
<tr>
<td  style='text-align:left;'>Email</td>
<td colspan='5'  style='text-align:left;'>".$cust_email."</td>   
</tr>
<tr>
<td  style='text-align:left;'>Phone Number</td>
<td colspan='5'  style='text-align:left;'>".$cust_phone."</td>   
</tr>				

<tr>
<td  style='text-align:left;'>Message</td>
<td colspan='5'  style='text-align:left; text-transform:none;'>".$msg."</td>   
</tr>

<tr style='background:#fff;'>
<td colspan='3' style='text-align:right;'>".$paymenturl1."</td> 
<td colspan='3' style='text-align:left; text-transform:none;'>".$paymenturl2."</td>    
</tr>
</tbody>
</table>
</body>
</html>";

//echo $body;die;






 
$mail->AddReplyTo($mailSenderEmail,$mailSenderName);

$mail->SetFrom($mailSenderEmail, $mailSenderName);

$mail->AddReplyTo($mailSenderEmail,$mailSenderName);

$address = $mailEmailAdress;

$mail->AddAddress($address, $mailAddressName);

//$mail->AddCC($mailCCEmail);

$mail->AddBCC($mailBccEmail);

$mail->Subject = "Inquiry from Dune Castle West";

$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; 

$mail->MsgHTML($body);


if(!$mail->Send()) {
echo "<script>alert('Error : Error While Sending Mail, Please Try After Sometime'); window.location.href='booking_details.php'</script>";
exit();
} else {
	
$update = mysqli_query($conn,"UPDATE ".$booking_details." SET  message_send_status='".$message_send_status."' WHERE bok_det_id='".$booking_id."'") or (mysqli_error($conn));
	
	
echo "<script>alert('Success : Booking Quote Send Successfully'); window.location.href='booking_details.php'</script>";
exit();
}


} else {
echo "<script>window.location.href='booking_details.php';</script>";
exit;	
}
?>

<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script>
</body>
</html>