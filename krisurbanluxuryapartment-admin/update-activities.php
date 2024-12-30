<?php include_once('session_destroy.php'); ?>
<?php include("include/db.php"); ?>
<?php

$amenity = $pre_fix."amenity";
$amenity_details = $pre_fix."amenity_details";
$property_details = $pre_fix."property_details";

if(isset($_GET['update']))
{
	@$edit_id = $_GET['update'];
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
<style>
.sin_amen{
	display: inline-block;
    vertical-align: top;
    background: #286090;
    width: 29%;
    min-width: 320px;
    padding: 5px 20px;
    margin: 5px;
    color: #fff;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	height:auto;
	    text-align: left;
}
a.remove_field {
    
    color: #fff;
    position: absolute;
    right: 10px;
}
a.remove_field i{
	font-size:20px;
}
a.remove_field:hover{
	color:#fff;
}
.content-header label {
    font-size: 14px !important;
}
[type="checkbox"]:not(:checked),
[type="checkbox"]:checked {
  position: absolute;
  left: -9999px;
}
[type="checkbox"]:not(:checked) + label,
[type="checkbox"]:checked + label {
  position: relative;
  padding: 10px 25px;
  cursor: pointer;
}
/* checkbox aspect */
[type="checkbox"]:not(:checked) + label:before,
[type="checkbox"]:checked + label:before {
  content: '';
  position: absolute;
  left:0; top: 10px;
  width: 20px; height: 20px;
  border: 1px solid #aaa;
  background: #f8f8f8;
  border-radius: 3px;
  box-shadow: inset 0 1px 3px rgba(0,0,0,.3);
  
}
/* checked mark aspect */
[type="checkbox"]:not(:checked) + label:after,
[type="checkbox"]:checked + label:after {
  content: '✔';
  position: absolute;
  top: 12px; left: 4px;
  font-size: 18px;
  line-height: 0.8;
  color: #09ad7e;
  transition: all .2s;
}
/* checked mark aspect changes */
[type="checkbox"]:not(:checked) + label:after {
  opacity: 0;
  transform: scale(0);
}
[type="checkbox"]:checked + label:after {
  opacity: 1;
  transform: scale(1);
}
/* disabled checkbox */
[type="checkbox"]:disabled:not(:checked) + label:before,
[type="checkbox"]:disabled:checked + label:before {
  box-shadow: none;
  border-color: #bbb;
  background-color: #ddd;
}
[type="checkbox"]:disabled:checked + label:after {
  color: #999;
}
[type="checkbox"]:disabled + label {
  color: #aaa;
}
/* accessibility */
[type="checkbox"]:checked:focus + label:before,
[type="checkbox"]:not(:checked):focus + label:before {
  border: 1px dotted blue;
}
/* hover style just for information */
label:hover:before {
  border: 1px solid #4778d9!important;
}
.butn{
	width:100px;
	padding:8px 10px;
	color:#fff;
	background:#449d44 !important;
	border:0;
	float: left;
}
a.butn1,.butn1, a.butn1:hover, a.butn1:focus{
	
	padding:5px 10px;
	color:#fff !important;
	background:#449d44 !important;
	border:0;
	font-size:12px;
	margin-bottom:10px;
}
.margin-20{
	margin:20px auto;
}
.error11 {
	color:#F00;
	margin-left:10px;
}
span .button-dwn {
    margin: 5px auto;
    text-align: center;
    color: #fff;
    background-color: #69cb95;
    border: 2px solid #5cb85c;
    color: #fff;
    padding: 5px 15px;
    font-family: 'Source Sans Pro', sans-serif;
    font-size: 14px;
}
.refresh {
    float: right;
}
a:focus {
    outline:none !important;
    outline-offset: -2px;
}
a:focus, a:hover {
    color: #fff !important;
    text-decoration: none !important;
}
</style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<?php include_once('include/sidebar.php'); ?>
<?php $admin_id = $_SESSION['admin_id']; ;?> 
<?php
	  $fetch11 = mysqli_query($conn,"SELECT * FROM ".$amenity." WHERE amenity_id='".$edit_id."' AND admin_id='".$admin_id."'");
	   $num11 = @mysqli_num_rows($fetch11);
	   if($num11>0)
	   {
		$show11 = mysqli_fetch_assoc($fetch11);
		$amenity_name = $show11['amenity_name'];
	   }
?>     
      
      
      <div class="content-wrapper" >
<section class="content-header">
<h1> Edit Amenity <small>Update your Property Amenity Easily</small> 
<span class="refresh"><a href="property_details.php?data=prototyping" class="button-dwn">Back to Property</a></span>
</h1>
<hr>
<div class="heading">
            <h3><i class="fa fa-clipboard" aria-hidden="true"></i> Update amenity category: <span class="cat-change"><?php echo @$amenity_name ;?></span>
          <span style="float:right;">  <form id="catte" style="display: inline-block;">
            <input type="text" name="cat-name" id="cat-name" />
            <input type="hidden" name="catid" id ="catid" value="<?php echo $edit_id ;?>" />
            <button name="cat" id="cat" title="Update your amenity category name" class="butn1">Update</button>
            </form>
            <a href="javascript:;" id="edit-cat" class="butn1">Change Category Name</a><span></h3>
          </div>
          <div class="row"><div class="alert-msg"></div></div>
          <div class="row">
          <div class="col-md-10 col-md-offset-1" align="center" >
            <div class="input_rates">
              <div class="form-group">
               <div class="col-md-6">
               <form id="add_amne">
                <input type="text" name="amenities" class="form-control" id="amenities" placeholder="Add amenities to this amenity category" /></div>
                  <input type="hidden" name="amenity_id" id="aid" value="<?php echo $edit_id ;?>" />
                  <input type="hidden" name="amenity_name" id="aname" value="<?php echo @$amenity_name ;?>" />
                   <input type="hidden" name="ip" id="aip" value="<?php echo getClientIP() ;?>" />
                 <div class="col-md-6"> <input type="submit" name="amen_submit" id="amen_submit" value="Add" title="Add Amenity" class="butn"/><span id="errormsg" class="error11"></span></div>
                </form>
              </div>
            </div>
          </div>     
</div>
<form name="k" method="post" action="">
<ul class="aminity_ul" id="sortable">
<?php 
$fetch = mysqli_query($conn,"SELECT amen_id,amen_value,amen_status FROM ".$amenity_details." WHERE amenity_id='".$edit_id."' ORDER BY amen_id DESC");
while($row=@mysqli_fetch_assoc($fetch))
{
	$amenvalue = html_entity_decode($row['amen_value']);
	if($row['amen_status']==1)
	{ ?>
	<li class="img_li" id="menu-order-<?php echo $row['amen_id']; ?>"><span class='sin_amen'><input type='checkbox' class='subhi' name='<?php echo $amenvalue; ?>' id='<?php echo $amenvalue; ?>' checked/><label for='<?php echo $amenvalue; ?>'><?php echo $amenvalue; ?></label><a title='Delete this amenity' href='#' class='remove_field'><i class='fa fa-times-circle' aria-hidden='true'></i></a><p id='xc-<?php echo $amenvalue; ?>'></p></span></li>
	<?php 
	}
	else
	{
	?><li class="img_li" id="menu-order-<?php echo $row['amen_id']; ?>"><span class='sin_amen'><input type='checkbox' name='<?php echo $amenvalue; ?>' id='<?php echo $amenvalue; ?>' /><label for='<?php echo $amenvalue; ?>'><?php echo $amenvalue; ?></label><a  title='Delete this amenity' href='#' class='remove_field'><i class='fa fa-times-circle' aria-hidden='true'></i></a><p id='xc-<?php echo $amenvalue; ?>'></p></span></li>
	<?php 
	}
}
?>
</ul>
</form>
<style>
.aminity_ul {
    margin: 20px 0px 0px;
    padding: 0;
    text-align: center;
}
.aminity_ul li {
    height: auto;
    overflow: hidden;
    width: 300px;
    display: inline-block;
    list-style: outside none none;
    position: relative;
    margin: 0px 5px 10px;
}
</style>
<!--<div id="successmsg" class="margin-20" align="center"></div>-->
<input type="hidden" name="amenity_id" value="<?php echo @$amenity_id ;?>" />
  </div>
</div>
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script> 
<script src="framework/js/dropdown.js"></script> 
<script src="framework/js/select.js"></script>
  <script>
  $(function() {
		  $( "#sortable" ).sortable({
    update: function( event, ui ) {
		var sorted = $( "#sortable" ).sortable( "serialize" );
        $.post( "ajax/save_aminity_order.php",{ 'choices': sorted} ,function( data ) {
  $( ".success-msg" ).html( data );
		});
   	 }
  });
	 });
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
<script>
function postForm() {
	/*var id= <?php echo $edit_id ?>;
    $.ajax({
type: "POST",
url: "ajax/amenity_show.php",
data: {amenId:id},
cache: true,
success: function(msg){
$("#successmsg").html(msg);
}  
}); */
$('#sortable').on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault();
		if (!confirm("Do you want to delete?")){
         return false;
	     };
		var am =  $(this).prevAll("input[type=checkbox]").next('label').text();
		
		$(this).parent('span').remove();
		var id= <?php echo $edit_id ?>;
	$.ajax({
type: "POST",
url: "ajax/amenity_delete.php",
data: {amenId:id , amenName:am },
cache: true,
success: function(msg){
	var mgg = $.trim(msg);
	$('#errormsg').html(mgg);
	setTimeout(function() {
         $('#errormsg').html('');
           }, 5000);
	return false;
}
}); 
});
}
</script>
<?php
}
?>
<script>
 $(document).ready(function(){
	 $('#catte').hide();
$('#edit-cat').click(function(){
	$('#catte').toggle();
});
});
	$('#cat').click(function(){
		var ctName = $('#cat-name').val();
		var ctId = $('#catid').val();
		if(ctName=="")
		{
			alert("Please enter some text first...");
			return false;
		}
		else
		{
			$.ajax({
  method: "POST",
  url: "ajax/amenity_category.php",
  cache: false,
  data: {'catName':ctName , 'catId':ctId }
  })
  .done(function( nnn ) {
	 
	var mg = $.trim(nnn);
	if(mg==="Amenity category name changed successfully.")
	{
		$('#catte').hide();
		alert(mg);
		$('.cat-change').html(ctName);
		
	}
	else
	{
		alert(mg);
	}
       });	
	   return false;
		}
	});
