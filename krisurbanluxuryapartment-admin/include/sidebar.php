<?php include_once('include/functions.php');?>
<?php $current = basename($_SERVER['PHP_SELF']); ?>
<?php
error_reporting(0);
$profile_details = $pre_fix."profile_details";
$admin_id = $_SESSION['admin_id'];
  $fetch = mysqli_query($conn,"SELECT * FROM ".$profile_details." WHERE admin_id='".$admin_id."'");
	$num = mysqli_num_rows($fetch);
  while($show = mysqli_fetch_assoc($fetch))
  {
	$profile_img = $show['profile_img'];
	$profile_name=$show['profile_name'];
	$website_name=$show['website_name'];
  }
?>
<aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
            <?php if(@$profile_img==""){ ?>
              <img src="framework/img/user2-160x160.jpg" class="img-circle" alt="User Image">
              <?php }else{ ?>
      			<img src="<?php echo @$profile_img ?>" class="img-circle" alt="User Image">
    		  <?php } ?>
            </div>
            <div class="pull-left info">
              <p><?php echo @$profile_name ?></p>
              <i class="fa fa-circle text-success"></i> Online
            </div>
          </div>
      
          
         
          <ul class="sidebar-menu">
            <?php if($current=='index.php'){ ?>
            <li class="active">
            <?php } else { ?>
            <li>
            <?php } ?>
             <a href="index.php"><i class="fa fa-tasks" aria-hidden="true"></i> 
             <span>Dashboard</span>
             </a>
             </li>

             <?php if($current=='about_property.php' || $current=='about.php'){ ?>
                <li class="active">
            <?php } else { ?>
                <li>
            <?php } ?>
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#about"><i class="fa fa-home" aria-hidden="true"></i><span>About</span><i class="fa fa-angle-left pull-right"></i></a>
            </li>
            <div id="about" class="collapse">
                <ul class="sidebar-menu">
                    <?php if($current=='about.php'){ ?>
                        <li class="active">
                    <?php } else { ?>
                        <li>
                    <?php } ?>
                        <!--<a href="about.php"><i class="fa fa-home" aria-hidden="true"></i><span>About Property</span></a>-->
                    </li>

                    <?php if($current=='about_property.php'){ ?>
                        <li class="active">
                    <?php } else { ?>
                        <li>
                    <?php } ?>
                        <a href="about_property.php"><i class="fa fa-home" aria-hidden="true"></i><span>About Owner</span></a>
                    </li>
                </ul>
            </div>


              <?php if(($current=='property_listing.php')){ ?>
            <li class="active">
            <?php } else { ?>
            <li>
            <?php } ?>
             <a href="property_listing.php"><i class="fa fa-building" aria-hidden="true"></i> 
             <span>Property</span>
             </a>
             </li>
 	    <?php if($current=='area_information.php'){ ?>
            <li class="active">
            <?php } else { ?>
            <li>
            <?php } ?>
             <a href="area_information.php"><i class="fa fa-cog"></i> 
             <span>Attractions</span>
             </a>
             </li>

             <?php if($current=='property_ical_links.php'){ ?>
            <li class="active">
            <?php } else { ?>
            <li>
            <?php } ?>
             <a href="property_ical_links.php"><i class="fa fa-calendar" aria-hidden="true"></i> 
             <span>Ical Link</span>
             </a>
             </li>
            
             <?php if($current=='contact_details.php'){ ?>
            <li class="active">
            <?php } else { ?>
            <li>
            <?php } ?>
             <a href="contact_details.php"><i class="fa fa-phone"></i> 
             <span>Contact</span>
             </a>
             </li>
             
            <?php if($current=='review.php'){ ?>
            <li class="active">
            <?php } else { ?>
            <li>
            <?php } ?>
             <a href="review.php"><i class="fa fa-users" aria-hidden="true"></i></i> 
             <span>Reviews</span>
             </a>
             </li>
            <?php if($current=='social_links.php'){ ?>
            <li class="active">
            <?php } else { ?>
            <li>
            <?php } ?>
             <a href="social_links.php"><i class="fa fa-share-square-o" aria-hidden="true"></i></i> 
             <span>Social Links</span>
             </a>
             </li>



            

              
             <?php if($current=='payment_details.php' || $current=='booking_details.php' || $current=='password.php'){ ?>
                <li class="active">
            <?php } else { ?>
                <li>
            <?php } ?>
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#demo"><i class="fa fa-cog" aria-hidden="true"></i><span>Setting</span><i class="fa fa-angle-left pull-right"></i></a>
            </li>
            <div id="demo" class="collapse">
                <ul class="sidebar-menu">
                    <?php if($current=='payment_details.php'){ ?>
                        <li class="active">
                    <?php } else { ?>
                        <li>
                    <?php } ?>
                        <a href="payment_details.php"><i class="fa fa-paypal" aria-hidden="true"></i><span>Payments</span></a>
                    </li>

                    <?php if($current=='booking_details.php'){ ?>
                        <li class="active">
                    <?php } else { ?>
                        <li>
                    <?php } ?>
                        <a href="booking_details.php"><i class="fa fa-book" aria-hidden="true"></i><span>Booking Requests</span></a>
                    </li>

                    <?php if($current=='password.php'){ ?>
                        <li class="active">
                    <?php } else { ?>
                        <li>
                    <?php } ?>
                        <a href="password.php"><i class="fa fa-key" aria-hidden="true"></i><span>Change Login Details</span></a>
                    </li>
                </ul>
            </div>
            </div>
        </ul>
    </section>

</aside>