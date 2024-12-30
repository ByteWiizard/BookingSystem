<?php
include_once('include/db.php');
$files = $pre_fix."files";
if(isset($_POST['name']))
{
$t= $_POST['name'];
unlink("../uploads/".$t);
$del = mysqli_query($conn,"DELETE FROM ".$files." WHERE file_name='".$t."' AND admin_id=1");
}
?>