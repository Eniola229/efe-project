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
                    <h3 class="text-primary">Invigilator Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add Invigilator</li>
                    </ol>
                </div>
            </div>
           
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-8" style="    margin-left: 10%;">
                        <div class="card">
                            
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" action="pages/save_inv.php" name="classform" enctype="multipart/form-data">

                                   <input type="hidden" name="currnt_date" class="form-control" value="<?php echo $currnt_date;?>">
                                   

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
                                                                    <option value="<?php echo $row["id"];?>" >
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

                                    <option value="">--Choose Department--</option>
                                                            <?php 
                                                            
                                                            $code= null;
                                                            $c1 = "SELECT * FROM `tbl_dept`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"];?>" >
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
                                                <label class="col-sm-3 control-label">Invigilator Code</label>
                                                <div class="col-sm-9">
         <input type="text" name="code" class="form-control" placeholder="Department code" id="code"  required="" readonly='true'>
                                                </div>
                                            </div>
                                        </div>

                                       
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label"> Choose Invigilator</label>
                                                <div class="col-sm-9">
                                    <select type="text" name="inv" class="form-control" placeholder="invigilator" id="inv" required="">

                                    <option value="">--Choose Invigilator--</option>
                                                            


                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                       
                                        <button type="submit" name="btn_save" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>

<?php include('footer.php');?>



<script type="text/javascript">
      

      $(document).ready(function(){
      
      $('#dept').change(function(){
      
      var form = $('#dept').val();
      
      $.ajax(
      {
            type:'POST',
            url: 'query.php',
            data: {dataQuery:form},
            success: function(data)
      {

               $('#code').val(data);
      }
      ,
      error:function(error){
         $('#code').val(data);
      }
      
      }
      ); } );
      
      
      
      });
      
      
      
      $(document).ready(function(){
      
      $('#dept').change(function(){
      
      var form = $('#dept').val();
      
      $.ajax(
      {
            type:'POST',
            url: 'query5.php',
            data: {dataQuery:form},
            success: function(data)
      {
               $('#inv').html(data);
      }
      ,
      error:function(error){
         $('#inv').html(data);
      }
      
      }
      ); } );
      });
      
   



      $(document).ready(function(){
      
      $('#inv').change(function(){
      
      var form = $('#code').val();
      var inv = $('#inv').val();
      
      $.ajax(
      {
            type:'POST',
            url: 'query10.php',
            data: {dataQuery:form,in:inv},
            success: function(data)
      {
               
               $('#code').val(data);
      }
      ,
      error:function(error){
         $('#code').html(data);
      }
      
      }
      ); } );
      });
          </script>