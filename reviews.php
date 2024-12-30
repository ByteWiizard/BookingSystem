<?php include 'header.php';?>
<div class='page-title'>
	<div id='particles-js-pagetitle'></div>
	<div class='container'>
		<h1>List Property</h1><h6>Vancouver Furnished Rentals</h6>
	</div>
</div>
<div class="section-block" style="margin-bottom:100px"> 
		<div class="container">
	 
<div class="blog-comments">
		<?php
		$review = mysqli_query($conn,"SELECT * FROM lhk_reviews_detail ");
			  while($revInfo = mysqli_fetch_assoc($review)){
		?>
			<div class="blog-comment-user">
				<div class="row">
					<div class="col-xs-1"><img alt="comment-user" src="https://image.flaticon.com/icons/png/512/149/149071.png"></div>
					<div class="col-xs-11">
						<h6><?php echo $revInfo['heading'];?></h6> 
						<?php echo html_entity_decode($revInfo['c_review']);?>
						<h6 style="font-size: 15px;font-weight:800"><?php echo $revInfo['c_name'];?>  &nbsp;&nbsp;&nbsp;&nbsp;   <?php  echo $revInfo['sdate']; ?></h6>
					</div>
				</div>
			</div>
		<?php } ?>			
		</div>
					
		</div>				   
	</div>
 <?php include 'footer.php';?>