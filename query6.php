<?php

include 'connect.php';


$data = $_POST['dataQuery'];
$table = 'tbl_hall';
$field = 'fal';

$sql = "SELECT * FROM $table WHERE $field = '$data' ";
$query = $conn->query($sql);
                            

if (mysqli_num_rows($query) > 0) {


	while($row = $query->fetch_assoc()) { 


        echo '<option value = '.$row['id'].'>'.$row['hallname'].'</option>';

    }

    
}



else{

}

?> 