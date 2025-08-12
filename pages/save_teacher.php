<?php
// Update save_teacher.php to handle staff_id and role fields
include('../connect.php');

// Get form data
$staff_id = $_POST['staff_id'];
$fname = $_POST['tfname'];
$lname = $_POST['tlname'];
$category = $_POST['tcategory'];
$email = $_POST['temail'];
$password = $_POST['password'];
$gender = $_POST['tgender'];
$dob = $_POST['tdob'];
$contact = $_POST['tcontact'];
$role = $_POST['role']; // New field for invigilator role

// First check if staff_id already exists (double-check)
$check_sql = "SELECT COUNT(*) as count FROM tbl_teacher WHERE staff_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $staff_id);
$check_stmt->execute();
$result = $check_stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    // Staff ID already exists, redirect back with error
    echo "<script>
        alert('This Staff ID is already registered. Please use a different ID.');
        window.location.href='../add_teacher.php';
    </script>";
    exit;
}

// Proceed with insertion if staff_id is unique
$sql = "INSERT INTO tbl_teacher(staff_id, tfname, tlname, tcategory, temail, password, tgender, tdob, tcontact, role) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssss", $staff_id, $fname, $lname, $category, $email, $password, $gender, $dob, $contact, $role);

if ($stmt->execute()) {
    echo "<script>
        alert('Teacher record added successfully!');
        window.location.href='../view_teacher.php';
    </script>";
} else {
    echo "<script>
        alert('Error: " . $stmt->error . "');
        window.location.href='../add_teacher.php';
    </script>";
}

$stmt->close();
$conn->close();
?>
