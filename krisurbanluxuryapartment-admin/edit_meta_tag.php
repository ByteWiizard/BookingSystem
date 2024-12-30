<?php include_once('session_destroy.php') ;?>
<?php
include("include/db.php");
$meta_tags = $pre_fix."meta_tags";
error_reporting(0);
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
<div class="wrapper">
<?php include_once('include/functions.php');?>
<?php include_once('include/topbar.php'); ?>
<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
if(isset($_POST['edit_meta_button']))
{
$r_id = $_POST['edit_meta_id'];
$fetch = mysqli_query($conn,"SELECT * FROM ".$meta_tags." WHERE  id='".$r_id."'");
$num = @mysqli_num_rows($fetch);
while($show = @mysqli_fetch_assoc($fetch))
{
$mtitle =$show['title'];
$mkeyword =$show['keywords'];
$mdescription =$show['description'];
$cononical_url = $show['cononical_url'];
}
?>
<div class="content-wrapper">
<section class="content-header">
<h1> Meta Tag <small>Update Your Meta Tag Easily</small> </h1>
<hr>
<form method="post" action="" enctype="multipart/form-data">
<div class="form-group">
<label for="exampleInputEmail1">Meta Title </label>
<input type="text" name="metatitle" class="form-control" placeholder="Meta Title" value="<?php echo html_entity_decode($mtitle) ;?>"/>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Meta Keyword </label>
<textarea name="metakeyword" class="form-control"><?php echo html_entity_decode($mkeyword) ;?> </textarea> 
</div>
<div class="form-group">
<label for="exampleInputEmail1">Meta Description </label>
<textarea name="metadescription" class="form-control"><?php echo html_entity_decode($mdescription) ;?> </textarea> 
</div>
<div class="form-group">
<label for="exampleInputEmail1">Cononical Url </label>
<input type="text" name="cononical_url" class="form-control" placeholder="Cononical Url" value="<?php echo $cononical_url; ?>"/>
</div>
<input type="hidden" name="r_id" value="<?php echo @$r_id ;?>" >
<div style="clear:both"></div>
<p class="text-center">
<button type="submit" name="home_details_submit" class="btn btn-success btn-outline-rounded green"> Submit <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
</p>
</form>
</section>
</div>
<?php } ?>
</div>
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script>
</body>
</html>
<?php
if(isset($_POST['home_details_submit']))
{
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
$mtitle=test_input($_POST['metatitle']);
$mkeyword=test_input($_POST['metakeyword']);
$mdescription=test_input($_POST['metadescription']);
$cononical_url = $_POST['cononical_url'];
$rid=test_input($_POST['r_id']);
$update = mysqli_query($conn,"UPDATE ".$meta_tags." SET title='".$mtitle."', keywords='".$mkeyword."', description='".$mdescription."', cononical_url='".$cononical_url."' WHERE id='".$rid."' ") or (mysqli_error($conn));
echo "<script>alert('Updated Successfully.');</script>";
}
?>
<?php
if(!isset($_POST['edit_meta_button']))
{
$server = 'meta_tag.php';
?>
<script>
window.location ='<?php echo $server ;?>' ;
</script>
<?php
}
?>