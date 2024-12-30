<?php include_once('session_destroy.php') ;
error_reporting(0);
?>
<?php 
	include_once('include/db.php');
	$reviews_detail = $pre_fix."reviews_detail";
	$property_details = $pre_fix."property_details";
?>
<?php include_once('include/functions.php');?>
<?php
if(isset($_POST['home_details_submit']))
{

	$admin_id = $_SESSION['admin_id'];
	
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
    $img_name=$_FILES['image']['name'];
	$type=$_FILES['image']['type'];
	$size=$_FILES['image']['size'];
	$tmp=$_FILES['image']['tmp_name']; 
	
	$c_name=mysqli_escape_string($conn, $_POST['c_name']);
	$heading=mysqli_escape_string($conn, $_POST['heading']);
	$c_review=mysqli_escape_string($conn, $_POST['c_review']);
	$c_place=test_input($_POST['c_place']);
	$pro_id=test_input($_POST['pro_id']);
       $submit = test_input($_POST['submit']);
	$stayed = test_input($_POST['stayed']);
		$folder_path = '../uploads/review/'.$pro_id;
		$targetDir = '../uploads/review/'.$pro_id."/";
	if (!file_exists($folder_path)) {
    mkdir($folder_path, 0777, true);
	}
    
	if(($_FILES["image"]["type"] == "image/gif") || 
			($_FILES["image"]["type"] == "image/jpeg") || 
			($_FILES["image"]["type"] == "image/png") || 
			($_FILES["image"]["type"] == "image/pjpeg") ||
			($img_name == "")
			)			
			{				
			function compress_image($source_url, $destination_url, $quality) {
			$info = getimagesize($source_url);
			if ($info['mime'] == 'image/jpeg')
			$image = imagecreatefromjpeg($source_url);
			elseif ($info['mime'] == 'image/gif')
			$image = imagecreatefromgif($source_url);
			elseif ($info['mime'] == 'image/png')
			$image = imagecreatefrompng($source_url);
			imagejpeg($image, $destination_url, $quality);
			return $destination_url;
			}
			if($size<=4194304) // 4 Mb
			{
			$targetFile =  $targetDir.$img_name;
			$filenames = compress_image($_FILES["image"]["tmp_name"], $targetFile, 80);
			$compress_size = filesize($folder_path);
	
	
	 $insert = mysqli_query($conn,"INSERT into ".$reviews_detail."(property_id,admin_id,img,c_name,heading,c_review,c_place,sdate,edate,added_date) VALUES('".$pro_id."','".$admin_id."','".$img_name."','".$c_name."','".$heading."','".$c_review."', '".$c_place."','".$submit."','".$stayed."', now())");
	 
	 	}	     
		   else
		  {
			  echo "<script>alert('Size of image is greater than 4MB, Please insert image than 4 Mb.');</script>";
					
		  }
			}else{
			echo"<script>alert('Image Format Is Not Valid ')</script>";

		          }
	
	if($insert)
	{
		
		echo "<script>alert('Inserted Successfully.');</script>";
		?>
		<script>
		window.location = 'review.php';
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
<script>
 function block(id){
      confirm('Are you sure block this review');
       window.location.href="review-block.php?id="+id;
   }

function active(id){
      confirm('Are you sure active this review');
       window.location.href="review-active.php?id="+id;
   }
</script>
<script>
$(document).ready(function(e) {
	$('#add_rev').hide();
    $('#add_areview').click(function(){
		var but = $('#add_areview').val();
			$('#add_rev').toggle(function(){
			if(but== 'Add New Review' )
				{
					$('#add_areview').val('Close X');
				}
			else
				{
					$('#add_areview').val('Add New Review');
					$('#add_rev').hide();
				}
		});
		return false;
		});
})
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<?php include_once('include/topbar.php'); ?>
<div class="wrapper">
<?php include_once('include/sidebar.php'); ?>
<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>
<?php
$admin_id = $_SESSION['admin_id'];
?>

  
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Customer Reviews<small>Add Reviews From Here</small> </h1>
      <hr>
      <input type="button" class="btn btn-success green" id="add_areview" value="Add New Review" style="margin:10px;"/>
      <div id="add_rev">
      <form method="post" action="" id="review_form" enctype="multipart/form-data">
	  
	  <!-- <div class="row">
     <div class="col-md-3">
     <div class="image_holder">
     <img src="../img/default.jpg">
     <div class="form-group">
    <input type="file" name="image" id="about_profile_img">
  </div>
     </div>
     </div>
       
       </div> -->
		
  	<div class="form-group">
          <label for="exampleInputEmail1">Customer Name </label>
          <input type="text" name="c_name" class="form-control" id="cust_name" placeholder="Customer Name" />
          <div id="#error_firstname"></div>
        </div>

   	<div class="form-group">
          <label for="exampleInputEmail1">Heading </label>
          <input type="text" name="heading" class="form-control" id="home_heading" placeholder="Review Heading"/>
        </div>

        <div class="editor">
          <label for="exampleInputEmail1">Customer Review</label>
          <textarea class="ckeditor" name="c_review" id="noticeMessage" ></textarea>
        </div>
		
	<div class="col-md-6 form-group">
          <label for="exampleInputEmail1">Submit date </label>
          <input type="date" name="submit" class="form-control" id="home_heading" placeholder="Customer submit"/>
        </div>
 
        <div class="col-md-6 form-group">
          <label for="exampleInputEmail1">Stay date</label>
          <input type="date" name="stayed" class="form-control" id="home_heading" placeholder="Customer stayed"/>
        </div>

        <div class="row">
          <div class="heading">
            <h3><i class="fa fa-home" aria-hidden="true"></i> Select Your Property Name</h3>
          </div>
          <div class="col-md-4">
            <div class="prop_type" style="height: 216px;">
              <section>
                <select name="pro_id" class="cs-select cs-skin-underline">
				<option value="0">SELECT PROPERTY NAME</option>
				<?php
					$pro_fin = mysqli_query($conn, "SELECT property_id,property_heading FROM ".$property_details." WHERE admin_id=1");
					while($resfin = mysqli_fetch_assoc($pro_fin)) :
				?>
				 <option value="<?php echo $resfin['property_id']; ?>"><?php echo $resfin['property_heading']; ?></option>
				<?php endwhile; ?>
				</select>
              </section>
              <div id="error_pro_id"></div>
            </div>
          </div>
          
         
<div style="clear:both"></div>
         <p class="text-center">
          <button type="submit" name="home_details_submit" class="btn btn-success btn-outline-rounded green"> Submit <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
        </p>
      </form>
      </div>
    </section>
 
<?php
function prop_info($conn,$id) {
				$fetch22 = mysqli_query($conn,"SELECT * FROM lhk_property_listing where property_id ='".$id."'");
				$show22 = mysqli_fetch_assoc($fetch22);					
				return $show22['property_heading'];
			}


$admin_id = $_SESSION['admin_id'];
$per_page= 5; // number of user to show
$page_query=mysqli_query($conn,"SELECT id FROM ".$reviews_detail." WHERE admin_id='".$admin_id."'");
$pages=ceil(mysqli_num_rows($page_query) / $per_page); //total number of pages to show
$page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1; // current page list
$start= ($page - 1) * $per_page; //start list of user from zero becoz php starts from zero

  $fetch11 = mysqli_query($conn,"SELECT * FROM ".$reviews_detail." WHERE admin_id='".$admin_id."'  ORDER BY id DESC LIMIT $start, $per_page");
	   $num11 = mysqli_num_rows($fetch11);
	   if($num11>0)
	   {
	?>
        <h3 class="head text-center">Customer Review Section</h3>
        <table class="responsive-table">
          <thead>
            <tr>
              <th scope="col">S.No.  </th>
              <th scope="col">Customer Name  </th>
              <th scope="col">Review Content </th>
              <!-- <th scope="col">Review Heading </th> -->
			 
              <th scope="col">Customer Image</th>
			   <th scope="col">Status</th> 
			 <th scope="col">Edit</th>
			  
             <th scope="col">Delete</th>
             
            </tr>
          </thead>
          <tbody>
            <?php
                $i = 1 ;
			while($show11 = mysqli_fetch_assoc($fetch11))
			{
				$pro_id=$show11['property_id'];
				$c_img=$show11['img'];
				$c_name=$show11['c_name'];
				$c_head=$show11['heading'];
				$c_place=$show11['c_place'];

				$c_review=$show11['c_review'];
				$c_rev=substr($c_review,0,60);
			
		if($c_img!="")
		{
			$cust_image = "../uploads/review/".$pro_id."/".$c_img;
		} 
		else
		{
			$cust_image = "framework/img/avatar.png";
		}
		
		$p_name = prop_info($conn,$pro_id);
	?>
	
	
			<tr>
				<td scope="row"><?php echo ++$start ;?></td>
				<td scope="row"><?php echo $c_name ;?></td>

				<td data-title="Start Date"><?php echo $c_rev?html_entity_decode($c_rev)."...":''; ?></td>
				<!-- <td data-title="Start Date"><?php echo $c_head?html_entity_decode($c_head):'Not Available' ; ?></td> -->
				 <!--<td data-title="Start Date"><?php echo $p_name?html_entity_decode($p_name):'' ; ?></td>-->
				<!--<td scope="row"><?php echo $c_place?$c_place:'Not Available' ?></td>-->
				<td scope="row"><img src="<?php echo $cust_image ;?>" width="50px" height="50px"></td>
				

                                <?php if($show11['status']==1){?>
				<td data-title="Delete" ><a onclick="return block(<?php echo $show11['id']; ?>)"><img src="uploads/1.jpg" style="width:30px;"></a></td>
				<?php }else{?>
                                <td data-title="Delete" ><a  onclick="return active(<?php echo $show11['id']; ?>)"><img src="uploads/2.png" style="width:30px;"></a></td>
                                <?php } ?>
                                <form method="post" action="edit_review.php">
				<td data-title="Edit" >
				<input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id'] ;?>" >
				<input type="hidden" name="review_pro_id" value="<?php echo $pro_id; ?>">
				<input type="hidden" name="edit_review_id" value="<?php echo $show11['id']; ?>">
				<button type="submit" name="edit_review_button"><i class="fa fa-pencil"></i></button>
				</td>
				</form>
				<form action="" method="post">
				<td data-title="Delete" ><input type="hidden" name="delete_rate" value="<?php echo $show11['id']; ?>">
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
			$FileName = '../uploads/review/'.$pro_id.'/'.$del_file;
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
