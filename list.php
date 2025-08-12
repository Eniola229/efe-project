<?php include('head.php');?>
<?php include('header.php');?>
<?php include('teacher_sidebar.php');
 date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');
 ?>
<div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">My Exam Invigilation Schedule</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Exam Schedule</li>
                    </ol>
                </div>
            </div>
          
            <div class="container-fluid">                    
               <div class="card">
                            <div class="card-body">
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Course Title</th>
                                                <th>Exam Date</th>
                                                <th>Time</th> 
                                                <th>Hall</th>
                                                <th>Class</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';
                                    
                                    // Get current invigilator's name from session
                                    $invigilator_name = $_SESSION["fname"];
                                    
                                    // Query to get all exam schedules for this invigilator
                                    $sql = "SELECT e.*, c.classname 
                                           FROM exam e
                                           LEFT JOIN tbl_class c ON e.class_id = c.id
                                           WHERE e.invigilator_id = '$invigilator_name'
                                           ORDER BY e.exam_date ASC";
                                           
                                    $result = $conn->query($sql);

                                    if($result && $result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row['Course_Code']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['exam_date']; ?></td>
                                                <td><?php echo $row['start_time'].' - '.$row['end_time']; ?></td>
                                                <td><?php echo $row['hall']; ?></td>
                                                <td><?php echo $row['classname']; ?></td>
                                            </tr>
                                    <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No exam invigilation schedules found.</td></tr>";
                                    }
                                    ?>
                                        </tbody>
                                    </table>
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