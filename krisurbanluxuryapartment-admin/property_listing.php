<?php include_once('session_destroy.php') ;?>
<?php include("include/db.php"); ?>
<?php $tab = $pre_fix."property_details"; ?>
<?php error_reporting(0); ?>
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
   <?php
$admin_id = $_SESSION['admin_id'];
 $fetch111 = mysqli_query($conn,"SELECT * FROM ".$tab." WHERE admin_id='".$admin_id."'");
  $num111 = mysqli_num_rows($fetch111);
 ?>
  <script src="framework/js/ajax.js"></script>
  <script>
  function check(){
    var retVal= confirm(" Do you want to delete ");
    if(retVal==true){
  	 return true ;
    }else{
  	 return false ;
    }
  }
  </script>
  <script>
    $(document).ready(function(){
      var num_pro = <?php echo @$num111 ?>;
      $('#add_property').click(function(){
        if(num_pro == 10){ 
          alert("Please contact to your service provider for adding a new property.");
          return false;
        }
      });
    });
    </script>
    <!-- check feature property -->
    <script type="text/javascript">
      $(document).ready(function(){
        $(".featured").change(function(){
          var fetas  = $(this).attr('id');
          var a = $('#'+fetas).prop('checked');
          $.ajax({
            url: "check_feature.php",
            type: "POST",
            cache: false,
            data: { 'del_val': fetas, 'a': a},
            success: function(data)
            {
              if(data=='1'){
                alert("Your Featured limit has been accede.");
                location.reload();
              }
              if(data=='2'){
                alert("Property successfully added in featured.");
                location.reload();
              }
              if(data=='3'){
                alert("Property successfully removed from featured.");
                location.reload();
              }
            }
          });
        });
      });
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
        $fetch111 = mysqli_query($conn,"SELECT * FROM ".$tab." WHERE admin_id='".$admin_id."'");
        $num111 = mysqli_num_rows($fetch111);
      ?>

      <!-- end check feature property -->
      <div class="content-wrapper">
        <section class="content-header">
          <h1>Update <small>Update your property details easily</small> </h1>
          <hr>
          <?php if($num111<10){ ?>
            <div class="add">
              <h4>Add a new property from here  </h4>
              <a href="add_property.php" class="btn btn-success btn-outline-rounded green" id="add_property">Add Property</a>
            </div>
          <?php } ?>
          <?php
          $fetch11 = mysqli_query($conn,"SELECT * FROM ".$tab." WHERE admin_id='".$admin_id."'");
          @$num11 = mysqli_num_rows($fetch11);
          if($num11>0){
          ?>
            <h3 class="head text-center">Added Property</h3>
            <div class="ta_pad">
              <table class="responsive-table">
                <thead>
                  <tr>
                    <th scope="col"> S.No </th>
                    <th scope="col">Property heading</th>
                    <th scope="col">Property status</th>
                    <th scope="col">Added Date</th>
                    <th scope="col">Edit</th>
                    <!-- <th scope="col">Featured</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $i=1;
                    while($show11 = mysqli_fetch_assoc($fetch11)){
                    $loc_id = $show11['loc_id'];
                    $property_id = $show11['property_id'];
                    $property_heading=$show11['property_heading'];
                    $property_status=$show11['property_status'];
                    $added_date=$show11['pro_det_insert_date'];	 
                    $feats = $show11['featured'];
                  ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td data-title="Property heading"><?php echo @$property_heading; ?> </td>
                    <td data-title="Property status"><?php echo @$property_status ?></td>
                    <td data-title="Added date" ><?php echo @$added_date; ?></td>

                    <!-- <form action="" method="post">
                      <td data-title="Delete" ><input type="hidden" name="delete_property" value="<?php echo @$show11['property_id']; ?>"><button type="submit" name="delete_pro_button" onClick="return check()"><i class="fa fa-trash"></i></button></td>
                    </form> -->
                    <form method="post" action="property_details.php">
                      <td data-title="Edit" ><input type="hidden" name="edit_property" value="<?php echo @$show11['property_id']; ?>"><button type="submit" name="edit_pro_button"><i class="fa fa-pencil"></i></button></td>
                      <!-- <td data-title="Featured"><input type="checkbox" name="featured" <?php if($feats=='true'){ echo 'checked'; } ?> class="featured" id="<?php echo @$show11['property_id']; ?>"></td> -->
                    </form>
                  </tr>
                <?php
                $i++;
                }
                ?>
              </tbody>
            </table>
          </div>
          <?php } ?>
        </section>
      </div>
      <script>
        $(document).ready(function(e) {
          $( "#pro_new_rate_sdate" ).datepicker();
          $( "#pro_new_rate_edate" ).datepicker();
          $( ".form-control" ).datepicker( "option", "dateFormat", 'mm-dd-yy' );
        });
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
        });
      })();
      </script> 
</div>
</body>
</html>

