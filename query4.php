<?php

include 'connect.php';


$data = $_POST['dataQuery'];
$table = 'tbl_fal';
$field = 'id';

$sql = "SELECT * FROM $table WHERE $field = '$data' ";
$query = $conn->query($sql);
                            

if (mysqli_num_rows($query) > 0) {
	while($row = $query->fetch_assoc()) { 
        

            echo  $row['code']; 
	
    }

    
}



else{

}

?> 