<?php include_once('session_destroy.php'); ?>
<?php 
	include("include/db.php"); 
	$current_special1 = "lhk_current_special";
	$current_special = "sub_activities";
	$beach_place = $pre_fix."beach_place";
?>
<?php 
     if(isset($_POST['activity'])){
           $insert = mysqli_query($conn,"INSERT INTO sub_activities(aid,sub_activity,link,addedon)VALUES('".$_POST['r_id']."','".$_POST['sub']."','".$_POST['link']."','".date('Y-m-d H:m:s')."')");
           if($insert){
				echo "<script>alert('Inserted Successfully.');</script>";
			?>
				<script>
					window.location = 'edit_things.php?id=<?php echo $_REQUEST['id'];?>';
		        </script>
		    <?php
			}
     }
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
<?php

	$r_id = $_REQUEST['id'];
	$fetch = mysqli_query($conn,"SELECT * FROM ".$current_special1." WHERE current_id='".$r_id."'");
	$num = @mysqli_num_rows($fetch);
	while($show = @mysqli_fetch_assoc($fetch))
	{
		$r_img=$show['img'];
		$beach_id = $show['beach_id'];
		$r_heading=base64_decode($show['heading']);
		$r_content=$show['content'];
		$url = $show['url'];
	}
  
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Things To Do <small>Update Things To Do Easily</small> </h1>
      <hr>
      <form method="post" action="" enctype="multipart/form-data">
        
   	<div class="form-group">
          <label for="exampleInputEmail1">Title </label>
          <input type="text" name="c_heading" class="form-control" id="home_heading" placeholder="Title" value="<?php echo html_entity_decode($r_heading) ;?>"/>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Sub-Activities</label>
          <input type="text" name="sub" class="form-control" id="home_heading" placeholder="Sub Activity" />
        </div>
         <div class="form-group">
          <label for="exampleInputEmail1">Hyperlink</label>
          <input type="text" name="link" class="form-control" id="home_heading" placeholder="Hyperlink" />
        </div>
        

       
		<input type="hidden" name="r_id" value="<?php echo @$r_id ;?>" >
         
		<div style="clear:both"></div>
         <p class="text-center">
          <button type="submit" name="activity" class="btn btn-success btn-outline-rounded green"> Submit <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
      </form>
      
    </section>
      <?php
			$admin_id = $_SESSION['admin_id'];
			$per_page= 10; // number of user to show
			$page_query=mysqli_query($conn,"SELECT sid FROM ".$current_special." WHERE aid ='".$_REQUEST['id']."'");
			$pages=ceil(mysqli_num_rows($page_query) / $per_page); //total number of pages to show
			$page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1; // current page list
			$start= ($page - 1) * $per_page; //start list of user from zero becoz php starts from zero
			  $fetch11 = mysqli_query($conn,"SELECT * FROM ".$current_special." WHERE aid ='".$_REQUEST['id']."' ORDER BY sid DESC LIMIT $start, $per_page");
				   $num11 = mysqli_num_rows($fetch11);
				   if($num11>0)
				   {
				?>
			        <h3 class="head text-center">Sub Activities List Section</h3>
			        <table class="responsive-table">
			          <thead>
			            <tr>
			              <th scope="col">S.No.  </th>
			              <th scope="col"> Title </th>
				     <th scope="col"> Link </th>
			             <th scope="col">Delete</th>
			             
			            </tr>
			          </thead>
			          <tbody>
			            <?php
			                $i = 1 ;
						while($show11 = mysqli_fetch_assoc($fetch11))
						{
							$c_head=$show11['sub_activity'];
							$c_rev=substr($c_review,0,150);
				?>
						<tr>
							<td scope="row"><?php echo ++$start ;?></td>
							<td data-title="Start Date"><?php echo $c_head; ?></td>
							
							<td data-title="Link"><?php echo $show11['link']; ?></td>
							<form action="" method="post">
							<td data-title="Delete" ><input type="hidden" name="delete_rate" value="<?php echo $show11['sid']; ?>">
							<button type="submit" name="delete_rate_button" onClick="return check()"><i class="fa fa-trash"></i></button></td>
							</form>
						</tr>
			          <?php
			             }
				   
			          ?>
			            </tbody>
			          
			        </table>
			 <div style="text-align:center">
			<nav aria-label="Page navigation">
			  <ul class="pagination">
			<?php
			/* ----------------- Pages Links -------------- */
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
			/*-------------------------------------------------*/
			?>
			</ul>
			</nav>
			</div>
			<?php
			}
			?>
  </div>
  
</div>
<script src="framework/js/bootstrap.min.js"></script> 
<script src="framework/js/custom.js"></script> 
<script src="framework/js/app.min.js"></script> 
<script src="framework/ckeditor/ckeditor.js"></script>
</body>
</html>
<?php
if(isset($_POST['delete_rate_button']))
{
	$delete_id = $_POST['delete_rate'];
	
	$delete = mysqli_query($conn, "DELETE FROM sub_activities WHERE sid=$delete_id");
	if($delete)
		{		
		echo "<script>alert('Deleted Successfully.');</script>";
			?>
				<script>
					window.location = 'edit_things.php?id=<?php echo $_REQUEST['id'];?>';
		        </script>
		    <?php
			}
			}
		?>