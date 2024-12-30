<?php include_once('session_destroy.php') ;
error_reporting(0);
?>
<?php 
	include_once('include/db.php');
	$reviews_detail = $pre_fix."reviews_detail";
	$meta_tags = $pre_fix."meta_tags";
	$property_details = $pre_fix."property_details";
?>
<?php include_once('include/functions.php');?>

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
<div class="wrapper">

<?php include_once('include/topbar.php'); ?>
<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
$admin_id = $_SESSION['admin_id'];

?>

<div class="content-wrapper">
<section class="content-header">
<h1>Meta Tag<small>Add Meta Tag From Here</small> </h1>
<hr>
</section>

<?php
$admin_id = $_SESSION['admin_id'];
$per_page= 5; // number of user to show
$page_query=mysqli_query($conn,"SELECT id FROM ".$reviews_detail." WHERE admin_id='".$admin_id."'");
$pages=ceil(mysqli_num_rows($page_query) / $per_page); //total number of pages to show
$page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1; // current page list
$start= ($page - 1) * $per_page; //start list of user from zero becoz php starts from zero

$fetch11 = mysqli_query($conn,"SELECT * FROM ".$meta_tags."");
$num11 = mysqli_num_rows($fetch11);
if($num11>0)
{

?>
<h3 class="head text-center">Meta Tag Section</h3>
<table class="responsive-table">
<thead>
<tr>
<th scope="col">S.No.  </th>
<th scope="col">Page Name  </th>
<th scope="col">Edit</th>
</tr>
</thead>
<tbody>
<?php
$i = 1 ;
while($show11 = mysqli_fetch_assoc($fetch11))
{
	
if($show11['id']=='1') {
$category="Home Page";	
}
elseif($show11['id']=='2') {
$category="About Page";	
}
elseif($show11['id']=='3') {
$category="Policies Page";	
} 
elseif($show11['id']=='4') {
$category="Attraction Page";	
} 
elseif($show11['id']=='8') {
$category="show all rentals";	
} elseif($show11['id']=='6') {$category="Contact Page";	}
else {
$cateid= $show11['category'];
if(is_numeric($cateid)){
	$QueryPr = mysqli_query($conn, "select property_heading from ".$property_details." where property_id='$cateid' limit 1");
	$ResPr = mysqli_fetch_assoc($QueryPr);
	$category = $ResPr['property_heading']. "(Property)";
}	
}	
?>
<form method="post" action="edit_meta_tag.php">
<tr>
<td scope="row"><?php echo ++$start ;?></td>
<td scope="row"><?php echo $category ;?></td>
<td data-title="Edit" >
<input type="hidden" name="edit_meta_id" value="<?php echo $show11['id']; ?>">
<button type="submit" name="edit_meta_button"><i class="fa fa-pencil"></i></button>
</td>
</tr>
</form>
<?php
}
?>
</tbody>

</table>
<!--
<div style="text-align:center">
<nav aria-label="Page navigation">
<ul class="pagination">
<?php

$prev=$page - 1;
$next=$page + 1;
if(!($page<=1))
echo  "<li><a href='?page=$prev' aria-label='Previous'> <span aria-hidden='true'>&laquo;</span> </a> </li>";

if($pages>=1)
{
for($x=1;$x<=$pages;$x++){
echo ($x==$page) ? '<li class="active"><a href="?page='.$x.'">'.$x.'</a></li>' : '<li><a href="?page='.$x.'">'.$x.'</a></li>' ;
}

}

if(!($page>=$pages))
{
echo "<li> <a href='?page=$next' aria-label='Next'> <span aria-hidden='true'>&raquo;</span> </a> </li>";
}

?>

</ul>
</nav>
</div>  -->
<?php
}
?>
</div>
</div>
<?php 
if(isset($_POST['delete_rate_button']))
{
$delete_id = $_POST['delete_rate'];

$dt = mysqli_query($conn, "SELECT property_id,img FROM ".$reviews_detail." WHERE id='".$delete_id."'");
$dell = mysqli_fetch_assoc($dt);
$del_file = $dell['img'];
$pro_id = $dell['property_id'];
$delete = mysqli_query($conn, "DELETE FROM ".$reviews_detail." WHERE id=$delete_id");
if($delete)
{
$FileName = 'uploads/review/'.$pro_id.'/'.$del_file;
@chown($FileName,465); //Insert an Invalid UserId to set to Nobody Owner; for instance 465
@unlink($FileName);
echo "<script>alert('Deleted Successfully.');</script>";
echo "<script>window.location = 'review.php'</script>";
}
}


?>  
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
<script type="text/javascript">
$("#review_form").submit( function() {
var custname = $('#cust_name').val();
if(custname==="")
{
$('#error_firstname').html('* Please enter customer name...');
$('#cust_name').focus();
return false;
}
else
{
$('#error_firstname').html('');
}
var messageLength = CKEDITOR.instances['noticeMessage'].getData().replace(/<[^>]*>/gi, '').length;
if( !messageLength ) {
alert( 'Please enter a message' );
CKEDITOR.instances['noticeMessage'].focus();
return false;
}
var e = document.getElementById("pro_id");
var strUser = e.options[e.selectedIndex].value;
//if you need text to be compared then use
var strUser1 = e.options[e.selectedIndex].text;
if(strUser==="0") //for text use if(strUser1=="Select")
{
$('#error_pro_id').html('* Please select your Property Name');
$('#pro_id').focus();
return false;
}
else
{
$('#error_pro_id').html('');
}

})
</script>
</body>
</html>
