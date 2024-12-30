<?php @include_once('session_destroy.php') ;?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin</title>

<link href="framework/css/import.css" rel="stylesheet">



    <link href="framework/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <link href="framework/css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

	

<style>



     .modal-dialog {

		 width:50% !important;

		 height:100%;

		 

}

.modal-header {

    min-height: 16.43px;

    padding: 10px 15px !important;

    border-bottom: 1px solid #e5e5e5;

}

.modal-footer {

    padding: 5px 15px !important;

    text-align: right;

    border-top: 1px solid #e5e5e5;

}

.modal-body {

    position: relative;

    padding: 0px 15px !important;

}

.modal-dialog{

	z-index:9999;

}



.modal-header .close {

    margin-top: -8px !important;

}



.booking-pop

{

padding:20px;	

	

}



.booking-dt p span

{

	font-weight:bold;

	color:#000;

	

}

}

.booking-dt p

{

	font-size:14px;

	color:#333;

	padding:10px;

	margin: 0 0 15px;

	line-height:23px;

	text-align:left;

	margin:0;

}

</style>



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

      function calender(id){ 

  

          $('#myModal'+id).modal("show");      

       

      }    

  </script>

</head>

<body class="hold-transition skin-blue sidebar-mini">

<?php include_once('include/functions.php');?>

<?php include_once('include/topbar.php'); ?>

<div class="wrapper">

<?php include_once('include/sidebar.php'); ?>

<?php include_once('include/db.php'); ?>

<?php $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/' ;?>

<?php
    if(isset($_POST['status'])){
      $booking_id = $_POST['status'];
      $today = date('Y-m-d');
      $data = $conn->query("SELECT checkin,checkout,property_id,book_status from lhk_booking_details where bok_det_id='$booking_id'");
      if($data->num_rows >0){      
        $data = $data->fetch_assoc();
     
          if($data['book_status'] == 1){//GO FOR ENABLE BOOKED DATES
            $conn->query("DELETE FROM lhk_ical_events where event_pid='{$data['property_id']}' AND event_type='self'");

          }else{//GO FOR DISABLED BOOKED DATES
             
//echo "INSERT INTO lhk_ical_events SET start_date='{$data['checkin']}',admin_id='1',booking_status='1',text='Booked',added_date='{$today}',end_date='{$data['checkout']}',event_pid='{$data['property_id']}',event_type='self'"; die();
            $conn->query("INSERT INTO lhk_ical_events SET start_date='{$data['checkin']}',admin_id='1',booking_status='1',text='Booked',added_date='{$today}',end_date='{$data['checkout']}',event_pid='{$data['property_id']}',event_type='self'");

          }

        

        //UPDATE THE booking details table
      $sn = $data['book_status'] == '0'?1:0;
      // "UPDATE lhk_booking_details SET book_status='{$sn}' where bok_det_id='{$booking_id}'"; 
      $conn->query("UPDATE lhk_booking_details SET book_status='{$sn}' where bok_det_id='{$booking_id}'");
      }   
      
    }
    ?>



     <div class="content-wrapper">

    <section class="content-header" style="overflow-y: scroll;">

      <h1> Booking Details <small> your  Current Details</small></h1>

      <hr>

<?php  

 $i = 1;

$q=mysqli_query($conn,"select * from lhk_booking_details order by bok_det_id DESC");

$num = mysqli_num_rows($q);

?>

