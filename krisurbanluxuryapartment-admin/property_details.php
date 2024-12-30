<?php include_once('session_destroy.php') ;?>
<?php 
error_reporting(0);
  include_once('include/db.php'); 
?>
<?php include_once('include/functions.php');?>
<?php 
  $property_details = $pre_fix."property_details"; 
  $property_default_rates = $pre_fix."property_default_rates";
  $property_new_rates = $pre_fix."property_new_rates";
  $property_back_details = $pre_fix."property_back_details";
  $files = $pre_fix."files";
?>
<?php
if(isset($_POST['rate_insert_submit'])){
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $pro_id = test_input($_POST['property_id']);
  $pro_new_rate_desc=test_input($_POST['pro_new_rate_desc']);
  $pro_new_rate_sdate=test_input($_POST['pro_new_rate_sdate']);
  $pro_new_rate_edate=test_input($_POST['pro_new_rate_edate']);
  $pro_new_rate_weekend_night=test_input($_POST['pro_new_rate_weekend_nt']);
  $pro_new_rate_week_night=test_input($_POST['pro_new_rate_week_nt']);
  $pro_new_rate_weekly_night=test_input($_POST['pro_new_rate_weekly_nt']);
  $pro_new_rate_monthly=test_input($_POST['pro_new_rate_monthly']);
  $pro_new_rate_event = test_input($_POST['pro_new_rate_event']);
  $pro_new_rate_min_stay=test_input($_POST['pro_new_rate_min_stay']);
  $basedonguest = test_input($_POST['basedonguest']);
  $guestpernoght = test_input($_POST['guestpernoght']);
  $ip = getClientIP();
  $insert1 = mysqli_query($conn,"SELECT * FROM ".$property_new_rates." WHERE admin_id=$admin_id");
  $insert1 = mysqli_query($conn,"INSERT into ".$property_new_rates."(property_id,admin_id,pro_new_rate_desc,pro_new_rate_sdate,pro_new_rate_edate,pro_new_rate_weekend_nt,pro_new_rate_week_nt,pro_new_rate_weekly_nt,pro_new_rate_monthly,pro_new_rate_event,pro_new_rate_min_stay,basedonguest,guestpernoght,pro_new_insert_date,pro_new_ip) VALUES('".$pro_id."','".$admin_id."','".$pro_new_rate_desc."','".$pro_new_rate_sdate."','".$pro_new_rate_edate."','".$pro_new_rate_weekend_night."','".$pro_new_rate_week_night."','".$pro_new_rate_weekly_night."','".$pro_new_rate_monthly."','".$pro_new_rate_event."','".$pro_new_rate_min_stay."','".$basedonguest."','".$guestpernoght."',now(),'".$ip."')");
    if($insert1)
    {
      echo "<script>alert('Inserted Successfully.');</script>";
      ?>
      <script>
      window.location = 'property_details.php?data=profile';
    </script>
    <?php
    }
  
}
?>
<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="framework/js/ajax.js"></script>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>
<link href="framework/css/import.css" rel="stylesheet">
<link href="framework/css/timepicki.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="framework/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet">
<link href="framework/css/animation.css" rel="stylesheet">
<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>
<script type="text/javascript" src="js/extrajs.js"></script>

<!--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries-->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
  #mapCanvas {
    width: 700px;
    height: 300px;
    float: left;
  }
  #infoPanel{
    float: left;
    margin-left: 10px;
  }
  #infoPanel div{
    margin-bottom: 5px;
  }

