<?php

include 'connect.php';


$data = $_POST['dataQuery'];
$table = 'tbl_teacher';
$field = 'id';

$sql = "SELECT * FROM $table WHERE $field = '$data' ";
$query = $conn->query($sql) ;
                            

if (mysqli_num_rows($query) > 0) {

    
	while($row = $query->fetch_assoc()) { 
        
        echo $row['tfname'].' '.$row['tlname'];

    }

    
}



else{

}

?> 