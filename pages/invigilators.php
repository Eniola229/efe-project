<?php


$current_date = date('Y-m-d');
include('../connect.php');
session_start();
extract($_POST);

$exdate = null;
$start = null;
$end = null;

$s1 = "SELECT * FROM `exam` WHERE id='".$exam_id."'";
$sr = $conn->query($s1);
while ($sres = mysqli_fetch_array($sr)) {
$exdate = $sres['exam_date'];
$start = $sres['start_time'];
$end =  $sres['end_time'];

}

   $sql = "INSERT INTO `allot`(`class_id`,`room_type_id`,`subject_id`,`exam_id`,`added_date`, 
   `exam_date`,`start_time`,`end_time`,`room_id`,`invigilator1`,`cap`) VALUES ('$class_id','$room_type_id','$subject_id','$exam_id','$current_date','$exdate','$start','$end','$room','$inv','$class_capacity')";

 if ($conn->query($sql) === TRUE) {
 	 
      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_allotment.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_allotment.php";
</script>
<?php } ?>










