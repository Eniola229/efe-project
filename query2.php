<?php

include 'connect.php';


$data = $_POST['dataQuery'];
$table = 'tbl_teacher';
$field = 'dept';

$sql = "SELECT * FROM $table WHERE $field = '$data' ";
$query = $conn->query($sql);
                            

if (mysqli_num_rows($query) > 0) {

    echo '<option value="">--Choose Invigilator--</option>';
	while($row = $query->fetch_assoc()) { 

$sql2 = "SELECT * FROM tbl_inv WHERE invigilator = '$data' ";
$query2 = $conn->query($sql2);
if (mysqli_num_rows($query2) == 0) {              
        echo '<option value = '.$row['id'].'>'.$row['tfname'].' '.$row['tlname'].'</option>';
}else{

}
    }

    
}



else{

}

?> 