<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php
 include('connect.php');
 
 $current_date = date('Y-m-d');

?>

        <div class="page-wrapper">
           
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Allotment Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Allotment Invigilators</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-8" style="margin-left: 10%;">
                        <div class="card">
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" action="pages/allotinv.php" name="userform" enctype="multipart/form-data">
            
            
                                    <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Faculty</label>
                                                <div class="col-sm-9">
                                    <select type="text" name="fal" class="form-control" placeholder="Department" id="fal" required="">

                                    <option value="">--Choose Faculty--</option>
                                                            <?php 
                                                            
                                                            $code= null;
                                                            $c1 = "SELECT * FROM `tbl_fal`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"];?>">
                                                                        <?php $code = $row['code']; echo $row['falname'];?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            } else {
                                                            echo "0 results";
                                                                } ?>


                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Department</label>
                                                <div class="col-sm-9">
                                    <select type="text" name="dept" class="form-control" placeholder="Department" id="dept" required="">

                                    <option value="">--Choose Departments--</option>
                                                            <?php 
                                                            
                                                            $code= null;
                                                            $c1 = "SELECT * FROM `tbl_dept`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"];?>">
                                                                        <?php $code = $row['dcode']; echo $row['deptname'];?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            } else {
                                                            echo "0 results";
                                                                } ?>


                                    </select>
                                                </div>
                                            </div>
                                        </div>

            
            
            
            
            <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Hall/Venue</label>
                        <div class="col-sm-9">
                            <select type="text" name="hall" id="hall" class="form-control"   placeholder="Venue" required="">
                                <option value="">--Select Venue--</option>
                                   <?php  
                                    $c1 = "SELECT * FROM `tbl_hall`";
                                    $result = $conn->query($c1);
                                    while ($row = mysqli_fetch_array($result)) {
                                        
                                     ?>
                                             <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['hallname'];?>
                                            </option> 
                                            <?php
                                        }
                                    ?> 
                                       
                                    
                            </select>
                        </div>
                    </div>
                </div>
  
 

                       
                                       <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Period</label>
                                                <div class="col-sm-9">
            <input type="radio" name="period" class=""  value='MORNING' placeholder="MORNING" required> MORNING 

            <input type="radio" name="period" class="" value='AFTERNOON'  placeholder="AFTERNOON" required> AFTERNOON
            
                                                </div>
                                            </div>
                                        </div>

                    <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Allot Invigilator</label>
                        <div class="col-sm-9">
                 <select type="text" name="inv"  class="form-control" id='inv'  placeholder="Invigilator" >
                                <option value="">--Select Invigilator--</option>
                                    <?php  
                                    $c1 = "SELECT * FROM `tbl_inv`";
                                    $result = $conn->query($c1);
                                    while ($row = mysqli_fetch_array($result)) {
                                        
                                     ?>
                                             <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['invcode'];?>
                                            </option> 
                                            <?php
                                        }
                                    ?>  
                            </select>

                            
                        </div>

                        
                    </div>
                    
                    
                </div>



                <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Date</label>
                                                <div class="col-sm-9">
         <input type="date" name="data" class="form-control" placeholder="Date" id="data"  required="">
                                   
         <div  id='error' ></div>
                                    </div>
                                            </div>
                                        </div>



                                        <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
        
<?php include('footer.php');?>


<script type="text/javascript">
      

     // $(document).ready(function(){
      
      //$('#fal').change(function(){
      
      //var form = $('#fal').val();
      
     // $.ajax(
      //{
     //       type:'POST',
     //       url: 'query6.php',
     //       data: {dataQuery:form},
     //       success: function(data)
    //  {

     //          $('#hall').html(data);
    //  }
     // ,
     // error:function(error){
      //   $('#hall').html(data);
     // }
      
    //  }
     // ); } );
     // });



      
      $(document).ready(function(){
      
      $('#fal').change(function(){
      
      var form = $('#fal').val();
      
      $.ajax(
      {
            type:'POST',
            url: 'query9.php',
            data: {dataQuery:form},
            success: function(data)
      {

               $('#dept').html(data);
      }
      ,
      error:function(error){
         $('#dept').html(data);
      }
      
      }
      ); } );
      });
      
      

      $(document).ready(function(){
      
      $('#data').change(function(){
      
      var form = $('#data').val();
      var inv = $('#inv').val();
      
      $.ajax(
      {
            type:'POST',
            url: 'query7.php',
            data: {dataQuery:form,data:inv},
            success: function(data)
      {
               $('#error').html(data);
      }
      ,
      error:function(error){
         $('#error').html(data);
      }
      
      }
      ); } );
      });
      
    
      
</script>