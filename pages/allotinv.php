<?php

$current_date = date('Y-m-d');
include('../connect.php');
extract($_POST);
   $sql = "INSERT INTO `tbl_allot` (`hall`,`invcode`,`date`,`fal`,`data`,`dept`,`period`) VALUES ('$hall','$inv','$current_date','$fal','$data','$dept','$period')";
  
 if ($conn->query($sql) === TRUE) {


      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_allot.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_allot.php";
</script>
<?php } ?>



