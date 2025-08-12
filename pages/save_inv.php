<?php

session_start();
$current_date = date('Y-m-d');
include('../connect.php');
extract($_POST);

$c = trim($code);
   $sql = "INSERT INTO `tbl_inv` (`invigilator`,`invcode`,`invfal`,`invdept`) VALUES ('$inv','$code','$fal','$dept')";
   $sq2 = "INSERT INTO `tbl_history` (`invigilator`,`invcode`,`invfal`,`invdept`) VALUES ('$inv','$c','$fal','$dept')";


 if ($conn->query($sql) === TRUE) {
 	$conn->query($sq2);

      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_assign.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_assign.php";
</script>
<?php } ?>



