 <?php @include_once('session_destroy.php') ;?>
 <?php 
 	include_once('include/db.php');
 	$ical_links = $pre_fix."ical_links";
 	$ical_events = $pre_fix."ical_events";
 ?>
 <?php
if(isset($_POST['update_property_ical_submit']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$admin_id=$_SESSION['admin_id'];
	$pro_id=test_input($_POST['pro_id']);
	$pro_heading=test_input($_POST['property_heading']);
	$pro_ical=test_input($_POST['ical_link']);
	$ip = test_input($_POST['ip']);
		
		$sel1 = mysqli_query($conn, "SELECT link FROM ".$ical_links." WHERE i_id='".$pro_id."' AND admin_id='".$admin_id."'");
$num1 = @mysqli_num_rows($sel1);
$show1 = @mysqli_fetch_assoc($sel1);

if($num1==1)
{
	if($show1['link']!=$pro_ical)
	{
		$delete = mysqli_query($conn,"DELETE FROM ".$ical_events." WHERE event_pid='".$pro_id."' AND admin_id='".$admin_id."' AND event_type='ical'");
		define("ICS_URL1", 'http://'.$_SERVER['SERVER_NAME'].'/');
					$url = SITE_URL ? SITE_URL : ICS_URL1 ;
					define("ICS_URL", $url);
					
					//---------------------------------------------------------------------
					$site = $_SERVER['SERVER_NAME'];
						
					// the iCal date format. Note the Z on the end indicates a UTC timestamp.
					function dateToCal($timestamp) {
					  return date('Ymd\THis\Z', $timestamp);
					}
					 
					 $id= sprintf("%06d", $pro_id);
					
					// max line length is 75 chars. New line is \\n
					$n = mysqli_query($conn, "SELECT * FROM ".$ical_events." WHERE event_pid='".$pro_id."'");
					
					//---------------------------------------------------------------------------
					
					$output = "BEGIN:RJ-CALENDAR
					METHOD:PUBLISH
					VERSION:1.0
					CREATED BY:-// Rishabh #rishabh@personalwebsites.com #\n";
					
					function generateRandomString($length = 6) {
						$characters = '0123456789';
						$charactersLength = strlen($characters);
						$randomString = '';
						for ($i = 0; $i < $length; $i++) {
							$randomString .= $characters[rand(0, $charactersLength - 1)];
						}
						return $randomString;
					}
					$req_numm = generateRandomString();
					
					 
					// loop over events
					while(@$ical = mysqli_fetch_assoc($n))
					{
						$a = $ical['event_id'];
						$b = $ical['start_date'];
						$c = $ical['end_date'];
						$d = $ical['text'];
						$e = $ical['event_pid'];
						$f = $ical['added_date'];
					
					 $output .=
					"BEGIN:VEVENT
					SUMMARY:$d
					UID:$req_numm#$a#rj@$site
					STATUS:booked
					DTSTART:" . dateToCal(strtotime($b)) . "
					DTEND:" . dateToCal(strtotime($c)) . "
					PROPERTYID:$e
					LAST-MODIFIED:" . dateToCal(strtotime($f)) . "
					END:VEVENT\n";
					}
					// close calendar
					$output .= "END:RJ-CALENDAR";
					
					//------------------------------------------------------------
					
					$pagename = 'listing-'.$id;
					if (!file_exists('../ics-file')) {
						mkdir('../ics-file', 0777, true);
					}
					$fileaddress = '../ics-file/'.$pagename.".ics";
					$newFileName = 'ics-file/'.$pagename.".ics";
					
					if(file_put_contents($fileaddress,$output)!=false){
					 
					  $ics_link = ICS_URL.$newFileName;
					}
					else{
					   echo "Cannot create file (".basename($newFileName).")";
					}
	}

		$upd = mysqli_query($conn,"UPDATE ".$ical_links." SET property_heading='".$pro_heading."', link='".$pro_ical."', update_date=now(), ical_add_ip='".$ip."' WHERE i_id='".$pro_id."' AND admin_id='".$admin_id."'");
		
		if($upd)
		{
			echo "<script>alert('Updated Successfully.');</script>";
			?>
			<script>
			window.location = 'property_ical_links.php';
            </script>
            <?php
		}
		else
		{
			?>
			<script>alert('Something Went Wrong.')</script>;
			<script>
			window.location = 'property_ical_links.php';
            </script>
		<?php
        }
	
}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<script src="framework/js/ajax.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add Ical</title>
<link href="framework/css/import.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<?php include_once('include/sidebar.php'); ?>
<?php @$admin_id = $_SESSION['admin_id'] ;?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
<section class="content-header">
<h1> Property Ical <small>Update your Property Ical Easily</small> </h1>
<hr>
 <?php
 if(isset($_POST['edit_pro_button']))
 {
	 $property_id = @$_POST['edit_ical'] ;
 ?>
<?php
$sel = mysqli_query($conn, "SELECT * FROM ".$ical_links." WHERE i_id='".$property_id."' AND admin_id='".$admin_id."'");
$num = @mysqli_num_rows($sel);
$show = @mysqli_fetch_assoc($sel);
?>
<?php if($num>0)
{
?>
<form method="post" action="edit_ical.php">
        <input name="pro_id" value="<?php echo $property_id; ?>" type="hidden" />
        <input name="ip" value="<?php echo getClientIP(); ?>" type="hidden" />
        <div id="error_pro" style="color:red;"></div>
		<div class="form-group">
          <label for="exampleInputEmail1">Heading</label>
          <input type="text" name="property_heading" class="form-control" id="property_heading" placeholder="Heading" value="<?php echo $show['property_heading'] ;?>" required/>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Ical Link</label>
          <input type="text" name="ical_link" class="form-control" id="ical_link" placeholder="Ical Link" value="<?php echo $show['link'] ;?>" required/>
        </div>
       
        <p class="text-center">
          <button type="submit" name="update_property_ical_submit" id="update_property_ical_submit" class="btn btn-success btn-outline-rounded green"> Update <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
        </form>
<?php
}
}
?>
</section>
</div>
</div>
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