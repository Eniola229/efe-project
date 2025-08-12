<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>   
<?php
 date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');

 $sql_currency = "select * from manage_website"; 
             $result_currency = $conn->query($sql_currency);
             $row_currency = mysqli_fetch_array($result_currency);
?>    

<style>
@media print {
    button, .btn, a {
        display: none !important;
    }
    body {
        margin: 20px;
    }
    h2 {
        text-align: center;
    }
}
</style>
      
        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h2 class="text-primary">Dashboard</h2> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
                      <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-primary p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-bag f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <?php $sql="SELECT COUNT(*) FROM `tbl_teacher`";
                                $res = $conn->query($sql);
                                $row=mysqli_fetch_array($res);?> 
                                    <h2 class="color-white"><?php echo $row[0];?></h2>
                                    <p class="m-b-0">Total Lecturers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-pink p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-comment f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                <?php $sql="SELECT COUNT(*) FROM `room`";
                                $res = $conn->query($sql);
                                $row=mysqli_fetch_array($res);?>
                                    <h2 class="color-white"><?php echo $row[0];?></h2>
                                    <p class="m-b-0">Total Halls</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-danger p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-vector f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <?php $sql="SELECT COUNT(*) FROM `tbl_class`";
                                $res = $conn->query($sql);
                                $row=mysqli_fetch_array($res);?>
                                    <h2 class="color-white"><?php echo $row[0];?></h2>
                                    <p class="m-b-0">Total Classes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-location-pin f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                     <?php $sql="SELECT COUNT(*) FROM `exam`";
                                $res = $conn->query($sql);
                                $row=mysqli_fetch_array($res);?> 
                                    <h2 class="color-white"><?php echo $row[0];?></h2>
                                    <p class="m-b-0">Total Exams</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card">
    <div class="card-body">
        <button onclick="printSchedule()" class="btn btn-success">Print Schedule</button>

        <div class="table-responsive m-t-40" id="scheduleArea">
            <h2 class="text-center mb-4">EXAMINATION SCHEDULE</h2>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th rowspan="2">DATE / TIME</th>
                        <th rowspan="2">LEVEL</th>
                        <th colspan="3">8 – 11 am</th>
                        <th colspan="3">11:30 – 2:30 pm</th>
                        <th colspan="3">3 – 6 pm</th>
                    </tr>
                    <tr>
                        <th>Course</th>
                        <th>Hall</th>
                        <th>Invigilator</th>

                        <th>Course</th>
                        <th>Hall</th>
                        <th>Invigilator</th>

                        <th>Course</th>
                        <th>Hall</th>
                        <th>Invigilator</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'connect.php';

                    $sql = "SELECT * FROM `exam` ORDER BY exam_date, start_time";
                    $result = $conn->query($sql);

                    $grouped = [];

                    while ($row = $result->fetch_assoc()) {
                        $date = $row['exam_date'];
                        $code = strtoupper($row['Course_Code']);

                        // Derive LEVEL from Course Code
                        if (str_contains($code, 'ND1') || str_contains($code, 'ND I')) {
                            $level = 'ND I';
                        } elseif (str_contains($code, 'ND2') || str_contains($code, 'ND II')) {
                            $level = 'ND II';
                        } elseif (str_contains($code, 'HND1') || str_contains($code, 'HND I')) {
                            $level = 'HND I';
                        } elseif (str_contains($code, 'HND2') || str_contains($code, 'HND II')) {
                            $level = 'HND II';
                        } else {
                            $level = 'ND I'; // fallback
                        }

                        $time = strtotime($row['start_time']);
                        $block = '';

                        if ($time >= strtotime("08:00") && $time < strtotime("11:00")) {
                            $block = 'morning';
                        } elseif ($time >= strtotime("11:30") && $time < strtotime("14:30")) {
                            $block = 'midday';
                        } elseif ($time >= strtotime("15:00") && $time < strtotime("18:00")) {
                            $block = 'afternoon';
                        }

                        $grouped[$date][$level][$block] = $row;
                    }

                    $dayCount = 1;
                    foreach ($grouped as $date => $levels) {
                        $rowspan = count($levels);
                        $dateLabel = "<strong>DAY $dayCount</strong><br>" .
                                     date("d/m/Y", strtotime($date)) . "<br>" .
                                     date("l", strtotime($date));
                        $first = true;

                        foreach ($levels as $level => $slots) {
                            echo "<tr>";
                            if ($first) {
                                echo "<td rowspan='$rowspan'>$dateLabel</td>";
                                $first = false;
                            }

                            echo "<td><strong>$level</strong></td>";

                            foreach (['morning', 'midday', 'afternoon'] as $slot) {
                                if (isset($slots[$slot])) {
                                    $exam = $slots[$slot];
                                    echo "<td>{$exam['Course_Code']}<br>{$exam['name']}</td>";
                                    echo "<td>{$exam['hall']}</td>";
                                    echo "<td>{$exam['lecturer']}</td>";
                                } else {
                                    echo "<td></td><td></td><td></td>";
                                }
                            }

                            echo "</tr>";
                        }
                        $dayCount++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


        </div>
<?php
?>

<?php
?>

<div class="card" id="ReportArea">
    <button onclick="printReport()" style="width: 20%;" class="btn btn-success">Print Report</button>

    <h2><i class="fa fa-balance-scale"></i> Invigilator Workload Report</h2>
    <div class="card-body">
        <?php
        include 'connect.php';
        
        $today = date('Y-m-d');
        $past_date = date('Y-m-d', strtotime('-7 days'));
        $future_date = date('Y-m-d', strtotime('+7 days')); 
        
        $check_sql = "SELECT COUNT(*) as total FROM exam";
        $check_result = $conn->query($check_sql);
        $check_row = $check_result->fetch_assoc();
        $total_assignments = $check_row['total'];
        
        if ($total_assignments == 0) {
            echo '<div class="alert alert-warning">No assignments found in the system. Please add some exam assignments first.</div>';
        } else {
            echo '<div class="alert alert-info">Showing assignments from ' . $past_date . ' to ' . $future_date . 
                 ' (Total assignments in system: ' . $total_assignments . ')</div>';
            
            $sql = "SELECT 
                    t.id, 
                    CONCAT(t.tfname, ' ', t.tlname) as name,
                    t.role,
                    (SELECT COUNT(*) FROM exam WHERE lecturer = t.id) as total_assignments,
                    (SELECT COUNT(*) FROM exam 
                     WHERE lecturer = t.id 
                     AND exam_date BETWEEN '$past_date' AND '$future_date') as recent_assignments,
                    (SELECT GROUP_CONCAT(exam_date ORDER BY exam_date SEPARATOR ', ') 
                     FROM exam 
                     WHERE lecturer = t.id
                     AND exam_date BETWEEN '$past_date' AND '$future_date') as assignment_dates
                    FROM tbl_teacher t
                    ORDER BY recent_assignments DESC, name ASC";
            
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                echo '<div class="table-responsive">';
                echo '<table class="table table-bordered table-striped">';
                echo '<thead><tr>
                        <th>Invigilator</th>
                        <th>Role</th>
                        <th>Total Assignments</th>
                        <th>Recent Assignments (±7 days)</th>
                        <th>Assignment Dates</th>
                      </tr></thead>';
                echo '<tbody>';
                
                $has_recent_assignments = false;
                
                while($row = $result->fetch_assoc()) {
                    // Format the role with proper capitalization
                    $role = ucfirst(htmlspecialchars($row['role'] ?? 'academic'));
                    
                    // Format the dates to be more readable if they exist
                    $dates = $row['assignment_dates'];
                    if (!empty($dates)) {
                        $formatted_dates = [];
                        $date_array = explode(', ', $dates);
                        foreach ($date_array as $date) {
                            if (!empty($date)) {
                                $formatted_dates[] = date('D, M d', strtotime($date));
                            }
                        }
                        $dates = implode(' • ', $formatted_dates);
                        $has_recent_assignments = true;
                    } else {
                        $dates = 'None';
                    }
                    
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                    echo '<td>' . $role . '</td>';
                    echo '<td>' . (int)$row['total_assignments'] . '</td>';
                    echo '<td>' . (int)$row['recent_assignments'] . '</td>';
                    echo '<td>' . $dates . '</td>';
                    echo '</tr>';
                }
                
                echo '</tbody></table></div>';
                
                if(!$has_recent_assignments) {
                    echo '<div class="alert alert-warning mt-3">No recent invigilator assignments (within ±7 days).</div>';
                }
            } else {
                echo '<div class="alert alert-warning">No invigilators found in the system.</div>';
            }
        }
        ?>
        
        <!-- Script to highlight cells with zero assignments -->
        <script>
        $(document).ready(function() {
            $('td:contains("0")').each(function() {
                if ($(this).text() === "0") {
                    $(this).css('background-color', '#f8d7da');
                }
            });
        });
        </script>
    </div>
</div>

                        <?php include('footer.php');?>
<script>
function printSchedule() {
    var printContents = document.getElementById('scheduleArea').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // reload to restore events & page state
}
function printReport() {
    var printContents = document.getElementById('ReportArea').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // reload to restore events & page state
}
</script>
