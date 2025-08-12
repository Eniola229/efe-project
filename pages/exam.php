<?php
include('../connect.php');

if(isset($_POST['btn_save'])) {
    extract($_POST);
    
    // Get the hall name from the hidden field
    $hall_name = $_POST['hall'];
    
    // Get invigilator names from the hidden field
    $invigilator_names = $_POST['lecturer'];
    
    // Get class size
    $class_size = $_POST['class_size'];
    
    // Insert the exam with hall name, class size, and invigilator names
    $sql = "INSERT INTO `exam` 
            (`exam_date`, `Course_Code`, `name`, `start_time`, `end_time`, `hall`, `class_size`, `lecturer`) 
            VALUES 
            ('$exam_date', '$Course_Code', '$name', '$start_time', '$end_time', '$hall_name', '$class_size', '$invigilator_names')";
    
    $result = $conn->query($sql);
    
    if($result) {
        $_SESSION['success'] = "Exam added successfully";
        header("location:../view_exam.php");
    } else {
        $_SESSION['error'] = "Failed to add exam: " . $conn->error;
        header("location:../add_exam.php");
    }
}
?>