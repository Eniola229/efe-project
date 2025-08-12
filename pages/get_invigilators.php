<?php
include('../connect.php');
include('../automation_service.php');

$response = ['success' => false, 'message' => '', 'invigilators' => []];

if(isset($_POST['class_size']) && isset($_POST['exam_date'])) {
    $class_size = (int)$_POST['class_size'];
    $exam_date = $_POST['exam_date'];
    
    // Validate exam date
    if(!empty($exam_date) && strtotime($exam_date)) {
        $automation = new InvigilatorAutomationService($conn);
        $invigilators = $automation->selectInvigilatorsBasedOnRatio($class_size);
        
        if(!empty($invigilators)) {
            $response['success'] = true;
            $response['invigilators'] = $invigilators;
        } else {
            $response['message'] = 'No available invigilators found';
        }
    } else {
        $response['message'] = 'Invalid exam date';
    }
} else {
    $response['message'] = 'Missing required parameters';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
