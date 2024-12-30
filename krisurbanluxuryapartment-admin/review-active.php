<?php include('include/db.php');



      $update =$conn->query("UPDATE lhk_reviews_detail SET status=1 WHERE id ='".$_REQUEST['id']."'");

     if($update){
             header('Location:review.php');
 }
?>
   
       
     