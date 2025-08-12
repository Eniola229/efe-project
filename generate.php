
<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php include('connect.php');?>


 <?php
$t = null;
$date = date('Y-m-d') ;
if(isset($_POST['btn_save'])){

$date = $_POST['date'];
$rand = $_POST['period'];
$type = $_POST['type'];

$check = "SELECT * FROM `tbl_hall` ";
$count = $conn->query($check);
$r = 0;
while ($row = mysqli_fetch_array($count)) {
  
  $r = $r + $row['noi'];

}


$c1 = "SELECT * FROM `tbl_teacher` order by `id` limit $r ";
$result = $conn->query($c1);
$invigilator = null;


while ($row = mysqli_fetch_array($result)) {

$invigilator = $row['id'];


$val = (int) substr($date,8,9);
$cv = $val - 1;
$vc = substr(date('Y-m-d'),0,8) ;
$dat  = $vc.$cv;


$c3 = "SELECT * FROM `tbl_generate` where `invigilator` = '$invigilator' and `date` = '$dat'  ";
$inv2 = $conn->query($c3);
$v2=  mysqli_num_rows($inv2);

if ($v2 > 0) {
continue;

}else{


$c2 = "SELECT * FROM `tbl_generate` where `invigilator` = '$invigilator' and `date` = '$date' and `period` = '$rand' ";
$inv = $conn->query($c2);
$v=  mysqli_num_rows($inv);

if ($v > 0) {

continue;
	
}else{
	$invigilator = $row['id'];
}

}


ch:
$sq = "SELECT * FROM `tbl_hall` order by rand() limit 1";
$re = $conn->query($sq);
$hall = null;
while ($row3 = mysqli_fetch_array($re)) {


$hall  = $row3['hallname'];
$f = (int)$row3['noi'];

$checkha = "SELECT *  FROM `tbl_generate` where `hallname` = '$hall' and  `period` ='$rand' and `date` = '$date' ";
$hre = $conn->query($checkha);
$hr=mysqli_num_rows($hre);



if ($hr == $row3['noi']  ) {

goto ch;
	
}else{
	$hall  = $row3['hallname'];
}

}


$sql = "SELECT `dcode` FROM `tbl_dept` order by RAND() limit 1";
$res = $conn->query($sql);
$code = null;
while ($row2 = mysqli_fetch_array($res)) {

if($row['assistant'] == '0'){

code:

$code  = $row2['dcode'].'-'.mt_rand(0000,0150);

$sql7 = "SELECT `code` FROM `tbl_generate` where code  = '$code' ";
$res7 = $conn->query($sql7);

if (mysqli_num_rows($res7) > 0) {
  
  goto code;
}else{
$code  = $row2['dcode'].'-'.mt_rand(0000,0150);

}


}else{

code1:

$code  = 'A'.$row2['dcode'].'-'.mt_rand(0000,0150);

$sql9 = "SELECT `code` FROM `tbl_generate` where `code`  = '$code' ";
$res9 = $conn->query($sql9);

if (mysqli_num_rows($res9) > 0) {
  
  goto code1;
}else{

 $code  = 'A'.$row2['dcode'].'-'.mt_rand(0000,0150);
}


}

}


$s = "INSERT INTO `tbl_generate`(`invigilator`,`hallname`,`code`,`date`,`period`,`type`)
 VALUES ('$invigilator','$hall','$code','$date','$rand','$type')";
$t = $conn->query($s);


}

if($t){
$_SESSION['success']='Record Successfully Added'; 
}else{
	$_SESSION['error']='users have been alloted for this date';
}
?> 



<?php  } ?>

        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> Generate Schedule</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Generate Schedule</li>
                    </ol>
                </div>
            </div>
           
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-8" style="    margin-left: 10%;">
                        <div class="card">
                            
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" name="classform" enctype="multipart/form-data">

                                   <input type="hidden" name="currnt_date" class="form-control" value="<?php echo $currnt_date;?>">


                                      <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Exam Type</label>
                                                <div class="col-sm-9">
                                                    <select type="text" name="type" id="class_id" class="form-control"   placeholder="Class" required="">
                                                        <option value="full time">Full Time</option>
                                                        <option value="part time">Part Time</option>
                                                            
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Period</label>
                                                <div class="col-sm-9">
         <select class="form-control" name="period">
         	<option value="morning">Morning</option>
         	<option value="afternoon">Afternoon</option>
         	<option value="evening">Evening</option>
         </select>
                                                </div>
                                            </div>
                                        </div>
                                   

                                 



                                   <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Date</label>
                                                <div class="col-sm-9">
         <input type="date" name="date" class="form-control" placeholder="Date" id="code"  required="" />
                                                </div>
                                            </div>
                                        </div>

                                       
                                        <button type="submit" name="btn_save" class="btn btn-primary btn-flat m-b-30 m-t-30">Generate</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>

<?php include('footer.php');?>


<link rel="stylesheet" href="popup_style.css">
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>