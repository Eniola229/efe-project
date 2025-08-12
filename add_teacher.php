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
                    <h2 class="text-primary">Lecturer Management</h2> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add Lecturer</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-8" style="margin-left: 10%;">
                        <div class="card">
                            <div class="card-title">
                               
                            </div>
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" action="pages/save_teacher.php" name="teacherform" enctype="multipart/form-data" id="teacherForm">

                                   <input type="hidden" name="currnt_date" class="form-control" value="<?php echo $currnt_date;?>">


                                   <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Staff ID</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="staff_id" class="form-control" placeholder="Staff ID" id="staff_id" required="">
                                                  <div id="staff_id_result" style="margin-top: 5px;"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">First Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="tfname" class="form-control" placeholder="First Name" id="event" onkeydown="return alphaOnly(event);" required="">
                                                </div>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Last Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text"  name="tlname" id="lname" class="form-control" id="event" onkeydown="return alphaOnly(event);" placeholder="Last Name" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Category</label>
                                                <div class="col-sm-9">
                                                   <select name="tcategory" id="category" class="form-control" required="">
                                                    <option value="">--Select Category--</option>
                                                     <option value="ChiefLecturer">Chief Lecturer</option>
                                                      <option value="SeniorLecturer">Senior Lecturer</option>
                                                      <option value="AssistantLecturer">Assistant Lecturer</option>
                                                      <option value="Technologist">Technologist</option>
                                                      <option value="Non-Lecturer">Non-Lecturer</option>

                                                   </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Staff Role</label>
                                                <div class="col-sm-9">
                                                    <select name="role" class="form-control" required>
                                                        <option value="academic">Academic Staff</option>
                                                        <option value="non-academic">Non-Academic Staff</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                       

                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="temail" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  placeholder="Email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="password" id="password" placeholder="Password"  onkeyup='check();'  class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Confirm Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="cpassword" id="confirm_password" placeholder="Confirm Password"  onkeyup='check();'  class="form-control" required>
                                                    <span id="message"></span>
                                                </div>
                                            </div>
                                        </div>

                                       
                                          <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Gender</label>
                                                <div class="col-sm-9">
                                                   <select name="tgender" id="gender" class="form-control" required="">
                                                    <option value="">--Select Gender--</option>
                                                     <option value="Male">Male</option>
                                                      <option value="Female">Female</option>
                                                   </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                              <div class="row">
                                                <label class="col-sm-3 control-label">Date Of Birth</label>
                                                <div class="col-sm-9">
                                                  <input type="date" name="tdob" class="form-control" placeholder="Birth Date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Contact</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="tcontact" class="form-control" placeholder="Contact Number" id="tbNumbers" minlength="11" maxlength="11" onkeypress="javascript:return isNumber(event)" required="">
                                                </div>
                                            </div>
                                        </div>

                                       
                                        <button type="submit" name="btn_save" id="submitBtn" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
               

<?php include('footer.php');?>
<script>
// Password validation
var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'NOT Matching';
  }
}

// Staff ID validation
$(document).ready(function(){
    var staffIdValid = false;
    
    // Check staff ID as the user types
    $("#staff_id").keyup(function(){
        var staff_id = $(this).val().trim();
        
        if(staff_id != ''){
            // Delay the check slightly to avoid too many requests
            clearTimeout($.data(this, 'timer'));
            var wait = setTimeout(function(){
                $.ajax({
                    type: "POST",
                    url: "check_staff_id.php",
                    data: {staff_id: staff_id},
                    success: function(response){
                        if(response == "exists"){
                            $("#staff_id_result").html("<span style='color:red'>This Staff ID is already taken</span>");
                            staffIdValid = false;
                        }else{
                            $("#staff_id_result").html("<span style='color:green'>Staff ID is available</span>");
                            staffIdValid = true;
                        }
                    }
                });
            }, 500);
            $(this).data('timer', wait);
        } else {
            $("#staff_id_result").html("");
        }
    });
    
   
});
</script>
<script type="text/javascript">
 $('#class_id').change(function(){
    $("#subject_id").val('');
    $("#subject_id").children('option').hide();
    var class_id=$(this).val();
    $("#subject_id").children("option[data-id="+class_id+ "]").show();
    
  });
  
function alphaOnly(event) {
    var key = event.keyCode;
    return ((key >= 65 && key <= 90) || key == 8 || key == 32);
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
