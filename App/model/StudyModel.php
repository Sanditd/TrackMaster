<?php require_once __DIR__ . '/../libraries/database.php';

class StudyModel {
    private $db;
    
    public function __construct() {
        $this->db = new database();
    }
    
    // Fetch study performance data
    public function fetchStudyPerformance() {
        $this->db->query("SELECT student_name, average FROM study_performance");
        return $this->db->resultSet();
    }
    
    public function fetchUpcomingSessions() {
        $this->db->query("SELECT session_name, date FROM sessions WHERE date >= CURDATE() ORDER BY date ASC");
        return $this->db->resultSet();
    }
    
}
?>