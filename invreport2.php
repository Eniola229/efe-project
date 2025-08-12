
<?php include('head.php');?>
<?php include('header2.php');?>
<?php include('connect.php');?>

<?php include('teacher_sidebar.php');

if(isset($_GET['id']))
{ ?>
  
<?php } ?>

        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> Invigilators For This Exam</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Invigilators</li>
                    </ol>
                </div>
            </div>
            
            <div id='ex' class="container-fluid">
               


<style text='text/stylesheet'>

td{
    padding:10px;
}

th{
    padding:10px;
    font-size:15px;
}


</style>

                 <div  class="card">
      <div class="card-body">
                             
                                <div>
                                    <table border='1' id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th>S/N</th>
                                                <th>Invigilators</th>
                                                <th>Code</th>
                                                <th>Hall</th>
                                                
                                                <th>Date</th>

                                                    <th style="text-align: left;">Time / Period</th> 
                                             
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';
                                    
                             $hal = $_GET['hall'];
                             $exam = $_GET['id'];  
                            $pe = $_GET['period'];

                         

                             $i = 1;
                 $sql2="SELECT * FROM `tbl_generate` WHERE `date`='$exam'  and `hallname` = '$hal'  and `period` = '$pe' ";
                              $t = 0;
                              $result2=$conn->query($sql2);
                                     while($row = $result2->fetch_assoc()) {
                              
                                      ?>
                                            <tr>
                                              <td><?php echo $i++; ?></td>
                                               <td>
                                                   <?php 
                       $te = $row['invigilator'];                                       
                 $s="SELECT * FROM `tbl_teacher` WHERE `id`='$te' ";
                              
                              $re=$conn->query($s);
                                     while($row4 = $re->fetch_assoc()) {



                                                   echo $row4['tfname'].' '.$row4['tlname'];

                                                 }
                              
                                                ?>

                                               </td>
                                                  <td>
                                                  <?php 
                                                   echo $row['code'];
                              
                                                ?>
 </td>
                                                <td><?php echo $hal; ?></td>
                                               
                                                 <td ><?php echo $row['date']; ?></td>
                                               
                                                <td style="text-align: left;"><?php echo $_GET['time'].' ('.$_GET['period'].')'; ?></td>
                                                
                                               
                                            </tr>
                                          <?php } ?>
                                        

                                       

                                          <tr align="center"><td colspan='7' style='text-align:center;'><p> <i class="fa fa-print fa-2x" style="cursor: pointer;" 
                                         OnClick="CallPrint(this.value)" ></i></p></td></tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
               
             
<?php include('footer.php');?>

<script>
function CallPrint(strid) {
var prtContent = document.getElementById("ex");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>
