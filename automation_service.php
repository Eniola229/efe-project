<?php
class InvigilatorAutomationService {
    private $conn;
    
    public function __construct($connection) {
        $this->conn = $connection;
    }
    
    /**
     * Select invigilators based on student count (1:40 ratio)
     * @param int $student_count Number of students
     * @return array Selected invigilator IDs
     */
    public function selectInvigilatorsBasedOnRatio($student_count) {
        // Calculate number of invigilators needed
        $invigilators_needed = ceil($student_count / 40);
        
        // Get available invigilators (prioritize those who haven't been assigned recently)
        $invigilators = $this->getAvailableInvigilators($invigilators_needed);
        
        return $invigilators;
    }
    
    /**
     * Get available invigilators from database
     * @param int $count Number of invigilators needed
     * @return array Selected invigilator IDs
     */
    public function getAvailableInvigilators($count) {
        // Get current date
        $today = date('Y-m-d');
        
        // First try to get invigilators who haven't been assigned in the last 3 days
        $sql = "SELECT t.id, t.tfname, t.tlname, MAX(a.added_date) as last_assignment 
                FROM tbl_teacher t
                LEFT JOIN allot a ON t.id = a.invigilator1
                GROUP BY t.id
                HAVING last_assignment IS NULL OR last_assignment < DATE_SUB('$today', INTERVAL 3 DAY)
                ORDER BY last_assignment ASC, RAND()
                LIMIT $count";
        
        $result = $this->conn->query($sql);
        
        $selected_invigilators = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $selected_invigilators[] = [
                    'id' => $row['id'],
                    'name' => $row['tfname'] . ' ' . $row['tlname']
                ];
            }
        }
        
        // If we don't have enough, get additional invigilators
        if (count($selected_invigilators) < $count) {
            $needed = $count - count($selected_invigilators);
            $existing_ids = array_column($selected_invigilators, 'id');
            $exclude_list = !empty($existing_ids) ? "AND t.id NOT IN (" . implode(',', $existing_ids) . ")" : "";
            
            $sql = "SELECT t.id, t.tfname, t.tlname, 
                    (SELECT COUNT(*) FROM allot WHERE invigilator1 = t.id AND 
                     added_date BETWEEN DATE_SUB('$today', INTERVAL 2 DAY) AND '$today') as recent_assignments
                    FROM tbl_teacher t
                    WHERE 1=1 $exclude_list
                    ORDER BY recent_assignments ASC, RAND()
                    LIMIT $needed";
            
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $selected_invigilators[] = [
                        'id' => $row['id'],
                        'name' => $row['tfname'] . ' ' . $row['tlname']
                    ];
                }
            }
        }
        
        return $selected_invigilators;
    }
    
    /**
     * Check if an invigilator follows the two-days-on, one-day-off pattern
     * @param int $invigilator_id Invigilator ID
     * @param string $exam_date Exam date
     * @return bool True if eligible, false otherwise
     */
    public function checkInvigilatorEligibility($invigilator_id, $exam_date) {
        // Check if invigilator has been assigned for 2 consecutive days before exam_date
        $sql = "SELECT COUNT(DISTINCT added_date) as consecutive_days
                FROM allot 
                WHERE invigilator1 = $invigilator_id
                AND added_date BETWEEN DATE_SUB('$exam_date', INTERVAL 2 DAY) AND DATE_SUB('$exam_date', INTERVAL 1 DAY)";
        
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        
        // If invigilator has been assigned for 2 consecutive days, they need a day off
        if ($row['consecutive_days'] >= 2) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Select invigilators with specified roles (academic/non-academic)
     * @param string $role Role type
     * @param int $count Number needed
     * @return array Selected invigilators
     */
    public function selectInvigilatorsByRole($role, $count) {
        // Assuming role is stored in tbl_teacher or a related table
        $role_condition = ($role === 'academic') ? "t.role = 'academic'" : "t.role = 'non-academic'";
        
        $sql = "SELECT t.id, t.tfname, t.tlname
                FROM tbl_teacher t
                WHERE $role_condition
                ORDER BY RAND()
                LIMIT $count";
        
        $result = $this->conn->query($sql);
        $selected = [];
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $selected[] = [
                    'id' => $row['id'],
                    'name' => $row['tfname'] . ' ' . $row['tlname']
                ];
            }
        }
        
        return $selected;
    }
}
?>
