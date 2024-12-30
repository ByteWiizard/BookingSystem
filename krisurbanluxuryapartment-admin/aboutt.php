<?php include_once('session_destroy.php'); ?>
<?php 

  include("include/db.php"); 
  $property_details = $pre_fix."property_details";
  $reviews_detail = $pre_fix."reviews_detail";
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
</head>
<body class="hold-transition skin-blue sidebar-mini">


  <?php include_once('include/topbar.php'); ?>
  <?php include_once('include/sidebar.php'); ?>
  <div class="wrapper">
  <?php include_once('include/functions.php');?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Dashboard <small>Update your Content Easily</small> </h1>
      <hr>
      <form>
      <div class="row">
     <?php
       $Querycount = mysqli_query($conn, "select * from ".$property_details."");
       $countpro = mysqli_num_rows($Querycount);
     ?>
     <div class="col-md-4">
        <div class="dash wow zoomIn">
        <div class="thumb"> 
        <a href="property_listing.php">
        <div class="thumbdash"><h1>Total Property (<?php echo $countpro; ?>)</h1></div>
        </a>
        </div>
        </div>
     </div>
     
     <div class="col-md-4">
        <div class="dash wow zoomIn">
        <div class="thumb"> 
        <a href="contact_details.php">
        <div class="thumbdash"><h1>Contact</h1></div>
        </a>
        </div>
        </div>
     </div>
     <?php
       $Queryrev = mysqli_query($conn, "select * from ".$reviews_detail."");
       $countrev = mysqli_num_rows($Queryrev);
     ?>
      <div class="col-md-4">
        <div class="dash wow zoomIn">
        <div class="thumb"> 
        <a href="review.php">
        <div class="thumbdash"><h1>Reviews (<?php echo $countrev; ?>)</h1></div>
        </a>
        </div>
        </div>
     </div>
     
     <div class="col-md-4">
        <div class="dash wow zoomIn">
        <div class="thumb"> 
        <a href="social_links.php">
        <div class="thumbdash"><h1>Social Links</h1></div>
        </a>
        </div>
        </div>
     </div>
  
  	 <div class="col-md-4">
        <div class="dash wow zoomIn">
        <div class="thumb"> 
        <a href="password.php">
        <div class="thumbdash"><h1>Login Details</h1></div>
        </a>
        </div>
        </div>
     </div>

     <!--<div class="col-md-4">
        <div class="dash wow zoomIn">
        <div class="thumb"> 
        <div class="thumbdash">
          <h1>Total Visitor's</h1>
          <img src="http://smallcounter.com/count.php?c_style=22&id=1494622508" border=0 alt="web counter" style="height: 31px;width: 21px;">
        </div>
        
        </div>
        </div>
     </div>-->
  
  </div>
  
        
        
      </form>
      
    </section>
  </div>
</div>
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script>
<script src="framework/js/dropdown.js"></script>
<script src="framework/js/select.js"></script>
   <script src="framework/js/wow.js"></script>
<script>
        new WOW().init();
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
$pro_fetch = mysqli_query($conn, "SELECT * FROM ".$property_details."");
$pro_row = mysqli_fetch_assoc($pro_fetch);
$property_id = $pro_row['property_id'];
$admin_id = $_SESSION['admin_id'];
$ip = getClientIP();
if($property_id==null)
{
	$pro_add = mysqli_query($conn, "INSERT INTO ".$property_details."(property_id,admin_id,pro_det_insert_date,pro_det_ip) VALUES(1, '".$admin_id."' ,now(), '".$ip."')");

}
?>