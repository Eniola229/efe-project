 <?php 
 include('connect.php');
  $sql = "select * from admin where id = '".$_SESSION["id"]."'";
        $result=$conn->query($sql);
        $row1=mysqli_fetch_array($result);
       
            $q = "select * from tbl_permission_role where role_id='".$row1['group_id']."'";
            $ress=$conn->query($q);
           
             $name = array();
            while($row=mysqli_fetch_array($ress)){
            $sql = "select * from tbl_permission where id = '".$row['permission_id']."'";
            $result=$conn->query($sql);
            if(mysqli_num_rows($result) > 0){
                $row2=mysqli_fetch_array($result);
                array_push($name,$row2[1]);
            }
             }
             $_SESSION['name']=$name;
             $useroles=$_SESSION['name'];

 ?>

 
        <div class="left-sidebar">
            
            <div class="scroll-sidebar">
                
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="index.php" aria-expanded="false"><i class="fa fa-window-maximize"></i>Dashboard</a>
                        </li>

                        <?php if(isset($useroles)){  if(in_array("manage_attendence",$useroles)){ ?> 
                         <!-- <li class="nav-label">Attendence</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-clock-o"></i><span class="hide-menu">Attendance Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($useroles)){  if(in_array("add_attendence",$useroles)){ ?> 
                                <li><a href="add_attendence.php">Add Attendance</a></li>
                            <?php } } ?>
                                <li><a href="view_attendence.php">View Attendance</a></li>
                               
                            </ul>
                        </li>
                    <?php } } ?>

                        <?php if(isset($useroles)){  if(in_array("manage_teacher",$useroles)){ ?> 
                         <!-- <li class="nav-label">Teacher</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Lecturer Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($useroles)){  if(in_array("add_teacher",$useroles)){ ?> 
                                <li><a href="add_teacher.php">Add Lecturer </a></li>
                            <?php } } ?>
                                <li><a href="view_teacher.php">View Lecturers</a></li>
                            </ul>
                        </li>
                    <?php } } ?> 

                         

                         <?php if(isset($useroles)){  if(in_array("manage_subject",$useroles)){ ?> 
                         <!-- <li class="nav-label">Subject</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-newspaper-o"></i><span class="hide-menu">Course Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($useroles)){  if(in_array("add_subject",$useroles)){ ?> 
                                <li><a href="add_subject.php">Add Course</a></li>
                            <?php } } ?>
                                <li><a href="view_subject.php">View Courses</a></li>
                            </ul>
                        </li>
                    <?php } } ?>

                      

                    

                     <?php if(isset($useroles)){  if(in_array("manage_class",$useroles)){ ?> 
                         <!-- <li class="nav-label">Class</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Class Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($useroles)){  if(in_array("add_class",$useroles)){ ?> 
                                <li><a href="add_class.php">Add Class</a></li>
                            <?php } } ?>
                                <li><a href="view_class.php">View Classes</a></li>
                            </ul>
                        </li>
                    <?php } } ?>
                    <?php if(isset($useroles)){  if(in_array("manage_exam",$useroles)){ ?> 
                         <!-- <li class="nav-label">Class</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Exam Management</span></a>
                            <ul aria-expanded="false" class="collapse"> 
                                <li><a href="add_roomtype.php">Add Room Type</a></li>
                                <li><a href="view_roomtype.php">View Room Type</a></li>
                                <li><a href="add_room.php">Add Hall</a></li>
                                <li><a href="view_room.php">View Halls</a></li>
                                <li><a href="add_exam.php">Add Exam</a></li>
                                <li><a href="view_exam.php">View Exams</a></li>
                                <li><a href="view_allotment.php">View Allotment</a></li>
                            </ul>
                        </li>
                    <?php } } ?>
                   
                   
                  <?php if(isset($useroles)){  if(in_array("manage_user",$useroles)){ ?> 
                         <li class="nav-label">Users</li> 
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-user-plus"></i><span class="hide-menu">Admin Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($useroles)){  if(in_array("add_user",$useroles)){ ?> 
                                <li><a href="add_user.php">Add Admin</a></li>
                            <?php } } ?>
                                <li><a href="view_user.php">View Admin</a></li>
                            </ul>
                        </li>
                    <?php } } ?>

                    <?php if($_SESSION["username"]=='admin') { ?>


                         
                        <li class="nav-label">Reports</li> 
                        <li>  <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-file"></i><span class="hide-menu">Report Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="today_exam.php">Today's Exam</a></li>
                                <li><a href="report_exam.php">Exam Report</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                   
                     


    
                    </ul>   
                </nav>
                




            </div>
           
        </div>
        