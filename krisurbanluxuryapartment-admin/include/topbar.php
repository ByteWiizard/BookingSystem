<?php 
  include_once('functions.php');
  $login_details = $pre_fix."login_details";
  $booking_details = $pre_fix."booking_details";
  $transaction = $pre_fix."transaction";
  $profile_details = $pre_fix."profile_details";
?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <!-- Required plugin - Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">
    <!-- Generic Bootbites.com CSS -->
    <link href="css/default.css" rel="stylesheet">
    <!-- Tutorial specific CSS -->
    <link href="css/tutorial.css" rel="stylesheet"> 
	<link href="framework/css/animation.css" rel="stylesheet">
<script>
$(document).ready(function() {
  $('.raj').click(function() {
    var ur = $(this).attr('data-url');
    var idd = $(this).attr('data-target');
    var admin = $(this).attr('data-admin');
    var spl = idd.split('-') ;
    var tabl = spl[0];
    var valu = spl[1];
    $.ajax({
      method: "POST",
      url: ur+"ajax/notification.php",
      cache: false,
      data: {'dat':tabl , 'id':valu , 'admin':admin }
    }).done(function( msg ) {
      var doo = $.trim(msg);
    });
  });
});
</script>
<script>
$(document).ready(function(){
	var countnumber = $('#not-count').attr('data-seq');
	if(countnumber==0)
	{
		$('#not-count').removeClass('faa-flash animated');
	}
	if(countnumber>0)
	{
		$('#not-count').addClass('faa-flash animated');
	}
	
})
</script>
<?php
if($_GET['booking-id'] && $_GET['booking-id'] != ''){
$bookingid =$_GET['booking-id']; 
//echo "UPDATE ".$booking_details." SET notification_status='1' WHERE bok_det_id='$bookingid'";
$conn->query("UPDATE ".$booking_details." SET notification_status='1' WHERE bok_det_id='$bookingid'");
}

if($_SESSION['admin_id']!="")

{
	$admin_id = $_SESSION['admin_id'];

	$ip = getClientIP();

$ins = mysqli_query($conn,"UPDATE ".$login_details." SET last_login=now() , admin_ip='".$ip."' WHERE admin_id='".$admin_id."'");

}

?>

<?php

$admin_id = $_SESSION['admin_id'];

  $fetch = mysqli_query($conn,"SELECT * FROM ".$profile_details." WHERE admin_id='".$admin_id."'");

	$num = mysqli_num_rows($fetch);

  while($show = mysqli_fetch_assoc($fetch))

  {
	$profile_img = $show['profile_img'];

	$profile_name=$show['profile_name'];

	$website_name=$show['website_name'];

  }

?>
<?php
$listing = "";
 $fetch1 = mysqli_query($conn,"SELECT bok_det_id FROM ".$booking_details." WHERE notification_status=0 ORDER BY added_date DESC");
 $num1 = @mysqli_num_rows($fetch1);
 
 if($num1>0)
 {
	 while($row1 = @mysqli_fetch_assoc($fetch1)){
                    		if($row1['bok_det_id']!="")
							{
								$req[] = preg_replace('/\s+/', '', "req-".$row1['bok_det_id']);
							}
	 }
 }
 
 $fetch2 = mysqli_query($conn,"SELECT trans_id FROM ".$transaction." WHERE trans_status=0 ORDER BY trans_date DESC");
 $num2 = @mysqli_num_rows($fetch2);
 
 if($num2>0)
 {
	 while($row2 = @mysqli_fetch_assoc($fetch2)){
                    		
							if($row2['trans_id']!="")
							{
								$pay[] = preg_replace('/\s+/', '', "pay-".$row2['trans_id']);
							}
	 }
 }
 
 function array_flatten($array) {
    $return = array();
    foreach ($array as $key => $value) {
        if (is_array($value)){
            $return = array_merge($return, array_flatten($value));
        } else {
            $return[$key] = $value;
        }
    }

    return $return;
}

$result = @array($req,$pay);
$result = array_filter($result) ;
 $listing = @array_flatten($result);
$list_count = count($listing);

