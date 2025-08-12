<?php

include 'connect.php';


$data = $_POST['dataQuery'];
$table = 'tbl_dept';
$field = 'id';

$sql = "SELECT * FROM $table WHERE $field = '$data' ";
$query = $conn->query($sql);
                            

if (mysqli_num_rows($query) > 0) {
	while($row = $query->fetch_assoc()) { 
        
        ch:

        $inv = $row['dcode'].'-'.mt_rand(0000,0150);

        $sql1 = "SELECT * FROM tbl_inv WHERE invcode = '$inv' ";
        $query1 = $conn->query($sql1);
        if (mysqli_num_rows($query1) > 0) {

            goto ch;
	
        }else {

            echo  $row['dcode'].'-'.mt_rand(0000,0150); 
        }

    }

    
}



else{

}

?> 