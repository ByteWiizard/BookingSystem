<?php include_once('session_destroy.php'); ?>
<?php
	include("include/db.php");
	$ical_links = $pre_fix."ical_links";
	$ical_events = $pre_fix."ical_events";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="framework/js/ajax.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>
<link href="framework/css/import.css" rel="stylesheet">
<link href="framework/css/timepicki.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet">
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<script src="framework/js/ajax.js"></script>

<script>
function check()
{
var retVal= confirm(" Do you want to delete? ");
if(retVal==true)
{
	return true ;
}
else
{
	return false ;
}
}

</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">

  <?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<div class="wrapper">
<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
$admin_id = $_SESSION['admin_id'];
 $fetch111 = mysqli_query($conn,"SELECT * FROM ".$ical_links." WHERE admin_id='".$admin_id."'");
  $num111 = mysqli_num_rows($fetch111);
 ?>
<script>
$(document).ready(function(){
	var num_pro = <?php echo @$num111 ?>;
    $('#add_ical').click(function(){
		if(num_pro == 13)
        {
		 alert("Please contact to your service provider for adding a new property ical link.");
		 return false;
		}
    });
})
</script>
  <div class="content-wrapper">
    <section class="content-header">
    
      <h1> Add or Update <small>Add or Update your property Ical links easily</small> </h1>
      <hr>
      
      <div class="add">
      <h4>Add a new property Ical link from here  </h4>
      
      <a href="add_ical.php" class="btn btn-success btn-outline-rounded green" id="add_ical">Add Property Ical</a>
    
      </div>
 <?php
 $fetch11 = mysqli_query($conn,"SELECT * FROM ".$ical_links." WHERE admin_id='".$admin_id."' ORDER BY property_id ASC ");
	   @$num11 = mysqli_num_rows($fetch11);
	   if($num11>0)
	   {
 ?>
  
    <h3 class="head text-center">Added Property Ical Links</h3>
        <div class="ta_pad">
        <table class="responsive-table">
    
    <thead>
      <tr>
        <th scope="col"> S.No </th>
        <th scope="col">Property ID</th>
        <th scope="col">Property heading</th>
        <th scope="col">Property Ical link</th>
        <th scope="col">Added Date</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    
    <tbody>
   
    <?php
		   $i=1;
		while($show11 = mysqli_fetch_assoc($fetch11))
		  {
		  	$id =$show11['i_id'];
			$property_id = $show11['property_id'];
			$admin_id = $show11['admin_id'];
			$property_heading=$show11['property_heading'];
			$property_ical_link=$show11['link'];
			$added_date=$show11['add_date'];	  
	?>
      <tr>
      	<td><?php echo $i ?></td>
        <td data-title="Property id"><?php echo @$property_id; ?> </td>
        <td data-title="Property heading"><?php echo @$property_heading; ?> </td>
        <td data-title="Ical link"><?php echo @$property_ical_link; ?> </td>
        <td data-title="Added date" ><?php echo @$added_date; ?></td>
   <form method="post" action="edit_ical.php">
        <td data-title="Edit" ><input type="hidden" name="edit_ical" value="<?php echo @$id; ?>"><button type="submit" name="edit_pro_button"><i class="fa fa-pencil"></i></button></td>
        </form>
         <form action="property_ical_links.php" method="post">
        <td data-title="Delete" ><input type="hidden" name="delete_ical" value="<?php echo @$id; ?>"><button type="submit" name="delete_pro_button" onClick="return check()"><i class="fa fa-trash"></i></button></td>
         </form>
          </tr>
          <?php
		  $i++;
             }
          ?>
         
    	</tbody>
	 </table>
     </div>
     <?php
	   }
	   ?>
     </section>
	 </div>
     <script>
  $(document).ready(function(e) {

	$( "#pro_new_rate_sdate" ).datepicker();
	$( "#pro_new_rate_edate" ).datepicker();
	$( ".form-control" ).datepicker( "option", "dateFormat", 'mm-dd-yy' );
 })
</script>
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script> 
<script src="framework/js/dropdown.js"></script> 
<script src="framework/js/select.js"></script> 
<script src="framework/js/timepicki.js"></script>
<!--<script src="framework/js/checkbox.js"></script>-->
<script >
        $(function () {
            $('#datetimepicker8, #datetimepicker9').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });
        });
    </script> 


<script type="text/javascript"> 
	$('#timepicker').timepicki(); 
	$('#timepicker1').timepicki(); 
	$('#timepicker3').timepicki(); 
	$('#timepicker4').timepicki(); 
</script>
<script>
			(function() {
				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
					new SelectFx(el);
				} );
			})();
			
        </script> 

</div>
</html>
<?php
if(isset($_POST['delete_pro_button']))
{
	$delete_id = $_POST['delete_ical'];
	
	$delete = mysqli_query($conn, "DELETE FROM ".$ical_links." WHERE i_id=$delete_id");
	if($delete)
		{
			mysqli_query($conn, "DELETE FROM ".$ical_events." WHERE event_pid=$delete_id AND admin_id=$admin_id AND event_type='ical'");
			echo "<script>alert('Deleted Successfully.');</script>";
			define("ICS_URL1", 'http://'.$_SERVER['SERVER_NAME'].'/');
					$url = SITE_URL ? SITE_URL : ICS_URL1 ;
					define("ICS_URL", $url);
					
					//---------------------------------------------------------------------
					$site = $_SERVER['SERVER_NAME'];
					
						$pro_id=$delete_id;
						
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
								
			
			?>
			<script>
			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
            </script>
            <?php
		}
}
?>
