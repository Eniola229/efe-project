<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php
 include('connect.php');
 date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');

?>

        <div class="page-wrapper">
           
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h2 class="text-primary">Exam Management</h2> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add Exam Management</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-8" style="margin-left: 10%;">
                        <div class="card">
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" action="pages/exam.php" name="userform" enctype="multipart/form-data">
                                    <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Class</label>
                                                <div class="col-sm-9">
                                                    <select type="text" name="class_id" id="class_id" class="form-control" placeholder="Class" required="">
                                                        <option value="">--Select Class--</option>
                                                            <?php  
                                                            $c1 = "SELECT * FROM `tbl_class`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"];?>">
                                                                        <?php echo $row['classname'];?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            } else {
                                                            echo "0 results";
                                                                }
                                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Course Code</label>
                                                <div class="col-sm-9">
                                                    <select type="text" name="Course_Code" id="course_code" class="form-control" placeholder="Course Code" required="">
                                                        <option value="">--Select Course Code--</option>
                                                        <?php  
                                                        $c2 = "SELECT * FROM `tbl_subject`";
                                                        $result2 = $conn->query($c2);

                                                        if ($result2->num_rows > 0) {
                                                            while ($row2 = mysqli_fetch_array($result2)) {?>
                                                                <option value="<?php echo $row2["course_code"];?>" data-id="<?php echo $row2["class_id"];?>" data-title="<?php echo $row2["subjectname"];?>" style="display:none;">
                                                                    <?php echo $row2['course_code'];?>
                                                                </option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Course Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="name" id="course_title" class="form-control" placeholder="Course Title" readonly required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Class Size</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="class_size" id="class_size" class="form-control" placeholder="Number of Students" min="1" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Hall</label>
                                                <div class="col-sm-9">
                                                    <select type="text" name="type_id" id="type_id" class="form-control" placeholder="Hall" required="">
                                                        <option value="">--Select Hall--</option>
                                                            <?php  
                                                            $c1 = "SELECT * FROM `room`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"];?>" data-name="<?php echo $row["name"];?>">
                                                                        <?php echo $row['name'];?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            } else {
                                                            echo "0 results";
                                                                }
                                                            ?>
                                                    </select>
                                                    <input type="hidden" name="hall" id="hall_name" value="">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label"> Date</label>
                                                <div class="col-sm-9">
                                                  <input type="date" name="exam_date" class="form-control" placeholder=" Date" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Start Time</label>
                                                <div class="col-sm-9">
                                                  <input type="time" name="start_time" class="form-control" placeholder=" Start Time" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">End Time</label>
                                                <div class="col-sm-9">
                                                  <input type="time" name="end_time" class="form-control" placeholder=" End Time" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Required Invigilators</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="required_invigilators" id="required_invigilators" class="form-control" readonly>
                                                    <small class="text-muted"><h4>Based on 1:40 ratio</h4></small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Single invigilator case - shown by default but hidden when multiple are needed -->
                                        <div class="form-group" id="single_invigilator_group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Invigilator</label>
                                                <div class="col-sm-9">
                                                    <select name="invigilator_id" id="single_invigilator_id" class="form-control" required>
                                                        <option value="">--Select Invigilator--</option>
                                                        <?php
                                                        $sql = "SELECT * FROM tbl_teacher";
                                                        $result = $conn->query($sql);
                                                        while($row = $result->fetch_assoc()) {
                                                            $fullName = $row['tfname'] . ' ' . $row['tlname'];
                                                            echo "<option value='".$fullName."'>".$fullName."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Multiple invigilators case - hidden by default and shown when needed -->
                                        <div id="multiple_invigilators_container" style="display:none;">
                                            <!-- Academic Invigilators -->
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label">Academic Invigilators</label>
                                                    <div class="col-sm-9">
                                                        <select name="academic_invigilator_id[]" id="academic_invigilator_id" class="form-control" multiple>
                                                            <?php
                                                            // Assuming academic staff are in tbl_teacher
                                                            $sql = "SELECT * FROM tbl_teacher WHERE role = 'academic'"; // You may need to add a column to differentiate academic staff
                                                            $result = $conn->query($sql);
                                                            while($row = $result->fetch_assoc()) {
                                                                $fullName = $row['tfname'] . ' ' . $row['tlname'];
                                                                echo "<option value='".$fullName."'>".$fullName."</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="hidden" name="academic_lecturers" id="academic_invigilator_names" value="">
                                                        <small class="text-muted"><h4>Hold Ctrl key to select multiple academic invigilators</h4></small>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Non-Academic Invigilators -->
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label">Non-Academic Invigilators</label>
                                                    <div class="col-sm-9">
                                                        <select name="non_academic_invigilator_id[]" id="non_academic_invigilator_id" class="form-control" multiple>
                                                            <?php
                                                            // You'll need to add a table for non-academic staff or modify tbl_teacher to include a staff_type column
                                                            // This is a placeholder - adjust the query based on your database structure
                                                            $sql = "SELECT * FROM tbl_teacher WHERE role = 'non-academic'"; // You may need a condition like WHERE staff_type = 'non-academic'
                                                            $result = $conn->query($sql);
                                                            while($row = $result->fetch_assoc()) {
                                                                $fullName = $row['tfname'] . ' ' . $row['tlname'];
                                                                echo "<option value='".$fullName."'>".$fullName."</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="hidden" name="non_academic_lecturers" id="non_academic_invigilator_names" value="">
                                                        <small class="text-muted"><h4>Hold Ctrl key to select multiple non-academic invigilators</h4></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Combined invigilator names for database storage -->
                                        <input type="hidden" name="lecturer" id="combined_invigilator_names" value="">

                                        <button type="submit" name="btn_save" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
        
<?php include('footer.php');?>

<script type="text/javascript">
    // When class is selected, show only relevant course codes
    $('#class_id').change(function(){
        $("#course_code").val('');
        $("#course_title").val('');
        $("#course_code").children('option').hide();
        var class_id = $(this).val();
        $("#course_code").children("option[data-id="+class_id+"]").show();
    });
    
    // When course code is selected, auto-fill the course title
    $('#course_code').change(function(){
        var selected = $(this).find('option:selected');
        var courseTitle = selected.attr('data-title');
        $("#course_title").val(courseTitle);
    });
    
    // Calculate required invigilators based on class size (1:40 ratio)
    // And toggle between single/multiple invigilator selection
    $('#class_size').on('input', function(){
        var classSize = $(this).val();
        var requiredInvigilators = Math.ceil(classSize / 40);
        $('#required_invigilators').val(requiredInvigilators);
        
        // Toggle between single invigilator and multiple invigilators sections
        if(requiredInvigilators > 1) {
            $('#single_invigilator_group').hide();
            $('#single_invigilator_id').prop('required', false);
            $('#multiple_invigilators_container').show();
            
            // Set min selection counts based on required invigilators
            // For simplicity, we'll require at least one academic and the rest can be non-academic
            var academicMin = 1;
            var nonAcademicMin = requiredInvigilators - academicMin;
            
            // You might want to display these requirements to the user
            $('#academic_invigilator_id').attr('data-min', academicMin);
            $('#non_academic_invigilator_id').attr('data-min', nonAcademicMin);
            
        } else {
            $('#single_invigilator_group').show();
            $('#single_invigilator_id').prop('required', true);
            $('#multiple_invigilators_container').hide();
        }
    });
    
    // Store hall name in hidden field
    $('#type_id').change(function(){
        var selected = $(this).find('option:selected');
        var hallName = selected.attr('data-name');
        $("#hall_name").val(hallName);
    });
    
    // Store single invigilator in combined field
    $('#single_invigilator_id').change(function(){
        var invigilatorName = $(this).val();
        $("#combined_invigilator_names").val(invigilatorName);
    });
    
    // Store selected academic invigilator names in hidden field
    $('#academic_invigilator_id').change(function(){
        var invigilatorNames = [];
        $('#academic_invigilator_id option:selected').each(function(){
            invigilatorNames.push($(this).text());
        });
        $("#academic_invigilator_names").val(invigilatorNames.join(', '));
        updateCombinedInvigilators();
    });
    
    // Store selected non-academic invigilator names in hidden field
    $('#non_academic_invigilator_id').change(function(){
        var invigilatorNames = [];
        $('#non_academic_invigilator_id option:selected').each(function(){
            invigilatorNames.push($(this).text());
        });
        $("#non_academic_invigilator_names").val(invigilatorNames.join(', '));
        updateCombinedInvigilators();
    });
    
    // Function to combine academic and non-academic invigilators
    function updateCombinedInvigilators() {
        var academicNames = $("#academic_invigilator_names").val();
        var nonAcademicNames = $("#non_academic_invigilator_names").val();
        
        var combined = "";
        if(academicNames) {
            combined += "Academic: " + academicNames;
        }
        
        if(nonAcademicNames) {
            if(combined) combined += " | ";
            combined += "Non-Academic: " + nonAcademicNames;
        }
        
        $("#combined_invigilator_names").val(combined);
    }
    
    // Form validation to ensure minimum required invigilators are selected
    $('form').submit(function(e){
        var requiredInvigilators = parseInt($('#required_invigilators').val());
        
        if(requiredInvigilators > 1) {
            // Count selected invigilators from both categories
            var academicCount = $('#academic_invigilator_id option:selected').length;
            var nonAcademicCount = $('#non_academic_invigilator_id option:selected').length;
            var totalSelected = academicCount + nonAcademicCount;
            
            // Minimum requirements
            var academicMin = parseInt($('#academic_invigilator_id').attr('data-min'));
            var nonAcademicMin = parseInt($('#non_academic_invigilator_id').attr('data-min'));
            
            if(academicCount < academicMin) {
                alert('Please select at least ' + academicMin + ' academic invigilator(s).');
                e.preventDefault();
                return false;
            }
            
            if(nonAcademicCount < nonAcademicMin) {
                alert('Please select at least ' + nonAcademicMin + ' non-academic invigilator(s).');
                e.preventDefault();
                return false;
            }
            
            if(totalSelected < requiredInvigilators) {
                alert('Please select at least ' + requiredInvigilators + ' invigilators in total.');
                e.preventDefault();
                return false;
            }
        }
    });
</script>