?>
<header class="main-header">

        <a href="index.php" class="logo">
          <span class="logo-mini">Admin</span>        
          <span class="logo-lg">Admin</span>
        </a>     
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
        <!-- rotateIn / rotateOut -->
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <?php if($list_count==0){echo "Notification" ;} else{ echo "Notifications";} ?> 
            <span class="badge" id="not-count" data-seq="<?php echo @$list_count;?>"> <?php echo @$list_count;?></span>
          </a>
            <ul class="dropdown-menu sambhu" id="list_ul" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
            <?php if($list_count!=0){
							foreach($listing as $list){
								$break = explode("-",$list);
								if($break[0]=="req"){
									$fet = mysqli_query($conn,"SELECT * FROM ".$booking_details." WHERE bok_det_id='".$break[1]."' AND book_status=0");
									$lo = mysqli_fetch_assoc($fet);
									$listing = "You have recieved a booking request from ".$lo['name']."(".$lo['email'].")";
								}
								if($break[0]=="pay")
								{
									$fetc = mysqli_query($conn,"SELECT * FROM ".$transaction." WHERE trans_id='".$break[1]."' AND trans_status=0");
									$loc = mysqli_fetch_assoc($fetc);
									$listing = "You got a payment through ".$loc['trans_name']."(".$loc['trans_email'].")";
								}
              ?>
              <li><a href="javascript:;" class="btn btn-info btn-lg raj" data-toggle="modal" data-target="#<?php echo @$list ;?>" data-url="<?php echo SITE_URL; ?>debbie-admin/" data-admin="<?php echo $_SESSION['admin_id'] ;?>"><?php echo @$listing; ?></a></li>
            <?php } }else{
						  echo "<li class='btn btn-info raj' style='pointer-events:none;'>You have no notification now.</li>";
					  }
					  ?>
          </ul>
        </li>

              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if(@$profile_img==""){ ?>
                  <img src="framework/img/user2-160x160.jpg" class="user-image" alt="User Image">
                   <?php }else{ ?>
      				<img src="<?php echo @$profile_img ;?>" class="user-image" alt="User Image">
    				  <?php } ?>
                  <span class="hidden-xs"><?php echo @$profile_name ;?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <?php if(@$profile_img==""){ ?>
                      <img src="framework/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <?php }else{ ?>
      				        <img src="<?php echo @$profile_img ?>" class="img-circle" alt="User Image">
    				        <?php } ?>
                    <p>
                      <?php echo @$profile_name ;?>
                    </p>
                    <p>
                      <?php echo @$website_name ;?>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="profile.php" class="btn btn-default btn-flat"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i>Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
 <!-- Modal -->
 <?php
 $fetch6 = mysqli_query($conn,"SELECT * FROM ".$transaction." WHERE trans_status=0 ORDER BY trans_date DESC");
 $num6 = @mysqli_num_rows($fetch6);
 
  if($num6>0){
    while($row6 = @mysqli_fetch_assoc($fetch6)){
      if($row6['trans_id']!=""){
        $pay="pay-".$row6['trans_id'];
      }
?> 
  <div class="modal fade" id="<?php echo $pay ;?>" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment Date: <?php echo $row6['trans_date'] ;?></h4>
        </div>
        <div class="modal-body">
        <p>Property Name: <?php echo $row6['prop_name']?$row6['prop_name']:"Not Available" ;?></p>
          <p>Name: <?php echo $row6['trans_name'] ;?></p>
          <p>Email: <?php echo $row6['trans_email'] ;?></p>
          <p>Phone: <?php echo $row6['trans_phone'] ;?></p>
          <p>CheckIn date: <?php echo $row6['trans_checkin'] ;?></p>
          <p>CheckOut date: <?php echo $row6['trans_checkout'] ;?></p>
          <p>Transaction Id: <?php echo $row6['transaction_id'] ;?></p>
          <p>Paid Amount: <?php echo $row6['trans_amt']?"$".number_format($row6['trans_amt'],2):"" ;?></p>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>      
    </div>
  </div>
<?php
	 }
 }
?>
<?php

 $fetch1 = mysqli_query($conn,"SELECT * FROM ".$booking_details." WHERE notification_status=0 ORDER BY added_date DESC");
 $num1 = @mysqli_num_rows($fetch1);
 
  if($num1>0){
    while($row1 = @mysqli_fetch_assoc($fetch1)){
      if($row1['bok_det_id']!=""){
        $req="req-".$row1['bok_det_id'];
      }
?>
	<div class="modal fade" id="<?php echo $req ;?>" data-id="<?php echo $row1['bok_det_id']; ?>" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Request Date: <?php echo $row1['added_date'] ;?></h4>
        </div>
        <div class="modal-body">
        <p>Property Name: <?php echo $row1['prop_name']?$row1['prop_name']:"Not Available" ;?></p>
        <p>Name: <?php echo $row1['name'] ;?></p>
        <p>Email: <?php echo $row1['email'] ;?></p>
        <p>Phone: <?php echo $row1['phone'] ;?></p>
          <p>CheckIn date: <?php echo $row1['checkin'] ;?></p>
          <p>CheckOut date: <?php echo $row1['checkout'] ;?></p>
          <p>Total Night: <?php echo $row1['totalnight']?$row1['totalnight']:"" ;?></p>
          <p>Total Guest: <?php echo $row1['no_of_ppl']?$row1['no_of_ppl']:"Not Available" ;?></p>
          <?php if($row1['pets']!=""){?><p>Pet: <?php echo $row1['pets'].'</p>' ;}?>
          <p>Payable Amount: <?php echo $row1['tot_amt']?"$".number_format($row1['tot_amt'],2):"" ;?></p>
<input type="hidden" value="<?php echo $row1['bok_det_id']; ?>" class="booking-id"/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-id="<?php echo $row1['bok_det_id']; ?>" data-dismiss="modal">Close</button>
        </div>
      </div>      
    </div>
  </div>
<?php
	 }
 }
?>   
 <!-- Tutorial JS code -->
    <script src="js/tutorial.js"></script>
<script>
$(document).ready(function(){

	$('button').click(function(){

var id = $(this).data('id');
		var d = $(this).attr('data-close');
		if(d=="close")
		{
		window.location="?booking-id="+id;
		}
	});
	$('.modal').click(function(){
var id = $(this).data('id');
		window.location="?booking-id="+id;
	});
	
})
</script>