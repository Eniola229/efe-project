<?php

include 'connect.php';


$data = $_POST['dataQuery'];
$inv = $_POST['data'];

$table = 'tbl_allot';
$field = 'data';

$sql = "SELECT * FROM $table WHERE $field = '$data' and invcode = '$inv' ";
$query = $conn->query($sql);
                            

if (mysqli_num_rows($query) > 0) {

    echo '<b style="color:red;">Invigilator already scheduled for this date</b>';

    ?>
<script  type="text/javascript">
  $(document).ready(function(){


$('#btn_save').attr('disabled',true);


  });


</script>

    <?php
    
}



else{


    ?>
<script  type="text/javascript">
  $(document).ready(function(){


$('#btn_save').attr('disabled',false);


  });


</script>


    <?php

}

?> 