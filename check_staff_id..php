
<?php
include('../connect.php');

// Check if staff_id parameter is set
if(isset($_POST['staff_id'])) {
    $staff_id = $_POST['staff_id'];
    
    // Prepare a secure query to check if the staff ID exists
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM tbl_teacher WHERE staff_id = ?");
    $stmt->bind_param("s", $staff_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Return JSON response
    header('Content-Type: application/json');
    if($row['count'] > 0) {
        echo json_encode(['exists' => true, 'message' => 'Staff ID already exists']);
    } else {
        echo json_encode(['exists' => false, 'message' => 'Staff ID is available']);
    }
    
    $stmt->close();
} else {
    // Return error if staff_id is not provided
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Staff ID parameter is missing']);
}
?>
