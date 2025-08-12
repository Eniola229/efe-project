<?php 
// First, ensure session is started at the top
session_start();

// Check if invigilator is logged in
if(!isset($_SESSION["id"]) || !isset($_SESSION["temail"])) {
    // Redirect to login page if not logged in
    echo "<script>location.href='invigilator.php';</script>";
    exit;
}

include('head.php');
include('header2.php');
include('teacher_sidebar.php'); 
  
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');

$sql_currency = "select * from manage_website"; 
$result_currency = $conn->query($sql_currency);
$row_currency = mysqli_fetch_array($result_currency);

// Get logged in invigilator's info from session
$invigilator_id = $_SESSION["id"];
$invigilator_fname = $_SESSION["fname"];
$invigilator_lname = $_SESSION["lname"];
$invigilator_fullname = $invigilator_fname . ' ' . $invigilator_lname;
?>    
      
<div class="page-wrapper">
    
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Dashboard</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
    
    <div class="container-fluid">
        <!-- Welcome Card -->
        <div class="card">
            <div class="card-body">
                <h3>Welcome, <?php echo $invigilator_fullname; ?>!</h3>
                <h4><p>Here are your invigilation duties. Make sure to be at the venue at least 30 minutes before the exam starts.</p></h4>
            </div>
        </div>
        
        <!-- Today's Schedule Section -->                    
        <div class="card">
            <div class="card-header">
                <h3><i class="fa fa-clock-o"></i> Today's Invigilation Schedule</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive m-t-40">
                    <table id="todayTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <tr>
                                                <th>Course Code</th>
                                                <th>Course Title</th>
                                                <th>Time</th>
                                                <th>Date</th> 
                                                <th>Hall</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';

                                    $sql = "SELECT * FROM exam ORDER BY RAND() LIMIT 1";
                                    $result = $conn->query($sql);

                                    if($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();

                                      ?>
                                            <tr>
                                            <td><?php echo $row['Course_Code']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['start_time'].'-'.$row['end_time']; ?></td>
                                                <td><?php echo $row['exam_date']; ?></td>
                                                <td><?php echo $row['hall']; ?></td>

                                            </tr>
            
                                            </tr>
                                          <?php 
                                        }
                                       else    {
                                        echo "<tr><td colspan='4'>No Allocations found for today.</td></tr>";

                                    }
                                    ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
        </div>
                                </div>
            




        
        
<!-- Add DataTables JS -->
<script>
    $(document).ready(function() {
        $('#todayTable').DataTable({
            "paging": false,
            "ordering": true,
            "info": false
        });
        
        
    });
</script>
            
<?php include('footer.php'); ?>

