<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>

<?php
// This page is meant for administrators only
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script type='text/javascript'>document.location='index.php';</script>";
}

include('connect.php');

// Process form submission for assigning invigilators
if(isset($_POST['submit'])) {
    $exam_id = $_POST['exam_id'];
    $invigilator_ids = $_POST['invigilator_ids'];
    
    // First check if the exam_invigilators table exists
    $table_check = $conn->query("SHOW TABLES LIKE 'exam_invigilators'");
    
    if($table_check->num_rows == 0) {
        // Create table if it doesn't exist
        $create_table = "CREATE TABLE IF NOT EXISTS `exam_invigilators` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `exam_id` int(11) NOT NULL,
            `invigilator_id` int(11) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        
        if($conn->query($create_table) === TRUE) {
            $_SESSION['success'] = "Invigilator assignment table created successfully";
        } else {
            $_SESSION['error'] = "Error creating table: " . $conn->error;
        }
    }
    
    // Clear existing assignments for this exam
    $conn->query("DELETE FROM exam_invigilators WHERE exam_id = '$exam_id'");
    
    // Insert new assignments
    $success = true;
    foreach($invigilator_ids as $invigilator_id) {
        $insert = "INSERT INTO exam_invigilators (exam_id, invigilator_id) 
                  VALUES ('$exam_id', '$invigilator_id')";
        
        if($conn->query($insert) !== TRUE) {
            $success = false;
            $_SESSION['error'] = "Error assigning invigilators: " . $conn->error;
            break;
        }
    }
    
    if($success) {
        $_SESSION['success'] = "Invigilators assigned successfully";
    }
}

// Get all exams
$sql_exams = "SELECT * FROM exam ORDER BY exam_date DESC";
$result_exams = $conn->query($sql_exams);

// Get all teachers/invigilators
$sql_teachers = "SELECT * FROM tbl_teacher ORDER BY id ASC";
$result_teachers = $conn->query($sql_teachers);
?>

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Assign Invigilators</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Assign Invigilators</li>
            </ol>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>Assign Invigilators to Exams</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label>Select Exam:</label>
                                    <select name="exam_id" class="form-control" id="exam-select" required>
                                        <option value="">Select Exam</option>
                                        <?php 
                                        if($result_exams->num_rows > 0) {
                                            while($exam = $result_exams->fetch_assoc()) {
                                                echo "<option value='".$exam['id']."'>".$exam['name']." - ".
                                                     (isset($exam['exam_date']) ? $exam['exam_date'] : $exam['added_date']).
                                                     " (".$exam['start_time']."-".$exam['end_time'].")</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Select Invigilators:</label>
                                    <select name="invigilator_ids[]" class="form-control" multiple required>
                                        <?php 
                                        if($result_teachers->num_rows > 0) {
                                            while($teacher = $result_teachers->fetch_assoc()) {
                                                echo "<option value='".$teacher['id']."'>".$teacher['fname']." ".$teacher['lname']."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <small class="form-text text-muted">Hold Ctrl/Cmd key to select multiple invigilators</small>
                                </div>
                                
                                <button type="submit" name="submit" class="btn btn-primary">Assign Invigilators</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Current Assignments Section -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>Current Assignments</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="assignmentTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Exam Name</th>
                                        <th>Exam Date</th>
                                        <th>Time</th>
                                        <th>Hall</th>
                                        <th>Assigned Invigilators</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Check if exam_invigilators table exists
                                $table_check = $conn->query("SHOW TABLES LIKE 'exam_invigilators'");
                                
                                if($table_check->num_rows > 0) {
                                    // Query to get all exams with their assigned invigilators
                                    $sql = "SELECT e.*, GROUP_CONCAT(CONCAT(t.fname, ' ', t.lname) SEPARATOR ', ') as invigilators
                                            FROM exam e
                                            LEFT JOIN exam_invigilators ei ON e.id = ei.exam_id
                                            LEFT JOIN tbl_teacher t ON ei.invigilator_id = t.id
                                            GROUP BY e.id
                                            ORDER BY e.exam_date DESC";
                                    
                                    $result = $conn->query($sql);
                                    
                                    if($result && $result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo isset($row['exam_date']) ? $row['exam_date'] : $row['added_date']; ?></td>
                                            <td><?php echo $row['start_time'].'-'.$row['end_time']; ?></td>
                                            <td><?php echo isset($row['hall']) ? $row['hall'] : 'N/A'; ?></td>
                                            <td><?php echo !empty($row['invigilators']) ? $row['invigilators'] : 'No invigilators assigned'; ?></td>
                                        </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No exam assignments found.</td></tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>Exam-invigilator relationship table not yet created.</td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
    </h3>
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
    </h3>
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

// Show current assignments when an exam is selected
document.getElementById('exam-select').addEventListener('change', function() {
    const examId = this.value;
    
    // You can implement AJAX here to load currently assigned invigilators
    // For now, we'll just highlight the row in the table
    
    const rows = document.querySelectorAll('#assignmentTable tbody tr');
    rows.forEach(row => {
        row.style.backgroundColor = '';
    });
    
    if(examId) {
        // This is a placeholder - in a real implementation, you'd highlight the correct row
        // based on the exam ID
    }
});
    </script>
