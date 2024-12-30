<?php include_once('session_destroy.php'); ?>
<?php include_once('include/functions.php');?>
<?php 
error_reporting(0);
  include("include/db.php"); 
  $property_new_rates = $pre_fix."property_new_rates";
?>
<?php
if(isset($_POST['edit_rate_button']))
{
	@$edit_id = $_POST['edit_rate'];
	@$pro_id = $_POST['edit_rate_pro_id'];
	$server = 'http://'.$_SERVER['SERVER_NAME'].'/admin/property_details.php?data=profile';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>
<link href="framework/css/import.css" rel="stylesheet">
<link href="framework/css/timepicki.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="framework/js/ajax.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include_once('include/topbar.php'); ?>
<?php include_once('include/sidebar.php'); ?>
<?php $admin_id = $_SESSION['admin_id']; ;?> 
<?php
	  $fetch11 = mysqli_query($conn,"SELECT * FROM ".$property_new_rates." WHERE pro_new_rate_id='".$edit_id."' AND property_id='".$pro_id."'");
	   $num11 = mysqli_num_rows($fetch11);
	   if($num11>0)
	   {
		while($show11 = mysqli_fetch_assoc($fetch11))
                    {
			$pro_edit_rate_desc=$show11['pro_new_rate_desc'];
			$pro_edit_rate_sdate=$show11['pro_new_rate_sdate'];
			$pro_edit_rate_edate=$show11['pro_new_rate_edate'];
			$pro_edit_rate_weekend_night=$show11['pro_new_rate_weekend_nt'];
			$pro_edit_rate_week_night=$show11['pro_new_rate_week_nt'];
			$pro_edit_rate_weekly_night=$show11['pro_new_rate_weekly_nt'];
			$pro_edit_rate_monthly=$show11['pro_new_rate_monthly'];
                        $pro_edit_rate_event=$show11['pro_new_rate_event'];
			$pro_edit_rate_min_stay=$show11['pro_new_rate_min_stay'];
                        $basedonguest = $show11['basedonguest'];
                        $guestpernoght = $show11['guestpernoght'];
		  }
	   }
?>     
      
      
      <div class="content-wrapper">
<section class="content-header">
<h1> Edit Rates <small>Update your Property Easily</small> </h1>
<hr>
<form class="ac-custom ac-checkbox ac-boxfill" method="post" action="" autocomplete="off">
<div class="heading">
            <h3><i class="fa fa-home" aria-hidden="true"></i> Edit Property Rates</h3>
          </div>
          
          <div class="row">
          <div class="col-md-4">
            <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Edit Season</label>
                <input type="text" name="pro_new_rate_desc" class="form-control" id="pro_new_rate_desc" placeholder="Season" value="<?php echo @$pro_edit_rate_desc ;?>" />
              </div>
            </div>
          </div>
          <div class="col-md-4">
             <div class="form-group">
          <label for="exampleInputEmail1">Edit Start Date</label>
          <div class='input-group date' id='datetimepicker8'>
            <input type='text' class="form-control" name="pro_new_rate_sdate" id="pro_new_rate_sdate" value="<?php echo @$pro_edit_rate_sdate ;?>" />
            </div>
        </div>
          </div>
          <div class="col-md-4">
             <div class="form-group">
          <label for="exampleInputEmail1">Edit End Date</label>
          <div class='input-group date' id='datetimepicker9'>
            <input type='text' class="form-control" name="pro_new_rate_edate" id="pro_new_rate_edate" value="<?php echo @$pro_edit_rate_edate ;?>" />
             </div>
        </div>
          </div>
          <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Edit Nightly</label>
                <input type="text" name="pro_new_rate_week_nt" class="form-control" id="pro_new_rate_week_nt" placeholder="Edit Nightly" value="<?php echo @$pro_edit_rate_week_night ;?>" />
              </div>
            </div>
          
          </div>
          
          <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Edit Weekend Night</label>
                <input type="text" name="pro_new_rate_weekend_nt" class="form-control" id="pro_new_rate_weekend_nt" placeholder="Weekend" value="<?php echo @$pro_edit_rate_weekend_night ;?>" />
              </div>
            </div>
          
          </div>
          
           <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Edit Weekly</label>
                <input type="text" name="pro_new_rate_weekly_nt" class="form-control" id="pro_new_rate_weekly_nt" placeholder="Weekly" value="<?php echo @$pro_edit_rate_weekly_night ;?>" />
              </div>
            </div>
          
          </div>
          
           <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Edit Monthly</label>
                <input type="text" name="pro_new_rate_monthly" class="form-control" id="pro_new_rate_monthly" placeholder="Monthly" value="<?php echo @$pro_edit_rate_monthly ;?>" />
              </div>
            </div>
          </div>

          <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Edit Event</label>
                <input type="text" name="pro_new_rate_event" class="form-control" id="pro_new_rate_event" placeholder="Event" value="<?php echo @$pro_edit_rate_event;?>" />
              </div>
            </div>
          </div>
          
          <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Edit Min Stay</label>
                <input type="text" name="pro_new_rate_min_stay" class="form-control" id="pro_new_rate_min_stay" placeholder="Min Stay" value="<?php echo @$pro_edit_rate_min_stay ;?>" />
              </div>
            </div>
            <input type="hidden" name="edit_rate_pro_id" value="<?php echo @$pro_id ;?>" />
          <input type="hidden" name="edit_rate_id" value="<?php echo @$edit_id ;?>" />
          <input type="hidden" name="admin_rate_id" value="<?php echo @$admin_id ;?>" />
          <input type="hidden" name="ip" value="<?php echo getClientIP();?>" />
          
        </div>
          <!-- <div class="col-md-4">
            <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Extra Guest Charge</label>
                  <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                          Guest
                          <input type="text" name="basedonguest" class="form-control" id="basedonguest" placeholder="Guest" value="<?php echo $basedonguest; ?>" />
                        </div>
                        <div class="col-md-6">
                          Per Night
                          <input type="text" name="guestpernoght" class="form-control" id="guestpernoght" placeholder="Per Night" value="<?php echo $guestpernoght; ?>" />
                        </div>
                    </div>
                  </div>
              </div>
            </div>
          
          </div> -->
<p class="text-center">
          <button type="submit" name="edit_pro_rate_submit" class="btn btn-success btn-outline-rounded green"> Update <span  class="glyphicon glyphicon-send"></span></button>
        </p>
</form>
  </div>
</div>
<script>
/*$( "#pro_new_rate_sdate" ).click(function(){
  $( "#pro_new_rate_sdate" ).datepicker();
});
$( "#pro_new_rate_edate" ).click(function(){
  $( "#pro_new_rate_edate" ).datepicker();
   
})*/
  $(document).ready(function(e) {
  //$( ".form-control" ).datepicker( "option", "dateFormat",'yy-mm-dd');
	$( "#pro_new_rate_sdate" ).datepicker({ dateFormat:"yy-mm-dd"});
	$( "#pro_new_rate_edate" ).datepicker({ dateFormat:"yy-mm-dd"});
	
 });
</script>
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script> 
<script src="framework/js/dropdown.js"></script> 
<script src="framework/js/select.js"></script>
<script>
	(function() {
	    [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
		new SelectFx(el);
		} );
	})();
			