<?php if($num!=""){ ?>

<h3 class="head text-center">Booking Request List</h3>

        <table class="responsive-table" id="example1">

    

    <thead>

      <tr>

         <th scope="col">S.No.</th>

         <!--<th scope="col">Property ID</th>-->

        <th scope="col">Property Name</th>

          <th scope="col">Check In</th>

        <th scope="col">Check Out</th>

        <th scope="col">Client Name</th>

       <th scope="col">Client Email</th>

	   <th scope="col">Phone</th>

	   <th scope="col">Amount</th>

	   <th scope="col">Booking Request Date</th>

	   <th scope="col">Booking Status</th>

	   <th scope="col">View Details</th>

           <th scope="col">Delete</th>

	 

       

      </tr>

    </thead>

    

    <tbody>

   

   <?php



		while($show11 = mysqli_fetch_assoc($q))

		  {

                        $p_id=$show11['property_id'];

			$p_name=$show11['prop_name'];

			$c_in=$show11['checkin'];

			$c_out=$show11['checkout'];

			$cname=$show11['name'];

			$email=$show11['email'];

			$phone=$show11['phone'];

			$amount=$show11['tot_amt'];

			$b_date=$show11['added_date'];

		  

		

	?>



      <tr>

      <td><?php echo $i ;?></th>

       <!--<td><?php echo $p_id ;?></th>-->

       <th scope="row"><?php echo $p_name ;?></th>

        <td><?php echo $c_in; ?> </td>

        <td><?php echo $c_out;?></td>

        <td><?php echo $cname; ?></td>

		<td><?php echo $email; ?></td>

		<td><?php echo $phone; ?></td>

		<td><?php echo "$".$amount; ?></td>

		<td><?php echo $b_date; ?></td>

		<!--<td><?php if($show11['payment_type']==2){ ?><i class="fa fa-credit-card" aria-hidden="true"></i>

 <?php }else{ ?> - <?php } ?></td>-->

		
    <td>
      <form name="" action="" method="POST">
        <button name="status" type="submit" value="<?php echo @$show11['bok_det_id']; ?>"><?php echo $show11['book_status'] == 0?'Pending':'Confimed'; ?></button>
      <form>
    </td>
	  <td><a href="#" onclick="calender(<?php echo $show11['bok_det_id']; ?>)" >View Details »</a></td>

     <form action="" method="post">
     <?php if($show11['book_status'] == 0){ ?>
        <td data-title="Delete" ><input type="hidden" name="delete_property" value="<?php echo @$show11['bok_det_id']; ?>"><button type="submit" name="delete_pro_button" onClick="return check()"><i class="fa fa-trash"></i></button></td>
     <?php  } ?>
        </form>

        </tr>		

		 <!-- Modal -->

              <div class="modal fade" id="myModal<?php echo $show11['bok_det_id']; ?>" role="dialog">

                <div class="modal-dialog">      

                  <!-- Modal content-->

                  <div class="modal-content">

                    <div class="modal-header">

                      <button type="button" class="close" data-dismiss="modal">&times;</button>

                      

                    </div>

                    <div class="modal-body booking-dt">

                     <div class="row">

                   

                     <div class="col-md-12">

					 

					 

		<div class="booking-pop">			 

          <p><span>Property Name : </span> <?php echo $p_name?$p_name:"Not Available" ;?></p>

          <p><span>Name : </span> <?php echo $cname; ?></p>

          <p><span>Email : </span> <?php echo $email; ?></p>

          <p><span>Phone : </span> <?php echo $phone; ?></p>
          

          <p><span>CheckIn date : </span> <?php echo $c_in; ?></p>

          <p><span>CheckOut date : </span> <?php echo $c_out; ?></p>

		  <p><span>Discount : </span>$ <?php echo $show11['discount']==1?0:$show11['discount']; ?></p>

		  <p><span>Total Night : </span> <?php echo $show11['totalnight']; ?></p>

          <p><span>Guest : </span> <?php echo $show11['no_of_ppl']; ?></p>

          <p><span>Booking date : </span> <?php echo $b_date; ?></p>

          <p><span>Paid Amount : </span> <?php echo "$".$amount; ?></p>

		  <?php if($show11['card_type']){ ?> <p><span>Card Type : </span> <?php echo $show11['card_type']; ?></p> <?php } ?>

		  <?php if($show11['card_no']){ ?> <p><span>Card No : </span> <?php echo $show11['card_no']; ?></p> <?php } ?>

		  <?php if($show11['cvv']){ ?> <p><span>CVV : </span> <?php echo $show11['cvv']; ?></p> <?php } ?>

		  <?php if($show11['expire_month'] AND $show11['year']){ ?> <p><span>Expiry Date : </span> <?php echo $show11['expire_month'].'/'.$show11['year']; ?></p> <?php } ?>

		  <?php if($show11['city']){ ?> <p><span>City : </span> <?php echo $show11['city']; ?></p> <?php } ?>

		  <?php if($show11['state']){ ?> <p><span>State : </span> <?php echo $show11['state']; ?></p> <?php } ?>

		 

		  <?php if($show11['zip']){ ?> <p><span>zip : </span> <?php echo $show11['zip']; ?></p> <?php } ?>

		  

		  <?php if($show11['addr']){ ?> <p><span>Address : </span> <?php echo $show11['addr']; ?></p> <?php } ?>
 
  
		  <p><span>Message:</span> <?php echo $show11['msg']; ?></p>

		</div>	

		
			
                    </div>

                    </div>



                    </div>

                    <div class="modal-footer">

                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>

                  </div>          

                </div>

              </div> 

	  

		

		

		

		

		

		

		

		  <?php 

                    $i++;

                    } 

                   ?>

     </tbody>

	 </table>

<?php 

} 

else

{

    echo "<p><h4>No booking requests has been done yet.</h4></p>";

}

?>

 <div class="tab-pane fade" id="prototyping">



<script src="framework/js/bootstrap.min.js"></script> 

<script src="framework/js/custom.js"></script> 

<script src="framework/js/app.min.js"></script> 

<script src="framework/ckeditor/ckeditor.js"></script>

<script src="framework/js/dropdown.js"></script>

<script src="framework/js/select.js"></script>





	<!---  ################## Table JS --->

	<!-- DATA TABES SCRIPT -->

    <script src="framework/js/jquery.dataTables.min.js" type="text/javascript"></script>

    <script src="framework/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

    <script type="text/javascript">

      $(function () {

        $("#example1").dataTable();

      });

    </script>

	<!---  ################## End Table JS --->

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

if(isset($_POST['delete_pro_button']))

{

	$delete_id = $_POST['delete_property'];

	$admin_id = $_SESSION['admin_id'];

	

	$delete = mysqli_query($conn, "DELETE FROM lhk_booking_details WHERE bok_det_id=$delete_id");

	if($delete)

		{

			echo "<script>alert('Deleted Successfully.');</script>";

			?>

			<script>

			window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>';

            </script>

            <?php

		}

}

?>