</script>
<script>
 $(document).ready(function(){
$('#amen_submit').click(function(){
	var te = $('#amenities').val() ;
	var aId = $('#aid').val();
	var aName = $('#aname').val();
	var aIp = $('#aip').val();
	
	if(te=="")
	{
		alert('Please enter a value first...');
		return false;
	}
    var fields = $( ":input" ).serializeArray();
	
  $.ajax({
  method: "POST",
  url: "ajax/checkamenities.php",
  cache: false,
  data: {'amenity_name':aName , 'amenities':te , 'amenity_id':aId , 'ip':aIp }
  })
  .done(function( msg ) {
	var mg = $.trim(msg);
	
	if(mg!=""){
		 if((mg=="This amenity already exists,Try a new one.")||(mg=="Insertion Failed."))
		 {
			 $('#errormsg').html(mg);
			 $('#amenities').val('');
			 return false;
		 }
		 else
		 {
		$('#amenities').val('');
		//$('#successmsg').prepend('<span class="sin_amen"><input type="checkbox" name='+mg+' id='+mg+' checked><label for='+mg+'>'+te+'</label><a title="Delete this amenity" href="#" class="remove_field"><i class="fa fa-times-circle" aria-hidden="true"></i></a><p></p></span>');
		window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';
		$('#errormsg').html('Added Successfully');
		setTimeout(function() {
         $('#errormsg').html('');
           }, 5000);
		return false;
		 }
	}
	
  	});
return false;
	});
	
$('#sortable').on("click",".sin_amen input", function(e){
		var amneId = <?php echo $edit_id ?>;
		var na = $(this).next('label').text();
		var na1 = $(this).nextAll('p').attr('data','checking');
			var checked = $(this).is(':checked');
			if(checked){
				var stat = "1";
			} else {
				var stat = "0";
			}
		
		$.ajax({
type: "POST",
url: "ajax/amenity_checkbox.php",
data: {'amenId':amneId , 'amenName':na ,'stat':stat},
cache: false,
success: function(msg){
	var xc = $.trim(msg);
	var na2 = $(na1).text(xc);
	setTimeout(function() {
         $(na2).html('');
           }, 2000);
	return false;
              }
		});
	
	});
 })
</script>
<script>
$(function() {
    postForm();
});
</script>
<?php
if(!isset($_GET['update'])||($_GET['update']==""))
{
$server = 'property_details.php';
?>
<script>
alert('No amenity category is finded...');
window.location ='<?php echo $server ;?>' ;
</script>
<?php
}
?>

