<?php
// This file fetches courses based on class ID
include('connect.php');

// Check if class_id is provided
if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
    
    // Query to get courses for the selected class
    $sql = "SELECT * FROM tbl_subject WHERE class_id = '$class_id'";
    $result = $conn->query($sql);
    
    $courses = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courses[] = array(
                "code" => $row['subject_code'],
                "title" => $row['subject_name']
            );
        }
    }
    
    // Return courses as JSON
    header('Content-Type: application/json');
    echo json_encode($courses);
} else {
    // No class_id provided
    echo "[]";
}
?>