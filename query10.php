<?php

include 'connect.php';


$data = $_POST['dataQuery'];
$inv = $_POST['in'];

$table = 'tbl_teacher';
$field = 'id';

$sql = "SELECT * FROM $table WHERE $field = '$inv' ";
$query = $conn->query($sql);
                            
	while($row = $query->fetch_assoc()) { 

        if ($row['assistant'] == 0) {
          echo str_replace('A','', $data);

        }


        if ($row['assistant'] == 1) {

        	if(strpos($data,'A') !== 0){

        	$t = str_replace('A','', $data);
        	$s = 'A'.$t;
            echo str_replace(' ','',$s);



        	}else{

        	$s = 'A'.$data;
            echo str_replace(' ','',$s);
        	}

        
        }
       }

?> 