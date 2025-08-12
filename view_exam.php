<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');

if(isset($_GET['id']))
{ ?>
<div class="popup popup--icon -question js_question-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Sure
    </h1>
    <p>Are You Sure To Delete This Record?</p>
    <p>
      <a href="del_exam.php?id=<?php echo $_GET['id']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="view_exam.php" class="button button--error" data-for="js_success-popup">No</a>
    </p>
  </div>
</div>
<?php } ?>


        <div class="page-wrapper"><style>
@media print {
    button, a, .btn {
        display: none !important;
    }
    body {
        margin: 20px;
    }
}
</style>

            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h2 class="text-primary"> View Exam</h2> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Exam</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <a href="add_exam.php"><button class="btn btn-primary">Add Exam</button></a>
            <button onclick="printTimetable()" class="btn btn-success">Print Timetable</button>


            <div class="table-responsive m-t-40" id="timetableArea">
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
                            <th colspan="1">Course</th>
                            <th colspan="1">Hall</th>
                            <th colspan="1">Invigilator</th>

                            <th colspan="1">Course</th>
                            <th colspan="1">Hall</th>
                            <th colspan="1">Invigilator</th>

                            <th colspan="1">Course</th>
                            <th colspan="1">Hall</th>
                            <th colspan="1">Invigilator</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'connect.php';

                        $sql = "SELECT * FROM `exam` ORDER BY exam_date, start_time";
                        $result = $conn->query($sql);

                        // Group by date > level > time block
                        $grouped = [];

                        while ($row = $result->fetch_assoc()) {
                            $date = $row['exam_date'];
                            $level = strtoupper($row['level'] ?? 'ND I'); // assumes a 'level' column
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
                            $dateLabel = "<strong>DAY $dayCount</strong><br>" . date("d/m/Y", strtotime($date)) . "<br>" . date("l", strtotime($date));
                            $first = true;

                            foreach ($levels as $level => $times) {
                                echo "<tr>";
                                if ($first) {
                                    echo "<td rowspan='$rowspan'>$dateLabel</td>";
                                    $first = false;
                                }
                                echo "<td><strong>$level</strong></td>";

                                foreach (['morning', 'midday', 'afternoon'] as $slot) {
                                    if (isset($times[$slot])) {
                                        $exam = $times[$slot];
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

    <script>
function printTimetable() {
    var printContents = document.getElementById('timetableArea').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // reload to restore events & state
}
</script>