.reorder_link {
    color: #3675B4;
    border: solid 2px #3675B4;
    border-radius: 3px;
    text-transform: uppercase;
    background: #fff;
    font-size: 18px;
    padding: 10px 20px;
    margin: 15px 15px 15px 0px;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.35s;
    -moz-transition: all 0.35s;
    -webkit-transition: all 0.35s;
    -o-transition: all 0.35s;
    white-space: nowrap;
}
.reorder_link:hover {
    color: #fff;
    border: solid 2px #3675B4;
    background: #3675B4;
    box-shadow: none;
}
#reorder-helper{margin: 18px 10px;padding: 10px;}
.light_box {
    background: #efefef;
    padding: 20px;
    margin: 10px 0;
    text-align: center;
    font-size: 1.2em;
}
.gallery{ width:100%; float:left; margin-top:100px;}
.gallery ul{ margin:0; padding:0; list-style-type:none;}
.gallery ul li{ padding:7px; border:2px solid #ccc; float:left; margin:10px 7px; background:none; width:28%; height:auto;}
.gallery img{ width:250px;}

/* NOTICE */
.notice, .notice a{ color: #fff !important; }
.notice { z-index: 8888; }
.notice a { font-weight: bold; }
.notice_error { background: #E46360; }
.notice_success { background: #657E3F; }
  </style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
<!-- Add Dropzone -->
<link rel="stylesheet" type="text/css" href="framework/css/dropzone.css" />
<script type="text/javascript" src="framework/js/dropzone.js"></script>
<script>
function gallery()
{
	alert('Gallery is refreshed now.');
}
$(document).ready(function(){
    var a = '<?php echo $_GET["data"]; ?>';
    var b  = $(".a").attr('id');
    //alert(b);
    if(a!=''){
      
      $('#'+a).removeClass( "fade" );
      $('#home').removeClass( "active" );
      $('#'+b).removeClass( "active" );
      $('#'+a).addClass( "active" );
      $('#'+a+'li').addClass( "active" );
      $("#"+a).show();
    }
  });


</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>

$(document).ready(function(){
    $('.reorder_link').on('click',function(){
        $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
        $('.reorder_link').html('save reordering');
        $('.reorder_link').attr("id","save_reorder");
        $('#reorder-helper').slideDown('slow');
        $('.image_link').attr("href","javascript:void(0);");
        $('.image_link').css("cursor","move");
        $("#save_reorder").click(function( e ){
            if( !$("#save_reorder i").length ){
                $(this).html('').prepend('<img src="https://loading.io/spinners/gears/lg.dual-gear-loading-icon.gif" style="width:25px;"/>');
                $("ul.reorder-photos-list").sortable('destroy');
                $("#reorder-helper").html( "Reordering Photos - This could take a moment. Please don't navigate away from this page." ).removeClass('light_box').addClass('notice notice_error');
    
                var h = [];
                $("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });                
                $.ajax({
                    type: "POST",
                    url: "ajax/orderUpdate.php",
                    data: {ids: " " + h + ""},
                    success: function(response){
                      window.location.reload();
                    }
                }); 
                return false;
            }   
            e.preventDefault();     
        });
    });
});
</script>

<script type="text/javascript">
  $(document).ready(function(e) {
    $('.del').click(function(){
    var del = $(this).val();
    var img_id = del.split(",");
var ret= confirm(" Do you want to delete? ");
if(ret==true)
{
    $.ajax({
        url: "delete_gallery.php",
        type: "POST",
        cache: false,
        data: { 'dele': del}
        })
    .done(function(msg){
      $('#menu-order-'+img_id[0]+'').fadeOut( "slow", function() {
        alert(msg);
        });
    });
    return false;
}
else
{
  return false ;
}
  });
});

function check(){
  var retVal= confirm(" Do you want to delete? ");
  if(retVal==true){
   return true ;
  }else{
   return false ;
  }
}
$(document).ready(function() {
    $('#del_mul_img').click(function(){
    if(confirm("Are you sure you want to delete this?"))
    {
      var id = [];
      $(':checkbox:checked').each(function(i){
        id[i] = $(this).val();
      });
      if(id.length===0)
      {
        alert('Please select atleast one checkbox');
      }else{
        $.ajax({
        url: "delete_gallery.php",
        type: "POST",
        cache: false,
        data: { 'dele_id': id},
        success: function(mes)
        {
          for(var i=0; i<id.length; i++)
          {
          $('#menu-order-'+id[i]+'').fadeOut("slow");
          }
          alert(mes);
        }
        });
        return false;
      }
    }
    else
    {
      return false;
    }
  });
});
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php include_once('include/topbar.php'); ?>
<div class="wrapper">

<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
if(isset($_POST['property_details_submit'])){

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $pro_id = test_input($_POST['property_id']);
  $loc_id = $_POST['location'];
  $admin_id=test_input($_SESSION['admin_id']);
  $pro_heading=mysqli_real_escape_string($conn, test_input($_POST['property_heading']));
  $pro_head_title=mysqli_real_escape_string($conn,test_input($_POST['property_head_title']));
  $pro_content=$_POST['property_content'];
  $other_content1 = $_POST['other_content1'];
  $other_content2 = $_POST['other_content2'];
  $masterbedroom = $_POST['masterbedroom'];
  $bedrooms2 = $_POST['bedrooms2'];
  $bedrooms3 = $_POST['bedrooms3'];
  $pro_acc_type=test_input($_POST['acc_type']);
  $pro_addr=mysqli_real_escape_string($conn,test_input($_POST['pro_addr']));
  $pro_latt=$_POST['map_latitude'];
  $pro_long=$_POST['map_longitude'];
  $pro_status =$_POST['property_status'];
  $pro_address =$_POST['paddress'];
  $pro_type=$_POST['property_type'];
  $pro_no_of_bedrooms=$_POST['property_no_of_bedrooms'];
  $pro_no_of_sleeps=$_POST['property_no_of_sleeps'];
  $pro_no_of_baths=$_POST['property_no_of_baths'];
  $pro_on_floor=$_POST['property_floor'];
  $pro_feet=$_POST['property_feet'];
  $pro_garage=$_POST['property_garage'];
  $pro_elev=$_POST['property_elevator'];
  /*$pro_city=test_input($_POST['property_city']);*/
  $ip = getClientIP();
  
  $insert = mysqli_query($conn,"SELECT * FROM ".$property_details." WHERE property_id='$pro_id' AND admin_id='$admin_id'");
  $row = mysqli_num_rows($insert);
  
  if($row==0){
    $insert = mysqli_query($conn,"INSERT into ".$property_details."(property_id,loc_id,admin_id,property_heading,property_head_title,property_content,other_content1,masterbedroom,bedrooms2,bedrooms3,other_content2,property_acc_type,property_latt,property_long,property_type,property_no_of_bedrooms,property_no_of_sleeps,property_no_of_baths,property_floor,property_feet,property_garage,property_elevator,property_address,pro_det_insert_date,pro_det_ip) VALUES('".$pro_id."','".$loc_id."','".$admin_id."','".$pro_heading."','".$pro_head_title."','".$pro_content."','".$other_content1."','".$other_content2."','".$masterbedroom."','".$bedrooms2."','".$bedrooms3."','".$pro_acc_type."','".$pro_addr."','".$pro_latt."','".$pro_long."','".$pro_type."','".$pro_no_of_bedrooms."','".$pro_no_of_sleeps."','".$pro_no_of_baths."','".$pro_on_floor."','".$pro_feet."','".$pro_garage."','".$pro_elev."','".$pro_address."', now() ,'".$ip."')") or die(mysqli_error($conn));    
    if($insert){
           echo "<script>alert('Inserted Successfully.');</script>";
      ?>
      <script>window.location = 'property_details.php';</script>
<?php
    }
  }
  if($row>0)
  {
    while($loop = mysqli_fetch_assoc($insert))
    {


      $update = mysqli_query($conn,"UPDATE ".$property_details." SET loc_id='".$loc_id."',property_heading='".$pro_heading."', property_head_title='".$pro_head_title."', property_content='".$pro_content."', other_content1='".$other_content1."', other_content2='".$other_content2."', masterbedroom='".$masterbedroom."', bedrooms2='".$bedrooms2."', bedrooms3='".$bedrooms3."', property_acc_type='".$pro_acc_type."', property_latt='".$pro_latt."',property_long='".$pro_long."', property_type='".$pro_type."', property_no_of_bedrooms='".$pro_no_of_bedrooms."', property_no_of_sleeps='".$pro_no_of_sleeps."', property_no_of_baths='".$pro_no_of_baths."', property_floor='".$pro_on_floor."',property_feet='".$pro_feet."',property_garage='".$pro_garage."', property_elevator='".$pro_elev."',property_address='".$pro_address."', pro_det_update_date=now() , pro_det_ip='".$ip."' WHERE property_id='".$loop['property_id']."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
    }
    if($update){
      echo "<script>alert('Updated Successfully.');</script>";
      ?>
      <script>
      window.location = 'property_details.php';
            </script>
            <?php
    }else{
      echo "<script>alert('Updatation Failed.');</script>";
    }
    
  }
}
?>
<?php
/*$pro_fetch = mysqli_query($conn, "SELECT * FROM property_details");
$pro_row = mysqli_fetch_assoc($pro_fetch);
$property_id = $pro_row['property_id'];*/
if($_POST['edit_property']){
  $_SESSION['property_id'] = $_POST['edit_property'];
}
$property_id = $_SESSION['property_id'];
?>
<?php
$property_id = $property_id;
$admin_id = $_SESSION['admin_id'];
  $fetch = mysqli_query($conn,"SELECT * FROM ".$property_details." WHERE property_id='".$property_id."' AND admin_id='".$admin_id."'");
	$num = mysqli_num_rows($fetch);
  while($show = mysqli_fetch_assoc($fetch)){
  $loc_id = $show['loc_id'];
	$pro_heading=$show['property_heading'];
	$pro_head_title=$show['property_head_title'];
	$pro_content=$show['property_content'];
        $other_content1 = $show['other_content1'];
        $other_content2 = $show['other_content2'];
        $masterbedroom = $show['masterbedroom'];
        $bedrooms2 = $show['bedrooms2'];
        $bedrooms3 = $show['bedrooms3'];
	$pro_acc_type=$show['property_acc_type'];
	$pro_addr=$show['property_address'];
	$map_latitude=$show['property_latt'];
	$map_longitude=$show['property_long'];
	$pro_status=$show['property_status'];
	$pro_type=$show['property_type'];
	$pro_no_of_bedrooms=$show['property_no_of_bedrooms'];
	$pro_no_of_sleeps=$show['property_no_of_sleeps'];
	$pro_no_of_baths=$show['property_no_of_baths'];
	$pro_on_floor=$show['property_floor'];
	$property_feet=$show['property_feet'];
	$pro_garage=$show['property_garage'];
	$paddress=$show['property_address'];
	$pro_elev=$show['property_elevator'];
	/*$pro_city=$show['property_city'];*/
  }
?>
<?php
$property_id = @$property_id;
  $fetch1 = mysqli_query($conn,"SELECT * FROM ".$property_default_rates." WHERE property_id='".$property_id."' AND admin_id='".$admin_id."'");
	$num1 = mysqli_num_rows($fetch1);
  while($show1 = mysqli_fetch_assoc($fetch1)){
	$pro_cur_rate=$show1['pro_def_rate_rates'];
	$pro_cur_rate_check_in=$show1['pro_def_rate_check_in'];
	$pro_cur_rate_check_out=$show1['pro_def_rate_check_out'];
	$pro_cur_rate_min_stay=$show1['pro_cleaning_fee'];
	$pro_cur_rate_currency=$show1['pro_def_rate_currency'];
	$pro_cur_rate_add_fees=$show1['add_fees'];
  $pro_refundable_amt = $show1['pro_refundable_amt'];
	$pro_cur_rate_can_policy=$show1['can_policy'];
	$pro_cur_rate_notes=$show1['notes'];
  $extra_notes = $show1['extra_notes'];
  }
  
        $fetch12 = mysqli_query($conn,"SELECT * FROM ".$property_back_details." WHERE property_id='".$property_id."' AND admin_id='".$admin_id."'");
	$row12 = mysqli_num_rows($fetch12);
	 while($show12 = mysqli_fetch_assoc($fetch12)){
		$pro_king_bed = $show12['pro_king_bed'];
		$pro_queen_bed = $show12['pro_queen_bed'];
		$pro_single_bed = $show12['pro_single_bed'];
		$pro_double_bed = $show12['pro_double_bed'];
		$pro_twin_bed = $show12['pro_twin_bed'];
		$pro_sofa_bed = $show12['pro_sofa_bed'];
		$pro_bunk_bed = $show12['pro_bunk_bed'];
		$pro_cribs = $show12['pro_cribs'];
		$pro_cot = $show12['pro_cot'];
	 }
?>
<!--<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyBwWYvWkM5w32RaTsrXmjvxenjpQeUFZXQ&callback=initialize"></script>-->
<!--        <script type="text/javascript">-->
<!--        var geocoder = new google.maps.Geocoder();-->

<!--        function geocodePosition(pos) {-->
<!--          geocoder.geocode({-->
<!--            latLng: pos-->
<!--          }, function(responses) {-->
<!--            if (responses && responses.length > 0) {-->
<!--              updateMarkerAddress(responses[0].formatted_address);-->
<!--            } else {-->
<!--              updateMarkerAddress('Cannot determine address at this location.');-->
<!--            }-->
<!--          });-->
<!--        }-->

<!--        function updateMarkerStatus(str) {-->
<!--          document.getElementById('markerStatus').innerHTML = str;-->
<!--        }-->

<!--        function updateMarkerPosition(latLng) {-->
<!--          document.getElementById('info').innerHTML = [-->
<!--            latLng.lat(),-->
<!--            latLng.lng()-->
<!--          ].join(', ');-->
<!--          document.getElementById('map_longitude').value=latLng.lat() ; -->
<!--           document.getElementById('map_latitude').value=latLng.lng() ;-->
<!--        }-->

<!--        function updateMarkerAddress(str) {-->
<!--          document.getElementById('address').innerHTML = str;-->
<!--          document.getElementById('property_address').value = str;-->
<!--        }-->

<!--        function initialize() {-->
<!--          var Long = <?php echo html_entity_decode(@$map_longitude) ?>;-->
<!--          var Latt = <?php echo html_entity_decode(@$map_latitude) ?>;-->
<!--          var latLng = new google.maps.LatLng(Long,Latt);-->
<!--          var map = new google.maps.Map(document.getElementById('mapCanvas'), {-->
<!--            zoom: 8,-->
<!--            center: latLng,-->
<!--            mapTypeId: google.maps.MapTypeId.ROADMAP-->
<!--          });-->
<!--          var marker = new google.maps.Marker({-->
<!--            position: latLng,-->
<!--            title: 'Point A',-->
<!--            map: map,-->
<!--            draggable: true-->
<!--          });-->
          
          
<!--          updateMarkerPosition(latLng);-->
<!--          geocodePosition(latLng);-->
          
          
<!--          google.maps.event.addListener(marker, 'dragstart', function() {-->
<!--            updateMarkerAddress('Dragging...');-->
<!--          });-->
          
<!--          google.maps.event.addListener(marker, 'drag', function() {-->
<!--            updateMarkerStatus('Dragging...');-->
<!--            updateMarkerPosition(marker.getPosition());-->
<!--          });-->
          
<!--          google.maps.event.addListener(marker, 'dragend', function() {-->
<!--            updateMarkerStatus('Drag ended');-->
<!--            geocodePosition(marker.getPosition());-->
<!--          });-->
<!--        }-->

        
<!--        google.maps.event.addDomListener(window, 'load', initialize);-->
<!--        </script>-->
<div class="content-wrapper">
<section class="content-header">
<h1> Property Details <small>Update your Property Easily</small> </h1>
<hr>
<section  class="section how-it-works" id="how-it-works">
<div class="row">
  <div class="col-md-12 board">
    <div class="board-inner">
      <ul class="nav nav-tabs" id="myTab">
        <div class="liner"></div>
        <li class="active a" id="homeli"> <a href="#home" aria-controls="home" role="tab" data-toggle="tab" title="About Property"> <span class="round-tabs one"><i class="fa fa-home" aria-hidden="true"></i> <span class="pun"> About Property</span> </span> </a></li>
        <li class="a" id='prototypingli'><a href="#prototyping" class="nav-tabs" id="protaty" aria-controls="prototyping" role="tab" data-toggle="tab" title="Amenities"> <span class="round-tabs three"> <i class="fa fa-clipboard" aria-hidden="true"></i><span class="pun"> Amenities </span></span> </a> </li>
        <li class="a" id="profileli"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" title="Rates"> <span class="round-tabs two"><i class="fa fa-usd" aria-hidden="true"></i><span class="pun"> Rates </span></span> </a> </li>
        
        <li class="a" id="uidesignli"><a href="#uidesign" aria-controls="uidesign" role="tab" data-toggle="tab" title="Gallery"> <span class="round-tabs four"> <i class="fa fa-picture-o" aria-hidden="true"></i> <span class="pun"> Gallery </span></span> </a></li>
        <!-- HIGHLIGHTS -->
        <!--<li class="a" id="highlightsli"><a href="#highlights" aria-controls="highlights" role="tab" data-toggle="tab" title="Highlights"> <span class="round-tabs four"> <i class="fa fa-star" aria-hidden="true"></i> <span class="pun"> Highlights </span></span> </a></li>-->
        <!-- END HIGHLIGHTS -->
        <li class="a" id="donerli"><a href="#doner" aria-controls="doner" role="tab" id="donerd" data-toggle="tab" title="calendar"> <span class="round-tabs five"> <i class="fa fa-calendar" aria-hidden="true"></i><span class="pun"> Calendar </span></span> </a> </li>
      </ul>
    </div>
    <div class="tab-content">
      <div class="tab-pane fade in active" id="home">
      <form class="ac-custom ac-checkbox ac-boxfill" method="post" action="" enctype="multipart/form-data">
        <h3 class="head text-center">About Property</h3>
        <div class="form-group">
          <label for="exampleInputEmail1">Heading</label>
          <input type="text" name="property_heading" class="form-control" id="property_heading" placeholder="Heading" value="<?php echo @$pro_heading ;?>" />
        </div>
         <div class="form-group">
          <label for="exampleInputEmail1">Owner Name</label>
          <input type="text" name="property_head_title" class="form-control" id="property_head_title" placeholder="Owner Name" value="<?php echo @$pro_head_title;?>" />
        </div> 

        <div class="editor">
          <label for="exampleInputEmail1">Short Description</label>
          <textarea class="ckeditor" name="property_content" placeholder="Short Description" id="property_content"><?php echo htmlspecialchars(@$pro_content) ;?>
          </textarea>
        </div>
        
         <div class="editor">
         <label for="exampleInputEmail1">Owner's Behaviour</label>
        <textarea class="ckeditor" name="other_content1" placeholder="Long Description" id="other_content1"><?php echo htmlspecialchars(@$other_content1) ;?>
              </textarea>
        </div>
       
        <!-- map here -->
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><i class="fa fa-map-marker" aria-hidden="true"></i> Latitude</label>
                    <input type="text" name="map_latitude" class="form-control" id="map_latitude" placeholder="Latitude" value="<?php echo @$map_latitude ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><i class="fa fa-map-marker" aria-hidden="true"></i> Longitude</label>
                    <input type="text" name="map_longitude" class="form-control" id="map_longitude" placeholder="Longitude" value="<?php echo @$map_longitude ?>">
                  </div>
                </div> -->
                

                <!--<div class="map">-->
                <!--  <div id="mapCanvas"></div>-->
                <!--  <div id="infoPanel">-->
                <!--    <b>Marker status:</b>-->
                <!--    <div id="markerStatus"><i>Click and drag the marker.</i></div>-->
                <!--    <b>Current position:</b>-->
                <!--    <div id="info"></div>-->
                <!--    <b>Closest matching address:</b>-->
                <!--    <input type="hidden" name="pro_addr" id="property_address" value="<?php echo $pro_addr; ?>">-->
                <!--    <div id="address"></div>-->
                <!--  </div>-->
                <!--</div>-->
              
              </div>
            </div>
          </div>
        <!-- end map here -->
        <div class="row">


            <div class="col-md-12">
              <div class="heading">
                <h3><i class="fa fa-home" aria-hidden="true"></i> Enter Your Property Features</h3>
              </div>
              <div class="col-md-4">
                <label for="exampleInputEmail1">Property Type</label>
                <input type="text" name="property_type" class="form-control" id="property_type" placeholder="Property Type" value="<?php echo @$pro_type; ?>" />
              </div>
              <div class="col-md-4">
              <label for="exampleInputEmail1">Bedrooms</label>
              <input type="number" name="property_no_of_bedrooms" class="form-control" id="property_no_of_bedrooms" placeholder="Bedrooms " value="<?php echo @$pro_no_of_bedrooms ;?>" />
            </div>
            <div class="col-md-4">
              <label for="exampleInputEmail1">Sleeps</label>
              <input type="number" name="property_no_of_sleeps" class="form-control" id="property_no_of_sleeps" placeholder="Sleeps" value="<?php echo @$pro_no_of_sleeps ;?>" />
            </div>
            <div class="col-md-4">
              <label for="exampleInputEmail1">Bathroom</label>
              <input type="text" name="property_no_of_baths" class="form-control" id="property_no_of_baths" placeholder="Bathroom" value="<?php echo @$pro_no_of_baths ;?>" />
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Min Night Stay</label>
                <input type="text" name="property_elevator" class="form-control" id="property_elevator" placeholder="Min Night Stay" value="<?php echo @$pro_elev; ?>"/>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Area (sq.ft)</label>
                <input type="text" name="property_feet" class="form-control" id="property_feet" placeholder="Parking space" value="<?php echo @$property_feet; ?>"/>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Prop Address</label>
                <input type="text" name="paddress" class="form-control" id="masterbedroom" placeholder="Address" value="<?php echo @$paddress ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Internet</label>
                <input type="text" name="masterbedroom" class="form-control" id="masterbedroom" placeholder="Internet" value="<?php echo @$masterbedroom ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Pets</label>
                <input type="text" name="bedrooms2" class="form-control" id="bedrooms2" placeholder="Pets" value="<?php echo @$bedrooms2 ?>">
              </div>
            </div>

          </div>
         
        </div>
        
      
        
        <input type="hidden" name="property_id" value="<?php echo @$property_id ?>" />
         
        <p class="text-center">
          <button type="submit" name="property_details_submit" class="btn btn-success btn-outline-rounded green"> Submit <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
        </form>
      </div>
      <div class="tab-pane fade" id="profile">
        <h3 class="head text-center">Rates</h3>
        <div class="row">
          <div class="heading">
            <h3><i class="fa fa-home" aria-hidden="true"></i> Current Property Details</h3>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
          <div class="col-md-12">
          <div class="col-md-4">
            <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Average Night</label>
                <input type="number" class="form-control" name="pro_def_rate_rates" id="pro_def_rate_rates" placeholder="Average Night" value="<?php echo @$pro_cur_rate; ?>">
              </div>
            </div>
          </div>
         
          <div class="col-md-4">
            <div class="editor">
              <label for="exampleInputEmail1">Refundable Damage Deposit</label>
              <input class="form-control" name="pro_refundable_amt" placeholder="Refundable Damage Deposit" type='number' value="<?php echo @$pro_refundable_amt; ?>"/>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="check_out">
              <div class="form-group">
                <label for="exampleInputEmail1">Tax(%)</label>
                <input type="text" class="form-control" name="add_fees" id="property_content" placeholder="Tax" value="<?php echo @$pro_cur_rate_add_fees ;?>">
              </div>
            </div>
          </div>
          </div>
		  
		  <div class="col-md-12">
          <div class="col-md-4">
            <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Cleaning Fee </label>
                <input type="number" class="form-control" name="pro_def_rate_min_stay" id="pro_def_rate_min_stay" placeholder="Cleaning Fee" value="<?php echo @$pro_cur_rate_min_stay; ?>">
              </div>
            </div>
          </div>         
          
          </div>
		  
          <div class="col-md-12">
            <div class="form-group">
            <label for="exampleInputEmail1">Owner's Policy:</label>
            <textarea name="can_policy" class="form-control ckeditor"><?php echo @$pro_cur_rate_can_policy ;?></textarea>
            
            </div>
          </div>
<div class="col-md-12">
            <div class="form-group">
            <label for="exampleInputEmail1">Notes:</label>
            <textarea name="notes" class="form-control ckeditor"><?php echo @$pro_cur_rate_notes ;?></textarea>
            
            </div>
          </div>
      		
            <input type="hidden" name="property_id" value="<?php echo @$property_id ?>" />
         <p class="text-center">
          <button type="submit" name="rate_update_submit" class="btn btn-success btn-outline-rounded green"> Update <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
        </form>
        </div>
         <h3 class="head text-center">Add New Rates</h3>
        <div class="row">
          <div class="heading">
            <h3><i class="fa fa-home" aria-hidden="true"></i> Enter Property Rates</h3>
          </div>
          <p><strong>Note*</strong> Please don't insert currency symbol and commas while filling the price.</p>
		    <form method="post" action="" enctype="multipart/form-data">
          <div class="col-md-4">
            <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Season</label>
                <input type="text" name="pro_new_rate_desc" class="form-control" id="pro_new_rate_desc" placeholder="Season" />
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="exampleInputEmail1">Start Date</label>
              <div class='input-group date' id='datetimepicker8'>
                <input type='text' class="form-control" name="pro_new_rate_sdate" id="pro_new_rate_sdate"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="exampleInputEmail1">End Date</label>
              <div class='input-group date' id='datetimepicker9'>
                <input type='text' class="form-control" name="pro_new_rate_edate" id="pro_new_rate_edate" />
              </div>
            </div>
          </div>
          <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Nightly</label>
                <input type="text" name="pro_new_rate_week_nt" class="form-control" id="pro_new_rate_week_nt" placeholder="Nightly" />
              </div>
            </div>
          
          </div>
          
          <div class="col-md-4">
            <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Weekend Night</label>
                <input type="number" name="pro_new_rate_weekend_nt" class="form-control" id="pro_new_rate_weekend_nt" placeholder="Weekend Night" />
              </div>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Weekly</label>
                <input type="text" name="pro_new_rate_weekly_nt" class="form-control" id="pro_new_rate_weekly_nt" placeholder="Weekly" />
              </div>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Monthly</label>
                <input type="number" name="pro_new_rate_monthly" class="form-control" id="pro_new_rate_monthly" placeholder="Monthly" />
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Event</label>
                <input type="number" name="pro_new_rate_event" class="form-control" id="pro_new_rate_event" placeholder="Event" />
              </div>
            </div>
          </div>
 
          <div class="col-md-4">
           <div class="input_rates">
              <div class="form-group">
                <label for="exampleInputEmail1">Min Stay</label>
                <input type="text" name="pro_new_rate_min_stay" class="form-control" id="pro_new_rate_min_stay" placeholder="Min Stay" />
              </div>
            </div>
          
          </div>
          <!--<div class="col-md-4">
            <div class="prop_type">
              <section>
                <select name="pro_new_rate_min_stay" class="cs-select cs-skin-underline">
                  <?php
				$options  = array('Per Night', 'Per Week', 'Per Month');
				if($selected==""){
              	echo "<option value='' disabled selected>Minimum Stay</option>";
				}
					echo "<option value=''>Minimum Stay</option>";
					foreach($options as $option){
						if($selected == $option){
							echo "<option selected='selected' value='$option'>$option</option>" ;
						}else{
							echo "<option value='$option'>$option</option>" ;
						}
					}
				?>
                </select>
              </section>
            </div>
          </div>
        </div> -->
    	<input type="hidden" name="property_id" value="<?php echo @$property_id ?>" />
         <p class="text-center">
          <button type="submit" name="rate_insert_submit" class="btn btn-success btn-outline-rounded green"> Insert <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
        </form>
    <?php
	  $fetch11 = mysqli_query($conn,"SELECT * FROM ".$property_new_rates." WHERE property_id='".$property_id."'");
	   $num11 = mysqli_num_rows($fetch11);
	   if($num11>0)
	   {
	?>     
        <h3 class="head text-center">Current Rate List</h3>
 
        <table class="responsive-table">
    
    <thead>
      <tr>
        <th scope="col">Season </th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Night</th>
        <th scope="col">Weekend Night</th>
        <th scope="col">Weekly</th>
        <th scope="col">Monthly</th>
        <th scope="col">Events</th>
        <th scope="col">Min Stay</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    
    <tbody>
   
   <?php
		while($show11 = mysqli_fetch_assoc($fetch11))
		  {
			$pro_new_rate_desc=$show11['pro_new_rate_desc'];
			$pro_new_rate_sdate=$show11['pro_new_rate_sdate'];
			$pro_new_rate_edate=$show11['pro_new_rate_edate'];
			$pro_new_rate_week_nt=$show11['pro_new_rate_week_nt'];
			$pro_new_rate_week_night=$show11['pro_new_rate_week_nt'];
			$pro_new_rate_weekly_night=$show11['pro_new_rate_weekly_nt'];
			$pro_new_rate_monthly=$show11['pro_new_rate_monthly'];
      $pro_new_rate_event=$show11['pro_new_rate_event'];
			$pro_new_rate_min_stay=$show11['pro_new_rate_min_stay'];
			
	?>
      <tr>
      
        <th scope="row"><?php echo $show11['pro_new_rate_desc']; ?></th>
        <td data-title="Start Date"><?php echo $pro_new_rate_sdate; ?> </td>
        <td data-title="End Date"><?php echo $pro_new_rate_edate; ?></td>
        <td data-title="Week Night" ><?php echo $pro_new_rate_week_nt?'$'.number_format($pro_new_rate_week_nt,2):'' ;?></td>
        <td data-title="Weekend Night"><?php echo $pro_new_rate_weekend_night?'$'.number_format($pro_new_rate_weekend_night,2).' fri,Sat':'' ;?></td>
        <td data-title="Weekly"><?php echo $pro_new_rate_weekly_night?'$'.number_format($pro_new_rate_weekly_night,2):'' ;?></td>
        <td data-title="Monthly" ><?php echo $pro_new_rate_monthly?'$'.number_format($pro_new_rate_monthly,2):'' ;?></td>
        <td data-title="Monthly" ><?php echo $pro_new_rate_event?'$'.number_format($pro_new_rate_event,2):'' ;?></td>
        <td data-title="Minimum Stay"><?php echo $show11['pro_new_rate_min_stay'].' '.$t; ?></td>
   
        <form action="" method="post">
          <td data-title="Delete" ><input type="hidden" name="delete_rate" value="<?php echo $show11['pro_new_rate_id']; ?>"><button type="submit" name="delete_rate_button" onClick="return check()"><i class="fa fa-trash"></i></button></td>
        </form>
        <form method="post" action="edit_rate.php">
          <td data-title="Edit" >
            <input type="hidden" name="edit_rate_pro_id" value="<?php echo $property_id; ?>">
            <input type="hidden" name="edit_rate" value="<?php echo $show11['pro_new_rate_id']; ?>">
            <button type="submit" name="edit_rate_button"><i class="fa fa-pencil"></i></button>
          </td>
        </form>
          </tr>
          <?php
             }
           }
          ?>
         
    	</tbody>
	 </table>
</div>
      </div>
      <div class="tab-pane fade" id="prototyping">
        <!----------  Amenities  ------------>
        <iframe src="amenities.php" frameborder="0" width="100%" height="2000px" scrolling="auto"></iframe>
      </div>
      
 
    
      <div class="tab-pane fade" id="uidesign">
      <style>
  .dz-max-files-reached {background-color: red};
</style> 
<?php
  $file_query = mysqli_query($conn,"SELECT count(image_id) as c_no,sum(file_size) as file FROM ".$files." WHERE property_id='".$property_id."' AND admin_id='".$admin_id."' ORDER BY menu_order ASC");
  $run = mysqli_fetch_assoc($file_query);
  $file_size = $run['file'];
  $file_count = $run['c_no'];
if($file_count<=100)
{
if($file_size<52428800)//less than 50 MB
{
?>
 <h3 class="head text-center">Property Gallery</h3>
        	
  <div class="heading"><h4 style="color:red;">*Maximum upload size 2mb</h4></div>
  <div class="image_upload_div">
  	<form action="upload.php" method="post" class="dropzone" id="my-awesome-dropzone">
      <input type="hidden" name="property_id" value="<?php echo $property_id ?>" >
      </form>
  </div>
<?php 
}
else
{
	echo "<p class='faa-flash animated rishi'>Your Image Quota for a property is exceeded over 50 Mb.For uploading more images,please delete some images first.</p>";
}
}
else
{
	echo "<p class='faa-flash animated rishi'>Maximum number of images for a property is 40.For uploading more images,please delete some images first.</p>";
}
 ?>
<div class="buttonContainer">
<p>Click to Refresh Gallery Button after uploading images
<a href="property_details.php?data=uidesign" class="btn btn-success btn-outline-rounded green" onClick="return gallery()">Refresh Gallery</a></p>
</div>
<div style="clear:both;"></div>
<?php if($file_count>0){?>
<form name="k" method="post" action="">
<input type="button" name="del_mul_img" id="del_mul_img" class="btn btn-success btn-outline-rounded green" value="Delete Selected Images" />
<input type="hidden" name="property_id" value='<?php echo $property_id ;?>'>
<input type="hidden" name="admin_id" value="<?php echo $admin_id ;?>">
<button type="submit" class="btn btn-success btn-outline-rounded green" id="add_caption" name="image_caption"/>Update Caption</button>
<a href="javascript:void(0);" class="btn outlined mleft_no reorder_link" id="save_reorder">reorder photos</a>
    
<div class="gallery">
<ul class="img_ul reorder_ul reorder-photos-list">
<?php
include_once("include/db.php");
$fetch = mysqli_query($conn,"SELECT * FROM ".$files." WHERE property_id='".$property_id."' AND admin_id='".$admin_id."' ORDER BY menu_order ASC");
@$count = mysqli_num_rows($fetch);
while(@$row = mysqli_fetch_assoc($fetch))
{
	?>
    <li  class="img_li ui-sortable-handle" id="image_li_<?php echo $row['image_id'] ?>"><img src="../uploads/<?php echo $row['property_id'] ?>/<?php echo $row['file_name'] ?>" /><div class="img_dt"><input type="text" name="img_<?php echo $row['image_id'] ?>" placeholder="Write Caption" value="<?php echo @$row['caption'] ;?>" /><div class="deleteCheck_box"><input type="checkbox" name="del_immg[]" class="del_imgg" id="del_imgg" value="<?php echo $row['image_id'].",".$property_id.",".$admin_id ;?>" /></div><button class="del" type="submit" value="<?php echo $row['image_id'] ?>,<?php echo $property_id ?>">Delete</button></div>
    </li>
	<?php
	
}
?>
</ul></div>
 </form>
<?php } ?>
<div class="success-msg"></div>
      </div>

      <!-- highlights -->
      <div class="tab-pane fade" id="highlights">
        <iframe src="highlights.php" frameborder="0" width="100%" height="2000px" scrolling="auto"></iframe>
      </div>
      <!-- end highlights -->
      <div class="tab-pane fade" id="doner">
        <div class="text-center"> <i class="img-intro icon-checkmark-circle"></i> </div>
        <div class="ical">
        	<h3 class="head text-center">Availability Calendar</h3>
          <iframe src="calender/calender.php?id=<?php echo $property_id; ?>"></iframe>
        </div>
        <!--<p class="text-center">
          <button class="btn btn-success btn-outline-rounded green"> Submit <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>-->
      </div>
      <div class="clearfix"></div>
    </div>
    
    <!--<div class="meta">
      <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo"><i class="fa fa-comment"></i> Meta Tags</button>
      <div id="demo" class="collapse">
      <form method="post" action="">
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Keyword</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Description</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Canonical Link</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">H1 Tag</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
        </div>
      </div>
    </div>
    
    <div class="ui_button">
        <button type="button" class="btn btn-default hi-icon hi-icon-images"><i class="fa fa-paper-plane-o"></i> Submit</button>
        </div>
    </form>-->
    </section>
  </div>
</div>
<script>
  $(document).ready(function(e) {
	$( "#pro_new_rate_sdate" ).datepicker();
	$( "#pro_new_rate_edate" ).datepicker();
	$( ".form-control" ).datepicker( "option", "dateFormat", 'yy-mm-dd' );
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
</body>
</html>
<?php
if(isset($_POST['rate_update_submit']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$pro_id = test_input($_POST['property_id']);
	$admin_id=test_input($_SESSION['admin_id']);
	$pro_cur_rate=test_input($_POST['pro_def_rate_rates']);
	$pro_cur_rate_check_in=test_input($_POST['pro_def_rate_check_in']);
	$pro_cur_rate_check_out=test_input($_POST['pro_def_rate_check_out']);
	$pro_cur_rate_min_stay=test_input($_POST['pro_def_rate_min_stay']);
	$pro_cur_rate_currency=test_input($_POST['pro_def_rate_currency']);
  $pro_refundable_amt = test_input($_POST['pro_refundable_amt']);
	$pro_cur_rate_add_fees=test_input($_POST['add_fees']);
	$pro_cur_rate_can_policy=test_input($_POST['can_policy']);
	$pro_cur_rate_notes=test_input($_POST['notes']);
  $extra_notes = $_POST['extra_notes'];
	$ip = getClientIP();
	
	$insert = mysqli_query($conn,"SELECT * FROM ".$property_default_rates." WHERE property_id='".$pro_id."' AND admin_id='".$admin_id."'");
	$row = mysqli_num_rows($insert);
	//echo $row; die;
	if($row==0)
	{
		$insert = mysqli_query($conn,"INSERT into ".$property_default_rates."(property_id,admin_id,pro_def_rate_rates,pro_def_rate_check_in,pro_def_rate_check_out,pro_refundable_amt,pro_cleaning_fee,pro_def_rate_currency,add_fees,notes,extra_notes,can_policy,pro_def_insert_date,pro_def_ip) VALUES('".$pro_id."','".$admin_id."','".$pro_cur_rate."','".$pro_cur_rate_check_in."','".$pro_cur_rate_check_out."','".$pro_refundable_amt."','".$pro_cur_rate_min_stay."','".$pro_cur_rate_currency."', '".$pro_cur_rate_add_fees."', '".$pro_cur_rate_notes."', '".$extra_notes."', '".$pro_cur_rate_can_policy."',now(),'".$ip."')");
		
		if($insert)
		{
			echo "<script>alert('Inserted Successfully.');</script>";
			?>
			<script>
			window.location = 'property_details.php?data=profile';
            </script>
            <?php
		}
	}
	
	if($row>0)
	{
		while($loop = mysqli_fetch_assoc($insert))
		{
			$update = mysqli_query($conn,"UPDATE ".$property_default_rates." SET pro_def_rate_rates='".$pro_cur_rate."', pro_def_rate_check_in='".$pro_cur_rate_check_in."', pro_def_rate_check_out='".$pro_cur_rate_check_out."', pro_refundable_amt='".$pro_refundable_amt."',pro_cleaning_fee='".$pro_cur_rate_min_stay."', pro_def_rate_currency='".$pro_cur_rate_currency."', add_fees='".$pro_cur_rate_add_fees."', notes='".$pro_cur_rate_notes."', extra_notes='".$extra_notes."', can_policy='".$pro_cur_rate_can_policy."', pro_def_update_date=now(), pro_def_ip='".$ip."' WHERE property_id='".$pro_id."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
		}
		
		if($update)
		{
			echo "<script>alert('Updated Successfully.');</script>";
			?>
			<script>
			window.location = 'property_details.php?data=profile';
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

<?php
if(isset($_POST['delete_rate_button']))
{
	$delete_id = $_POST['delete_rate'];
	$admin_id = $_SESSION['admin_id'];
	
	$delete = mysqli_query($conn, "DELETE FROM ".$property_new_rates." WHERE pro_new_rate_id=$delete_id");
	if($delete)
		{
			echo "<script>alert('Deleted Successfully.');</script>";
			echo "<script>window.location = 'property_details.php?data=profile'</script>";
		}
}
?>
<?php
if(isset($_POST['image_caption']))
{
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	 $pro_id = array_shift($_POST);
	 $admin_id = array_shift($_POST);
	foreach($_POST as $key=>$cap)
	{
		$cap_id= str_replace('img_','', $key);
		$update = mysqli_query($conn,"UPDATE ".$files." SET caption='".$cap."', updated_img_date=now() WHERE image_id='".$cap_id."' AND property_id='".$pro_id."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));
	}
	
	if($update)
		{
			echo "<script>alert('Caption updated Successfully.');</script>";
			echo "<script>window.location = 'property_details.php?data=uidesign'</script>";
		}
		else
		{
			echo "<script>alert('Updatation Failed.');</script>";
		}
	
}
?>
<script>
$(document).ready(function(){
document.addEventListener("leftclick",handler,true);
function handler(e){
    e.stopPropagation();
    e.preventDefault();
}
})
</script>