</script> 
</body>
</html>
<?php
}
?>
<?php
if(isset($_POST['edit_pro_rate_submit']))
{
  $prop_id = $_POST['edit_rate_pro_id'];
  $edit_id = $_POST['edit_rate_id'];
  $admin_id = $_POST['admin_rate_id'];
  $ip = $_POST['ip'];
  include_once('include/db.php') ;
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $fetching = mysqli_query($conn,"SELECT * FROM ".$property_new_rates." WHERE pro_new_rate_id='".$edit_id."' AND property_id='".$prop_id."'");
  $set = mysqli_fetch_assoc($fetching);
  
  $pro_new_rate_desc=test_input($_POST['pro_new_rate_desc']);
  $pro_new_rate_sdate=test_input($_POST['pro_new_rate_sdate']);
  $pro_new_rate_edate=test_input($_POST['pro_new_rate_edate']);
  $pro_new_rate_weekend_night=test_input($_POST['pro_new_rate_weekend_nt']);
  $pro_new_rate_week_night=test_input($_POST['pro_new_rate_week_nt']);
  $pro_new_rate_weekly_night=test_input($_POST['pro_new_rate_weekly_nt']);
  $pro_new_rate_monthly=test_input($_POST['pro_new_rate_monthly']);
  $pro_new_rate_event=test_input($_POST['pro_new_rate_event']);
  $pro_new_rate_min_stay=test_input($_POST['pro_new_rate_min_stay']);
  $basedonguest = test_input($_POST['basedonguest']);
  $guestpernoght = test_input($_POST['guestpernoght']);
  if($pro_new_rate_sdate == "")
  {
    $pro_new_rate_sdate = $set['pro_new_rate_sdate'];
  }
  if($pro_new_rate_edate == "")
  {
    $pro_new_rate_edate = $set['pro_new_rate_edate'];
  }
  
  $update = mysqli_query($conn,"UPDATE ".$property_new_rates." SET pro_new_rate_desc='".$pro_new_rate_desc."', pro_new_rate_sdate='".$pro_new_rate_sdate."', pro_new_rate_edate='".$pro_new_rate_edate."', pro_new_rate_weekend_nt='".$pro_new_rate_weekend_night."', pro_new_rate_week_nt='".$pro_new_rate_week_night."',pro_new_rate_weekly_nt='".$pro_new_rate_weekly_night."',pro_new_rate_monthly='".$pro_new_rate_monthly."', pro_new_rate_event='".$pro_new_rate_event."',pro_new_rate_min_stay='".$pro_new_rate_min_stay."',basedonguest='".$basedonguest."',guestpernoght='".$guestpernoght."', pro_new_update_date=now() , pro_new_ip='".$ip."' WHERE pro_new_rate_id='".$edit_id."'") or (mysqli_error($conn));
    
    if($update)
    {
      echo "<script>alert('Updated Successfully.');</script>";
      ?>
      <script>
      window.location = 'property_details.php?data=profile' ;
            </script>
            <?php
    }
    else
    {
      echo "<script>alert('Updatation Failed.');</script>";
    }
  
}
?>
<?php
if(!isset($_POST['edit_rate_button']))
{
$server = 'http://'.$_SERVER['SERVER_NAME'].'/admin/property_details.php?data=profile';
?>
<script>
window.location ='<?php echo $server ;?>' ;
</script>
<?php
}
?>