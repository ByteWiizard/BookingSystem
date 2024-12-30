<?php include_once('session_destroy.php') ;?>

<?php 

	include("include/db.php"); 

	$front_attraction = $pre_fix."front_attraction";

?>

<?php error_reporting(0); ?>

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

if(isset($_POST['edit_attraction_button']))

{

	$admin_id = $_POST['admin_id'];

	$f_id = $_POST['edit_attraction'];

	$pro_id = $_POST['attraction_pro_id'];

$admin_id = $_SESSION['admin_id'];

  $fetch = mysqli_query($conn,"SELECT * FROM ".$front_attraction." WHERE property_id='".$pro_id."' AND admin_id='".$admin_id."' AND f_id='".$f_id."'");

	$num = @mysqli_num_rows($fetch);

  while($show = @mysqli_fetch_assoc($fetch))

  {

	$f_img=$show['f_img'];

            $f_heading=$show['f_heading'];

		 $f_caption=$show['f_caption'];

			$f_content=$show['f_content'];

  }

?>

  <div class="content-wrapper">

    <section class="content-header">

      <h1> Front Attractions <small>Update your Front Attraction Easily</small> </h1>

      <hr>

      <form method="post" action="" enctype="multipart/form-data">

		<!-- <div class="row">

		<div class="col-md-3 col-md-offset-4">

		<div class="image_holder">

		<?php if(@$f_img==""){ ?>

		<img src="framework/img/no-image.png">

		<?php }else{ ?>

		<img src="uploads/front_attraction/<?php echo @$pro_id.'/'.@$f_img ?>">

		<?php } ?>

		<div class="form-group">

		<input type="file" name="image" id="profile_image">

		</div>

		</div>

		</div>

		</div>  -->

        

         <div class="form-group">

          <label for="exampleInputEmail1">Heading </label>

          <input type="text" name="f_heading" class="form-control" id="home_heading" placeholder="Heading" value="<?php echo html_entity_decode(@$f_heading) ;?>" />

        </div>



        <div class="editor">

          <label for="exampleInputEmail1">Content</label>

          <textarea class="ckeditor" name="f_content" id="noticeMessage" ><?php echo htmlspecialchars(@$f_content) ;?></textarea>

        </div>

        

        <div class="form-group">

          <label for="exampleInputEmail1">Logo </label>

          <input type="text" name="f_caption" class="form-control" id="f_caption" placeholder="Logo" value="<?php echo html_entity_decode(@$f_caption) ;?>" />

        </div>

         <input type="hidden" name="admin_id" value="<?php echo $admin_id;?>" />

            <input type="hidden" name="ip" value="<?php echo getClientIP();?>" />

           <input type="hidden" name="pro_id" value="<?php echo @$pro_id ;?>" >

           <input type="hidden" name="f_id" value="<?php echo @$f_id ;?>" >

         

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

	$ip = $_POST['ip'];

	$admin_id=$_POST['admin_id'];

	$id=test_input($_POST['f_id']);

	$f_heading=test_input($_POST['f_heading']);

	$f_content=$_POST['f_content'];

	$f_caption=test_input($_POST['f_caption']);

	$pro_id=test_input($_POST['pro_id']);

	$name=$_FILES['image']['name'];

	$type=$_FILES['image']['type'];

	$size=$_FILES['image']['size'];

	$tmp=$_FILES['image']['tmp_name'];

	$folder_path = 'uploads/front_attraction/'.$pro_id;

	$targetDir = 'uploads/front_attraction/'.$pro_id.'/';

	if (!file_exists($folder_path)) {

    mkdir($folder_path, 0777, true);

	}

	$insert = mysqli_query($conn,"SELECT * FROM ".$front_attraction." WHERE f_id='".$id."' AND property_id='".$pro_id."' AND admin_id='".$admin_id."'");

	$row = mysqli_num_rows($insert);

	

	if($row>0)

	{

		if(($_FILES["image"]["type"] == "image/gif") || 

			($_FILES["image"]["type"] == "image/jpeg") || 
			
			($_FILES["image"]["type"] == "image/jpg") || 
			
			($_FILES["image"]["type"] == "image/JPG") || 

			($_FILES["image"]["type"] == "image/png") || 
			
			($_FILES["image"]["type"] == "image/PNG") || 

			($_FILES["image"]["type"] == "image/pjpeg") ||

			($name == "")

			) 

			

			{

function compress_image($source_url, $destination_url, $quality) {



		$info = @getimagesize($source_url);



    		if ($info['mime'] == 'image/jpeg')

        			$image = imagecreatefromjpeg($source_url);



    		elseif ($info['mime'] == 'image/gif')

        			$image = imagecreatefromgif($source_url);



   		elseif ($info['mime'] == 'image/png')

        			$image = imagecreatefrompng($source_url);



    		@imagejpeg($image, $destination_url, $quality);

		return $destination_url;

	}

}



		

		while($loop = mysqli_fetch_assoc($insert))

		{

			$del_file = $loop['f_img'];

			if($name == "" )

			{

				$name = $loop['f_img'];

			}

			if($size<=4194304) // 4 Mb

			{

				$targetFile =  $targetDir.$name;

			$filenames = compress_image($_FILES["image"]["tmp_name"], $targetFile, 80);

			$compress_size = filesize($folder_path);

			

			$update = mysqli_query($conn,"UPDATE ".$front_attraction." SET f_img='".$name."' , f_heading='".$f_heading."', f_content='".$f_content."', f_caption='".$f_caption."',f_update_date=now(), f_ip='".$ip."' WHERE f_id='".$loop['f_id']."' AND admin_id='".$admin_id."'") or (mysqli_error($conn));

		}

		

		else

		{

		 echo "<script>alert('Size of image is greater than 4MB, Please insert image than 4 Mb.');</script>";

			?>

			<script>

			window.location = 'review.php';

            </script>

            <?php

		}

	}

		if($update)

		{

			//move_uploaded_file($tmp,"uploads/front_attraction/$pro_id/$name");

			$FileName = 'uploads/front_attraction/'.$pro_id.'/'.$del_file;

			@chown($FileName,465); //Insert an Invalid UserId to set to Nobody Owner; for instance 465

			if($name != $del_file)

			{

			@unlink($FileName);

			}

			echo "<script>alert('Updated Successfully.');</script>";

			?>

			<script>

			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';

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

if(!isset($_POST['edit_attraction_button']))

{

$server = 'front_attraction.php';

?>

<script>

window.location ='<?php echo $server ;?>' ;

</script>

<?php

}

?>